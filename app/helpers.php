<?php

// return a site specific setting value from the config
function _tnrs(string $key): string|null
{
    return config('_tnrs')[$key] ?? null;
}
