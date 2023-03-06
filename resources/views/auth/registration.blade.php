@extends('auth.layout_auth.layout_auth')
@section('body')
    <div class="row">
        <div class="col s12">
            <div class="container">
                <div id="register-page" class="row">
                    <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 register-card bg-opacity-8">
                        <form class="login-form" id="formValidate" method="post" action="{{route('register')}}">
                            @csrf
                            <div class="row">
                                <div class="input-field col s12">
                                    <h5 class="ml-4">Register</h5>
                                    <p class="ml-4">Join to our community now !</p>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">person_outline</i>
                                    {{-- <input id="username" type="text"> --}}
                            		<input type="text" id="name" name="name" value="{{old('name')}}">
                                    <label for="name" class="center-align">Name</label>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">mail_outline</i>
		                            <input type="text" id="email" name="email" value="{{old('email')}}">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">lock_outline</i>
                            		<input type="password" id="password" name="password">
                                    <label for="password">Password</label>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">lock_outline</i>
                            		<input type="password" id="password_confirmation" name="password_confirmation" >
                                    <label for="password_confirmation">Password again</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12" type="submit">Register</button>

                                    {{-- <a href="index.html" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Register</a> --}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <p class="margin medium-small"><a href="{{route('login')}}">Already have an account? Login</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('app-assets/js/custom/Registration-form-validator.js')}}"></script>
@endsection