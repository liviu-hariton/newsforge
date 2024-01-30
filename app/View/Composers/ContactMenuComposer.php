<?php

namespace App\View\Composers;

use App\Models\Contact;
use App\Models\ContactLabel;
use Illuminate\View\View;

class ContactMenuComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('unread_contacts_count', Contact::where('is_read', false)->count());
        $view->with('contact_labels', ContactLabel::where('user_id', auth()->user()->id)->get());
    }
}
