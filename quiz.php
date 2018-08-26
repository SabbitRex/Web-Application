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
        <div class="container-fluid" style="padding-top:10px;">
            <div class="row">
                
                <div class="col-md-3 col-lg-3">
                    
                    <?php require_once("left_side.php")?>
                    
                
                    
                    
                    
                    
                    
                    
                    
                    
                </div>
                
                
                <div class="col-md-9 col-lg-9">
                    
                </div>
                
                
                
            </div>
            
        </div>
            
            
        </main>
        
        
        <?php require_once("footer.php")?>
        <?php require_once("scripts.php")?>
        
        <script>
            $(document).ready(function(){
                var eh=12;
                var em=59;
                var es=59;
                var i;
                function setPageTime()
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
                }
                
                i=setInterval(function(){setPageTime()},1000);
                
                
                
                function getLocation()
                {
                    if(navigator.geolocation)
                    {
            navigator.geolocation.getCurrentPosition(showPosition)
            navigator.geolocation.getCurrentPosition(showPositionOnMap);
                        
                    }
                    else{
                        $("#location").html("Geolocation Error");
                    }
                }
                
                
                function showPosition(position)
                {
                    $("#lat").html(position.coords.latitude);
                    $("#long").html(position.coords.longitude);
                }
                
                function showPositionOnMap(position) {
    var latlon = position.coords.latitude+","+position.coords.longitude;

    var img_url = "https://maps.googleapis.com/maps/api/staticmap?center="+latlon+"&zoom=14&size=250x250&sensor=false&key=AIzaSyAO_9_s1QSHNfKDrG0teh9IHrL5LAJE5gU";

    document.getElementById("location_map").innerHTML = "<img src='"+img_url+"'>";
}


                
                getLocation();
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