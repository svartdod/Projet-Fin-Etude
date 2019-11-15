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
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Image 2 Text</title>    <meta name="description" content="">
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




  </head>
  <body>

    <div class="page home-page">
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
                  <div class="brand-text brand-big"><span>Image 2  </span><strong> Text</strong></div>
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
              echo '<p>'.strtoupper($inst).'</p>';
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
            <li class="active"> <a href="home.php"><i class="icon-home"></i>Home</a></li>
            <li><a href="#dashvariants" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Tasks </a>
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
              <h2 class="no-margin-bottom">Every Picture Tells a Story</h2>
            </div>
          </header>
		  <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item active"><a href="home.php">Home</a></li>
              
            </ul>
          </div>
		  
		  <div class="col-lg-12">
                  <div class="card">
                    <div class="card-close">
                      <div class="dropdown">
					  
					  </div>
					  </div>
					  
					  </div>
					  					<div class="card">
                    <div class="card-close">
                      <div class="dropdown">
                        <button type="button" id="closeCard5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                        <div aria-labelledby="closeCard5" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                      </div>
                    </div>
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Getting started </h3>
                    </div>
                    <div class="card-body">
					<div class="text-center">
					<p class="text-danger" style="font-size: 1.7em; font-weight: normal;"><i>Getting started ! </i><img src="img/route.png"/></p></div>
					


						<p class="text-light bg-dark"style="font-size:90%;margin-top: 3px;
padding-right: 15px;
padding-left: 15px;">Image2Text is a web platform that brings to the computer vision researcher and machine learning a large database of scenes.</p>
                       	<p class="text-light bg-dark" style="font-size:90%; margin-top: 3px;
padding-right: 15px;
padding-left: 15px;">This platform also makes it possible to interpret scenes in descriptive text.</p>
<div class="form-group row">
                         
                          
                        </div>

<p><a href="#" class="text-white bg-red">Image2Text platform allows users to :</a></p>
<p><a href="#" class="text-white bg-red"> To download data bases with specifying some features.</a></p>
<p><a href="#" class="text-white bg-red">To classify scenes.</a></p>
<p><a href="#" class="text-white bg-red">To add objects, actors and actions.</a></p>
<p><a href="#" class="text-white bg-red"> To interpret scenes.</a></p>

				 <div class="form-group row">
                         
                          
                        </div>
						 <div class="form-group row">
                         
                          
                        </div>
						 <div class="form-group row">
                         
                          
                        </div>
<div class="text-center">
					<p class="text-danger" style="font-size: 1.7em; font-weight: normal;"><img src="img/account-2.png"/> <i>Create an account as a user and login !</i> </p></div>
					
					<div class="form-group row">
                         
                          
                        </div>
						<div class="form-group row">
                         
                          
                        </div>
						
					<p class="text-light bg-dark"style="font-size:90%;margin-top: 3px;
padding-right: 15px;
padding-left: 15px;">To create an account, press <img src="img/sign.png"/> in button and fill in the form, then click on the confirmation button.</p>
						
						
						<p class="text-light bg-dark"style="font-size:90%;margin-top: 3px;
padding-right: 15px;
padding-left: 15px;">Once you create an account, you are automatically logged in to your account, press <img src="img/sign.png"/></p>
						 <div class="form-group row">
                         
                          
                        </div>
						 <div class="form-group row">
                         
                          
                        </div>
			<div class="text-center">			
<p class="text-danger" style="font-size: 1.7em; font-weight: normal;"> <i>Classification of the scene !</i>  <img src="img/classification-divide-digest-separate-analytic-identify-list-64.png"/></p>

						</div>
						
						
						<p class="text-light bg-dark"style="font-size:90%;margin-top: 3px;
padding-right: 15px;
padding-left: 15px;">To classify a scene, you have to go to the  <img src="img/task.png"/> button.</p>

 <div class="form-group row">
                         
                          
                        </div>

<p class="text-light bg-dark"style="font-size:90%;margin-top: 3px;
padding-right: 15px;
padding-left: 15px;">and then click on <img src="img/classifier.png"/>, a field page appears. Fill in the information of the scene</p>

 <div class="form-group row">
                         
                          
                        </div>

<p class="text-light bg-dark"style="font-size:90%;margin-top: 3px;
padding-right: 15px;
padding-left: 15px;">After introducing the scene description, and press this <img src="img/classifier.png"/>. the request will classify and give final result.</p>
 <div class="form-group row">
                         
                          
                        </div>
<p class="text-light bg-dark"style="font-size:90%;margin-top: 3px;
padding-right: 15px;
padding-left: 15px;">The <img src="img/download.png"/> button is used to download the query and the result in XML format<p>

 <div class="form-group row">
                         
                          
                        </div>
						 <div class="form-group row">
                         
                          
                        </div>
<div class="text-center">			
<p class="text-danger" style="font-size: 1.7em; font-weight: normal;"><img src="img/downloads.png"/> <i>Download the database !</i>  </p>

						</div>
						<div class="form-group row">
                         
                          
                        </div>
						

<p class="text-light bg-dark"style="font-size:90%;margin-top: 3px;
padding-right: 15px;
padding-left: 15px;">By pressing <img src="img/dw.png"/> in tasks bar you will have the "download data" page with six sections.<p>
<div class="form-group row">
                         
                          
                        </div>
						<div class="text-center">
<img src="img/six.png"/>

</div>
  <div class="form-group row">
                         
                          
                        </div>
						
						  <div class="form-group row">
                         
                          
                        </div>
<p class="text-light bg-blue"style="font-size:90%;margin-top: 3px;
padding-right: 15px;
padding-left: 15px;">"Download all": allows you to download the entire database<p>

<p class="text-light bg-blue"style="font-size:90%;margin-top: 3px;
padding-right: 15px;
padding-left: 15px;">"Noise data": allows you to download noise data.<p>

<p class="text-light bg-blue"style="font-size:90%;margin-top: 3px;
padding-right: 15px;
padding-left: 15px;">"specify your download": allows you to download the database with specify characteristics.<p>

<p class="text-light bg-blue"style="font-size:90%;margin-top: 3px;
padding-right: 15px;
padding-left: 15px;">"Scene": there are 3 choices (download big data, or small data, medium data with a degree of precision).<p>

<p class="text-light bg-blue"style="font-size:90%;margin-top: 3px;
padding-right: 15px;
padding-left: 15px;">"generating scene": allows to generate the scenes, you have to put the number of objects, actions, actors, precision and even number of scene.<p>

                        <div class="form-group row">
                         
                          
                        </div>
						
                        <div class="form-group row">
                         
                          
                        </div>
						
						<div class="text-center">			
<p class="text-danger" style="font-size: 1.7em; font-weight: normal;"> <i>Suggestion</i> <img src="img/Happy_Man_Human_Resource__Life_Style_C-132-512.png" height="50" width="50"/> </p>

						</div>
						
						  <div class="form-group row">
                         
                          
                        </div>
						  <div class="form-group row">
                         
                          
                        </div>
						
						<p class="text-light bg-blue"style="font-size:90%;margin-top: 3px;
padding-right: 15px;
padding-left: 15px;">To suggest an object, actor, or action, you must go on <img src="img/sugg.png"/>.<p>
						
                <p class="text-light bg-blue"style="font-size:90%;margin-top: 3px;
padding-right: 15px;
padding-left: 15px;"> Then specify the parameters of the object and click on <img src="img/suggg.png"/>.<p>
					   
					   
					  
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
    <script>
	function myFunction() {
    alert("I am an alert box!");
	}
	</script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="js/charts-home.js"></script>
    <script src="js/front.js"></script>
  </body>
</html>