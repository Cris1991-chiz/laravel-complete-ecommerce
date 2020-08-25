<ul class="social-media">
    <li><a href="contactUs.html"><span class="follow">Follow Us on:</span></a></li>
    <li><a href="contactUs.html"><span class="facebook">Facebook </span>
    <i class="fab fa-facebook-square"></i></a></li>
    <li><a href="contactUs.html"><span class="instagram">Instagram </span>
    <i class="fab fa-instagram-square" aria-hidden="true"></i></a></li>
</ul>
<ul>
    @guest
        <li><a href="#" data-toggle="modal" data-target="#userLogin" class="login-modal">Login</a></li>
        <li><a href="#" data-toggle="modal" data-target="#userSignup" class="register-modal">Register</a></li>
    @else
    <div class="account-btn-dropdown">

    <li><a href="#">{{ Auth::user()->name }} <i class="fa fa-caret-down"></i></a></li>
        
        <ul class="dropdown-content">
            <li><a href="{{route('account.edit')}}">Dashboard</a></li>
            <li><a href="{{route('wishlist.index')}}">My Wishlist</a></li>
            <li><a href="{{route('orders.index')}}">My Order</a></li>
            <li class="signout"><a href="{{ route('account.logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                 {{ __('Signout') }}</a>
 
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                 @csrf
            </form></li>
        </ul>
    </div>       
    
    <li><a href="{{route('personalinfo.index')}}"><span class="checkout">Checkout</span>
    <i class="fa fa-credit-card"></i></a></li></li>
    @endguest
    @if(!auth()->user())
    <li><a href="{{route('checkout.index')}}" class="signup btn-login-reg">Checkout as <i class="fas fa-user"></i></a></li>
    @endif
    <li><a href="contactUs.html"><span class="contact">Contact Us</span> <i class="fa fa-phone"></i></a></li>
</ul>
