<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\ContactLabel;
use App\Traits\FileDelete;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    use FileDelete;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.contact.index', [
            'contacts' => Contact::with('labels')->orderBy('created_at', 'desc')->paginate(15)
        ]);
    }

    public function createContactLabel(Request $request)
    {
        // A custom Request class is not used in this case because we need to
        // redirect the user back to the settings page with the modal form open
        // (a custom flash session variable is used for this)
        $validator = validator(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'color' => 'required|string',
            ]
        );

        if($validator->fails()) {
            session()->flash('open-new-contact-label-modal');

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        $user = auth()->user();

        $user->contactLabels()->save(
            new ContactLabel($validated)
        );

        return redirect()->route('admin.contact.index')->with('success', 'Contact label created successfully');
    }

    private function parseLabels($contact_id)
    {
        $output = '';

        $user_labels_for_contact = auth()->user()->contactLabels()
            ->whereHas('contacts', function ($query) use ($contact_id) {
                $query->where('contact_id', $contact_id);
            })
            ->get();

        foreach($user_labels_for_contact as $user_label_for_contact) {
            $output .= view('backend.contact.blocks.label', [
                'label' => $user_label_for_contact
            ])->render();
        }

        return $output;
    }

    public function setContactFormLabel(Request $request)
    {
        $contact = Contact::find($request->form_id);

        if(!$contact) {
            return response([
                'status' => 'error',
                'message' => 'The contact form ['.$request->form_id.'] does not exists'
            ]);
        }

        $labels_ids = is_array($request->label_id) ? $request->label_id : [$request->label_id];

        if(!$contact->labels()->whereIn('contact_label.contact_label_id', $labels_ids)->where('contact_label.user_id', auth()->user()->id)->exists()) {
            // Alternatively, we can use syncWithoutDetaching() here but we'll stick with manual verification for now.
            // See https://olegkreimerpublished.medium.com/laravel-sync-relationship-method-a-word-of-caution-300eece787a6
            $contact->labels()->attach($labels_ids, ['user_id' => auth()->user()->id]);
        } else {
            $contact->labels()->detach($labels_ids);
        }

        return response([
            'status' => 'success',
            'message' => 'Labels were updated successfully!',
            'labels' => $this->parseLabels($request->form_id)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return view('backend.contact.show', [
            'contact' => $contact
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Contact $contact)
    {
        // delete attachments, if any
        if(!in_array(SoftDeletes::class, class_uses($contact::class))) {
            if($contact->attachments) {
                foreach($contact->attachments as $attachment) {
                    $this->deleteFile($attachment, 'public');
                }
            }
        }

        // delete the associated details
        $contact->replies()->delete();
        $contact->labels()->delete();
        $contact->history()->delete();

        $contact->delete();

        if($request->input('redirect')) {
            // set a confirmation message in case of deleting with redirect (via Ajax)
            session()->flash('success', 'Submitted contact form data deleted successfully');
        } else {
            return response([
                'status' => 'success',
                'message' => 'Submitted contact form data deleted successfully'
            ]);
        }

        return true;
    }
}
