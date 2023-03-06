@extends('admin.layout.admin_layout')
@section('style')
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/flag-icon/css/flag-icon.min.css')}}">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/vertical-menu-nav-dark-template/materialize.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/vertical-menu-nav-dark-template/style.css')}}">
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
                                        <h4 class="card-title">Add User</h4>
                                        
                                        <form id="formValidate" method="POST" action="{{url()->current()}}">
                                            @csrf
                                            <div class="row">
                                                <div class="input-field col s12 m3">
                                                    <input type="text" name="name"  id="fn" value="{{old('name')}}">
                                                    <label for="fn">Name</label>
                                                </div>
                                                <div class="input-field col s12 m3">
                                                    <input id="email" name="email" type="email" value="{{old('email')}}">
                                                    @if($errors->has('email'))
                                                        <div id="email-email" class="error invalid_email">{{ $errors->first('email') }}</div>
                                                    @endif
                                                    <label for="email">Email</label>
                                                </div>
                                            
                                                <div class="input-field col s12 m3">
                                                    <input id="password" name="password" type="password">
                                                    <label for="password">Password</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12 m3">
                                                    <input id="country_code" name="country_code" class="phone_number" type="text" value="{{old('country_code')}}">
                                                    <label for="country_code">Country code</label>
                                                </div>
                                                <div class="input-field col s12 m3">
                                                    <input id="mobile" name="mobile" class="phone_number" type="text" value="{{old('mobile')}}">
                                                    @if($errors->has('mobile'))
                                                        <div id="mobile-error" class="error invalid_mobile">{{ $errors->first('mobile') }}</div>
                                                    @endif
                                                    <label for="mobile">Mobile</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="row">
                                                    <div class="input-field col s12 m6">
                                                        <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                                                            <i class="material-icons right">send</i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                            </div>
                        </div>
                        <div class="users-list-filter">
                            <div class="card-panel">
                                <div class="card-content">
                                        <h4 class="card-title">Add user through excel</h4>
                                        <form id="formValidate-excel" method="POST" enctype="multipart/form-data" action="{{route('admin.user.import.excel')}}">
                                            @csrf
                                            <div class="row">
                                                <div class="input-field col s12 m3">
                                                    <input type="file" name="imp_excel"  id="import-file">
                                                    {{-- <label for="fn">Name</label> --}}
                                                </div>
                                                <div class="input-field col s12 m6">
                                                    <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Import
                                                        <i class="material-icons right">send</i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                            </div>
                        </div>
                        <div class="users-list-filter">
                            <div class="card-panel">
                                <div class="card-content">
                                        <h4 class="card-title">Get users list through excel</h4>
                                        <a class="btn btn-success" href="{{ route('admin.user.export.excel') }}">click here</a>
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
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="{{asset('app-assets/js/plugins.js')}}"></script>
    <script src="{{asset('app-assets/js/search.js')}}"></script>
    <script src="{{asset('app-assets/js/custom/custom-script.js')}}"></script>
    <script src="{{asset('app-assets/js/custom/user-add-validation.js')}}"></script>
    <script>
        $(document).ready(function () {

            var msg = '@if(session()->has('message')){{ session()->get('message') }}@endif';
            if(msg){
                M.toast({html: msg, classes: 'rounded'});
            }
        });
    </script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->

@endsection