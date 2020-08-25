<!-- Login Modal Section-->
<div class="modal fade" id="userLogin"> 
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <div class="login-reg-title">
                <h5 class="modal-title">Customer {{ __('Login') }}</h5>
                <p>Discover Latest products and great deals.</p>
            </div>
            <span class="close" title="Close Modal" data-dismiss="modal" aria-label="Close">&times;</span>                
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="modal-body">
                <div class="container">
                    <a href="#" class="fb btn-login-reg">
                        <i class="fab fa-facebook fa-fw"></i>Login with Facebook
                    </a>
                    <a href="#" class="google btn-login-reg"><i class="fab fa-google fa-fw">
                        </i>Login with Google+
                    </a>  
                    <div class="or-div"><span class="or-text">or</span></div>         
                    
                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required autocomplete="email" autofocus>
    
                    <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}" required autocomplete="current-password">
                                           
                    <button type="submit" class="login btn-login-reg"> {{ __('Login') }}</button>
                        
                    <label>
                        <input class="remember-me" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
            <div class="modal-footer"> 
                <button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Cancel</button>
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif               
            </div>
        </form>
    </div>
    </div>
</div>
<!-- End of Login Modal Section-->

@section('extra-js')
@parent


@endsection
