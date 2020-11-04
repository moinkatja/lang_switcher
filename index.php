<?php
    include "config.php";
    // PHP Form Validation
    $error = "";
    $successMessage = "";
    if($_POST) {
        if(!$_POST["email_feld"]) {
            $error .= "E-mail is empty<br>";
        }
        if(!$_POST["titel_feld"]) {
            $error .= "There is no subject<br>";
        }
        if(!$_POST["frage_feld"]) {
            $error .= "Question is empty<br>";
        }
        if (filter_var($_POST["email_feld"], FILTER_VALIDATE_EMAIL) == false) { 
            $error .= "E-mail is not valid<br>";
        }
        
        if($error != ""){
            $error = '<div class="alert alert-danger" role="alert"><p><b>Please correct the mistakes:</b></p>'.$error.'</div>';
        } else {
            $emailTo = "test@testabcde.au";
            $subject = $_POST["titel_feld"];
            $content = $_POST["frage_feld"];
            $headers = "From: ".$_POST["email_feld"];
            if(mail($emailTo, $subject, $content, $headers)) {
                $successMessage= '<div class="alert alert-success" role="alert"><p><b>'. $lang["successMessage"]. '</b></p></div>';
            } else {
                $error = '<div class="alert alert-danger" role="alert"><p><b>'. $lang["errorMessage"].'</b></p></div>';
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <title>Language Switcher</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <style type="text/css">
        .footer {
            left: 0;
            position: fixed;
            bottom: 0;
            text-align: center;
            color: white;
            width: 100%;
            height: 50px;
            padding-top: 10px;
        }
        </style>
    </head>
    <body>
    <nav class = "navbar navbar-expand-sm bg-dark navbar-dark">
        <ul class = "navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href = "#">  <?php echo $lang["home"] ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href = "#">  <?php echo $lang["description"] ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href = "#">  <?php echo $lang["pricing"] ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href = "#">  <?php echo $lang["contact"] ?></a>
            </li>
        </ul>
    </nav>
    <div class="container" style="margin-top: 50px">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3 text-center">
                <h1>  <?php echo $lang["title"] ?></h1>
                <p>
                    <?php echo $lang["description"] ?>
                </p>
            </div>
    </div>
    <section class= "container">
        <h3> <?php echo $lang["contact"] ?></h3>
        <div id="error"><? echo $error; echo $successMessage ?></div>
        <form id="form" method="post"> 
            <div class="form-group">
                <label for="email">
                    <?php echo $lang["email"] ?>
                </label>
                <input type="email" class="form-control" id="email_feld" name="email_feld" placeholder="E-mail">
            </div>
            <div class="form-group">
                <label for="titel"> 
                    <?php echo $lang["subject"] ?>
                </label>
                <input type="text" class="form-control" id="titel_feld" name="titel_feld" placeholder="Titel">
            </div>
            <div class="form-group">
                <label for="frage">
                    <?php echo $lang["question"] ?>
                </label>
                <textarea type="text" class="form-control" id="frage_feld" name="frage_feld" rows="3"  placeholder="Deine Frage"></textarea>
            </div>
            <button type="submit" class="btn btn-primary"><?php echo $lang["send"] ?></button>
        </form>
    </section>
    <footer class="footer bg-dark">
        <a href="index.php?lang=en"><?php echo $lang["lang_en"] ?></a> | 
        <a href="index.php?lang=de"><?php echo $lang["lang_de"] ?></a> | 
        <a href="index.php?lang=ru"><?php echo $lang["lang_ru"] ?></a>
    </footer>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>