<!DOCTYPE html>
<html lang="en">
<head>
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


<!-- NAVBAR
================================================== -->
<body id="wrapper_contact">
<div class="navbar-wrapper">
    <div class="container">


        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="http://picsaplenty.com:8888/">Profile Pics aPlenty</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="http://picsaplenty.com:8888/">Home</a></li>
                        <li><a href="/index.php/user_profiles/user_registration_show">Register</a></li>
                        <li ><a href="/index.php/user_profiles/user_login_show">Login</a></li>
                        <li class="active"><a href="/index.php/contact">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </nav>

    </div>
</div>

<!-- ajax contact form validation -->
<div class="container">
    <div class="row">
        <div class="col-md-6 col-lg-offset-3" id="contact_form">
            <?php echo form_open('contact/contact_form', array('id'=>'frm')); ?>

            <div id="validation-error"></div>

            <h5>Name</h5>
            <input type="text" name="name" value="<?php echo set_value('name'); ?>" size="50" />

            <h5>Email Address</h5>
            <input type="text" name="email" value="<?php echo set_value('email'); ?>" size="50" />

            <div><input type="submit" value="Submit" id="contact_submit"/></div>

            </form>

            <br/><br/>
        </div>
    </div>
</div>

    <div id="contact_info">
        <h3>Our Location</h3>
    </div>
    <div id="map">

    </div>



<script>
    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 38.581572, lng: -121.494400},
            zoom: 8
        });
    }
</script>

<!-- JavaScript API to Google -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6Vp2c83d5i9mIwqHttrq6D2wMnxer6dg
&callback=initMap" async defer></script>