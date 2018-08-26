<?php
session_start();
require_once("connect.php");
?>
<html>
    <head>
        <?php require_once("head.php")?>
    </head>
    
    <body>
        <?php require_once("navbar.php")?>
        
        
        <main>
            <div class="container" style="padding-top:10px; width:50%;">
                <?php
                if(isset($_POST['change_password']))
                {
                    $email=$_POST['user_email'];
                    $pass=$_POST['user_pass'];
                    $pass_hash=password_hash($pass,PASSWORD_DEFAULT);
                    $cmd="update users set password='$pass_hash' where email='$email'";
                    $res=mysqli_query($connect,$cmd);
                    if($res)
                    {
                        ?>
                
    <div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>
            <i class="fa fa-check-circle-o"></i>
            Your password has been updated. <a href="index.php">Continue...</a>
        </strong> 
</div>
                        <?php
                    }
                }
    
                if(isset($_POST['verify_digits']))
                {
                    $digits=$_POST['digits'];
                    $u_digits=$_POST['user_digits'];
                    $email=$_POST['user_email'];
                    if($digits==$u_digits)
                    {
                        $mobileVerified=true;
                    }
                    else
                    {
                        ?>
                
    <div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>
            <i class="fa fa-check-exclamation-triangle"></i>
            Verification Failed
        </strong> 
</div>
                        <?php
                    }
                }
                if(isset($_POST['verify']))
                {
        $email=filter_var($_POST['user_email'],FILTER_SANITIZE_EMAIL);
        $sql="select * from users where email='$email'";
        $res=mysqli_query($connect,$sql);
        if($res)
        {
            if(mysqli_num_rows($res)>0)
            {
                $isValidEmail=true;
                $info=mysqli_fetch_assoc($res);
                $mobile=$info['mobile'];
                $start_pos=mt_rand(0,6);
                $digits=substr($mobile,$start_pos,4);
                $hint=str_replace($digits,"****",$mobile);
                
            }
            else
            {
                ?>
                
    <div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>
            <i class="fa fa-exclamation-triangle"></i>
            Incorrect Email
        </strong> 
</div>
                        <?php
            }
        }
                    
                }
        
                if(isset($mobileVerified))
                {    
                    ?>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Recover Password
                        </div>
                        
                        <div class="panel-body">
                            <form method="post">
                                <input type="hidden" name="user_email" value="<?= $email?>">
                                
                                <div class="form-group">
            <input id="password" type="password" placeholder="Password" class="form-control" required name="user_pass">
                        </div>
                        
                        <div class="form-group">
            <input id="c_password" type="password" placeholder="Confirm Password" class="form-control" required>
                        </div>
                                
                        <div class="form-group">
            <input type="submit" value="Change Password" class="btn btn-primary" name="change_password"/>
                        </div>
                                
                            </form>
                            
                        </div>
                    </div>
                    <?php
                }
                else if(isset($isValidEmail))
                {
                    ?>
                <div class="panel panel-primary">
                    
                    <div class="panel-heading">
                        Verify Mobile
                    </div>
                    
                    <div class="panel-body">
                        <form method="post">
                        
            <input type="hidden" name="user_email" value="<?= $email?>">
                            
            <input type="hidden" name="digits" value="<?= $digits?>">
                            
                            
                        <div class="form-group">
                            <div class="form-control text-center">
                                <?= $hint?>
                            </div>
                        </div>
                        
                            
                            
                        <div class="form-group input-group">
            
    <input id="email" type="tel" maxlength="4" placeholder="Enter Missing Digits" class="form-control" required name="user_digits">
                            
                             <div class="input-group-btn">
            <input type="submit" value="Verify Mobile" class="btn btn-success" name="verify_digits"/>
                            </div>
                            
                            
                        </div>
                        
                        
                        
                        
                      
                        
                        
                        
                       
                            
                        
                        
                    </form>
                    </div>
                </div>
                    <?php
                }
                else
                {
                ?>
                <div class="panel panel-primary">
                    
                    <div class="panel-heading">
                        Verify Email
                    </div>
                    
                    <div class="panel-body">
                        <form id="changePass" method="post">
                        
                        
                        
                        <div class="form-group input-group">
            
    <input id="email" type="email" placeholder="Email" class="form-control" required name="user_email">
                            
                             <div class="input-group-btn">
            <input type="submit" value="Verify Email" class="btn btn-success" name="verify"/>
                            </div>
                            
                            
                        </div>    
                    </form>
                    </div>
                </div>
                <?php
                }
                
                ?>
            </div>
            
            
        </main>
        
        
        <?php require_once("footer.php")?>
        <?php require_once("signinModal.php")?>
        
        
        <?php require_once("scripts.php")?>
    </body>
</html>
