<?php
namespace Foodsharing\TranslationManager\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\URL;

class LocaleController extends Controller
{
    /*
     * set the currenten locale and redirect back
     * to previous page
     */
    public function setLocale($locale)
    {
        if(in_array($locale, config('translation-manager.locales')))
        {
            session(['locale' => $locale]);
            \App::setLocale($locale);
        }

        /*
         * prevent redirect loop
         */
        if(strpos(URL::previous(),'translate/') === false)
        {
            return redirect()->back();
        }

        return redirect('/');
    }
}