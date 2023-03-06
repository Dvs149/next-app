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
                        <div class="card-panel">
                            <div class="row">
                                <div class="col s12 m7">
                                    <div class="display-flex media">
                                        <a href="{{$user_detail->profile_photo_url}}" target="_blank" class="avatar">
                                            <img src="{{$user_detail->profile_photo_url}}" alt="users view avatar" class="z-depth-4 circle" height="64" width="64">
                                        </a>
                                        <div class="media-body">
                                            <h6 class="media-heading">
                                                <span class="users-view-name">{{$user_detail->name}}</span>
                                                
                                            </h6>
                                            <span>Email:</span>
                                            <span class="users-view-id">{{$user_detail->email}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-2">
                                    {{-- <a href="app-email.html" class="btn-small btn-light-indigo"><i class="material-icons">mail_outline</i></a> --}}
                                    {{-- <a href="user-profile-page.html" class="btn-small btn-light-indigo">Profile</a> --}}
                                    <a href="{{Helper::admin_url('user/edit/'.Helper::encrypt($user_detail->id))}}" class="btn-small indigo">Edit</a>
                                    {{-- <a href="" class="btn-small indigo">Suspend</a> --}}
                                    {{-- <a href="" class="btn-small indigo">Delete</a> --}}
                                </div>
                            </div>
                        </div>
                        <!-- users view media object ends -->
                        <!-- users view card details start -->
                        <div class="card">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col s12">
                                        <h6 class="mb-2 mt-2"><i class="material-icons">error_outline</i> Personal Info</h6>
                                        <table class="striped">
                                            <tbody>
                                                <tr>
                                                    <td>Name:</td>
                                                    <td class="users-view-username">{{$user_detail->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Email:</td>
                                                    <td class="users-view-name">{{$user_detail->email}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Mobile:</td>
                                                    <td class="users-view-email">{{$user_detail->mobile}}</td>
                                                </tr>
                                                

                                            </tbody>
                                        </table>
                                        <h6 class="mb-2 mt-2"><i class="material-icons">error_outline</i> Business Info</h6>
                                        <table class="striped">
                                            <tbody>
                                                <tr>
                                                    <td>Tiltle:</td>
                                                    <td>{{$user_detail->business_info->b_title}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Company Name:</td>
                                                    <td>{{$user_detail->business_info->b_company_name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Contact:</td>
                                                    <td>{{$user_detail->business_info->b_contact_number}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Ext:</td>
                                                    <td>{{$user_detail->business_info->b_ext}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Website:</td>
                                                    <td><a href="{{$user_detail->business_info->b_website}}" target="_blank">{{$user_detail->business_info->b_website}}</a></td>
                                                </tr>
                                                <tr>
                                                    <td>Department:</td>
                                                    <td>{{$user_detail->business_info->b_department}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Whatsapp URL:</td>
                                                    <td><a href="{{$user_detail->business_info->b_whatsapp_url}}" target="_blank">{{$user_detail->business_info->b_whatsapp_url}}</a></td>
                                                </tr>
                                                <tr>
                                                    <td>Youtube video link:</td>
                                                    <td><a href="{{$user_detail->youtube_video_link}}" target="_blank">{{$user_detail->youtube_video_link}}</a></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <h6 class="mb-2 mt-2"><i class="material-icons">link</i> Social Links</h6>
                                        <table class="striped">
                                            <tbody>
                                                <tr>
                                                    <td>Facebook:</td>
                                                    <td><a href="{{$user_detail->facebook_link}}" target="_blank">{{$user_detail->facebook_link}}</a></td>
                                                </tr>
                                                <tr>
                                                    <td>Snapchat:</td>
                                                    <td><a href="{{$user_detail->snapchat_link}}" target="_blank">{{$user_detail->snapchat_link}}</a></td>
                                                </tr>
                                                <tr>
                                                    <td>Twitter:</td>
                                                    <td><a href="{{$user_detail->twitter_link}}" target="_blank">{{$user_detail->twitter_link}}</a></td>
                                                </tr>
                                                <tr>
                                                    <td>Tiktok:</td>
                                                    <td><a href="{{$user_detail->tiktok_link}}" target="_blank">{{$user_detail->tiktok_link}}</a></td>
                                                </tr>
                                                <tr>
                                                    <td>Linkedin:</td>
                                                    <td><a href="{{$user_detail->linkedin_link}}" target="_blank">{{$user_detail->linkedin_link}}</a></td>
                                                </tr>
                                                <tr>
                                                    <td>Instagram:</td>
                                                    <td><a href="{{$user_detail->instagram_link}}" target="_blank">{{$user_detail->instagram_link}}</a></td>
                                                </tr>
                                                <tr>
                                                    <td>Youtube:</td>
                                                    <td><a href="{{$user_detail->youtube_link}}" target="_blank">{{$user_detail->youtube_link}}</a></td>
                                                </tr>
                                                <tr>
                                                    <td>Behance:</td>
                                                    <td><a href="{{$user_detail->behance_link}}" target="_blank">{{$user_detail->behance_link}}</a></td>
                                                </tr>
                                                <tr>
                                                    <td>Soundcloud:</td>
                                                    <td><a href="{{$user_detail->soundcloud_link}}" target="_blank">{{$user_detail->soundcloud_link}}</a></td>
                                                </tr>
                                                <tr>
                                                    <td>Podcast:</td>
                                                    <td><a href="{{$user_detail->podcast_link}}" target="_blank">{{$user_detail->podcast_link}}</a></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        @if(count($user_detail->photo_gallery))
                                        <h6 class="mb-2 mt-2"><i class="material-icons">add_a_photo</i> Photo Gallery</h6>
                                            <div class="masonry-gallery-wrapper">
                                                <div class="popup-gallery">
                                                    <div class="gallery-sizer"></div>
                                                    <div class="row">
                                                        
                                                        {{-- {{$user_detail->photo_gallery}} --}}
                                                        @foreach ($user_detail->photo_gallery as $user)
                                                            <div class="col s12 m6 l4 xl2">
                                                            <div>
                                                                <a href="{{$user->photo_gallery_url}}" title="">
                                                                    <img src="{{$user->photo_gallery_url}}"  class="responsive-img mb-10" alt="">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
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