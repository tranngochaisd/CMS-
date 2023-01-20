<?php

namespace App\Http\Controllers;


//<!-- Dieu kien language -->


class LocalizationController extends Controller
{
    
    // public function __invoke($language = 'en')
    // {
    //     request()-> session()->put('locale',$language);
    //     return redirect()-> back();
    // }

    public function switch($language = 'en'){
        request()-> session()->put('locale',$language);
        return redirect()-> back();
    }
   
}
