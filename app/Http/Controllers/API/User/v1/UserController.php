<?php

namespace PaladinsNinja\Http\Controllers\API\User\v1;

use Illuminate\Http\Request;
use PaladinsNinja\Http\Controllers\Controller;
use GuzzleHttp\Client;

class UserController extends Controller
{
    public function storeHiRezLink(Request $request)
    {
        $client = new Client();

        $form = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if ($request->has('code') && $request->code != null) {
            $form = array_add($form, 'code', $request->code);
        }

        $responseOpts = $client->request('OPTIONS', 'https://api.hirezstudios.com/acct/login', [
            'json' => $form,
        ]);

        $response = $client->request('POST', 'https://api.hirezstudios.com/acct/login', [
            'json' => $form,
        ]);

        $body = json_decode($response->getBody());

        if (isset($body->statusCode) && $body->statusCode == 403) {
            $form = array_add($form, 'need2fa', true);
            return response()->json($form);
        }

        if ($body->userInfo->banned) {
            return response()->json([
                'errors' => ['The Hi-Rez account you are attempting log in to has been banned.']
            ]);
        }

        $paladinsGame = array_first($body->userInfo->games, function($value, $key) {
            return $value->game == 'Paladins';
        }, null);

        if ($paladinsGame == null) {
            return response()->json([
                'errors' => ['The Hi-Rez account you are attempting to log in to does not have a Paladins account.']
            ]);
        }

        if (\PaladinsNinja\Models\User::where([
            ['hirez_account_id', $body->userInfo->accountId],
            ['paladins_player_id', $paladinsGame->playerId]
        ])->exists()) {
            return response()->json([
                'errors' => ['The account you are trying to link has already been attached to another account.']
            ]);
        }

        \PaladinsNinja\Models\User::where('email', $request->user()->email)->firstOrFail()->update([
            'hirez_account_id' => $body->userInfo->accountId,
            'paladins_player_id' => $paladinsGame->playerId,
            'linked_hirez_at' => now(),
        ]);

        return response()->json([
            'connected' => true,
        ]);
    }
}
