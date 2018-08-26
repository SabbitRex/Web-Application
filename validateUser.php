<?php
if(isset($_POST['signin']))
{
    
    $email=filter_var($_POST["user_email"],FILTER_SANITIZE_EMAIL);
    $pass=$_POST['user_pass'];
    $sql="select * from users where email='$email'";
    $res=mysqli_query($connect,$sql);
    if($res)
    {
        if(mysqli_num_rows($res) > 0)
        {
            $info=mysqli_fetch_assoc($res);
            $pass_hash=$info['password'];
            if(password_verify($pass,$pass_hash))
            {
                
                $_SESSION["isLoggedIn"]=true;
                $_SESSION["info"]=$info;
                $_SESSION["default_subject"]="HTML";
                $sql="select * from question_set where subject='HTML'";
                $res=mysqli_query($connect,$sql);
    $_SESSION["question_set"]=mysqli_fetch_all($res,MYSQLI_ASSOC);
    shuffle($_SESSION["question_set"]);
                $_SESSION["user_ans"]=array();
                header("location: quiz.php");
            }
            else
            {
                ?>

<div class="alert alert-danger">

    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>


    <strong>
        <i class="fa fa-exclamation-triangle"></i>
        Incorrect email or password.

    </strong>
</div>

            <?php
            }
        }
        else
        {
            ?>

<div class="alert alert-danger">

    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>


    <strong>
        <i class="fa fa-exclamation-triangle"></i>
        Incorrect email or password.

    </strong>
</div>

            <?php
        }
    }
    else
    {
        
    }
}
?>