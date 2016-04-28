<!-- NAVBAR
================================================== -->
<body id="wrapper_homepage">

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
                        <li class="active"><a href="http://picsaplenty.com:8888/">Home</a></li>
                        <li><a href="/index.php/user_profiles/user_registration_show">Register</a></li>
                        <li><a href="/index.php/user_profiles/user_login_show">Login</a></li>
                        <li><a href="/index.php/contact">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </nav>

    </div>
</div>

<div id="slideshow">
    <img src="/img/home_bg.jpg" class="bgM"/>
    <img src="/img/h22.jpg" class="bgM"/>
    <img src="/img/retro-camera.jpg" class="bgM"/>
    <img src="/img/add_bg.jpg" class="bgM"/>
</div>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div id="wrap">
<div class="home_jumbotron" style="margin-bottom:20px;">
    <div class="container">
        <h1>Hey Stranger...</h1>
        <h3>Finally a single location to manage all your favorite profile pics! Upload and archive all your images and then easily sync with your social networks.</h3>
        <br />
        <!-- Button Registration -->
        <div class="col-md-3" style="margin-bottom: 25px;">
            <a href="/index.php/user_profiles/user_registration_show" type="button" class="btn btn-primary btn-lg btn-block">
                Register for Access
            </a>
        </div>

        <!-- Modal Button for Login -->
        <div class="col-md-3">
            <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myLogin">
                Login
            </button>
        </div>



    </div>
    </div> <!-- /container -->


<!--   LOGIN FORM
================================================= -->
<!-- Modal -->
<div class="modal fade" id="myLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Admin Panel Access</h4>
            </div>
            <div class="modal-body">

                <!-- LOGIN_FORM VIEW IN MODAL -->
                <?php
                if (isset($logout_message)) {
                    echo "<div class='message'>";
                    echo $logout_message;
                    echo "</div>";
                }
                ?>
                <?php
                if (isset($message_display)) {
                    echo "<div class='message'>";
                    echo $message_display;
                    echo "</div>";
                }
                ?>
                    <div id="login">
                        <h2>Login Form</h2>
                        <hr/>
                        <?php echo form_open('user_profiles/user_login_process'); ?>
                        <?php
                        echo "<div class='error_msg'>";
                        if (isset($error_message)) {
                            echo $error_message;
                        }
                        echo validation_errors();
                        echo "</div>";
                        ?>
                        <label>UserName :</label>
                        <input type="text" name="username" id="name" placeholder="username"/><br /><br />
                        <label>Password :</label>
                        <input type="password" name="password" id="password" placeholder="**********"/><br/><br />
                        <input type="submit" value=" Login " name="submit"/><br />
                        <a href="<?php echo base_url() ?>index.php/user_profiles/user_registration_show">To SignUp Click Here</a>
                        <?php echo form_close(); ?>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> <!-- close Modal -->



</div> <!-- close ID - wrap -->

