<!-- BEGIN: SideNav-->
    <aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light navbar-full sidenav-active-rounded">
        <div class="brand-sidebar">
            <h1 class="logo-wrapper">
                <a class="brand-logo darken-1" href="{{route('admin.dashboard')}}">
                    <img src="{{asset('app-assets/images/logo/logo_light.png')}}" alt="nextap logo" />
                    {{-- <span class="logo-text hide-on-med-and-down">NEXTAP</span> --}}
                </a>
                <a class="navbar-toggler" href="#"></a></h1>
        </div>
        <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
            {{-- dashboard --}}
            <li class="bold {{ (request()->is('*/dashboard')) ? 'active' : '' }}"><a class="waves-effect waves-cyan {{ (request()->is('*/dashboard')) ? 'active' : '' }}" href="{{route('admin.dashboard')}}"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
            </li>
            

            {{-- user --}}
            <li class="bold {{ (request()->is('*/user//add')) ? 'active' : '' }}"><a class="waves-effect waves-cyan {{ (request()->is('*/user/add')) ? 'active' : '' }}" href="{{route('admin.user.add')}}"><i class="material-icons">face</i><span class="menu-title" data-i18n="User">Add user</span></a>
            </li>
            <li class="bold {{ (request()->is('*/user')) ? 'active' : '' }}"><a class="waves-effect waves-cyan {{ (request()->is('*/user')) ? 'active' : '' }}" href="{{route('admin.user')}}"><i class="material-icons">face</i><span class="menu-title" data-i18n="User">Users</span></a>
            </li>
            <li class="bold {{ (request()->is('*/feedback')) ? 'active' : '' }}"><a class="waves-effect waves-cyan {{ (request()->is('*/feedback')) ? 'active' : '' }}" href="{{route('admin.feedback')}}"><i class="material-icons">face</i><span class="menu-title" data-i18n="User">Feedback</span></a>
            </li>

            {{-- <li class="bold"><a class="waves-effect waves-cyan " href="" target="_blank"><i class="material-icons">help_outline</i><span class="menu-title" data-i18n="Support">Support</span></a> --}}
            </li>
        </ul>
        <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
    </aside>
    <!-- END: SideNav-->