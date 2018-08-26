<div class="panel panel-primary">
                        <div class="panel-body text-center">
                            <?php
        $src="user_data/".$_SESSION['info']['root_dir']."/profile_pic/".basename($_SESSION['info']['profile']);
                                if(empty($_SESSION['info']['profile']))
                                {
                $src="https://www.hit4hit.org/img/login/user-icon-6.png";
                                }
                            ?>
                            
                            
                            <img src="<?= $src?>" width="100px" class="img-thumbnail">
                        </div>
                        
                        
                        <div class="panel-footer">
                        <table width="100%">
                            <tr align="center">
                                <td width="60%">
                        <div><?= $_SESSION['info']['name']?></div>
                        <div><?= $_SESSION['info']['email']?></div>
                                </td>
                                <td align="right">
                                    
                                    
                                    <div class="dropdown">
  <button style="font-size:14px;" class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    Actions
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
      <li>
          <a href="profile.php">
          <i class="fa fa-user-o"></i> View Profile
          </a>
      </li>
    <li>
        <a href="updateProfilePic.php">
            <i class="fa fa-photo"></i> Upload Profile Image
        </a>
      </li>
    <li>
        <a href="playground.php">
            <i class="fa fa-cube"></i> Code Playground
        </a>
      </li>
      
      
      <li>
        <a href="quiz_page.php">
            <i class="fa fa-question-circle-o"></i> Start Quiz
        </a>
      </li>
      
      
      
    <li role="separator" class="divider"></li>
      <li><a href="signout.php"><i class="fa fa-sign-out"></i> Sign Out</a></li>
  </ul>
</div>
                                    
                                    
                                </td>
                            </tr>
                        </table>
                            
                        </div>
                        
                    </div>