<?php
session_start();
require_once("connect.php");

if(isset($_SESSION["isLoggedIn"]))
{
    header("location: quiz.php");
}
else
{
?>
<html>
    <head>
        <?php require_once("head.php")?>
    </head>
    
    <body>
        <?php require_once("navbar.php")?>
        
        
        <main>
        <div class="container-fluid" style="padding-top:10px;">
            <?php require_once("validateUser.php")?>
            
            
            <div class="row">
                <div class="col-md-8 col-lg-8">
                    
                    <?php require_once("slider.php")?>
                    
                    
                </div>
                
                <div class="col-md-4 col-lg-4">
                    <?php
                    require_once("register.php");
                    ?>
                    
                    
                    
                    <div style="display:none;" class="alert alert-danger" id="error_div">
                        
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        
                        
                        <strong>
                            <i class="fa fa-exclamation-triangle"></i>
                            <span id="err_msg">
                            </span>
                            
                        </strong>
                    </div>
                    
                    
                    <form id="signup_form" method="post">
                        
                        <div class="form-group">
            <input type="text" placeholder="Name" class="form-control" required name="user_name">
                        </div>
                        
                        <div class="form-group">
            <input id="email" type="email" placeholder="Email" class="form-control" required name="user_email">
                        </div>
                        
                        
                        <div class="form-group">                
                    <select id="c_codes" name="country_code" class="form-control">  
                        <option>
                            Country Code
                        </option>
                    </select>
           
                        </div>
                        
                        <div class="form-group">                
                            
            <input id="cno" type="tel" placeholder="Mobile" class="form-control" required name="user_cno" maxlength="10">
                        </div>
                        
                        <div class="form-group">
            <input id="password" type="password" placeholder="Password" class="form-control" required name="user_pass">
                        </div>
                        
                        <div class="form-group">
            <input id="c_password" type="password" placeholder="Confirm Password" class="form-control" required>
                        </div>
                        
                        
                        <div class="form-group input-group">
                            <div id="captcha" class="form-control">
                                <?php 
                                require_once("captcha/captcha.php");
                                ?>
                            </div>
                            
                            <div class="input-group-btn">
                    <input id="re_captcha" type="button" value="Regenerate Captcha" class="btn btn-default"/> 
                            </div>
                            
                        </div>
                        
                        
                        <div class="form-group">
            <input id="u_captcha" type="text" placeholder="Enter Captcha" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
            <input type="submit" value="Sign up" class="btn btn-success btn-block" name="signup"/>
                        </div>
                            
                        
                        
                    </form>
                </div>
            </div>
            
        </div>
            
            
        </main>
        
        
        <?php require_once("footer.php")?>
        <?php require_once("signinModal.php")?>
        
        
        <?php require_once("scripts.php")?>
        
        <script>
            $(document).ready(function(){
                $.getJSON("phone.json",function(data){
                    $.each(data,function(key,value){
                        var element="<option>"+value+"</option>";
                        $("#c_codes").append(element);
                        
                    })
                })
            })
        </script>
    </body>
</html>
<?php
}
?>