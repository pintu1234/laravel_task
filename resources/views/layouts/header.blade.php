<nav class="navbar navbar-static-top">
    <div class="navbar-header">
        <div class="col-md-3">
            <a href="{{ URL :: to('/') }}" style="text-decoration: none; color: #fff;">
                <img class="gov_logo" src="{{ asset('/assets/images/laravel.png') }}"/>
            </a>
        </div>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse pull-left topnav" id="navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="treeview">
                <a href="{{ URL :: to('/') }}">
                    <span> Companies </span>
                </a>
            </li>
            <li class="treeview">
                <a href="{{ URL :: to('/employees') }}">
                    <span> Employees </span>
                </a>
            </li>
        </ul>
    </div>
    <div class="collapse navbar-collapse pull-right topnav" id="navbar-collapse">
                    <!-- Left Side Of Navbar -->
                
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-na">
                        <!-- Authentication Links -->
                   
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                       
                    </ul>
                </div>
    <!-- /.navbar-collapse -->
    <!-- Navbar Right Menu -->

    <!-- /.navbar-custom-menu -->
</nav>
<script type="text/javascript">
    $(document).ready(function () {
        $('.nav li').each(function () {
            if (window.location.href.indexOf($(this).find('a:first').attr('href')) > -1) {
                $(this).find('a').addClass('active');
                $(this).siblings('li').find('a').removeClass('active');
            }
        });
        $('.dropdown .dropdown-menu li').each(function () {
            if (window.location.href.indexOf($(this).find('a:first').attr('href')) > -1) {
                $(this).closest('ul').closest('li').attr('class', 'active');
                $('.nav li a').removeClass('active');
                $(this).addClass('active').siblings().removeClass('active');
            }
        });
    });
</script>
