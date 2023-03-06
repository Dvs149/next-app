<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    @include('admin.layout.head')
    @yield('style')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/custom/custom.css')}}">

</head>
<!-- END: Head-->

<body class="vertical-layout page-header-light vertical-menu-collapsible vertical-menu-nav-dark preload-transitions 2-columns   " data-open="click" data-menu="vertical-menu-nav-dark" data-col="2-columns">

    <!-- BEGIN: Header-->
    @include('admin.layout.header')
    <!-- END: Header-->

    @include('admin.layout.sidenav')
    
    @yield('main')

    @include('admin.layout.footer')

    {{-- @include('admin.layout.script') --}}
    
    @yield('script')
</body>

</html>