<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactForm;
use App\Models\ContactOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ContactController extends Controller
{
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

    public function store(Request $request)
    {
        dd($request->all());
    }
}
