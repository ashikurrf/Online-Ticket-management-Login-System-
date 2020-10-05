<?php
    include('db_con.php');

$Error_No = 0;
session_start();
session_destroy();
session_start();

/*** Error Defination *******

Error : 1       [ Password & Confirm Password Does not Match ]
Error : -1      [ Account Created Successfully ]
Error : 2       [ One or More Fields Are Empty ]
Error : 3       [ SignIN Password Fields Empty ]
Error : 4       [ SignIN Username Fields Are Empty ]
Error : 5       [ SignIN Both Fields Are Empty ]
Error : -2      [ Login Success ]
Error : -3      [ Ridirect Unsucessful ]





**************************/


/******* Sign Up Button *****************/

if( isset($_POST['signup_btn']) ){
    
    $a = $_POST['signup_first_name'];
    $b = $_POST['signup_last_name'];
    $c = $_POST['signup_email'];
    $d = $_POST['signup_contact'];
          
    $server_id = 0;
    
    $user_query = mysqli_query(mysqli_connect('localhost','root','','busdb'),"select * from user_info order by server_id asc");
    
    while( $row = mysqli_fetch_array($user_query) )
    {
            $server_id = $row['server_id'];
    }
    
    $server_id = $server_id + 1;

   if( !empty($_POST['signup_first_name']) && !empty($_POST['signup_last_name']) &&  !empty($_POST['signup_email']) && !empty($_POST['signup_username']) &&  !empty($_POST['signup_password']) && !empty($_POST['signup_retype_password']) && !empty($_POST['signup_contact']) )
    {
       
       if( $_POST['signup_password'] != $_POST['signup_retype_password'] )
       {
           $Error_No = 1;
       }
       else
       {
            $query = "INSERT INTO user_info(server_id,first_name,last_name,email,contact_no) values ($server_id,'$a','$b', '$c','$d')";
		  mysqli_query(mysqli_connect('localhost','root','','busdb'),$query);
           
           $a = $_POST['signup_username'];
           $b = $_POST['signup_password'];
           
           $query = "INSERT INTO user_handle(server_id,username,pass) values ($server_id,'$a','$b')";
		  mysqli_query(mysqli_connect('localhost','root','','busdb'),$query);
           
           $Error_No = -1;
       }
       
        
    }
    else
    {
        // field empty
        $Error_No = 2;
    }
    
}

/*********** Sign IN Button *****************************/

if( isset($_POST['signin_btn']) ){
    

   if(!empty($_POST['signin_username']) && !empty($_POST['signin_password']))
    {
            // All OK
        $user_email=$_POST['signin_username'];
		$user_password=$_POST['signin_password'];
       
        $user_query = mysqli_query(mysqli_connect('localhost','root','','busdb'),"select * from user_handle");
       
        while( $row = mysqli_fetch_array($user_query) )
        {
            if($row['username']==$user_email && $row['pass']==$user_password)
            {
                $_SESSION['server_id'] = $row['server_id'];
                $Error_No = -2;
                break;
            }
           
        }
       
       if( $Error_No == -2 )
       {
           header('Location: dash.php');
       }
       else
           $Error_No = 6;
    }
    else if( !empty($_POST['signin_username']) && empty($_POST['signin_password']) )
    {
        // password empty
        $Error_No = 3;
    }
    else if( empty($_POST['signin_username']) && !empty($_POST['signin_password']) )
    {
        //username empty
        $Error_No = 4;
    }
    else
    {
        // both empty
        $Error_No = 5;
    }
    
}

?>
<html lang="en">

<head>
    <title>Bus Ticket</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
-->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/custom.css">

    <!--- Font --->
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
    

    <div class="hero-image">
        <div class="hero-text">
            <h1 style="font-size:50px">T I C K E T M A N A G M E N T</h1>
            <p style="font-family: 'Lato', sans-serif; font-size: 20px;">Book Your ticket now</p>
        </div>
    </div>

    <nav class="navbar navbar-default navbar-dark navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#myPage">Home</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar" style="color: white;">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#services">SERVICES</a></li>
                    <li><a href="#about">ABOUT</a></li>
                    <li><a href="" data-toggle="modal" data-target="#signupmodal">JOIN US</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Error Section ----->
    <div class="row">
        <div class="container">
            <div class="col-sm-4 col-sm-offset-4">
                <?php
                        
                        if( $Error_No == 1  ){
                            echo '<br><div class="alert alert-warning text-center">
                                      <strong>Password</strong> Does not match
                            </div>';
                        }
                        else if( $Error_No == 2 )
                        {
                            echo '<br><div class="alert alert-warning text-center">
                                      all fields are required
                            </div>';
                        }
                        else if( $Error_No == -1 )
                        {
                            echo '<br><div class="alert alert-success text-center">
                                      Please <a href="" data-toggle="modal" data-target="#signinmodal"> Signin </a> to Continue
                            </div>';
                        }
                        else if( $Error_No >= 3 && $Error_No <= 6 )
                        {
                            echo '<br><div class="alert alert-danger text-center">
                                      invalid username or password
                            </div>';
                        }
                        
    ?>
            </div>
        </div>
    </div>

    <!-- Container (Services Section) -->

    <div class="container-fluid" style="padding-top: 30px;">
        <div class="row">
            <div class="col-sm-7">
                <div id="services" class="container-fluid text-center right-block">
                    <h2>Services We Are Offering</h2>
                    <br>
                    <div class="row slideanim">
                        <div class="col-sm-4">
                            <i class="fas fa-bus logo-small"></i>
                            <h4>BUS TICKET</h4>
                            <p style="color: gray;">Lorem ipsum dolor sit amet..</p>
                        </div>
                        <div class="col-sm-4">
                            <i class="fas fa-train logo-small"></i>
                            <h4>TRAIN TICKET</h4>
                            <p style="color: gray;">Lorem ipsum dolor sit amet..</p>
                        </div>
                        <div class="col-sm-4">
                            <i class="fas fa-taxi logo-small"></i>
                            <h4>CAB BOOKING</h4>
                            <p style="color: gray;">Lorem ipsum dolor sit amet..</p>
                        </div>
                    </div>
                    <br><br>
                    <div class="row slideanim">
                        <div class="col-sm-4">
                            <i class="fas fa-user-cog logo-small"></i>
                            <h4>24/7 CUSTOMER SUPPORT</h4>
                            <p style="color: gray;">Lorem ipsum dolor sit amet..</p>
                        </div>
                        <div class="col-sm-4">
                            <span class="glyphicon glyphicon-certificate logo-small"></span>
                            <h4>CERTIFIED INSURENCE</h4>
                            <p style="color: gray;">Lorem ipsum dolor sit amet..</p>
                        </div>
                        <div class="col-sm-4">
                            <i class="fas fa-dollar-sign logo-small"></i>
                            <h4 style="color:#303030;">LOW BOOKING COST</h4>
                            <p style="color: gray;">Lorem ipsum dolor sit amet..</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 right-block text-center">
                            <h2>Join Us For Free</h2>
                            <br>
                            <br>
                            <br>
                            <button type="button" class="btn signupbtn" data-toggle="modal" data-target="#signupmodal">Create an account</button>
                            <br><br>
                            <p>OR ALREADY HAVE AN ACCOUNT!</p>
                            <br>
                            <button type="button" class="btn signinbtn" data-toggle="modal" data-target="#signinmodal">Sign In</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sign IN Modal -->
    <div class="modal fade" id="signinmodal" tabindex="-1" role="dialog" aria-labelledby="Signin" aria-hidden="true" style="margin-top:200px;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header modal-primary">
                    <h4 class="modal-title text-center signinmodaltitle" id="exampleModalCenterTitle">Sign In</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <br>

                    <form action="" method="POST">
                        <div class="input-group si_usernamebox">
                            <span class="input-group-addon" style="color: #094074;background-color: white;border: none;"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control no-border" name="signin_username" placeholder="Email or Username">
                        </div>
                        <br>
                        <div class="input-group si_passwordbox">
                            <span class="input-group-addon" style="color: #094074;background-color: white;border: none;"><i class="fas fa-key"></i></span>
                            <input type="password" class="form-control no-border" name="signin_password" placeholder="Password">
                        </div>
                        <br>
                        <div class="form-group text-center">
                            <button type="submit" name="signin_btn" class="btn btn-primaryp">Sign In</button>
                        </div>

                    </form>
                    <!-- <br>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="signin_btn" class="btn btn-primaryp">Sign In</button> 
                        

                    </div> -->
                </div>
            </div>
        </div>
    </div>


    <!-- Sign UP Modal -->
    <div class="modal fade" id="signupmodal" tabindex="-1" role="dialog" aria-labelledby="SignUP" aria-hidden="true" style="margin-top:200px;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header modal-primary">
                    <h4 class="modal-title text-center signinmodaltitle" id="exampleModalCenterTitle">Sign Up</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <br>

                    <form action="" method="POST">
                        <div class="form-group si_usernamebox">
                            <input type="text" class="form-control no-border" name="signup_first_name" placeholder="First Name">
                        </div>
                        <div class="form-group si_usernamebox">
                            <input type="text" class="form-control no-border" name="signup_last_name" placeholder="Last Name">
                        </div>
                        <div class="form-group si_usernamebox">
                            <input type="email" class="form-control no-border" name="signup_email" placeholder="Email">
                        </div>
                        <div class="form-group si_usernamebox">
                            <input type="text" class="form-control no-border" name="signup_username" placeholder="Username">
                        </div>
                        <div class="form-group si_passwordbox">
                            <input type="password" class="form-control no-border" name="signup_password" placeholder="New Password">
                        </div>
                        <div class="form-group si_passwordbox">
                            <input type="password" class="form-control no-border" name="signup_retype_password" placeholder="Retype Password">
                        </div>
                        <div class="form-group si_usernamebox">
                            <input type="text" class="form-control no-border" name="signup_contact" placeholder="Contact No">
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" name="signup_btn" class="btn btn-primaryp">Sign Up</button>
                        </div>
                    </form>
                    <!-- <br>
                    <div class="modal-footer">
                        <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primaryp">Sign Up</button>

                    </div>-->
                </div>
            </div>
        </div>
    </div>

    <div id="about" class="container-fluid bg-grey right-block">
        <div class="row">
            <div class="col-sm-8">
                <h2>About Us</h2><br>
                <h4 style="font: 400 15px Lato, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</h4><br>
                <p style="font: 400 15px Lato, sans-serif; color: gray;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <div class="col-sm-4">
                <br><br><br>
                <i class="fas fa-road logo"></i>
            </div>
        </div>
    </div>



    <footer class="container-fluid text-center" style="background-color: #222; color: white; min-height: 100px;">
        <a href="#myPage" title="To Top">
            <span class="glyphicon glyphicon-chevron-up"></span>
        </a>
        <p style="font-family : font-family: Montserrat, sans-serif;">A L L R I G H T R E S E R V E D</p>
    </footer>

    <script>
        $(document).ready(function() {
            // Add smooth scrolling to all links in navbar + footer link
            $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
                // Make sure this.hash has a value before overriding default behavior
                if (this.hash !== "") {
                    // Prevent default anchor click behavior
                    event.preventDefault();

                    // Store hash
                    var hash = this.hash;

                    // Using jQuery's animate() method to add smooth page scroll
                    // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 900, function() {

                        // Add hash (#) to URL when done scrolling (default click behavior)
                        window.location.hash = hash;
                    });
                } // End if
            });

            $(window).scroll(function() {
                $(".slideanim").each(function() {
                    var pos = $(this).offset().top;

                    var winTop = $(window).scrollTop();
                    if (pos < winTop + 600) {
                        $(this).addClass("slide");
                    }
                });
            });
        })

    </script>

</body>

</html>
