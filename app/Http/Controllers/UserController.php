<?php

namespace PaladinsNinja\Http\Controllers;

use Illuminate\Http\Request;
use PaladinsNinja\Models\User;

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

    public function show(User $user)
    {
        return view('user.show', [
            'user' => $user,
            'pageTitle' => properize($user->username) . ' Profile'
        ]);
    }
}
