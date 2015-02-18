<?php
session_start();

include('functions.php');

if(!isLogged()){
    header("Location: login.php");
}

if(isAdmin()){
    header("Location: admin");
}

?>
<?php include("header.php"); ?>

<?php include("footer.php"); ?>