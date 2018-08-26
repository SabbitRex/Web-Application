<nav id="nav" class="navbar navbar-default">
    
    <div class="container-fluid">
        <div class="navbar-header">
           
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#my_nav">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
            
            <a class="navbar-brand" href="index.php">
                <i class="fa fa-cube"></i> SpecQuiz
            </a>
        </div>
        
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="my_nav">
            
            <ul class="nav navbar-nav navbar-right">
                <?php
                    if(isset($_SESSION["isLoggedIn"]))
                    {
                        ?>
                <li>
                    <a href="signout.php">Sign Out</a>
                </li>
                        <?Php
                    }
                    else
                    {
                        ?>
                                
                <li>
                    <a href="" data-toggle="modal" data-target="#signinModal">Sign In</a>
                </li>
                        <?php
                    }
                ?>
                
                
                
                
            </ul>
        
        </div>
    </div>
</nav>