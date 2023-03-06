@extends('admin.layout.admin_layout')
@section('style')
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/flag-icon/css/flag-icon.min.css')}}">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/vertical-menu-nav-dark-template/materialize.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/vertical-menu-nav-dark-template/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/page-users.css')}}">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/custom/custom.css')}}">
    <!-- END: Custom CSS-->

    <!-- BEGIN: VENDOR CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/flag-icon/css/flag-icon.min.css"> --}}
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/vertical-menu-nav-dark-template/materialize.css"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/vertical-menu-nav-dark-template/style.css"> --}}
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="../../../app-assets/css/custom/custom.css"> --}}
    <!-- END: Custom CSS-->
   
    
@endsection
@section('main')
    <!-- BEGIN: Page Main-->
    <div id="main">
        <div class="row">
            <div class="col s12">
                <div class="container">
                    
                    <!-- users view start -->
                    <div class="section users-view">
                        <!-- users view media object start -->
                        <div class="card">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col s12">
                                        <h6 class="mb-2 mt-2"><i class="material-icons">error_outline</i>User feedback</h6>
                                        <table class="striped">
                                            <tbody>
                                                <tr>
                                                    <td>Name:</td>
                                                    <td class="users-view-username">{{$user_detail->user->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Message:</td>
                                                    <td class="users-view-name">{{$user_detail->feedback_message}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Rating:</td>
                                                    <td class="users-view-email">{{$user_detail->rate}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Type:</td>
                                                    <td class="users-view-email">{{$user_detail->type}}</td>
                                                </tr>
                                                
                                                

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                        <!-- users view card details ends -->
                    </div>
                    <!-- users view ends -->

                </div>
                <div class="content-overlay"></div>
            </div>
        </div>
    </div>
    <!-- END: Page Main-->
@endsection
    
@section('script')
<!-- BEGIN VENDOR JS-->
    <script src="{{asset('app-assets/js/vendors.min.js')}}"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{asset('app-assets/vendors/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/imagesloaded.pkgd.min.js')}}"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="{{asset('app-assets/js/plugins.js')}}"></script>
    <script src="{{asset('app-assets/js/search.js')}}"></script>
    <script src="{{asset('app-assets/js/custom/custom-script.js')}}"></script>
    <script src="{{asset('app-assets/js/custom/user-add-validation.js')}}"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{asset('app-assets/js/scripts/media-gallery-page.js')}}"></script>
    <!-- END PAGE LEVEL JS-->
@endsection