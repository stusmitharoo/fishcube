<div>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
        <div class="row">
            <div class="logo-box">
                <a href="{{ url('/') }}">
                <img class="img-responsive image image-corners" src="/images/index/logosmalldark.jpg">
                </a>
            </div>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

           <div class="collapse navbar-collapse" id="app-navbar-collapse">
               
                <!-- Left Side Of Navbar -->
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-left margin-s">
                    <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}" class="margin-ls margin-bs">Login</a></li>
                    <li><a href="{{ route('register') }}" class="margin-ls margin-bs">Register</a></li>
                    <li><a href="{{ route('report.choice') }}" class="margin-ls">Reports</a></li>
                @else
                    <li><a class="margin-rs" href="{{ route('report.choice') }}">Reports</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle margin-rs" data-toggle="dropdown" role="button" aria-expanded="false">Gallery <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('gallery.choice') }}">Create a gallery</a>
                            </li>
                            <li>
                                <a href="{{ route('gallery.view.choice') }}">Search for gallery</a>
                            </li>
                            <li>
                                <a href="{{ route('gallery.list.choice') }}">List your gallery</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle margin-rs" data-toggle="dropdown" role="button" aria-expanded="false">Blog <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('blog.choice') }}">Create a blog</a>
                            </li>
                            <li>
                                <a href="{{ route('blog.view.choice') }}">Search for blogs</a>
                            </li>
                            <li>
                                <a href="{{ route('blog.list.choice') }}">List your blogs</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle margin-rs" data-toggle="dropdown" role="button" aria-expanded="false">Video <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('video.choice') }}">Create a video</a>
                            </li>
                            <li>
                                <a href="{{ route('video.views.choice') }}">Search for videos</a>
                            </li>
                            <li>
                                <a href="{{ route('video.listChoice') }}">List your videos</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle margin-rs" data-toggle="dropdown" role="button" aria-expanded="false">Profile <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('profile.index') }}">{{Auth::user()->name}}'s profile</a>
                            </li>
                            <li>
                                <a href="{{ route('createChoice.show') }}">Create a card</a>
                            </li>
                            <li>
                                <a href="{{ route('locationChoice.show') }}">New location</a>
                            </li>
                            <li>
                                <a href="{{ route('friends.index') }}">Friends List</a>
                            </li>
                            <li>
                                <a href="{{ route('tacklebox.index') }}">Tackle Box</a>
                            </li>
                        </ul>
                    </li>
                    
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle margin-rs" data-toggle="dropdown" role="button" aria-expanded="false">Settings<span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                        @if (!Auth::user()->subscribed('main'))
                        <li>
                            <a href="{{ route('plans.index') }}">Subscriptions</a>
                        </li>
                        @endif
                        @if (Auth::user()->subscribed('main'))
                        <li>
                            <a href="{{ route('subscription.index') }}">Subscriptions</a>
                        </li>
                        @endif
                        
                        @if (Auth::user())
                         <li>
                            <a href="{{ route('profileSettings.index') }}">Profile Settings</a>
                        </li>
                        @endif
                            @role('admin')
                                <li>
                                    <a href="{{ route('admin.index') }}">Admin Panel</a>
                                </li>
                            @endrole
                        <li>
                            <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                    </li>
                    @endif
                </ul>
                </div>
            </div>
        </div>
    </nav>
</div>  
