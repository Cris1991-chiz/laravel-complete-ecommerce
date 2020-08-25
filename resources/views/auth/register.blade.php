<!-- Signup Modal Section-->
<div class="user-add">
    <div class="modal fade" id="userSignup"> 
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="login-reg-title">
                    <h5 class="modal-title">Customer {{ __('Register') }}</h5>
                    <p>Signup on our site now and earn<b> 25 Reward </b>points.</p>
                </div>
                <span class="close" title="Close Modal" data-dismiss="modal" aria-label="Close">&times;</span>                
            </div>
            <div class="modal-body">
                <div class="container">
                    <a href="#" class="fb btn-login-reg">
                        <i class="fab fa-facebook fa-fw"></i>Signup with Facebook
                    </a>
                    <a href="#" class="google btn-login-reg"><i class="fab fa-google fa-fw">
                        </i>Signup with Google+
                    </a>  
                    <div class="or-div"><span class="or-text">or</span></div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        
                        <input id="nameReg" type="text" class="" name="name" value="{{ old('name') }}" placeholder="{{ __('Name') }}"required>

                        <input id="lastnameReg" type="text" class="@error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" placeholder="{{ __('Lastname') }}"required>
                        
                        <input id="emailReg" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}"required>
                    
                        <input id="passwordReg" type="password" class="@error('password') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}"required>
                    
                        <input id="password-confirm" type="password" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required>

                        <button type="submit" class="login btn-login-reg">{{ __('Register') }}</button>
                        
                    </form> 
                </div>
            </div>
            <div class="modal-footer"> 
                <button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Cancel</button>
            </div>
        </div>
        </div>
    </div>
</div>
<!-- End of Signup Modal Section-->


