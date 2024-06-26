<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ContactRequest;
use App\Jobs\SendContactAdminNotify;
use App\Jobs\SendContactCopy;
use App\Mail\ContactCopy;
use App\Models\Contact;
use App\Models\ContactForm;
use App\Models\ContactOption;
use App\Models\User;
use App\Notifications\NewContact;
use App\Services\FormService;
use App\Traits\FileDelete;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    use FileDelete;

    public function __construct(private readonly FormService $formService){}

    public function index()
    {
        $contact_methods = Cache::rememberForever(ContactOption::$cache_key, function () {
            return ContactOption::where('active', 1)->with('type')->orderBy('sort_order')->get();
        });

        $contact_form_fields = Cache::rememberForever(ContactForm::$cache_key, function () {
            return ContactForm::where('active', 1)->with('type')->orderBy('sort_order')->get();
        });

        return view('frontend.contact.index', [
            'breadcrumbs' => ['Contact'],
            'contact_methods' => $contact_methods,
            'contact_form_fields' => $contact_form_fields
        ]);
    }

    public function store(ContactRequest $request, Contact $contact)
    {
        $validated = $request->validated();

        $contact_data['from_name'] = $this->formService->setFieldValue($validated, 'contact_from_name');
        $contact_data['from_email'] = $this->formService->setFieldValue($validated, 'contact_from_email');
        $contact_data['subject'] = $this->formService->setFieldValue($validated, 'contact_subject');
        $contact_data['message'] = $this->formService->setFieldValue($validated, 'contact_message');
        $contact_data['headers'] = $this->formService->setFieldValue($validated, 'contact_headers');

        // Handle attachments uploads, if any
        $attachments = [];

        foreach($request->file() as $file_field=>$file) {
            $attachments[] = $this->uploadFile($request, $file_field, 'uploads/contacts', 'public');
        }

        if(count($attachments) > 0) {
            $contact_data['attachments'] = $attachments;
        }

        $contact_data['ipv4'] = $request->ip();

        // Create a new contact record
        $contact_entry = $contact->create($contact_data);

        // notify admin via email and Notification system
        $this->sendNotifications($contact_entry);

        if(_tnrs('send_contact_copy')) {
            $this->sendCopy($contact_entry);
        }

        return redirect()->route('contact')->with('success', 'Your message has been sent successfully.');
    }

    public function sendNotifications(Contact $contact)
    {
        /**
         * Get all the admin users
         *
         * @todo Update this with roles and permissions functionality (who is allowed to receive what?)
         */
        $admin_users = User::whereHas('roles', function($query) {
            $query->where('name', 'admin');
        })->get();

        // notify everyone
        Notification::send($admin_users, new NewContact($contact));

        // email each user
        foreach($admin_users as $admin_user) {
            dispatch(new SendContactAdminNotify($admin_user, $contact));
        }
    }

    /**
     * Send a copy to the user, if the option is enabled
     *
     * @param Contact $contact_entry
     * @return void
     */
    public function sendCopy(Contact $contact_entry)
    {
        dispatch(new SendContactCopy($contact_entry));
    }
}
