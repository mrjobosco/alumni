<?php


class Template
{


    public static function start(){

        $user = new User();


        echo '
        
        <div style="margin-bottom: 100px">



  <header style="position: fixed; top: 0; width: 100%; z-index: 200; background-color: floralwhite">
  <div class="container">
<div class="row">
    <div style="margin: 5px"></div>

    <div class="col-md-6"><img src="img/logo.png"></div>

    <div class="col-md-6">
        <div style="color: #009241; padding-top:45px; font-size: 1.3em" class="pull-right">Contact us on:
            <a href="mailto:ifo@cjinnovators.com"><i class="fa fa-fw fa-envelope"></i></a>
            <a href="tel:07037350494"><i class="fa fa-fw fa-phone"></i> </a>
        </div>
    </div>
</div>
</div>
<div style="margin: 5px"></div>
<nav class="navbar top-link" style="background-color:#009241; padding-bottom: 0; margin-bottom: 0 ">
    <div class="container-fluid" style="padding-bottom: 0; margin-bottom: 0" >
  
      
      ';

        if ($user->isLoggedIn()) {

            echo '
                <div class="chat-box">
                    <div onClick="$(\'.chat-box\').hide()" class="pull-right" style="cursor: pointer;">&times</div>
                    <div class="chatBoxBody">
                    
                    </div>
                </div>
            
              <ul class="navbar-nav navbar-left top-link-links">
              <li style="color: #ffffff; margin-right: 13px;"> '.$user->activeRecord()->data()->first_name.' '.$user->activeRecord()->data()->last_name.' </li>
              <li><img src="'.$user->activeRecord()->data()->profile_picture.'" height="25px"></li>
          <li><a href="profile.php" class="navbar-link">Profile</a></li>
          <li><a id="chat-btn" style="cursor: pointer;" class="navbar-link">Chat</a></li>';
          if($user->isAdmin()){

         echo' 
          <li><a href="manageUsers.php">Manage Users</a></li>
        <li><a href="moderator.php">Moderators</a></li>
        <li><a href="addnews.php">Add News</a></li>
        <li><a href="addevents.php">Add Event</a></li>
        
            ';
        }if ($user->isModerator()){

                echo '<li ><a href="categories.php">Manage Categories</a></li>';


            }
         echo '
            <li><a href="ask.php">Ask Question</a></li>
            <li><a href="tags.php">Tags</a></li>
            <li><a href="questions.php">Questions</a></li>
            <li><a href="topics.php">Topics</a></li>
          <li><a href="logout.php" class="navbar-link">Log out</a></li>
          <li><input type="text" id="search" class="nav-input" placeholder="Search Q&A"></li>

    
        </ul>
            
            ';

        }else{

            echo '
        <ul class="navbar-nav navbar-right top-link-links">
          <li><a href="login.php" class="navbar-link">log in</a></li>
          <li><a href="login.php" class="navbar-link">sign up</a></li>
          <li><input type="text" id="search" class="nav-input" placeholder="Search Q&A"></li>

    
        </ul>
        ';


        }
        $cat = new Category();
        $all_cat = $cat->activeRecord()->read()->results();
        $i = 1;

        echo '
      </div>
    </nav>
  </header>

</div>
<div class="container">
        <div class="main-content">


<div class="row">
  <div class="container">

    <div class="">


    </div>
  </div>
</div>

        
        ';



    }


    public static function tabs(){

        echo '
        
        <div class="tabs">
      <div class="tab-item tab-active" id="log-in">
        <a href="#">log in</a>
      </div>
      <div class="tab-item tab-inactive" id="sign-up">
        <a href="#">sign up</a>
      </div>
      <div class="tab-line">

      </div>
    </div>
        ';

    }

}