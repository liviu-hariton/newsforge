<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact.index', [
            'breadcrumbs' => ['Contact']
        ]);
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
