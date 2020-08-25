<!-- Edit Profile-->
<div class="modal fade" id="userProfile"> 
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="edit-prof">
                    <h2 class="modal-title">Edit Profile</h2>
                    <p>Your account information</p>
                </div>
                <span class="close" title="Close Modal" data-dismiss="modal" aria-label="Close">&times;</span>                
            </div>
            <form action="{{route('account.update')}}" enctype="multipart/form-data" method="POST">
                @csrf
            <div class="modal-body">
                <div class="container">
                    <input type="text" placeholder="Firstname" name="name" id="profileName" value="{{auth()->user()->name}}" required>
        
                    <input type="text" placeholder="Lastname" name="lastname" id="profileLastname" value="{{auth()->user()->lastname}}" required>
        
                    <input type="email" placeholder="Email" name="email" id="profileEmail" value="{{auth()->user()->email}}" required>
        
                    <div class="btn-pwd"><p><input type="checkbox" id="imgCheck"> Add profile image?</p></div>
                    <input type="file" class="img-file" name="image" id="image">
        
                    <div class="btn-pwd"><p><input type="checkbox" id="pwdCheck"> Change password?</p></div>                               
                    <div class="change-pwd">
                        <input type="password" placeholder="New Password" id="newPassword" name="new_password">
                        <input type="password" placeholder="Confirm Password" id="confirmPassword" name="confirm_password">
                    </div> 
        
                    <button type="submit" class="save-info">Save</button>                                   
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Edit Profile -->

    