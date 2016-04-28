<!DOCTYPE html>
<html lang="en">
<?php
if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['username']);
    $email = ($this->session->userdata['logged_in']['email']);
} else {
    header("location: login");
}
?>

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

    <script  src="<?php echo base_url(); ?>js/jquery.waypoints.js"></script>
    <script  src="<?php echo base_url(); ?>js/inview.js"></script>


</head>
<body id="wrapper_admin">
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
                    <a class="navbar-brand" href="http://picsaplenty.com:8888/index.php/user_profiles/user_login_process">Profile Pics aPlenty</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active" id="logout"><a href="logout">Logout</a></li>
                        <li><a href="/index.php/contact">Contact Us</a></li>

                    </ul>
                </div>
            </div>
        </nav>

    </div>
</div>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
    <div class="container">
        <h1> <?php echo "Hello <b id='welcome'><i>" . $username . "</i> !</b>"; ?></h1>

    </div>
</div>

<div class="container">




    <div id="profile">
        <div class="row">
            <div class="col-md-4">
                <div class="admin_intro">
                    <?php
                    echo "Welcome to your <br />Profile Dashboard";
                    echo "<br/>";
                    echo "<br/>";
                    echo "Your Username is <br /><span style='font-weight:700'> " . $username . '</span>';
                    echo "<br/><br />";
                    echo "Your Email is <br /><span style='font-weight:700'>" . $email . '</span>';
                    echo "<br/> ";
                    ?>
                </div>
            </div>

            <div class="col-md-8 well">
                <?php if(validation_errors() || isset($error)) : ?>
                    <div class="alert alert-danger" role="alert" align="center">
                        <?=validation_errors()?>
                        <?=(isset($error)?$error:'')?>
                    </div>
                <?php endif; ?>

                <?=form_open_multipart('user_profiles/add')?>

                <div class="form-group">
                    <h3>Upload Your Profile Pictures!!</h3>
                    <label for="userfile">Image File</label>
                    <input type="file" class="form-control" name="userfile">
                </div>

                <div class="form-group">
                    <label for="caption">Caption</label>
                    <input type="text" class="form-control" name="caption" value="" placeholder="required">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" ></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Upload</button>
                <?=anchor('user_profiles','Cancel',['class'=>'btn btn-warning'])?>

                </form>
            </div> <!-- close MD-6 columns -->
        </div> <!-- close row -->
    </div> <!-- close Profile class -->
</div> <!-- close profile Container -->

<div class="row" id="img_gallery">
    <div class="container" >

        <!-- Display Images Options -->

        <section>
            <!-- <div class="dipper"><img src="/img/prof-1.jpg" /></div> -->
        </section>

        <?php if($images->num_rows() > 0) : ?>



            <?php if($this->session->flashdata('message')) : ?>
                <div class="alert alert-success" role="alert" align="center">
                    <?=$this->session->flashdata('message')?>
                </div>
            <?php endif; ?>
            <a name="gallery"></a>
            <!-- add new image button
            <div align="center"><?=anchor('user_profiles/add','Add a new image',['class'=>'btn btn-primary'])?></div>
            -->
            <div class="row">
                <h3 id="pics_header">Your Profile Pics!</h3>





               <?php foreach($images->result() as $img) : ?>
                    <div class="col-md-3">
                        <div class="thumbnail fade">
                            <?=img($img->file)?>
                            <div class="caption">
                                <h3><?=$img->caption?></h3>
                                <p><?=substr($img->description, 0,100)?>...</p>
                                <p>
                                    <?=anchor('user_profiles/edit/'.$img->id,'Edit',['class'=>'btn btn-default', 'role'=>'button'])?>
                                    <?=anchor('user_profiles/delete/'.$img->id,'Delete',['class'=>'btn btn-danger', 'role'=>'button','onclick'=>'return confirm(\'Are you sure?\')'])?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <div align="center">We don't have any image yet, go ahead and <?=anchor('user_profiles/add','add a new one')?>.</div>
        <?php endif; ?>



    </div>

</div> <!-- close img gallery -->




