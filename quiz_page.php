<?php
session_start();
if(isset($_SESSION["isLoggedIn"]))
{

if(!isset($_SESSION["isQuizRunning"]))
{
    date_default_timezone_set("asia/kolkata");
    $month=date("M");
    $day=date("d");
    $year=date("Y");
    $h=date("H");
    $m=date("i");
    $s=date("s");
    
    $startTime=array("month"=>$month,"day"=>$day,"year"=>$year,"h"=>$h,"m"=>$m,"s"=>$s);
    
    $_SESSION["start_time"]=$startTime;
    $_SESSION["s_time"]=date("M d, Y H:i:s");
    $_SESSION["isQuizRunning"]=true;
}
    
require_once("connect.php");
$qid=0;
$default_subject=$_SESSION["default_subject"];

if(isset($_POST['submit_ans']))
{
    $q_id=$_POST['c_que'];
    if(isset($_POST['answer']))
    {
        $ans=$_POST['answer'];
        $_SESSION['user_ans'][$q_id]=$ans;
    }
    $qid=$q_id+1;
    if($qid==count($_SESSION["question_set"]))
    {
        header("location: result.php");
    }
}
    
    

if(isset($_REQUEST['subject']))
{
    $default_subject=$_REQUEST['subject'];
    $_SESSION["default_subject"]=$default_subject; 
    
    $sql="select * from question_set where subject='$default_subject'";
    $res=mysqli_query($connect,$sql);
$_SESSION["question_set"]=mysqli_fetch_all($res,MYSQLI_ASSOC);
    shuffle($_SESSION["question_set"]);
    $_SESSION["user_ans"]=array();
}

$question=$_SESSION['question_set'][$qid];


?>

<html>
    <head>
        <?php require_once("head.php")?>
    </head>
    
    <body>
        <?php require_once("navbar.php")?>
        
        
        <main>
        <div class="container-fluid" style="padding-top:10px;">
            <div class="row">
                
                <div class="col-md-3 col-lg-3">
                    <?php require_once("profile_panel.php")?>
                    <?php require_once("subject_nav.php")?>    
                </div>
                
                
                <div class="col-md-7 col-lg-7">
                    <form action="<?= $_SERVER["PHP_SELF"]?>" method="post">
                    
                    <div class="panel panel-primary">
                        <div class="panel-heading">
        <span>
            SpecQuiz '<?= $default_subject?>' Quiz
        </span>
                            
        <span class="pull-right">
            Total Questions : <?= count($_SESSION['question_set'])?>
        </span>
                        </div>
                        
                        <div class="panel-body">
                            
                            <div class="alert alert-info">
                                <strong>
                                    Question <?= $qid+1?>
                                </strong>
                                
                                <p>
                    <?= htmlspecialchars($question['question'])?>
                                </p>
                            </div>
                            
                            
                            <div class="alert alert-info">
                    <input type="hidden" name="c_que" value="<?= $qid?>">
                                
                                <?php
                                foreach($question as $field=>$value)
                                {
                                   if($field!="qid" and $field!="question" and $field!="answer" and $field!="subject")
                                   {
                                       
                                       if(!empty($value))
                                       {
                                            ?>
<div class="radio">
  <label>
    <input type="radio" name="answer" value="<?= htmlspecialchars($value)?>"><?= htmlspecialchars($value)?>
    
  </label>
</div>
                                            <?php
                                       }
                                   }
                                }
                                ?>
                            </div>
                            
                        </div>
                        
                        
                        <div class="panel-footer text-right">
           <input type="submit" name="submit_ans" value="Next Question" class="btn btn-primary"/>                 
           
                        </div>
                    </div>
                    
                    </form>
                </div>
                
                <div class="col-md-2 col-lg-2">
                    <div class="panel panel-primary" id="time_panel">
                        <div class="panel-heading">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        
                        <div class="panel-body text-center" id="r_time">
                            
                        </div>
                    </div>
                    
                </div>
                
            </div>
            
        </div>
            
            
        </main>
        
        
        <?php require_once("footer.php")?>
        <?php require_once("scripts.php")?>
        
        <script>
            $(document).ready(function(){
                var eh=0;
                var em=0;
                var es=59;
                var i;
                var dt;
                
                $.ajax({
                    url:"getStartTime.php",
                    type:"post",
                    success:function(result){
                        //var res=JSON.parse(result);
                        j_dt=JSON.parse(result);
                        dt=j_dt["month"]+" "+j_dt["day"]+", "+j_dt["year"]+" "+(parseInt(j_dt["h"]))+":"+(parseInt(j_dt["m"])+3)+":"+j_dt["s"];
                        //alert(dt);
                        setCountDown(dt);
                    }
                })
               
                
              /*  function setPageTime()
                {
                    var dt=new Date();
                    var h=eh-dt.getHours();
                    var m=em-dt.getMinutes();
                    var s=es-dt.getSeconds();
                    if(h==0 && m==0 && s==0)
                    {
                        clearInterval(i);
                        window.location="result.php";
                    }
                    else
                    {
                    
                        var time=h+" : "+m+" : "+s;
                    //var time=dt.getHours()+" : "+dt.getMinutes()+" : "+dt.getSeconds();
                        $("#r_time").html(time);
                    }
                }*/
                
                
                //i=setInterval(function(){setPageTime()},1000);
                
                function setCountDown(dt)
                {
                
                // Set the date we're counting down to
                
                
var countDownDate = new Date(dt).getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get todays date and time
  var now = new Date().getTime();

  // Find the distance between now an the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  //var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  //document.getElementById("r_time").innerHTML = days + "d " + hours + "h "
  //+ minutes + "m " + seconds + "s ";
    
    if( (minutes==0) && (seconds<10))
    {
        $("#time_panel").removeClass("panel-primary");        
        $("#time_panel").addClass("panel-danger animated tada infinite");      
    }
    
    
    document.getElementById("r_time").innerHTML = hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("r_time").innerHTML = "EXPIRED";
    window.location="result.php?isTimeOut=true";
  }
}, 1000);
                
                }
                
            })
            

                
                
        </script>
        
    </body>
</html>
<?php
}
else
{
    header("location: index.php?not_logged_in=true");
}

?>