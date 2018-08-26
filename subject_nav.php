<nav style="padding:0px;margin:0px;" class="navmenu navmenu-default" role="navigation">
  

  <ul class="nav navmenu-nav">
    <?php
        $cmd="select name from subjects order by id asc";
        $res=mysqli_query($connect,$cmd);
        while($rec=mysqli_fetch_assoc($res))
        {
            $sub=$rec["name"];
            
            if($sub==$default_subject)
            {
                echo "<li class='active'>";
            }
            else
            {
                echo "<li>";
            }
            echo "<a href='quiz.php?subject=$sub'>$sub</a>";
            echo "</li>";
        }
    ?>
    
    
  </ul>
</nav>