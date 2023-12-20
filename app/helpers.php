<?php

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

/**
 * Return a site specific setting value from the config
 *
 * @param string $key
 * @return string|null
 */
function _tnrs(string $key): string|null
{
    return config('_tnrs')->$key ?? null;
}

/**
 * Check if the current route matches any of the given route items
 * and return true if there's a match.
 *
 * @param array $routes array of routes names to compare against the current route
 * @return bool
 */
function menuItemActive(array $routes): bool
{
    foreach($routes as $route) {
        if(request()->routeIs($route)) {
            return true;
        }
    }

    return false;
}

/**
 * Return a formatted alert message
 *
 * @param string $message
 * @param string $type possible values: primary, secondary, success, danger, warning, info, light, dark
 * @param string $icon icons from https://icons.getbootstrap.com/
 * @param bool $dismissible
 * @param bool $outlined
 * @return \Illuminate\Contracts\View\View|Application|Factory|\Illuminate\Contracts\Foundation\Application
 */
function tnrAlert(
    string $message = '',
    string $type = 'success',
    string $icon = 'bi-check-square-fill',
    bool $dismissible = false,
    bool $outlined = false
): \Illuminate\Contracts\View\View|Application|Factory|\Illuminate\Contracts\Foundation\Application
{
    return view('backend.components.alert', [
        'message' => $message,
        'type' => $type,
        'icon' => $icon,
        'dismissible' => $dismissible,
        'outlined' => $outlined,
    ]);
}
