@extends('admin.layout.admin_layout')
@section('style')
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/flag-icon/css/flag-icon.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/dropify/css/dropify.min.css')}}">
    
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/vertical-menu-nav-dark-template/materialize.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/vertical-menu-nav-dark-template/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/magnific-popup/magnific-popup.css')}}">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/custom/custom.css')}}">
    <!-- END: Custom CSS-->
    
@endsection
@section('main')
    <!-- BEGIN: Page Main-->
    
    <div id="main">
        <div class="row">
            <div class="col s12">
                <div class="container">
                    <!-- users list start -->
                    <section class="users-list-wrapper section">
                        <div class="users-list-filter">
                            <div class="card-panel">
                                <div class="card-content">
                                        <h4 class="card-title">Edit User Details</h4>
                                        @if(session()->has('message'))
                                            <h5 class="card-title right">{{ session()->get('message') }}</h5>
                                        @endif
                                        <form id="formValidate" method="POST" action="{{url()->current()}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col s4 input-field">
                                                    <input id="name" name="name" type="text" class="validate" value="{{$user_business->name}}" >
                                                    <label for="name" class="active">Name</label>
                                                </div>
                                                <div class="col s4 input-field">
                                                    <input id="email" name="email" type="text" class="validate" value="{{$user_business->email}}" >
                                                    <label for="email" class="active">Email</label>
                                                </div>
                                                <div class="col s4 input-field">
                                                    <input id="mobile" name="mobile" type="text" class="validate" value="{{$user_business->mobile}}" >
                                                    <label for="mobile" class="active">Mobile</label>
                                                </div>
                                            </div>
                                            
                                            <h4 class="card-title">Business Information</h4>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <textarea id="b_bio" name="b_bio"  class="materialize-textarea">{{$user_business->business_info->b_bio}}</textarea>
                                                    <label for="b_bio">Bio</label>
                                                </div>
                                                <div class="col s4 input-field">
                                                    <input id="b_title" name="b_title" type="text" class="validate" value="{{$user_business->business_info->b_title}}" >
                                                    <label for="b_title" class="active">Title</label>
                                                </div>
                                                <div class="col s4 input-field">
                                                    <input id="b_company_name" name="b_company_name" type="text" class="validate" value="{{$user_business->business_info->b_company_name}}" >
                                                    <label for="b_company_name" class="active">Comapany Name</label>
                                                </div>
                                                <div class="col s4 input-field">
                                                    <input id="b_department" name="b_department" type="text" class="validate" value="{{$user_business->business_info->b_department}}" >
                                                    <label for="b_department" class="active">Department</label>
                                                </div>
                                                <div class="col s3 input-field">
                                                    <input id="b_contact_number" name="b_contact_number" type="text" class="validate" value="{{$user_business->business_info->b_contact_number}}" >
                                                    <label for="b_contact_number" class="active">Contact number</label>
                                                </div>
                                                <div class="col s1 input-field">
                                                    <input id="b_ext" name="b_ext" type="text" class="validate" value="{{$user_business->business_info->b_ext}}" >
                                                    <label for="b_ext" class="active">Ext</label>
                                                </div>
                                                <div class="col s4 input-field">
                                                    <input id="b_website" name="b_website" type="text" class="validate" value="{{$user_business->business_info->b_website}}" >
                                                    <label for="b_website" class="active">Website</label>
                                                </div>
                                                <div class="col s4 input-field">
                                                    <input id="b_whatsapp_url" name="b_whatsapp_url" type="text" class="validate" value="{{$user_business->business_info->b_whatsapp_url}}" >
                                                    <label for="b_whatsapp_url" class="active">Whatsapp URL</label>
                                                </div>
                                                <div class="col s4 input-field">
                                                    <input id="youtube_video_link" name="youtube_video_link" type="text" class="validate" value="{{$user_business->youtube_video_link}}" >
                                                    <label for="youtube_video_link" class="active">Youtube video link</label>
                                                </div>
                                            </div>
                                            <h4 class="card-title">Social media</h4>
                                            <div class="row">
                                                <div class="col s12">
                                                    <div class="input-field col l1 m1 s1">
                                                        <img class="social-media-icon" src="{{asset('app-assets/images/icon/facebook.png')}}" alt="">
                                                    </div>
                                                    <div class="input-field col l2 s12">
                                                        <select name="facebook_visibility">
                                                            <option value="0" {{ ( $user_business->facebook_visibility == 0) ? 'selected' : '' }}>Hide</option>
                                                            <option value="1" {{ ( $user_business->facebook_visibility == 1) ? 'selected' : '' }}>Visible</option>
                                                        </select>
                                                        <label>Visibilty</label>
                                                    </div>
                                                    <div class="input-field col l2 m2 s3">
                                                        <select id="facebook_order" class="soc_med_order" name="facebook_order">
                                                            <option value="0" {{ $user_business->facebook_order == 0 ? 'selected' : '' }}>Hide</option>
                                                            <option value="1" {{ $user_business->facebook_order == 1 ? 'selected' : '' }}>1</option>
                                                            <option value="2" {{ $user_business->facebook_order == 2 ? 'selected' : '' }}>2</option>
                                                            <option value="3" {{ $user_business->facebook_order == 3 ? 'selected' : '' }}>3</option>
                                                            <option value="4" {{ $user_business->facebook_order == 4 ? 'selected' : '' }}>4</option>
                                                            <option value="5" {{ $user_business->facebook_order == 5 ? 'selected' : '' }}>5</option>
                                                            <option value="6" {{ $user_business->facebook_order == 6 ? 'selected' : '' }}>6</option>
                                                            <option value="7" {{ $user_business->facebook_order == 7 ? 'selected' : '' }}>7</option>
                                                            <option value="8" {{ $user_business->facebook_order == 8 ? 'selected' : '' }}>8</option>
                                                            <option value="9" {{ $user_business->facebook_order == 9 ? 'selected' : '' }}>9</option>
                                                            <option value="10" {{ $user_business->facebook_order == 10 ? 'selected' : '' }}>10</option>
                                                        </select>
                                                        <label for="facebook_order">Order</label>
                                                    </div>
                                                    <div class="input-field col l3 m3 s3">
                                                        <input type="text" id="facebook_link" name="facebook_link" value="{{$user_business->facebook_link}}" class="materialize-textarea"></input>
                                                        <label for="facebook_link">Facebook link</label>
                                                    </div>
                                                </div>
                                                <div class="col s12">
                                                    <div class="input-field col l1 m1 s1">
                                                        <img class="social-media-icon" src="{{asset('app-assets/images/icon/snapchat.png')}}" alt="">
                                                    </div>
                                                    <div class="input-field col l2 s12">
                                                        <select name="snapchat_visibility">
                                                            <option value="0" {{ ( $user_business->snapchat_visibility == 0) ? 'selected' : '' }}>Hide</option>
                                                            <option value="1" {{ ( $user_business->snapchat_visibility == 1) ? 'selected' : '' }}>Visible</option>
                                                        </select>
                                                        <label>Visibilty</label>
                                                    </div>
                                                    <div class="input-field col l2 m2 s12">
                                                        <select id="snapchat_order" class="soc_med_order" name="snapchat_order">
                                                            <option value="0" {{ $user_business->snapchat_order == 0 ? 'selected' : '' }}>Hide</option>
                                                            <option value="1" {{ $user_business->snapchat_order == 1 ? 'selected' : '' }}>1</option>
                                                            <option value="2" {{ $user_business->snapchat_order == 2 ? 'selected' : '' }}>2</option>
                                                            <option value="3" {{ $user_business->snapchat_order == 3 ? 'selected' : '' }}>3</option>
                                                            <option value="4" {{ $user_business->snapchat_order == 4 ? 'selected' : '' }}>4</option>
                                                            <option value="5" {{ $user_business->snapchat_order == 5 ? 'selected' : '' }}>5</option>
                                                            <option value="6" {{ $user_business->snapchat_order == 6 ? 'selected' : '' }}>6</option>
                                                            <option value="7" {{ $user_business->snapchat_order == 7 ? 'selected' : '' }}>7</option>
                                                            <option value="8" {{ $user_business->snapchat_order == 8 ? 'selected' : '' }}>8</option>
                                                            <option value="9" {{ $user_business->snapchat_order == 9 ? 'selected' : '' }}>9</option>
                                                            <option value="10" {{ $user_business->snapchat_order == 10 ? 'selected' : '' }}>10</option>
                                                        </select>
                                                        <label for="snapchat_order">Order</label>
                                                    </div>
                                                    <div class="input-field col l3 m3 s3">
                                                        <input type="text" id="snapchat_link" name="snapchat_link" class="materialize-textarea" value="{{$user_business->snapchat_link}}"></input>
                                                        <label for="snapchat_link">Snapchat link</label>
                                                    </div>
                                                </div>
                                                <div class="col s12">
                                                    <div class="input-field col l1 m1 s1">
                                                        <img class="social-media-icon" src="{{asset('app-assets/images/icon/twitter.png')}}" alt="">
                                                    </div>
                                                    <div class="input-field col l2 s12">
                                                        <select name="twitter_visibility">
                                                            <option value="0" {{ ( $user_business->twitter_visibility == 0) ? 'selected' : '' }}>Hide</option>
                                                            <option value="1" {{ ( $user_business->twitter_visibility == 1) ? 'selected' : '' }}>Visible</option>
                                                        </select>
                                                        <label>Visibilty</label>
                                                    </div>
                                                    <div class="input-field col l2 m2 s3">
                                                        <select id="twitter_order" class="soc_med_order" name="twitter_order">
                                                            <option value="0" {{ $user_business->twitter_order == 0 ? 'selected' : '' }}>Hide</option>
                                                            <option value="1" {{ $user_business->twitter_order == 1 ? 'selected' : '' }}>1</option>
                                                            <option value="2" {{ $user_business->twitter_order == 2 ? 'selected' : '' }}>2</option>
                                                            <option value="3" {{ $user_business->twitter_order == 3 ? 'selected' : '' }}>3</option>
                                                            <option value="4" {{ $user_business->twitter_order == 4 ? 'selected' : '' }}>4</option>
                                                            <option value="5" {{ $user_business->twitter_order == 5 ? 'selected' : '' }}>5</option>
                                                            <option value="6" {{ $user_business->twitter_order == 6 ? 'selected' : '' }}>6</option>
                                                            <option value="7" {{ $user_business->twitter_order == 7 ? 'selected' : '' }}>7</option>
                                                            <option value="8" {{ $user_business->twitter_order == 8 ? 'selected' : '' }}>8</option>
                                                            <option value="9" {{ $user_business->twitter_order == 9 ? 'selected' : '' }}>9</option>
                                                            <option value="10" {{ $user_business->twitter_order == 10 ? 'selected' : '' }}>10</option>
                                                        </select>
                                                        <label for="twitter_order">Order</label>
                                                    </div>
                                                    <div class="input-field col l3 m3 s3">
                                                        <input type="text" id="twitter_link" name="twitter_link" class="materialize-textarea" value="{{$user_business->twitter_link}}"></input>
                                                        <label for="twitter_link">Twitter link</label>
                                                    </div>
                                                </div>
                                                <div class="col s12">
                                                    <div class="input-field col l1 m1 s1">
                                                        <img class="social-media-icon" src="{{asset('app-assets/images/icon/tik-tok.png')}}" alt="">
                                                    </div>
                                                    <div class="input-field col l2 s12">
                                                        <select name="tiktok_visibility">
                                                            <option value="0" {{ ( $user_business->tiktok_visibility == 0) ? 'selected' : '' }}>Hide</option>
                                                            <option value="1" {{ ( $user_business->tiktok_visibility == 1) ? 'selected' : '' }}>Visible</option>
                                                        </select>
                                                        <label>Visibilty</label>
                                                    </div>
                                                    <div class="input-field col l2 m2 s3">
                                                        <select id="tiktok_order" class="soc_med_order" name="tiktok_order">
                                                            <option value="0" {{ $user_business->tiktok_order == 0 ? 'selected' : '' }}>Hide</option>
                                                            <option value="1" {{ $user_business->tiktok_order == 1 ? 'selected' : '' }}>1</option>
                                                            <option value="2" {{ $user_business->tiktok_order == 2 ? 'selected' : '' }}>2</option>
                                                            <option value="3" {{ $user_business->tiktok_order == 3 ? 'selected' : '' }}>3</option>
                                                            <option value="4" {{ $user_business->tiktok_order == 4 ? 'selected' : '' }}>4</option>
                                                            <option value="5" {{ $user_business->tiktok_order == 5 ? 'selected' : '' }}>5</option>
                                                            <option value="6" {{ $user_business->tiktok_order == 6 ? 'selected' : '' }}>6</option>
                                                            <option value="7" {{ $user_business->tiktok_order == 7 ? 'selected' : '' }}>7</option>
                                                            <option value="8" {{ $user_business->tiktok_order == 8 ? 'selected' : '' }}>8</option>
                                                            <option value="9" {{ $user_business->tiktok_order == 9 ? 'selected' : '' }}>9</option>
                                                            <option value="10" {{ $user_business->tiktok_order == 10 ? 'selected' : '' }}>10</option>
                                                        </select>
                                                        <label for="tiktok_order">Order</label>
                                                    </div>
                                                    <div class="input-field col l3 m3 s3">
                                                        <input type="text" id="tiktok_link" name="tiktok_link" class="materialize-textarea" value="{{$user_business->tiktok_link}}"></input>
                                                        <label for="tiktok_link">Tiktok link</label>
                                                    </div>
                                                </div>
                                                <div class="col s12">
                                                    <div class="input-field col l1 m1 s1">
                                                        <img class="social-media-icon" src="{{asset('app-assets/images/icon/linkedin.png')}}" alt="">
                                                    </div>
                                                    <div class="input-field col l2 s12">
                                                        <select name="linkedin_visibility">
                                                            <option value="0" {{ ( $user_business->linkedin_visibility == 0) ? 'selected' : '' }}>Hide</option>
                                                            <option value="1" {{ ( $user_business->linkedin_visibility == 1) ? 'selected' : '' }}>Visible</option>
                                                        </select>
                                                        <label>Visibilty</label>
                                                    </div>
                                                    <div class="input-field col l2 m2 s3">
                                                        <select id="linkedin_order" class="soc_med_order" name="linkedin_order">
                                                            <option value="0" {{ $user_business->linkedin_order == 0 ? 'selected' : '' }}>Hide</option>
                                                            <option value="1" {{ $user_business->linkedin_order == 1 ? 'selected' : '' }}>1</option>
                                                            <option value="2" {{ $user_business->linkedin_order == 2 ? 'selected' : '' }}>2</option>
                                                            <option value="3" {{ $user_business->linkedin_order == 3 ? 'selected' : '' }}>3</option>
                                                            <option value="4" {{ $user_business->linkedin_order == 4 ? 'selected' : '' }}>4</option>
                                                            <option value="5" {{ $user_business->linkedin_order == 5 ? 'selected' : '' }}>5</option>
                                                            <option value="6" {{ $user_business->linkedin_order == 6 ? 'selected' : '' }}>6</option>
                                                            <option value="7" {{ $user_business->linkedin_order == 7 ? 'selected' : '' }}>7</option>
                                                            <option value="8" {{ $user_business->linkedin_order == 8 ? 'selected' : '' }}>8</option>
                                                            <option value="9" {{ $user_business->linkedin_order == 9 ? 'selected' : '' }}>9</option>
                                                            <option value="10" {{ $user_business->linkedin_order == 10 ? 'selected' : '' }}>10</option>
                                                        </select>
                                                        <label for="linkedin_order">Order</label>
                                                    </div>
                                                    <div class="input-field col l3 m3 s3">
                                                        <input type="text" id="linkedin_link" name="linkedin_link" class="materialize-textarea" value="{{$user_business->linkedin_link}}"></input>
                                                        <label for="linkedin_link">Linkedin link</label>
                                                    </div>
                                                </div>
                                                <div class="col s12">
                                                    <div class="input-field col l1 m1 s1">
                                                        <img class="social-media-icon" src="{{asset('app-assets/images/icon/instagram.png')}}" alt="">
                                                    </div>
                                                    <div class="input-field col l2 s12">
                                                        <select name="instagram_visibility">
                                                            <option value="0" {{ ( $user_business->instagram_visibility == 0) ? 'selected' : '' }}>Hide</option>
                                                            <option value="1" {{ ( $user_business->instagram_visibility == 1) ? 'selected' : '' }}>Visible</option>
                                                        </select>
                                                        <label>Visibilty</label>
                                                    </div>
                                                    <div class="input-field col l2 m2 s3">
                                                        <select id="instagram_order" class="soc_med_order" name="instagram_order">
                                                            <option value="0" {{ $user_business->instagram_order == 0 ? 'selected' : '' }}>Hide</option>
                                                            <option value="1" {{ $user_business->instagram_order == 1 ? 'selected' : '' }}>1</option>
                                                            <option value="2" {{ $user_business->instagram_order == 2 ? 'selected' : '' }}>2</option>
                                                            <option value="3" {{ $user_business->instagram_order == 3 ? 'selected' : '' }}>3</option>
                                                            <option value="4" {{ $user_business->instagram_order == 4 ? 'selected' : '' }}>4</option>
                                                            <option value="5" {{ $user_business->instagram_order == 5 ? 'selected' : '' }}>5</option>
                                                            <option value="6" {{ $user_business->instagram_order == 6 ? 'selected' : '' }}>6</option>
                                                            <option value="7" {{ $user_business->instagram_order == 7 ? 'selected' : '' }}>7</option>
                                                            <option value="8" {{ $user_business->instagram_order == 8 ? 'selected' : '' }}>8</option>
                                                            <option value="9" {{ $user_business->instagram_order == 9 ? 'selected' : '' }}>9</option>
                                                            <option value="10" {{ $user_business->instagram_order == 10 ? 'selected' : '' }}>10</option>
                                                        </select>
                                                        <label for="instagram_order">Order</label>
                                                    </div>
                                                    <div class="input-field col l3 m3 s3">
                                                        <input type="text" id="instagram_link" name="instagram_link" class="materialize-textarea" value="{{$user_business->instagram_link}}"></input>
                                                        <label for="instagram_link">Instagram link</label>
                                                    </div>
                                                </div>
                                                <div class="col s12">
                                                    <div class="input-field col l1 m1 s1">
                                                        <img class="social-media-icon" src="{{asset('app-assets/images/icon/youtube.png')}}" alt="">
                                                    </div>
                                                    <div class="input-field col l2 s12">
                                                        <select name="youtube_visibility">
                                                            <option value="0" {{ ( $user_business->youtube_visibility == 0) ? 'selected' : '' }}>Hide</option>
                                                            <option value="1" {{ ( $user_business->youtube_visibility == 1) ? 'selected' : '' }}>Visible</option>
                                                        </select>
                                                        <label>Visibilty</label>
                                                    </div>
                                                    <div class="input-field col l2 m2 s3">
                                                        <select id="youtube_order" class="soc_med_order" name="youtube_order">
                                                            <option value="0" {{ $user_business->youtube_order == 0 ? 'selected' : '' }}>Hide</option>
                                                            <option value="1" {{ $user_business->youtube_order == 1 ? 'selected' : '' }}>1</option>
                                                            <option value="2" {{ $user_business->youtube_order == 2 ? 'selected' : '' }}>2</option>
                                                            <option value="3" {{ $user_business->youtube_order == 3 ? 'selected' : '' }}>3</option>
                                                            <option value="4" {{ $user_business->youtube_order == 4 ? 'selected' : '' }}>4</option>
                                                            <option value="5" {{ $user_business->youtube_order == 5 ? 'selected' : '' }}>5</option>
                                                            <option value="6" {{ $user_business->youtube_order == 6 ? 'selected' : '' }}>6</option>
                                                            <option value="7" {{ $user_business->youtube_order == 7 ? 'selected' : '' }}>7</option>
                                                            <option value="8" {{ $user_business->youtube_order == 8 ? 'selected' : '' }}>8</option>
                                                            <option value="9" {{ $user_business->youtube_order == 9 ? 'selected' : '' }}>9</option>
                                                            <option value="10" {{ $user_business->youtube_order == 10 ? 'selected' : '' }}>10</option>
                                                        </select>
                                                        <label for="youtube_order">Order</label>
                                                    </div>
                                                    <div class="input-field col l3 m3 s3">
                                                        <input type="text" id="youtube_link" name="youtube_link" class="materialize-textarea" value="{{$user_business->youtube_link}}"></input>
                                                        <label for="youtube_link">Youtube link</label>
                                                    </div>
                                                </div>
                                                <div class="col s12">
                                                    <div class="input-field col l1 m1 s1">
                                                        <img class="social-media-icon" src="{{asset('app-assets/images/icon/behance.png')}}" alt="">
                                                    </div>
                                                    <div class="input-field col l2 s12">
                                                        <select name="behance_visibility">
                                                            <option value="0" {{ ( $user_business->behance_visibility == 0) ? 'selected' : '' }}>Hide</option>
                                                            <option value="1" {{ ( $user_business->behance_visibility == 1) ? 'selected' : '' }}>Visible</option>
                                                        </select>
                                                        <label>Visibilty</label>
                                                    </div>
                                                    <div class="input-field col l2 m2 s3">
                                                        <select id="behance_order" class="soc_med_order" name="behance_order">
                                                            <option value="0" {{ $user_business->behance_order == 0 ? 'selected' : '' }}>Hide</option>
                                                            <option value="1" {{ $user_business->behance_order == 1 ? 'selected' : '' }}>1</option>
                                                            <option value="2" {{ $user_business->behance_order == 2 ? 'selected' : '' }}>2</option>
                                                            <option value="3" {{ $user_business->behance_order == 3 ? 'selected' : '' }}>3</option>
                                                            <option value="4" {{ $user_business->behance_order == 4 ? 'selected' : '' }}>4</option>
                                                            <option value="5" {{ $user_business->behance_order == 5 ? 'selected' : '' }}>5</option>
                                                            <option value="6" {{ $user_business->behance_order == 6 ? 'selected' : '' }}>6</option>
                                                            <option value="7" {{ $user_business->behance_order == 7 ? 'selected' : '' }}>7</option>
                                                            <option value="8" {{ $user_business->behance_order == 8 ? 'selected' : '' }}>8</option>
                                                            <option value="9" {{ $user_business->behance_order == 9 ? 'selected' : '' }}>9</option>
                                                            <option value="10" {{ $user_business->behance_order == 10 ? 'selected' : '' }}>10</option>
                                                        </select>
                                                        <label for="behance_order">Order</label>
                                                    </div>
                                                    <div class="input-field col l3 m3 s3">
                                                        <input type="text" id="behance_link" name="behance_link" class="materialize-textarea" value="{{$user_business->behance_link}}"></input>
                                                        <label for="behance_link">Behance link</label>
                                                    </div>
                                                </div>
                                                <div class="col s12">
                                                    <div class="input-field col l1 m1 s1">
                                                        <img class="social-media-icon" src="{{asset('app-assets/images/icon/podcast.png')}}" alt="">
                                                    </div>
                                                    <div class="input-field col l2 s12">
                                                        <select name="podcast_visibility">
                                                            <option value="0" {{ ( $user_business->podcast_visibility == 0) ? 'selected' : '' }}>Hide</option>
                                                            <option value="1" {{ ( $user_business->podcast_visibility == 1) ? 'selected' : '' }}>Visible</option>
                                                        </select>
                                                        <label>Visibilty</label>
                                                    </div>
                                                    <div class="input-field col l2 m2 s3">
                                                        <select id="podcast_order" class="soc_med_order" name="podcast_order">
                                                            <option value="0" {{ $user_business->podcast_order == 0 ? 'selected' : '' }}>Hide</option>
                                                            <option value="1" {{ $user_business->podcast_order == 1 ? 'selected' : '' }}>1</option>
                                                            <option value="2" {{ $user_business->podcast_order == 2 ? 'selected' : '' }}>2</option>
                                                            <option value="3" {{ $user_business->podcast_order == 3 ? 'selected' : '' }}>3</option>
                                                            <option value="4" {{ $user_business->podcast_order == 4 ? 'selected' : '' }}>4</option>
                                                            <option value="5" {{ $user_business->podcast_order == 5 ? 'selected' : '' }}>5</option>
                                                            <option value="6" {{ $user_business->podcast_order == 6 ? 'selected' : '' }}>6</option>
                                                            <option value="7" {{ $user_business->podcast_order == 7 ? 'selected' : '' }}>7</option>
                                                            <option value="8" {{ $user_business->podcast_order == 8 ? 'selected' : '' }}>8</option>
                                                            <option value="9" {{ $user_business->podcast_order == 9 ? 'selected' : '' }}>9</option>
                                                            <option value="10" {{ $user_business->podcast_order == 10 ? 'selected' : '' }}>10</option>
                                                        </select>
                                                        <label for="podcast_order">Order</label>
                                                    </div>
                                                    <div class="input-field col l3 m3 s3">
                                                        <input type="text" id="podcast_link" name="podcast_link" class="materialize-textarea" value="{{$user_business->podcast_link}}"></input>
                                                        <label for="podcast_link">Podcast link</label>
                                                    </div>
                                                </div>
                                                <div class="col s12">
                                                    <div class="input-field col l1 m1 s1">
                                                        <img class="social-media-icon" src="{{asset('app-assets/images/icon/soundcloud.png')}}" alt="">
                                                    </div>
                                                    <div class="input-field col l2 s12">
                                                        <select name="soundcloud_visibility">
                                                            <option value="0" {{ ( old('soundcloud_visibility',$user_business->soundcloud_visibility) == 0) ? 'selected' : '' }}>Hide</option>
                                                            <option value="1" {{ ( old('soundcloud_visibility',$user_business->soundcloud_visibility) == 1) ? 'selected' : '' }}>Visible</option>
                                                        </select>
                                                        <label>Visibilty</label>
                                                    </div>
                                                    <div class="input-field col l2 m2 s3">
                                                        <select id="soundcloud_order"  class="soc_med_order " name="soundcloud_order">
                                                            {{-- <label>Browser Select</label> --}}
                                                            {{-- <select class="browser-default soc_med_order"> --}}
                                                                <option value="0" {{ old('soundcloud_order',$user_business->soundcloud_order) == 0 ? 'selected' : '' }}>Hide</option>
                                                                <option value="1" {{ old('soundcloud_order',$user_business->soundcloud_order) == 1 ? 'selected' : '' }}>1</option>
                                                                <option value="2" {{ old('soundcloud_order',$user_business->soundcloud_order) == 2 ? 'selected' : '' }}>2</option>
                                                                <option value="3" {{ old('soundcloud_order',$user_business->soundcloud_order) == 3 ? 'selected' : '' }}>3</option>
                                                                <option value="4" {{ old('soundcloud_order',$user_business->soundcloud_order) == 4 ? 'selected' : '' }}>4</option>
                                                                <option value="5" {{ old('soundcloud_order',$user_business->soundcloud_order) == 5 ? 'selected' : '' }}>5</option>
                                                                <option value="6" {{ old('soundcloud_order',$user_business->soundcloud_order) == 6 ? 'selected' : '' }}>6</option>
                                                                <option value="7" {{ old('soundcloud_order',$user_business->soundcloud_order) == 7 ? 'selected' : '' }}>7</option>
                                                                <option value="8" {{ old('soundcloud_order',$user_business->soundcloud_order) == 8 ? 'selected' : '' }}>8</option>
                                                                <option value="9" {{ old('soundcloud_order',$user_business->soundcloud_order) == 9 ? 'selected' : '' }}>9</option>
                                                                <option value="10" {{ old('soundcloud_order',$user_business->soundcloud_order) == 10 ? 'selected' : '' }}>10</option>
                                                        </select>
                                                        <label for="soundcloud_order">Order</label>
                                                    </div>
                                                    
                                                    <div class="input-field col l3 m3 s3 ">
                                                        <input type="text" id="soundcloud_link" name="soundcloud_link" class="materialize-textarea" value="{{$user_business->soundcloud_link}}"></input>
                                                        <label for="soundcloud_link">Soundcloud link</label>
                                                    </div>
                                                </div>
                                                {{-- <label>Browser Select</label>
                                                <select class="browser-default soc_med_order">
                                                    <option value="" disabled selected>Choose your option</option>
                                                    <option value="1">Option 1</option>
                                                    <option value="2">Option 2</option>
                                                    <option value="3">Option 3</option>
                                                </select> --}}
                                            </div>
                                            <div class="row">
                                                <h4 class="card-title">Photo gallery</h4>
    

                                                <div class="popup-gallery">
                                                    <div class="gallery-sizer"></div>
                                                    <div class="row">
                                                        @foreach ($user_business->photo_gallery as $photo)
                                                        {{-- {{dd($photo->photo_gallery_url)}} --}}
                                                            <div class="col s12 m6 l4 xl2 " id="{{Helper::encrypt($photo->id)}}">
                                                                <div class="center">
                                                                    <pop href="{{$photo->photo_gallery_url}}" title="image">
                                                                        <img src="{{$photo->photo_gallery_url}}"  class="responsive-img mb-10" alt="">
                                                                    </pop>
                                                                    <a href="javascript:void(0)" class=" btn-warning-cancel mb-6 btn waves-effect waves-light red accent-2" data-id="{{Helper::encrypt($photo->id)}}" data-url={{route('admin.user').'/delete/photo/'.Helper::encrypt($user_business->id).'/'.Helper::encrypt($photo->id)}}>delete</a>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <!--Set dropzone height-->
                                                    <div class="col s12 m4 l4 xl4">
                                                        <input type="file" id="input-file-now-custom-2" class="dropify" name="photo_gallery[]"  data-height="100" />
                                                    </div>
                                                <div id="add-more-pg">
                                                    <div class="col s12 m4 l4 ">
                                                        <input type="file" id="input-file-now-custom-2" class="dropify" name="photo_gallery[]"  data-height="100" />
                                                    </div>
                                                    <div class="col s12 m4 l4 ">
                                                        <input type="file" id="input-file-now-custom-2" class="dropify" name="photo_gallery[]"  data-height="100" />
                                                    </div>
                                                </div>
                                                </div>
                                                </div>
                                                <!--Disabled the dropzone-->
                                            </div>
                                            <div class="row">
                                                    <div class="input-field col s12 m12 ">
                                                        <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                                                            <i class="material-icons right">send</i>
                                                        </button>
                                                    </div>
                                            </div>
                                        </form>
                                    </div>
                            </div>
                        </div>
                    </section>
                    <!-- users list ends -->
                </div>
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
    <script src="{{asset('app-assets/vendors/dropify/js/dropify.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/sweetalert/sweetalert.min.js')}}"></script>

    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="{{asset('app-assets/js/plugins.js')}}"></script>
    <script src="{{asset('app-assets/js/search.js')}}"></script>
    <script src="{{asset('app-assets/js/custom/custom-script.js')}}"></script>
    <script src="{{asset('app-assets/js/custom/user-edit-validation.js')}}"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
    <script>
        
        $(document).ready(function () {
            social_order_check();
            $('.dropify').dropify({
                    messages: {
                        'default': 'Drag and drop a file here or click',
                        'replace': 'Drag and drop or click to replace',
                        'remove':  'Remove',
                        'error':   'Ooops, something wrong happended.'
                    }
                });

                $('body').on('click', '.btn-warning-cancel', function (e) {
                    var get_url = $(this).data("url");
                    var id = $(this).data("id");
                    var token = $("meta[name='csrf-token']").attr("content");
                    swal({
                            title: "Are you sure?",
                            text: "You will not be able to recover photo from gallery!",
                            icon: 'warning',
                            dangerMode: true,
                            buttons: {
                                cancel: 'No, Please!',
                                delete: 'Yes, Delete It'
                            }
                        }).then(function (willDelete) {
                            
                            if (willDelete) {
                                $.ajax({
                                    type: "DELETE",
                                    url: get_url,
                                    data: {"_token": "{{ csrf_token() }}","id": id },
                                    success: function (data) {
                                        $('#'+data).remove();
                                        swal("Poof! Your user has been deleted!", {
                                            icon: "success",
                                        });
                                        
                                    },
                                    error: function (data) {
                                          swal({
                                                title: 'Error',
                                                icon: 'error'
                                            })
                                        // console.log('Error:', data);
                                    }
                                });
                                
                            } else {
                                
                            }
                        });
                });

                $('.popup-gallery').magnificPopup({
                    delegate: 'pop',
                    type: 'image',
                    closeOnContentClick: true,
                    fixedContentPos: true,
                    tLoading: 'Loading image #%curr%...',
                    mainClass: 'mfp-img-mobile mfp-no-margins mfp-with-zoom',
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true,
                        preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
                    },
                    image: {
                        verticalFit: true,
                        tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                        titleSrc: function(item) {
                        return item.el.attr('title') + '<small></small>';
                        },
                        zoom: {
                        enabled: true,
                        duration: 300 // don't foget to change the duration also in CSS
                        }
                    }
                });

            $('body').on('change', '.soc_med_order', function (e) {
                var order_given_value = [];
                var order_value = ["0","1","2","3","4","5","6","7","8","9","10"];
                social_order_check();
                // get value for which social media order is given
                $( ".order_given" ).each(function() {
                    order_given_value.push(this.value);
                });

                arr = order_value.filter(item => !order_given_value.includes(item))
                
                //remove selected option which is allready selected
                $(".order_not_given").each(function(){
                    $(".order_not_given option").remove();
                    $.each(arr, function( index, value ) {
                        $(".order_not_given").append(`<option value="${value}">${value!=0?value:'Hide'}</option>`);
                    });
                });

                
                // get required option in the already seleceted
                $(".order_given").each(function(){
                    var current_given_value = this.value;
                    var current_given_id = this.id;
                    var current_select_option =[];
                    
                    $.each(order_given_value, function( index, value ) {
                        if(value!=current_given_value){
                            $('#'+current_given_id+" option[value='"+value+"']").remove();
                        }
                    });
                    
                    $("#"+current_given_id+" option").each(function()
                    {
                        current_select_option.push(this.value);
                    });

                    var result = mergeTwo(current_select_option, arr);
                    
                    $("#"+current_given_id+" option").remove();
                    $.each(result, function( index, value ) {
                        $('#'+current_given_id).append(`<option value="${value}">${value!=0?value:'Hide'}</option>`);
                    });
                    $('#'+current_given_id).val(current_given_value);

                });

                
                $("select.soc_med_order").formSelect();

            
        });
        function social_order_check(){
                $( ".soc_med_order" ).each(function() {
                    if(this.value!=0){
                      $( this ).addClass( "order_given" );
                      $( this ).removeClass( "order_not_given" );
                    }else {
                      $( this ).removeClass( "order_given" );
                      $( this ).addClass( "order_not_given" );
                    }
                });
                // $('.soc_med_order').trigger('change');
            }

        function mergeTwo(arr1, arr2) {
            let result = [...arr1, ...arr2];
            var res = result.sort((a,b) => a-b);
            // var names = ["Mike","Matt","Nancy","Adam","Jenny","Nancy","Carl"];
            var uniqueNames = [];
            $.each(res, function(i, el){
                if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
            });
            return uniqueNames;
        }


    });
    </script>
@endsection