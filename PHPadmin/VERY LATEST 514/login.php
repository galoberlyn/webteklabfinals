<?php
 session_start();
    include('/shared/connection.php');
    if(!empty($_POST['username']) && !empty($_POST['password'])){
        if(isset($_POST['submit'])){
            
                $username = $_POST['username'];
                $password = $_POST['password'];
                $use = "SELECT username,password,status,UserType FROM users inner join user_details on users.idUsers = user_details.idUser where username = '$username'";
                $result = mysqli_query($conn, $use) or die(mysqli_error($conn));                
                
                $userow = mysqli_fetch_array($result);

            

                if(($userow['username'] == $username AND password_verify($password, $userow['password'] )) ){

                    $_SESSION['username'] = $userow['username'];
                    $_SESSION['UserType'] = $userow['UserType'];
                    
                        $message = "Login Success!";
                        echo "<script type='text/javascript'>
                        alert('$message');
                        
                        </script>";

                }
                else {
                    $message = "Login Failed!";
                        echo "<script type='text/javascript'>
                        var msg;
                        msg = '$message';
                        alert(msg);
                        
                        </script>";
                }
        } 
        else {
                header("Location: index.php");
                exit;
        }


    }
?>