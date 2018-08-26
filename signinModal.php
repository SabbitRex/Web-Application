<div class="modal fade" id="signinModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" class="close">
                    &times;
                </button>
            </div>
            
            <div class="modal-body">
                <form action="<?= $_SERVER["PHP_SELF"]?>" method="post">
                    <div class="input-group form-group">
        <span class="input-group-addon">
            <i class="fa fa-2x fa-user-o"></i>                
        </span>
                        
        <input type="email" name="user_email" placeholder="Email" class="form-control" requierd/>                
                        
                    </div>
                    
                    
                    <div class="input-group form-group">
        <span class="input-group-addon">
            <i class="fa fa-2x fa-lock"></i>                
        </span>
                        
        <input type="password" name="user_pass" placeholder="Password" class="form-control" requierd/>                
                        
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" value="Sign In" class="btn btn-primary" name="signin">
                    </div>
                </form>
            </div>
            
            <div class="modal-footer">
                <a href="changePassword.php">Forgot Password</a>
            </div>
        </div>
    </div>
</div>