<?php
session_start();

    include("connections.php");
    include("functions.php");


    if($_SERVER['REQUEST_METHOD'] == "POST") 
    {
        //something was posted
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        if(!empty($user_name) && !empty($password) && !is_numeric($user_name)) 
        {
            //checks database to see if username is taken
            $query = "select * from users where user_name = '$user_name' limit 1";
            
            $result = mysqli_query($con, $query);
            print_r($result);
            if($result) {
                if($result && mysqli_num_rows($query) > 0) {
                    print_r(mysqli_num_rows($query));
                    echo "Username already exists";
                } else {
                    //save to database
                    $user_id = random_num(20);
                    $query = "insert into users (user_id, user_name, password) values ('$user_id', '$user_name', '$password')";
                    
                    $result = mysqli_query($con, $query);

                    header("Location: login.php");
                    die;
                }
            }
        } else
        {
            echo "Please enter valid information!";
        }
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Signup</title>
</head>
<body>
    <style type="text/css">
    #text{
        height: 25px;
        border-radius: 5px;
        padding: 4px;
        border: solid thin #aaa;
        width: 100%;
    }

    #button{

        padding: 10px;
        width: 100px;
        color: white;
        background-color: lightblue;
        border: none;
    }

    #box{
        background-color: grey;
        margin: auto;
        width: 300px;
        padding: 20px;
    }

    </style>

    <div id="box">
        <form method = "post">
            <div style="font-size: 20px;margin:10px;color: white;">Signup</div><br><br>
            <input type="text" name="user_name"><br><br>
            <input type="password" name="password"><br><br>

            <input type="submit" value="Signup"><br><br>
            <a href="login.php">Click to Login</a><br><br>
        </form> 


</body>
</html>