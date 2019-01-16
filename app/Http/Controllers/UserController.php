<?php

namespace PaladinsNinja\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['hirez_link'])->except('getHirezLink');
    }

    public function getHirezLink()
    {
        return view('hirez-link');
    }

    public function getSettings()
    {
        return view('user.settings', [
           'pageTitle' => 'My Settings' 
        ]);
    }
}
