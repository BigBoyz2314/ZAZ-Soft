<?php

if($_POST["name"]) {
    mail("zazimran@gmail.com", "From ". $_POST["name"]. " of " . $_POST["company"] ,
    $_POST["message"]. " From: " . $_POST["email"]);

    mail("universalunisoft@gmail.com", "From ". $_POST["name"]. " of " . $_POST["company"] ,
    $_POST["message"]. " From: " . $_POST["email"]);

    mail("info@zazsoft.com", "From ". $_POST["name"]. " of " . $_POST["company"] ,
    $_POST["message"]. " From: " . $_POST["email"]);

    header("Location: contact.html");
    }
else {
    header("Location: contact.html");
}

?>