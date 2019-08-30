<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
</html>
<?php
    session_start();
    $online = $_SESSION['user'];
    $con = mysqli_connect('localhost' , 'root' , '' , 'chat');
    $q = "DELETE from online where OnUser = '$online'";
    $rs = mysqli_query($con , $q);

    echo "<div class = 'coverlogout'><p class = 'logoutthanks' >Web<img src = 'message.png'><div class = 'under-line'></div></p><p class = 'lo'>Logout Successfully</p></div>";
            echo"<script>setTimeout(function(){window.location = 'reglog.php';},5000)</script>";

    session_destroy();
?>