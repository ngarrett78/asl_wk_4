<!-- NAVBAR
================================================== -->
<body id="wrapper_reg">

<div class="navbar-wrapper">
    <div class="container" id="reg_login">


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
                        <li ><a href="http://picsaplenty.com:8888/">Home</a></li>
                        <li class="active"><a href="/index.php/user_profiles/user_registration_show">Register</a></li>
                        <li><a href="/index.php/user_profiles/user_login_show">Login</a></li>
                        <li><a href="/index.php/contact">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </nav>

    </div>
    </div>

<div id="slideshow">
    <img src="/img/reg_bg.jpg" class="bgM"/>
    <img src="/img/bg3.jpg" class="bgM"/>
    <img src="/img/bg4.jpg" class="bgM"/>
    <img src="/img/bg5.jpg" class="bgM"/>


</div>


<div class="container" id="wrap">
    <div id="login">

        <h2>Registration Form</h2>
        <hr/>



        <?php
        //echo "<div class='error_msg'>";
        //echo validation_errors();
        //echo "</div>";

        echo ('<div id="validation-error"></div> <!-- placeholder for Ajax error message -->');



        //echo form_open('user_profiles/new_user_registration');
        echo form_open('user_profiles/new_user_registration', array('id'=>'errors')); ?>


        <?php
        echo "<div class='col-md-4'>" . form_label('Create Username : ');
        echo"<br/>";
        echo form_input('username');
        echo "<div class='error_msg'>";
        if (isset($message_display)) {
            echo $message_display;
        }
        echo "</div> </div>";

        echo"<div class='col-md-4'>";
        echo form_label('Email : ');
        echo"<br/>";
        $data = array(
            'type' => 'email',
            'name' => 'email_value'
        );
        echo form_input($data);
        echo"</div>";

        echo"<div class='col-md-4'>";
        echo form_label('Password : ');
        echo"<br/>";
        echo form_password('password');
        echo"</div>";

        echo"<div class='spacing'></div>";
        //echo form_submit('submit', 'Sign Up');
        echo ('<div><input type="submit" value="Submit" /></div>');
        echo form_close();
        ?>
        <a href="<?php echo base_url('/index.php/user_profiles/user_login_show') ?> ">For Login Click Here</a>
    </div>
</div>

