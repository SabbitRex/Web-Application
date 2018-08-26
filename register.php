<?php
if(isset($_POST['signup']))
{
    $name=htmlspecialchars(stripslashes(trim($_POST['user_name'])));
    $email=filter_var($_POST['user_email'],FILTER_SANITIZE_EMAIL);
    $pass=trim($_POST['user_pass']);
    $cno=trim($_POST["user_cno"]);
    
    
    $pass_hash=password_hash($pass,PASSWORD_DEFAULT);
    
    $sql="insert into users (name,email,password,mobile) values ('$name','$email','$pass_hash','$cno')";
    
    $res=mysqli_query($connect,$sql);
    if($res)
    {
        $_SESSION["isLoggedIn"]=true;
       
        
        $_SESSION["default_subject"]="HTML";
        $sql="select * from question_set where subject='HTML'";
        $res=mysqli_query($connect,$sql);
        $_SESSION["question_set"]=mysqli_fetch_all($res,MYSQLI_ASSOC);
        $_SESSION["user_ans"]=array();
        
        $root_dir=$name."_".md5($email);
        mkdir("user_data/$root_dir");
        mkdir("user_data/$root_dir/profile_pic");
        
        $sql="update users set root_dir='$root_dir' where email='$email'";
        mysqli_query($connect,$sql);
        
         $_SESSION['info']=array("name"=>$name,"email"=>$email,"profile"=>null,"root_dir"=>$root_dir);
        
        header("location: quiz.php");
    }
    else
    {
        ?>

<div class="alert alert-danger">

    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>


    <strong>
        <i class="fa fa-exclamation-triangle"></i>
        <?= mysqli_error($connect)?>
    </strong>
</div>
        <?php
    }
    
    
}
?>