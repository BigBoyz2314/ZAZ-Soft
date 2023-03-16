<?php

if($_POST["name"]) {
    mail("zazimran@gmail.com", "From ". $_POST["name"]. " of " . $_POST["company"] ,
    $_POST["message"]. " From: " . $_POST["email"], "CC: universalunisoft@gmail.com" . "CC: info@zazsoft.com");

    header("Location: contact.html");
    }
else {
    header("Location: contact.html");
}

?>