<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function set_locale($locale)
    {
        // menyimpan session put untuk menyimpan locale dalam session dengan nama locale
        Session::put('locale', $locale);
        return Redirect::back();
    }
}
