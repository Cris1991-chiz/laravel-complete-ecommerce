<div class="profile">
    @if(auth()->user()->profileImage())
    <img src="{{asset(auth()->user()->profileImage())}}" alt="">
    @else
    <img src="{{asset('storage/profile/no_profile_image.png')}}" alt="">
    @endif
    <p><b>{{auth()->user()->name}}</b></p>
    <p>{{auth()->user()->email}}</p>
    <a href="#" data-toggle="modal" data-target="#userProfile" id="edit-profile">EDIT</a> 
</div>
<div class="profile-ext">
    <div class="orders-container">
        <div class="row-count">
        <span class="count">{{($count)}}</span>                     
        </div>
        <p>Current Orders</p>
    </div>
    <div class="rewards-container">
        <div class="reward-count">
            <span class="count">125</span>
        </div>
        <p>Current Reward Points</p>
    </div>
</div>