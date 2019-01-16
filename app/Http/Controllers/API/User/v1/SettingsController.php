<?php

namespace PaladinsNinja\Http\Controllers\API\User\v1;

use Illuminate\Http\Request;
use PaladinsNinja\Http\Controllers\Controller;
use PaladinsNinja\Http\Requests\ChangeUserPasswordRequest;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'hirez_link']);
    }

    public function changePassword(ChangeUserPasswordRequest $request)
    {
        if (!\Hash::check($request->current_password, $request->user()->password)) {
            return apiErrorResponse('The current password does not match the password in our system');
        }

        if ($request->current_password == $request->new_password) {
            return apiErrorResponse('The new password can not be the same as the old one.');
        }

        $request->user()->update([
            'password' => bcrypt($request->new_password)
        ]);

        return response()->json([
            'message' => 'Password has been changed.'
        ]);
    }
}
