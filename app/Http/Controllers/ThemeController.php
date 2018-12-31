<?php

namespace PaladinsNinja\Http\Controllers;

use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function set(Request $request, $theme)
    {
        $themes = ['cerulean', 'cosmo', 'cyborg', 'darkly', 'flatly', 'journal', 'litera', 'lumen', 'lux', 'materia', 'minty', 'pulse', 'sandstone', 'simplex', 'sketchy', 'slate', 'solar', 'spacelab', 'superhero', 'united', 'yeti'];

        if (!in_array($theme, $themes)) {
            return abort(404);
        }
            
        $request->session()->put('user.theme', $theme);

        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $request->session()->forget('user.theme');

        return redirect()->back();
    }
}
