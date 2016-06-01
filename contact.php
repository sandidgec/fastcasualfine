<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title> Contact Page </title>

    <link rel="stylesheet" href="lib/css/style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    
</head>

<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Home</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="contact.php">Contact</a></li>
                <li><a href="about.php">About</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav><br>

    <!-- Main Jumbotron -->
    <div class="container main-content">
        <div class="col-md-12">
            <h1 class="text-center"><span class="text-white">Have any questions?</span></h1>
            <?php
            if(isset($_POST["submit"])) {
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                if(empty($email)) {
                    $errEmail = "Please enter a valid email address.";
                }
                $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
                if(empty($message)) {
                    $errMessage = "Please enter a message.";
                }
                $from = "$email";
                $to = "cashley@cultivatingcoders.com, charles@cultivatingcoders.com";
                $subject = "Message from $email about Cultivating Coders";
                $body = "$message" . PHP_EOL;
                // If there are no errors, send the email
                if(!isset($errName) && !isset($errEmail) && !isset($errMessage)) {
                    if(mail($to, $subject, $body, $from)) {
                        $result = '<br/><div class="alert alert-success" role="alert">Thanks, we\'ll be in touch!</div>';
                    } else {
                        $result = '<div class="alert alert-danger" role="alert">There was an error sending your message. Please try again later.</div>';
                    }
                }
            }
            ?>
            <form method="post" action="<?php echo $PREFIX; ?>contact/" class="col-md-6 col-md-offset-3"
                  id="contactForm" name="contactForm">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    <?php if(isset($errEmail)) {
                        echo "<p class='alert alert-danger' role='alert'>$errEmail</p>";
                    } ?>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="3" placeholder="Message"></textarea>
                    <?php if(isset($errMessage)) {
                        echo "<p class='alert alert-danger' role='alert'>$errMessage</p>";
                    } ?>
                </div>
                <button class="btn btn-success" id="submit" name="submit" type="submit">Send</button>
                <div class="form-group">
                    <?php if(isset($result)) {
                        echo $result;
                    } ?>
                </div>
            </form>
            <div class="col-md-4 col-md-offset-4 teambtn">
                <a class="btn btn-primary btn-lg center-block" href="#team" role="button">
                    <span class="text-big">The Team</span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="navbar navbar-default navbar-fixed-bottom">
    <div class="container">
        <p class="navbar-text pull-center">Copyright 2016 Cultivating Coders</p>
    </div>
</div>

</body>
</html>
