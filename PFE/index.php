<?php 
require "database.php";
session_start();
?>

<!DOCTYPE html>
<html>

<?php 
if($_SERVER['REQUEST_METHOD']=='POST')
{
  if(isset($_POST['Signin']))
  {
    require 'login.php';
  }
  elseif(isset($_POST['reg']))
  {

    require 'registerr.php';
  }

}
?>
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="sweetalert2-master/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" type="text/css" href="sweetalert2-master/dist/sweetalert2.css">


  
      <link rel="stylesheet" href="css/sauce.css">
   

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
                <!-- Navbar Brand --><a href="index.html" class="navbar-brand">
                  <div class="brand-text brand-big"><span>Image 2 </span><strong> Text</strong></div>

                  <div class="brand-text brand-small"><strong>I2T</strong></div></a>
                  
                <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>

              </div>
              <!-- Navbar Menu -->
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Search-->
                <li class="nav-item d-flex align-items-center"><a id="search" href="#"><i class="icon-search"></i></a></li>
                <!-- Notifications-->
                
                <!-- Messages                        -->
               
                <!-- Logout    -->
                <li class="nav-item" data-toggle="modal" data-target="#myModal"><a  href="#myModal" class="nav-link logout" >Log in <i class="fa fa-sign-in"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
	                   

	   <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                        <div role="document" class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 id="exampleModalLabel" class="modal-title">Sign in</h4>
                              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                              <p>To continue to I2T.</p>
                              <form id="zraxlog" method="POST" action="index.php">
                                <div class="form-group">
                                  <label>Username</label>
                                  <input name="username" type="text" placeholder="Email Address" class="form-control"  required>
                                </div>
                                <div class="form-group">       
                                  <label>Password</label>
                                  <input name="password" type="password" placeholder="Password" class="form-control" required>

                                </div>
                                <div class="form-group">       
                                  <input name="Signin" type="submit" value="Signin" class="btn btn-primary" >
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#regg">Registration</button>
                            </div>
                          </div>
                        </div>
                      </div>
	  
	  
	  
	  
	  
	  
      <div class="page-content d-flex align-items-stretch">
        <!-- Side Navbar -->
        <nav class="side-navbar">
          <!-- Sidebar Header-->
          <div class="sidebar-header d-flex align-items-center">
            <div class="avatar">
            <div class="avatar"><img src="img/Users-Guest-icon.png" alt="..." class="img-fluid rounded-circle"></div>

            </div>
            <div class="title">
              <h1 class="h4">Guest</h1>
              
            </div>
          </div>
          <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
          <ul class="list-unstyled">
            <li class="active"> <a href="index.php"><i class="icon-home"></i>Get Started</a></li>
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






            <li data-toggle="modal" data-target="#regg"> <a> <i class="icon-grid"></i>Connect</a></li>
          </ul>
        </nav>
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Every Picture Tells a Story</h2>
            </div>
          </header>
          <!-- Dashboard Counts Section-->
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
          <!-- Page Footer-->
          <footer class="main-footer">
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-6">
                  <p>Your company &copy; 2017-2019</p>
                </div>
                <div class="col-sm-6 text-right">
                 <p>Design by <a href="https://http://www.optidevs.com/" class="external">Optidevs</a></p>
                 <p><a href="
                  ../ElaAdmin-master/page-login.php">Admin</a></p>
                  <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
                </div>
              </div>
            </div>
          </footer>
        </div>
      </div>
    </div>
	<!-- Registration -->
	 <div id="regg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                        <div role="document" class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 id="exampleModalLabel" class="modal-title">Registration</h4>
                              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                              <p><h3>One account is all you need.</h3></p>
                              <p><h5>One free account gets you into everything I2T.</h5></p>


                              <form method="POST" action="index.php">
                                <div class="form-group">
                                  <label>Username</label>
                                  <input name="username" type="text" placeholder="Username" class="form-control" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" required>
<span id="status"></span>                                </div>
                                <div class="form-group">       
                                  <label>Password</label>
                                  <input name="password" type="password" placeholder="Password" class="form-control" required >
                                </div>
								
								<div class="form-group">
                                  <label>Email</label>
                                  <input name="email" type="email" placeholder="Email Address" class="form-control" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,}" required>
                                </div>
								
								<div class="form-group">
                                  <label>First Name</label>
                                  <input name="first_name" type="text" placeholder="First Name" class="form-control" pattern="[A-Za-z]{3,20}" required>
                                </div>
								
								<div class="form-group">
                                  <label>Second Name</label>
                                  <input name="second_name" type="text" placeholder="Second Name" class="form-control" pattern="[A-Za-z]{3,20}" required>
                                </div>
								
								
								<div class="form-group">
                                  <label>Insitution</label>
                                  <input name="insitution" type="text" placeholder="Insitution" class="form-control">
                                </div>
								
                                <div class="form-group">       
                                  <input name="reg" type="submit" value="Registration" class="btn btn-primary">
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
	  
	  
    <!-- Javascript files-->
 


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