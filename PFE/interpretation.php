<?php 

require "database.php";
session_start();

if ( $_SESSION['logged_in'] != 1 ) {

$_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location:index.php");

}
else 
{
  $first_name=$_SESSION['first_name'];
  $second_name=$_SESSION['Second_name'];
  $email=$_SESSION['Email'];
  $inst=$_SESSION['Institution'];
  if($_SESSION['Confidential_Level']<5)
  {
    $lvl=1;
  }
  elseif ($_SESSION['Confidential_Level']<10)
  {

    $lvl=2;
  }
  else
  {
    $lvl=3; 
  }

}


?>


<!DOCTYPE html>
<html>


<?php 

if($_SERVER['REQUEST_METHOD']=='POST')
{
    if(isset($_POST['Claaaaaass']))
    {
      require "interpretationn.php";
        interp($database);
     
    }
    if (isset($_POST['downloadd']))
    {
      require "interpretationn.php";
      download_interp($database,$_POST['txtScript'],$_POST['actionss'],$_POST['ACTS']);
    }
    if(isset($_POST['classs']))
    {
      require "interpretationn.php";
      interpp($database);
    }
    if(isset($_POST['downs']))
    {
require "interpretationn.php";
      download_interpp($database,$_POST['obj3'],$_POST['act3'],$_POST['actts']);

    }
    if(isset($_POST['Interp_final']))
    {
      require "new_interp.php";
      /*
      $resultat=Generate_triplet($database,$_POST['object15'],$_POST['action15'],$_POST['acteur15']);
      $resultat2= only_correct_triplet_transi($database,$resultat,"bedroom");
      
      $x=check($resultat2);
      echo  create_pluar_sentence($resultat2[0]);*/
       interpretation_final($database);
    } 
}


?>


  <head>
    <style> 
textarea {
    width: 100%;
    height: 80px;
    padding: 12px 20px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
    font-size: 16px;
    resize: none;
}
</style>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Image 2 Text</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="css/fontastic.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Google fonts - Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="favicon.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

          <script src="sweetalert2-master/dist/sweetalert2.min.js"></script>
        <link rel="stylesheet" type="text/css" href="sweetalert2-master/dist/sweetalert2.css">

    
    
  </head>
  <body>
    <div class="page form-page">
      <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">
          <!-- Search Box-->
          <div class="search-box">
            <button class="dismiss"><i class="icon-close"></i></button>
            <form id="searchForm" action="#" role="search">
              <input type="search" placeholder="What are you looking for..." class="form-control">
            </form>
          </div>
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                <!-- Navbar Brand --><a href="index.php" class="navbar-brand">
                  <div class="brand-text brand-big"><span>Image  </span><strong>2 Text</strong></div>
                  <div class="brand-text brand-small"><strong>I2T</strong></div></a>
                <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
              </div>
              <!-- Navbar Menu -->
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Search-->
                <li class="nav-item d-flex align-items-center"><a id="search" href="#"><i class="icon-search"></i></a></li>
                <!-- Notifications-->
                <li class="nav-item dropdown"> <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-bell-o"></i><span class="badge bg-red">12</span></a>
                  <ul aria-labelledby="notifications" class="dropdown-menu">
                    
                      <!--All Notification -->

                      <li><a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification">
                          <?php 
                          $Query="SELECT * FROM suggestion_object where Username=:usern AND statu=:str Limit 2 ";
                          $resultat=$database->prepare($Query);
                          $resultat->execute(array(':usern'=>$_SESSION['username'],'str'=>'True'));
                          while($row=$resultat->fetch(PDO::FETCH_ASSOC))
                            {
                          echo '<div class="notification-content"><i class="fa fa-upload bg-orange"></i>'.$row['Objectname'].'</div>';


                        }




                          ?>
                          <div class="notification-time"><small>10 minutes ago</small></div>

                        </div>
                      </a>
                    </li>


                    <li><a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification">
                          <?php 
                          $Query="SELECT * FROM suggestion_action where Username=:usern AND statu=:str Limit 2 ";
                          $resultat=$database->prepare($Query);
                          $resultat->execute(array(':usern'=>$_SESSION['username'],'str'=>'True'));
                          while($row=$resultat->fetch(PDO::FETCH_ASSOC))
                            {
                          echo '<div class="notification-content"><i class="fa fa-upload bg-orange"></i>'.$row['Actionname'].'</div>';


                        }




                          ?>
                          <div class="notification-time"><small>10 minutes ago</small></div>

                        </div>
                      </a>
                    </li>


                    <li><a rel="nofollow" href="tables.php" class="dropdown-item all-notifications text-center"> <strong>view all notifications                                            </strong></a></li>
                  </ul>
                </li>
                <!-- Messages                        -->
                <li class="nav-item dropdown"> <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-envelope-o"></i><span class="badge bg-orange">10</span></a>
                  <ul aria-labelledby="notifications" class="dropdown-menu">
                    <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                        <div class="msg-profile"> <img src="img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle"></div>
                        <div class="msg-body">
                          <h3 class="h5">Jason Doe</h3><span>Sent You Message</span>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                        <div class="msg-profile"> <img src="img/avatar-2.jpg" alt="..." class="img-fluid rounded-circle"></div>
                        <div class="msg-body">
                          <h3 class="h5">Frank Williams</h3><span>Sent You Message</span>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                        <div class="msg-profile"> <img src="img/avatar-3.jpg" alt="..." class="img-fluid rounded-circle"></div>
                        <div class="msg-body">
                          <h3 class="h5">Ashley Wood</h3><span>Sent You Message</span>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong>Read all messages    </strong></a></li>
                  </ul>
                </li>
                <!-- Logout    -->
                <li class="nav-item"><a href="logout.php" class="nav-link logout">Logout<i class="fa fa-sign-out"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <div class="page-content d-flex align-items-stretch"> 
        <!-- Side Navbar -->
        <nav class="side-navbar">
          <!-- Sidebar Header-->
          <div class="sidebar-header d-flex align-items-center">
            <div class="avatar"><img src="img/man.png" alt="..." class="img-fluid rounded-circle"></div>
            <div class="title">
               <?php 

              echo '<h1 class="h4">'.strtoupper($first_name)." ".ucfirst ($second_name).'</h1>';
              echo '<p>'."USTHB".'</p>';
              ?>
            </div>
          </div>
          <!-- Sidebar Navidation Menus--><span class="heading">
              <?php 
            for ($i=0;$i<$lvl;$i++)
            {


              echo '<img src="https://png.icons8.com/color/25/000000/christmas-star.png">';
            }


            ?>
          </span>
          <ul class="list-unstyled">
            <li> <a href="home.php"><i class="icon-home"></i>Home</a></li>
            <li  class="active" ><a href="#dashvariants" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Tasks </a>
              <ul id="dashvariants" class="collapse list-unstyled">
                <li><a href="Classification.php">Classification</a></li>
                <li><a href="interpretation.php">Interpretation</a></li>
              </ul>
            </li>




             <li><a href="download.php" > <img src="https://png.icons8.com/download/p1em/26/666666"> Download </a>
              
            </li>

 





             <li><a href="#sugg" aria-expanded="false" data-toggle="collapse"><img src="https://png.icons8.com/thinking-male/ios7/26/666666"> Suggestion </a>
              <ul id="sugg" class="collapse list-unstyled">
                <li><a href="forms.php"><img src="https://png.icons8.com/chair/ios7/26/666666"> Suggest an object</a></li>
                <li><a href="suggactor.php"><img src="https://png.icons8.com/man/ios7/26/666666"> Suggest an Actor</a></li>
                <li><a href="action.php"><img src="https://png.icons8.com/collaboration/ios7/26/666666"> Suggest an Action</a></li>
              </ul>
            </li>


               <li><a href="#help" aria-expanded="false" data-toggle="collapse"> <img src="https://png.icons8.com/help/ios7/26/666666"> Help </a>
              <ul id="help" class="collapse list-unstyled">
                <li><a href="faq.php"><img src="https://png.icons8.com/faq/ios7/26/666666"> FAQs</a></li>
                <li><a href="#"><img src="https://png.icons8.com/question-mark/ios7/26/666666"> Help me</a></li>
                <li><a href="#"><img src="https://png.icons8.com/myspace/ios7/26/666666">ESPACE USERS </a></li>
              </ul>
            </li>






            <li> <a href="tables.php"> <i class="icon-grid"></i>Archive </a></li>
          </ul>
        </nav>
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Interpretation</h2>
            </div>
          </header>
          <!-- Breadcrumb-->
          <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Interpretation</li>
            </ul>
          </div>
          <!-- Forms Section-->
          <section class="forms"> 
            <div class="container-fluid">
              <div class="row">
                <!-- Basic Form-->
               
                <!-- Horizontal Form-->
                
                <!-- Inline Form-->
                
                <!-- Modal Form-->
                
                <!-- Form Elements -->
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-close">
                      <div class="dropdown">
                        <button type="button" id="closeCard5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                        <div aria-labelledby="closeCard5" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                      </div>
                    </div>
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Now, you can transforme your data to story !</h3>
                    </div>
                    <div class="card-body">
                      <form method="POST" action ="interpretation.php" class="form-horizontal">
                        
                        
                        
                        <section class="container py-4">
        <div class="row">
            <div class="col-md-12">
                
                <ul id="tabsJustified" class="nav nav-tabs">
                    <li class="nav-item"><a href="" data-target="#profile1" data-toggle="tab" class="nav-link small text-uppercase active" >Full's scene information </a></li>
                    <li class="nav-item"><a href="" data-target="#profile2" data-toggle="tab" class="nav-link small text-uppercase ">Small information about scene</a></li>
                    <li class="nav-item"><a href="" data-target="#messages1" data-toggle="tab" class="nav-link small text-uppercase">Interpretation</a></li>
                    


                </ul>
                <br>
                <div id="tabsJustifiedContent" class="tab-content">

                    <div id="profile1" class="tab-pane fade active show">
                      <h2><p class="font-italic">Let us tell you a little story about  your scene</p></h2>
                     
                      <p>Describe your scene,objects,actions and actors</p> 
                      <br>Tell us about objects in your scene (9 objects )</br> 

                     <textarea name="txtScript" id="word_count"></textarea> 
                      <br>
Total word Count : <span id="display_count">0</span> words. Words left : <span id="word_left">9</span></br>
                      <p></p>
                      <div class="line"> </div>
                      <br>Tell us about actions in your scene (3 actions )</br> 
                      <textarea name="actionss" id="actionss" ></textarea>

                       <br>
Total word Count : <span id="d_c">0</span> words. Words left : <span id="w_l">3</span></br> 

<div class="line"> </div>
<br>Tell us about actors in your scene (3 actors )</br> 
                                            <textarea name="ACTS" id="ACTS" ></textarea>

                                             <br>
Total word Count : <span id="d_a">0</span> words. Words left : <span id="w_a">3</span></br> 

 <div class="col-md-5 align-items-center"> 
                     </div>

                       <div class="col-md-12">    
   <label class="col-sm-5 form-control-label"></label>

 
 <button name="Claaaaaass" type="submit" class="btn btn-primary">Interpretation</button>
 <button name="downloadd" type="submit" class="btn btn-primary">Download</button>
</div>
                    </div>


					 <div id="profile2" class="tab-pane fade">
                      <h2><p class="font-italic">Small classifier for small input data :</p></h2>
                      <p></p> 
                      <p>Describe your scene,objects,actions and actors</p> 
                      <br>Tell us about objects in your scene (3 objects )</br> 
                     <textarea name="obj3" id="obj3_count" ></textarea> 
                      <br>
Total word Count : <span id="displayobject">0</span> words. Words left : <span id="wordobject">3</span></br>
<div class="line"> </div>
                      <p></p>
                      <br>Tell us about action in your scene (1 action )</br>
                      <textarea name="act3" id="act3" ></textarea>

                       <br>
Total word Count : <span id="displayaction">0</span> words. Words left : <span id="wordaction">1</span></br> 
<div class="line"> </div>
<br>Tell us about actor in your scene (1 actor )</br> 
                                            <textarea name="actts" id="actts" ></textarea>

                                             <br>
Total word Count : <span id="d_aa">0</span> words. Words left : <span id="w_aa">1</span></br> 
                      
                       <div class="col-md-12">    
   <label class="col-sm-5 form-control-label"></label>
 
 <button name="classs" type="submit" class="btn btn-primary">Interpertation</button>
 <button name="downs" type="submit" class="btn btn-primary">Download</button>

</div>
                    </div>
                      
                      
          
          
          
                    <div id="messages1" class="tab-pane fade">
                       <h2><p class="font-italic">Let us tell you a little story about your scene</p></h2>
                      <p></p> 
                      <p>Describe your scene,objects,actions and actors</p> 
                      <br>Tell us about objects in your scene </br> 
					<textarea name="object15" id="object15" ></textarea> 
                      <br>
Total word Count : <span id="display15">0</span> words. Words left : <span id="word15">15</span></br>
                      <p></p>
                      <br>Tell us about action in your scene </br> 

                      <textarea name="action15" id="action15" ></textarea>

                       <br>
Total word Count : <span id="daction15">0</span> words. Words left : <span id="waction15">5</span></br> 
<br>Tell us about actor in your scene </br> 

<textarea name="acteur15" id="acteur15" ></textarea>
                      
                       <div class="col-md-12">    
   <label class="col-sm-5 form-control-label"></label>
 
 <button name="Interp_final" type="submit" class="btn btn-primary">Interpretation</button>
</

					
                       
</div>
</div>

               
                
                
                
                      
                    </div>
                </div>
            </div>
        </div>
    
    </section>
    
                       
                        <div class="form-group row">
                         
                          
                        </div>
                        <div class="form-group row">
                          
                          <div class="col-sm-9">
                          
                            
                           
                          </div>
                        </div>
                        <div class="form-group row">
                          
                          <div class="col-sm-9">
                           
                            
                          </div>
                        </div>
                        <div class="form-group row">
                            
                          
                        </div>
                        <div class="form-group row has-success">
                        
                          
                        </div>
                        <div class="form-group row has-danger">
                          
                          <div class="col-sm-9">
                            
                          </div>
                        </div>
                        <div class="form-group row">
                        <label class="col-sm-3 form-control-label"></label>
                          <div class="col-sm-9">
                            <div class="row">
                              
                
                </div>
                            
                          
                          </div>
                        </div>
                        <div class="form-group row">
                          
                        </div>
                        <div class="row">
                          
                          <div class="col-sm-9">
                           
                            
                            
                          </div>
                        </div>
                        <div class="form-group row">
                          
                          <div class="col-sm-9">
                            <div class="form-group">
                              
                            </div>
                            
                           
                            
                           
                            
                            
                          </div>
                        </div>

                        <div class="form-group row">
                        
                          <div class="col-sm-9">
                            <div class="form-group">
                              
                            </div>
                            
                          </div>
                        </div>
                        <div class="form-group row">
                         
                          <div class="col-sm-9">
                            
                          </div>
                        </div>
                        <div class="line"></div>

                        
                       
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- Page Footer-->
          <footer class="main-footer">
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-6">
                  <p>Your company &copy; 2017-2019</p>
                </div>
                <div class="col-sm-6 text-right">
                 <p>Design by <a href="https://http://www.optidevs.com/" class="external">Optidevs</a></p>
                  <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
                </div>
              </div>
            </div>
          </footer>
        </div>
      </div>
    </div>
    <!-- Javascript files-->
   
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="js/front.js"></script>

     <script>
      $(document).ready(function() {
    $("#word_count").on('keydown', function(e) {
        var words = $.trim(this.value).length ? this.value.match(/\S+/g).length : 0;
        if (words <= 9) {
            $('#display_count').text(words);
            $('#word_left').text(9-words)
        }else{
            if (e.which !== 8) e.preventDefault();
        }
    });
 });
    </script>

         <script>
      $(document).ready(function() {
    $("#actionss").on('keydown', function(e) {
        var words = $.trim(this.value).length ? this.value.match(/\S+/g).length : 0;
        if (words <= 3) {
            $('#d_c').text(words);
            $('#w_l').text(3-words)
        }else{
            if (e.which !== 8) e.preventDefault();  
        }
    });
 });
    </script>
	
	<script>
      $(document).ready(function() {
    $("#obj3_count").on('keydown', function(e) {
        var words = $.trim(this.value).length ? this.value.match(/\S+/g).length : 0;
        if (words <= 3) {
            $('#displayobject.').text(words);
            $('#wordobject.').text(3-words)
        }else{
            if (e.which !== 8) e.preventDefault();
        }
    });
 });
    </script>
  <script>
      $(document).ready(function() {
    $("#act3").on('keydown', function(e) {
        var words = $.trim(this.value).length ? this.value.match(/\S+/g).length : 0;
        if (words <= 1) {
            $('#displayaction.').text(words);
            $('#wordaction.').text(1-words)
        }else{
            if (e.which !== 8) e.preventDefault();
        }
    });
 });
    </script>
    
  </body>
</html>