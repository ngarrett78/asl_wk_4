<!DOCTYPE html>
<html lang="en">
<head>

    <?php
    if (isset($this->session->userdata['logged_in'])) {

        header("location: http://picsaplenty.com:8888/index.php/user_profiles/user_login_process");

    }
    ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="organize your online profile pictures">
    <meta name="author" content="Nate Garrett">


    <title>Profile Pics aPlenty</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/dist/css/bootstrap.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom style sheets -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display' rel='stylesheet' type='text/css'>

    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- scripts for jquery animation and gmaps -->
    <script  src="<?php echo base_url(); ?>js/jquery.waypoints.js"></script>
    <script  src="<?php echo base_url(); ?>js/inview.js"></script>

    <!-- Google Maps -->
    <script src="https://cdn.firebase.com/js/client/2.2.1/firebase.js"></script>


</head>

