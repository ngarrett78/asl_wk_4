<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if($this->input->post()){
    $caption       = set_value('caption');
    $description    = set_value('description');
} else {
    $caption       = $image->caption;
    $description    = $image->description;
}
?><!DOCTYPE html>
<html lang="en">
<head>
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

</head>
<body class="wrapper_edit_image">

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
                        <li class="active" id="logout"><a href="logout">Logout</a></li>

                    </ul>
                </div>
            </div>
        </nav>

    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="container">
                <h1>Update Image</h1>

                    <?php if(validation_errors() || isset($error)) : ?>
                        <div class="alert alert-danger" role="alert" align="center">
                            <?=validation_errors()?>
                            <?=(isset($error)?$error:'')?>
                        </div>
                    <?php endif; ?>
                    <?=form_open_multipart('user_profiles/edit/'.$image->id)?>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="userfile">Image File</label>
                        <div class="row" style="margin-bottom:5px"><div class="col-md-12"><?=img(['src'=>$image->file,'width'=>'100%'])?></div></div>

                        </div>
                </div>
                    <div class="col-md-6">
                        <input type="file" class="form-control" name="userfile">



                    <div class="form-group">
                        <label for="caption">Caption</label>
                        <input type="text" class="form-control" name="caption" value="<?=$caption?>">
                    </div>


                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description"><?=$description?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    <?=anchor('user_profiles','Cancel',['class'=>'btn btn-warning'])?>

                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>

