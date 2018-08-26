<?php
session_start();
require_once("connect.php");

$total_que = $correct = $inc = $skip = $marks = 0;

$que_paper=$_SESSION['question_set'];
$ans=$_SESSION['user_ans'];

foreach($que_paper as $q_index=>$que)
{
    if(isset($ans[$q_index]))
    {
        if(htmlspecialchars($que['answer'])==htmlspecialchars($ans[$q_index]))
        {
            $correct++;
        }
        else
        {
            $inc++;
        }
    }
    else
    {
        $skip++;
    }
}

$marks=($correct*4)-($inc);

$u_id=$_SESSION["info"]["user_id"];
$sub=$_SESSION["default_subject"];
$dt=$_SESSION["s_time"];

$sql="insert into result values(null,$u_id,'$sub',$correct,$inc,$skip,$marks,'$dt')";

$res=mysqli_query($connect,$sql);

?>

<html>
    <head>
        <?php require_once("head.php")?>
    </head>
    
    <body>
        <?php require_once("navbar.php")?>
        
        
        <main>
            <div class="container-fluid">
                <div class="row">
                
                <div class="col-md-8 col-lg-8 text-center">
                
                <div class="panel panel-success text-center score-card">
                    <div class="panel-body">
                        <?= $correct?>
                    </div>
                    <div class="panel-footer">
                        Correct Answers
                    </div>
                </div>
                
                
                <div class="panel panel-danger text-center score-card">
                    <div class="panel-body">
                        <?= $inc?>
                    </div>
                    <div class="panel-footer">
                        Incorrect Answers
                    </div>
                </div>
                
                
                <div class="panel panel-warning text-center score-card">
                    <div class="panel-body">
                        <?= $skip?>
                    </div>
                    <div class="panel-footer">
                        Skiped Questions
                    </div>
                </div>
                    
                <div class="panel panel-warning text-center score-card">
                    <div class="panel-body">
                        <?= $marks?>
                    </div>
                    <div class="panel-footer">
                        Obtained Marks
                    </div>
                </div>
                </div>
                
                <div class="col-md-4 col-lg-4">
                     
                    <div class="well" style="margin:20px;">
                    <?php
                        foreach($que_paper as $q_index=>$que)
                        {
                            echo "<div style='width:100%;' class='alert alert-success'>";
                            ?>
                            <strong>
                                Question : <?= $que['question']?>
                            </strong>
                            <?php
                            echo "</div>";
                                
                        }
                    ?>
                    
                    </div>
                    </div>
                </div>
            </div>
            
            
        </main>
        
        
        <?php require_once("footer.php")?>
        <?php require_once("scripts.php")?>
    </body>
</html>