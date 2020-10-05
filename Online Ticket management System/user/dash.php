<?php
 session_start();
    $first_name = "";
    $last_name = "";
    $email = "";
    $contact_no = "";
$Error_No = 0;

    $user_query = mysqli_query(mysqli_connect('localhost','root','','busdb'),"select * from user_info");
    $server_id = $_SESSION['server_id'];
       
    while( $row = mysqli_fetch_array($user_query) )
    {
                    if( $row['server_id']==$server_id )
                    {
                        /*echo "<strong>";
                        echo $row['first_name']." ".$row['last_name'];
                        echo "</strong>";*/
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                        $email = $row['email'];
                        $contact_no = $row['contact_no'];
                        
                        break;
                    }
    }


if( isset($_POST['bus_btn']) ){
    
    $a = $_POST['bus_from'];
    $b = $_POST['bus_to'];
    $c = $_POST['bus_date'];
    $d = $_POST['bus_ticket'];
    
    $server_id = $_SESSION[ 'server_id' ];
          
   if( !empty($_POST['bus_from']) && !empty($_POST['bus_to']) &&  !empty($_POST['bus_date']) && !empty($_POST['bus_ticket']) )
    {
            $query = "INSERT INTO bus_ticket(server_id,bus_from,bus_to,bus_date,ticket_no) values ($server_id,'$a','$b', '$c',$d)";
		  mysqli_query(mysqli_connect('localhost','root','','busdb'),$query);
           
           $Error_No = -1;     
    }
    else
    {
        // field empty
        $Error_No = 2;
    }
    
}
    
?>
<html lang="en">

<head>
    <title>Welcome</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/dash.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <!--- Font --->
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body>

    <div class="container-fluid" style="padding: 0px 0px;">
        <ul class="nav nav-tabs header">
            <li class="active"><a data-toggle="tab" href="#profile">Profile</a></li>
            <li><a data-toggle="tab" href="#bus">Bus Ticket</a></li>
            <li><a data-toggle="tab" href="#train">Tarin Ticket</a></li>
            <li><a data-toggle="tab" href="#cab">Book A Cab</a></li>
            <li><a data-toggle="tab" href="#tour">Your Tour</a></li>
        </ul>

        <div class="tab-content">
            <div id="profile" class="tab-pane fade in active">
                <br>
                <div class="row">
                    <div class="container cover-img">
                        <div class="row">
                            <div class="container">
                                <div class="col-sm-3">
                                    <img src="css/images/avatar.jpg" class="profile-photo">
                                </div>
                                <div class="col-sm-4">
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <h3 style="color: white; font-size:20px; font-family: Montserrat, sans-serif;">Welcome</h3>
                                    <h4 class="name">
                                        <?php
                                            echo $first_name." ".$last_name; 
                                        ?>
                                    </h4>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="container">
                        <div class="col-sm-3">
                            <div class="cus-well">
                                <h4>Bus Trip</h4>
                                <p>0</p>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="cus-well">
                                <h4>Train Trip</h4>
                                <p>0</p>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="cus-well">
                                <h4>Cab Booking</h4>
                                <p>0</p>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="cus-well">
                                <h4>Rating</h4>
                                <p>5.00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="bus" class="tab-pane fade">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <h4 style="font-family: Montserrat, sans-serif;letter-spacing: 4px;font-size: 30px; background-color: #01295f; color: white;border-radius: 8px;padding: 15px 15px;">Bus Ticket</h4>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <form action="" method="POST">
                            <div class="input-group regbox">
                                <span class="input-group-addon" style="color: #094074;background-color: white;border: none;"><i class="fas fa-bus"></i></span>
                                <input type="text" class="form-control no-border" name="bus_from" placeholder="From" style="border-style: none; border: 0; box-shadow: none;">
                            </div>
                            <br>
                            <div class="input-group regbox">
                                <span class="input-group-addon" style="color: #094074;background-color: white;border: none;"><i class="fas fa-bus-alt"></i></span>
                                <input type="text" class="form-control no-border" name="bus_to" placeholder="To" style="border-style: none; border: 0; box-shadow: none;">
                            </div>
                            <br>
                            <div class="input-group regbox">
                                <span class="input-group-addon" style="color: #094074;background-color: white;border: none;"><i class="fas fa-calendar-week"></i></span>
                                <input type="text" class="form-control no-border" name="bus_date" placeholder="Date" style="border-style: none; border: 0; box-shadow: none;">
                            </div>
                            <br>
                            <div class="input-group regbox">
                                <span class="input-group-addon" style="color: #094074;background-color: white;border: none;"><i class="far fa-bookmark"></i></span>
                                <input type="text" class="form-control no-border" name="bus_ticket" placeholder="No Of Tickets" style="border-style: none; border: 0; box-shadow: none;">
                            </div>
                            <br>
                            <div class="form-group text-center">
                                <button type="submit" name="bus_btn" class="btn btn-reg">Confirm</button>
                            </div>

                        </form>
                    </div>
                </div>

                <!-- Error Section ----->
                <div class="row">
                    <div class="container">
                        <div class="col-sm-4 col-sm-offset-4">
                            <?php
                        
                        if( $Error_No == 2 )
                        {
                            echo '<br><div class="alert alert-warning text-center">
                                      all fields are required
                            </div>';
                        }
                        else if( $Error_No == -1 )
                        {
                            echo '<br><div class="alert alert-success text-center">
                                      Our Customer Care Agent Will Contact You Soon
                            </div>';
                        }
                        
    ?>
                        </div>
                    </div>
                </div>

            </div>
            <div id="train" class="tab-pane fade">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <h4 style="font-family: Montserrat, sans-serif;letter-spacing: 4px;font-size: 30px; background-color: #01295f; color: white;border-radius: 8px;padding: 15px 15px;">Train Ticket</h4>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <form action="" method="POST">
                            <div class="input-group regbox">
                                <span class="input-group-addon" style="color: #094074;background-color: white;border: none;"><i class="fas fa-bus"></i></span>
                                <input type="text" class="form-control no-border" name="train_from" placeholder="From" style="border-style: none; border: 0; box-shadow: none;">
                            </div>
                            <br>
                            <div class="input-group regbox">
                                <span class="input-group-addon" style="color: #094074;background-color: white;border: none;"><i class="fas fa-bus-alt"></i></span>
                                <input type="text" class="form-control no-border" name="train_to" placeholder="To" style="border-style: none; border: 0; box-shadow: none;">
                            </div>
                            <br>
                            <div class="input-group regbox">
                                <span class="input-group-addon" style="color: #094074;background-color: white;border: none;"><i class="fas fa-calendar-week"></i></span>
                                <input type="text" class="form-control no-border" name="train_date" placeholder="Date" style="border-style: none; border: 0; box-shadow: none;">
                            </div>
                            <br>
                            <div class="input-group regbox">
                                <span class="input-group-addon" style="color: #094074;background-color: white;border: none;"><i class="far fa-bookmark"></i></span>
                                <input type="text" class="form-control no-border" name="train_ticket" placeholder="No Of Tickets" style="border-style: none; border: 0; box-shadow: none;">
                            </div>
                            <br>
                            <div class="form-group text-center">
                                <button type="submit" name="train_btn" class="btn btn-reg">Confirm</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
            <div id="cab" class="tab-pane fade">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <h4 style="font-family: Montserrat, sans-serif;letter-spacing: 4px;font-size: 30px; background-color: #01295f; color: white;border-radius: 8px;padding: 15px 15px;">Cab Booking</h4>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <form action="" method="POST">
                            <div class="input-group regbox">
                                <span class="input-group-addon" style="color: #094074;background-color: white;border: none;"><i class="fas fa-bus"></i></span>
                                <input type="text" class="form-control no-border" name="cab_from" placeholder="From" style="border-style: none; border: 0; box-shadow: none;">
                            </div>
                            <br>
                            <div class="input-group regbox">
                                <span class="input-group-addon" style="color: #094074;background-color: white;border: none;"><i class="fas fa-bus-alt"></i></span>
                                <input type="text" class="form-control no-border" name="cab_to" placeholder="To" style="border-style: none; border: 0; box-shadow: none;">
                            </div>
                            <br>
                            <div class="input-group regbox">
                                <span class="input-group-addon" style="color: #094074;background-color: white;border: none;"><i class="fas fa-calendar-week"></i></span>
                                <input type="text" class="form-control no-border" name="cab_date" placeholder="Date" style="border-style: none; border: 0; box-shadow: none;">
                            </div>
                            <br>
                            <div class="form-group text-center">
                                <button type="submit" name="cab_btn" class="btn btn-reg">Confirm</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div id="tour" class="tab-pane fade">

            </div>
        </div>
    </div>

    <script>
        $('.input-group.date').datepicker({
            format: "dd.mm.yyyy"
        });

    </script>


</body>

</html>
