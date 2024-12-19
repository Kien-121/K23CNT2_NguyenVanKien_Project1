<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NVK_QUAN_TRIController extends Controller
{
    //login 
    public function nvkLogin(){
        return view('NvkLogin.nvk.login');
    }

    public function nvkLoginSubmit(Request $REQUEST){
        return view('NvkLogin.nvk.login');
    }
}
