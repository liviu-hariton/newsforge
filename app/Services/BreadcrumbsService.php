<?php

namespace App\Services;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class BreadcrumbsService
{
    public function render($breadcrumbs): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('frontend.components.breadcrumbs', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }
}
