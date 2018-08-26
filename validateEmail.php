<?php
if(isset($_POST['user_email']))
{
    $email=$_POST['user_email'];
    require_once("connect.php");
    $cmd="select * from users where email='$email'";
    $res=mysqli_query($connect,$cmd);
    if($res)
    {
        if(mysqli_num_rows($res)>0)
        {
            $output=array("status"=>true,"msg"=>"Email address already exists.");
        }
        else
        {
            $output=array("status"=>false);
            
        }
        
        $json_output=json_encode($output);
        echo $json_output;
    }
    else
    {
        
    }
}
?>