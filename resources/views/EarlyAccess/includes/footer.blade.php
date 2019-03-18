<section id="footer" class="footer-section mt-5 shadow-lg">
    <div class="container">
        <div class="row text-center text-xs-center text-sm-left text-md-left">
            <div class="col-xs-12 col-sm-4 col-md-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled quick-links ml-2">
                    <li>
                        <a href="#" data-toggle="modal" data-target="#siteThemeSwitcher">
                            <i class="fa fa-angle-right"></i> Theme Switcher
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/') }}">
                            <i class="fa fa-angle-right"></i> Home
                        </a>
                    </li>

                    <li>
                        <a href="https://help.paladins.ninja/" target="_blank" rel="noopener noreferrer">
                            <i class="fa fa-angle-right"></i> Help Desk
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('champion.index') }}">
                            <i class="fa fa-angle-right"></i> Champions
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4">
                <h5>Connect with Us</h5>
                <ul class="list-unstyled quick-links ml-2">
                    <li>
                        <a href="https://discord.gg/C6zQ6Yj" target="_blank" rel="noopener noreferrer">
                            <i class="fab fa-discord mr-1"></i> Discord
                        </a>
                    </li>

                    <li>
                        <a href="https://twitter.com/Paladins_Ninja" target="_blank" rel="noopener noreferrer">
                            <i class="fab fa-twitter mr-1"></i> Twitter
                        </a>
                    </li>

                    <li>
                        <a href="https://twitch.tv/PaladinsNinjaTTV" target="_blank" rel="noopener noreferrer">
                            <i class="fab fa-twitch mr-1"></i> Twitch
                        </a>
                    </li>

                    <li>
                        <a href="mailto:supprot@paladins.ninja" target="_blank" rel="noopener noreferrer">
                            <i class="fa fa-envelope mr-1"></i> Email
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4">
                <h5>Other Resources</h5>
                <ul class="list-unstyled quick-links ml-2">
                    <li>
                        <a href="{{ route('developer.index') }}">
                            <i class="fa fa-angle-right"></i> Developers
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 text-center text-white">
                <p>
                    &copy; {{ date('Y') }} Paladins Ninja & <a href="https://halfpetal.com" target="_blank" rel="noopener noreferrer">Halfpetal LLC</a>. All Rights Reserved.
                <p>
                <p>
                    Raw data licensed from Hi-Rez Studios​®. <br/>
                    Hi-Rez Studios​® is a trademark or registered trademark of Hi-Rez Studios, Inc. in the United States and other countries. <br/>
                    Paladins™ is a trademark of Hi-Rez Studios, Inc. in the United States and other countries.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="siteThemeSwitcher" tabindex="-1" role="dialog" aria-labelledby="siteThemeSwitcherLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="siteThemeSwitcherLabel">Change Site Theme</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body row mr-3 text-center">
                <form class="col-6 mb-3" method="POST" action="{{ route('theme.remove') }}">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button class="btn btn-outline-primary" type="submit">
                        Remove Custom Theme
                    </button>
                </form>

                @foreach (['cerulean', 'cosmo', 'cyborg', 'darkly', 'flatly', 'journal',
                'litera', 'lumen', 'lux', 'materia', 'minty', 'pulse', 'sandstone', 'simplex',
                'sketchy', 'slate', 'solar', 'spacelab', 'superhero', 'united', 'yeti'] as
                $theme)
                <form class="col-6 mb-3" method="POST" action="{{ route('theme.change', ['theme' => $theme]) }}">
                    {{ csrf_field() }}
                    <button class="btn btn-outline-primary" type="submit">
                        Switch to {{ title_case($theme) }}
                    </button>
                </form>
                @endforeach
            </div>
        </div>
    </div>
</div>