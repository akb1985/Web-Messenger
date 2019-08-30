<?php
    session_start();

    //INSERTING MESSAGES TO DATABASE

    if(isset($_REQUEST['key']))
    {   
        $msg = $_REQUEST['key'];
        $sendby = $_SESSION['user'];
        $sendto = $_REQUEST['key2'];

        $con = mysqli_connect('localhost' , 'root' , '' , 'chat');
        $q = "INSERT into chats values(NULL ,'$msg' , '$sendby' , '$sendto')";
        $rs = mysqli_query($con , $q);

        if($rs)
        {
            echo "Message Sent";
        }
        else{
            echo "Sending Error";
        }
    }

    //FOR KNOWING WHO IS ONLINE

    else if(isset($_REQUEST['k']))
    {
        $online = $_SESSION['user'];

        $con = mysqli_connect('localhost' , 'root' , '' , 'chat');
        

        $arr = array();
        $q = "SELECT *from online";
        $rs = mysqli_query($con , $q);
        while($row = mysqli_fetch_array($rs))
        {
           
            $arr[] = $row['OnUser'];
        
        }

        $q = "SELECT * from register where Username != '$online' ";
        $rs = mysqli_query($con , $q);
        while($row = mysqli_fetch_array($rs))
        {
             echo "<li><button class = 'peopleon'>$row[Username]</button>";
            if(in_array( $row['Username'],$arr))
            {
                echo "<div class = 'dot' style = 'background-color:green;'></div></li>";
                
            }
            else{
                echo" <div class = 'dot'></div></li>";
            }
            
        }
    }

    //FOR PRINTING MESSAGES or CHATS

    else
    {
        $sendto = $_REQUEST['hii'];
        $person =$_REQUEST['p'];
        
        $con = mysqli_connect('localhost' , 'root' , '' , 'chat');

        if($sendto == "Group"){
            $q = "SELECT * from chats where SendTo='$sendto'";
            $rs = mysqli_query($con , $q);
        }else{

            $q = "SELECT*FROM chats where (SendTo = '$person' and SendBy = '$sendto')or(SendBy = '$person' and SendTo = '$sendto')";
            $rs = mysqli_query($con , $q);
        }

        while($row = mysqli_fetch_array($rs))
        {   
            if($person == $row['SendBy'])
            {
                echo "<div class = 'senddiv'><div class = 'senddiv1'><p class = 'usrh'>$row[SendBy] </p><p class = 'usrm'> $row[Message]</p></div></div>";
            }
            else{
                echo "<div class = 'receivediv'><div class = 'receiverdiv1'><p class = 'usr2h'>$row[SendBy] </p> <p class = 'usr2m'>$row[Message]</p></div></div>";
            }
        }
        
    }
?>
