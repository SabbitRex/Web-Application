<?php
session_start();
if(isset($_SESSION["isLoggedIn"]))
{
    require_once("connect.php");
?>
<html>
    <head>
        <?php require_once("head.php")?>
    </head>
    
    <body>
        <?php require_once("navbar.php")?>
        
        
        <main>
        <div class="container" style="padding-top:10px;width:50%;">
            
            <?php
                if(isset($_POST['upload']))
                {
                    $file=$_FILES['profile'];
                    $error_code=$file['error'];
                    $name=$file['name'];
                    $tmp_name=$file['tmp_name'];
                    $type=$file['type'];
                    $size=$file['size'];
                    
                    if($error_code==UPLOAD_ERR_OK)
                    {
                        $new_name=time()."_$name";
        move_uploaded_file($tmp_name,"user_data/".$_SESSION['info']['root_dir']."/profile_pic/$new_name");
                        
                        $cmd="update users set profile='$new_name' where email='".$_SESSION['info']['email']."'";
                        $res=mysqli_query($connect,$cmd);
                        if($res)
                        {
        $_SESSION['info']['profile']="user_data/".$_SESSION['info']['root_dir']."/$new_name";
                        ?>
            
                        <?php
                        }
                    }
                }
            ?>
            
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Update Profile
                </div>
                
                <div class="panel-body text-center">
                    <form method="post" enctype="multipart/form-data">
                        
                        
                        <div class="fileinput fileinput-new" data-provides="fileinput">
  <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
      
    <?php
    $src="user_data/".$_SESSION['info']['root_dir']."/profile_pic/".basename($_SESSION['info']['profile']);
    if(empty($_SESSION['info']['profile']))
    {
$src="https://www.hit4hit.org/img/login/user-icon-6.png";
    }
?>
      
    <img src="<?= $src?>" alt="">
  </div>
  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
  <div>
    <span class="btn btn-default btn-file">
        <span class="fileinput-new">
            <i class="fa fa-photo"></i> Select image
        </span>
        <span class="fileinput-exists">
            <i class="fa fa-edit"></i> Change
        </span>
        
        <input type="file" name="profile"></span>
    
      <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">
         <i class="fa fa-trash"></i> Remove
      </a>
      
      <button type="submit" class="btn btn-primary fileinput-exists" value="upload" name="upload">
          <i class="fa fa-upload"></i> Update Profile
      </button>
      
      
  </div>
</div>
                        
                        
                    </form>
                </div>
                
                <div class="panel-footer">
                    <a href="quiz.php" class="btn btn-primary">
                        Back
                    </a>   
                </div>
            </div>
            
            
            
            
        </div>
            
            
        </main>
        <?php require_once("footer.php")?>
        <?php require_once("scripts.php")?>
        </body>
</html>
<?php
}
else
{
    header("location: index.php?not_logged_in=true");
}

?>