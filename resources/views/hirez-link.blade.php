@extends('layouts.app')

@section('content')
<div class="container">
    <div class="alert alert-info row" role="alert">
        <i class="fa fa-info-circle fa-6x col-1"></i>
        <div class="col">
            Linking your Hi-Rez account is a one-time thing. We do not retain any usernames or passwords. We only take two pieces of information from your account which are Hi-Rez account id and your Paladins player id. <br/>
            Why do we need this information? Multiple features that are currently on the site, or in development, require you to have a Paladins account. This helps us prevent trolls and also gives us more flexibility on the site and improves your overall experience. <br/>
            Why do you need to disable 2FA? 2FA messes up from time to time for Hi-Rez. We're trying to make our side account for it however we can't do that 100% of the time. To make things easier, we're just requiring that users disable it during this process. Once we save this info, you're free to re-enable it as you please.<br/><br/>

            If you have any, real, concerns please feel free to contact us directly to discuss anything. We can provide snippets of our code that are related to this process. In short: you type your info here and submit it, we contact their website and ensure it's valid, we ask for your 2FA code (if needed), get the info from the JSON response on the login request.
        </div>
    </div>

    <hi-rez-link></hi-rez-link>
</div>
@endsection