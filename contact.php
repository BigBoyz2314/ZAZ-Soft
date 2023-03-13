<?php

if($_POST["name"]) {
    mail("zazimran@gmail.com", "From ". $_POST["name"]. "of " . $_POST["company"] ,
    $_POST["message"]. "From: " . $_POST["email"]);

    header("contact.html");
    }
else {
    header("contact.html");
}

?>