@extends('auth.layout_auth.layout_auth')
@section('body')
 <div class="row">
        <div class="col s12">
            <div class="container">
                <div id="forgot-password" class="row">
                    <div class="col s12 m6 l4 z-depth-4 offset-m4 card-panel border-radius-6 forgot-card bg-opacity-8">
                        <form method="post" id="formValidate" action="{{route('password.email')}}" class="login-form">
                          @csrf
                            <div class="row">
                                <div class="input-field col s12">
                                    <h5 class="ml-4">Forgot Password</h5>
                                    <p class="ml-4">You can reset your password</p>
                                </div>
                            </div>
                            <div class="row">
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
                                <div class="input-field col s12">
                                  
                                  @if (session()->has('success'))
                                    <div class="alert alert-success">
                                        @if(is_array(session('success')))
                                            <ul>
                                                @foreach (session('success') as $message)
                                                    <li>{{ $message }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            {{ session('success') }}
                                        @endif
                                    </div>
                                  @endif
                                </div>

                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12" type="submit" name="action">Reset Password</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m12 l12 center">
                                    <p class="margin medium-small"><a href="{{route('login')}}">Login</a></p>
                                </div>
                                {{-- <div class="input-field col s6 m6 l6">
                                    <p class="margin right-align medium-small"><a href="user-register.html">Register</a></p>
                                </div> --}}
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
    <script src="{{asset('app-assets/js/custom/Forgot-form-validator.js')}}"></script>
@endsection