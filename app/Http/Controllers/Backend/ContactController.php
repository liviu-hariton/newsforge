<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\ContactLabel;
use App\Traits\FileDelete;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    use FileDelete;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.contact.index', [
            'contacts' => Contact::with('labels')->orderBy('created_at', 'desc')->simplePaginate(15)
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
            // set a confirmation massage in case of deleting with redirect (via Ajax)
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
