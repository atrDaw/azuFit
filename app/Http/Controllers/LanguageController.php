<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller {

    public function switchLanguage($locale) {
        $supportedLocales = ['es', 'en', 'va'];
        if (in_array($locale, $supportedLocales)) {
            session()->put('locale', $locale);
        }
        return redirect()->back();
    }
}
