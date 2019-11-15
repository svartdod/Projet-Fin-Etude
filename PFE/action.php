<?php 
require "database.php";
session_start();

if ( $_SESSION['logged_in'] != 1 ) {

$_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: index.php");

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
      if(isset($_POST['suggest']))
    {
    require "suggestion_action.php";   
    }

    if(isset($_POST['cancel']))
    {
      header("location:home.php");
    }


}





?> 
  <head>
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
                <!-- Navbar Brand --><a href="index.html" class="navbar-brand">
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
            <li > <a href="home.php"><i class="icon-home"></i>Home</a></li>
            <li><a href="#dashvariants" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Tasks </a>
              <ul id="dashvariants" class="collapse list-unstyled">
                <li><a href="Classification.php">Classification</a></li>
                <li><a href="interpretation.php">Interpretation</a></li>
              </ul>
            </li>




             <li><a href="download.php" > <img src="https://png.icons8.com/download/p1em/26/666666"> Download </a>
              
            </li>

 





             <li class="active"><a href="#sugg" aria-expanded="false" data-toggle="collapse"><img src="https://png.icons8.com/thinking-male/ios7/26/666666"> Suggestion </a>
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
              <h2 class="no-margin-bottom">Sugggestion</h2>
            </div>
          </header>
          <!-- Breadcrumb-->
          <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Sugggestion</li>
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
                      <h3 class="h4">Suggest your Action</h3>
                    </div>
                    <div class="card-body">
                      <form action="action.php" method="POST"  class="form-horizontal">
                        
                        
                        
                        
                       
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
                              <div class="col-md-3">
							  
								<label class="row-sm-3 form-control-label">Superclass</label>

							  </div>
							  <div class="col-md-4">
							  
								<label class="row-sm-3 form-control-label">Action</label>

							  </div>
							  
							  <div class="col-md-4">
							  
								<label class="row-sm-3 form-control-label">Poid</label>

							  </div>
							  
							  </div>
                            
                          
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Choose your action</label>
                          <div class="col-sm-9">
                            <div class="row">
                              <div class="col-md-3">
                            <select name="Superclass" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                 <?php 
                              $query="SELECT * FROM Superclass";
                              $resultat=$database->prepare($query);
                              $resultat->execute();
                              while($row=$resultat->fetch(PDO::FETCH_ASSOC))
                                { 
                                  echo '<option value="'.$row['Classname'].'">'.$row['Classname'].'</option>';
                                }


                              ?>
                            </select>
                              </div>
                              <div class="col-md-4">
                            <select name="Action" class="custom-select mb-2 mr-sm-2 mb-sm-0" >
                                  <?php 
                              //$query="SELECT * FROM Action";
                              $query="SELECT DISTINCT Actionname FROM action_in_superclass";
                              $resultat=$database->prepare($query);
                              $resultat->execute();
                              
                              while($row=$resultat->fetch(PDO::FETCH_ASSOC))
                                { 
                                  echo '<option value="'.$row['Actionname'].'">'.$row['Actionname'].'</option>';
                                }


                              ?>
                            </select>
                              </div>
                              <div class="col-md-3">
                                <select name="Poid" class="custom-select mb-2 mr-sm-2 mb-sm-0" >
                              <option value="Very Frequent">Very Frequent</option>
                              <option value="Frequent">Frequent</option>
                              <option value="Less Frequent">Less Frequent</option>
                              
                            </select>
                              </div>
								
							        <div id="lino" name="lino" class="line"> </div>
                                        <label class="col-sm-3 form-control-label">Other Action</label>

									
									<div  id="otherobj"class="col-md-5">
									<input name="otherr" type="text" placeholder="" class="form-control">
                              
									
									</div>	
									<div>
									   <div class="line"> </div>
							  <div class="row-sm-4 offset-sm-3">
                            <button name="cancel" type="submit" class="btn btn-secondary">Cancel</button>
                            <button name="suggest" type="submit" class="btn btn-primary">Suggest</button>
                          </div>
                            </div>
                          </div>
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
	
	</script>
  </body>
</html>