<?php include('server.php');
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}


?>




<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="dash.css">
</head>

<body>
    <div class="thankyou">

        <div class="main-logo"> <a href="http://">Pentagonia</a></div>
        <div class="mini-sqr">
            <div class="mini-box">
                <h1 class="msg">Your Appointment is now set</h1>
                <p class="msg2">See you on</p>
                <div class="date">
                <?php
                echo "<p style='font-size: 24px;font-weight: 600;'>" . $_SESSION['Schedule'] . "</p>"; ?>
            </div>

            <div class="name">
            <?php
                echo "<p style='font-size: 24px;font-weight: 600;'>" . $_SESSION['firstname'] ." ". $_SESSION['lastname'] ."</p>"; ?>
            </div>

            <p class="msg3">We would like to see<b> <?php echo $_SESSION['petname']; ?></b></p>
        
            <a href="expi.html" class="homebtn">HOME</a>

            <p class="thankmsg">Thank You for setting an Appointment</p>
        </div>


        </div>
    </div>

    <script src="" async defer></script>
</body>

</html>