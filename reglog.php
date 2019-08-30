<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web Messenger</title>
    <link rel = "stylesheet" href = "style.css">
    <script src =  "jquery-3.4.1.min.js"></script>
</head>
<body>
    <div class="main-header">
        <div class = "bounceIn"><p class="main-title">Web<img src = "message.png"></p></div>
    </div>
    <div class="hr"></div>
    <div class = "header">
        <p class = "login">LogIn</p>
        <hr>
        <form method = "POST" class = 'form' onsubmit = 'return checklog()'>
            <input type = "text" name = "usrname" placeholder = "Username" class = "inputbox1" id = "usrname"></br>
            <input type = "password" name = "psw" placeholder = "Password" class = "inputbox2" id = "pass"></br>
            <input type="submit" value = "Login" class = "loginbut">
            <p class = "kreg">Have you <a id = "red">Register</a>?</p>
        </form>
    </div>
    <footer class="footer"><p>Get Connected</p></footer>
    <div class = "chattitle"><img src = "chat2.jpg" class = "image"></div>
    <div class = "chattitle2"><img src = "chat3.jpg" class = "image"></div>
    <div class = "reg">
    <p class = "login" style = "color:red;">Register</p>
    <hr>
        <form method = "POST" class = "form" onsubmit = 'return checkreg()'>
            <input type = "text" name = "uname" placeholder = "Enter username" class = "inputbox1" id = "usrname1">
            <input type = "password" name = "pass" placeholder = "Enter Password" class = "inputbox2" id = "pass1">
            <input type="submit" value = "SignUp" class = "loginbut" style = "background-color:red;">
            <p class = "kreg">Already Register?<a id = "green">Login</a></p>
        </form>
    </div>

    
   
</body>
</html>
<script>
    $(document).ready(function()
    {
        $(".reg").hide();
        $(".chattitle2").hide();
        
        $("#red").click(function(){
            $(".reg").slideDown(2000).css({"visibility":"visible"});
            $(".chattitle").css({"visibility":"hidden"});
            $(".chattitle2").fadeIn(2000).css({"visibility":"visible"});
            $(".header").css({"visibility":"hidden"});
            $(".para").css({"visibility":"hidden"});
            $(".para1").css({"visibility":"hidden"});
            $(".chattitle").hide();
            $(".header").hide();
        });
        $("#green").click(function(){
            $(".reg").css({"visibility":"hidden"});
            $(".chattitle").fadeIn(2000).css({"visibility":"visible"});
            $(".chattitle2").css({"visibility":"hidden"});
            $(".header").slideDown(2000).css({"visibility":"visible"});
            $(".reg").hide();
            $(".chattitle2").hide();
        });
    });

        function  checkreg()
        {
                var  m = document.getElementById("usrname1").value;
                var p = document.getElementById("pass1").value;
                if(m.length == 0)
                {
                    alert("Enter Something");
                    return false;
                }
                else if(p.length < 8){
                    alert("Password is too short");
                    return false;
                }
                else{
                    return true;
                }
                
        }

                    
        function checklog()
        {
                var m = document.getElementById("usrname").value;
                var p = document.getElementById("pass").value;
                if(m.length == 0)
                {
                    alert("Something Empty");
                    return false;
                    
                }
                else if(!p)
                {
                    alert("Don't you have Password");
                    return false;
                }
                else{
                    return true;
                }
        }
    </script>
<?php

        session_start();
        if(isset($_SESSION['user']))
        {
            echo " <script>window.location = 'home.php'</script>";
        }
        session_abort();

        if(isset($_REQUEST['uname']))
        {
                $uname = $_REQUEST['uname'];
                $pass = $_REQUEST['pass'];

                $con = mysqli_connect('localhost' , 'root' , '' , 'chat');
                $q = "insert into register values('$uname' , '$pass')";
                $rs = mysqli_query($con , $q);

                if($rs)
                {
                    echo "<p class = 'para'>Registered Successfully</p> ";
                }
                else
                {
                    echo "<p class = 'para1'>Error</p>";
                }
        }
        if(isset($_REQUEST['usrname']))
            {
                $c = 0;
                $uname = $_REQUEST['usrname'];
                $pass = $_REQUEST['psw'];

                $con = mysqli_connect('localhost' , 'root' , '' , 'chat');
                $q = "SELECT*from register where Username = '$uname'";
                $rs = mysqli_query($con , $q);

                while($row = mysqli_fetch_array($rs))
                {
                    if($row['Password'] == $pass)
                    {
                        $c++;
                    }
                }
                if($c==1)
                {
                    session_start();
                    $_SESSION['user'] = $uname;
                    $online = $_SESSION['user'];
                    
                    $con = mysqli_connect('localhost' , 'root' , '' , 'chat');
                    $q = "INSERT into online values(NULL , '$online')";
                    $rs = mysqli_query($con , $q);

                    echo "<script>window.location = 'home.php'</script>";
                }
                else{
                    echo "<p class = 'para1'>Error</p>r";
                }

                


            }
        

?>