@extends('auth.layout_auth.layout_auth')
@section('body')
    <div class="row">
        <div class="col s12">
            <div class="container">
                <div id="login-page" class="row">
                    <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
                        <form method="post" id="formValidate" class="login-form" action="{{route('password.update')}}">
                        	@csrf
                            <div class="row">
                                <div class="input-field col s12">
                                    <h5 class="ml-4">Reset Password</h5>
                                </div>
                            </div>
                          	<input type="hidden" name="token" value="{{ $token }}">

                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">person_outline</i>
                                    <input id="email" name="email" value="{{old('email')}}" type="text">
                                    @if ($errors->any())
                                        @foreach ($errors->all() as $error)
                                            <div id="email-error" class="error">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                    <label for="email" class="center-align">Email</label>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">lock_outline</i>
                                    <input id="password" name="password" type="password"  autocomplete="on">
                                    <label for="password">Password</label>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">lock_outline</i>
                                    <input id="password_confirmation" name="password_confirmation" type="password"  autocomplete="on">
                                    <label for="password_confirmation">Password Confirmation</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12" type="submit" name="action">Submit</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m12 l12 center">
                                    <p class="margin medium-small"><a href="{{route('login')}}">Login</a></p>
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
    <script src="{{asset('app-assets/js/custom/login-form-validator.js')}}"></script>
@endsection