<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="path/to/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <style>
        *{
            margin: 0;
            padding:0;
            box-sizing: border-box;
        }
        .edit-menu-container{
            display: flex;
  justify-content: center;
  padding-top: 10px;
        }
       
        .edit-main-con{
            width: 100%;
            max-width:768px;
            margin: auto;

             
        }
        .edit-image-con {
            width: 100%;
            max-width:100px;
            margin: auto;
            padding-top: 20px;
            padding-bottom:20px ;

            
             
        }
        .edit-image-con img {
            width: 100px;
            height: 100px;  
            border-radius: 50%;

        }
        .edit-image-con button {
            width: 130px;
            border: none;
            margin-top: 10px;
            color: black;
            font-size: 16px;
            margin-left: -12px;
             
            
        }
        span input[type=file]
        {
            width: 90px;
    
            
        }
        .edit-profile-con{
            width: 100%;
            padding: 10px;

        }
        .edit-profile-con input[type=text]
        {
            width: 100%;
            padding: 5px;
            margin-top: 8px;
            margin-bottom: 8px;
            border: none;
            border-bottom: 1px solid black;
             
        }
        .edit-profile-con  label{
            padding: 5px;
            margin-top: 5px;
        }
        .button{
  margin: 10px 0;
  width: 300px;
  height: 50px;
  font-size: 18px;
  line-height: 50px;
  font-weight: 600;
  background: #dde1e7;
  border-radius: 25px;
  border: none;
  outline: none;
  cursor: pointer;
  color: #595959;
  box-shadow: 2px 2px 5px #BABECC,
             -5px -5px 10px #ffffff73;
}
.button:focus{
  color: black;
  box-shadow: inset 2px 2px 5px #BABECC,
             inset -5px -5px 10px #ffffff73;
}    
.edit-profile-con input[type=email]
        {
            width: 100%;
            padding: 5px;
            margin-top: 8px;
            margin-bottom: 8px;
            border: none;
            border-bottom: 1px solid black;
             
        }  
    </style>
</head>
<body>
        <?php
            $link = mysqli_connect("localhost", "root", "", "phplogin");
            $name=$_SESSION['name'];
            $query=" SELECT * FROM accounts Where username='$name' ";
            $result=mysqli_query($link,$query);
            $row=mysqli_fetch_array($result);
            $username=$row['username'];
            $password=$row['password'];
            $email=$row['email'];  

            if(!isset($_POST['submit']))
            {
                $name1=mysqli_real_escape_string($link, $_POST['name']);
                $password1=mysqli_real_escape_string($link, $_POST['password']);
                $email1=mysqli_real_escape_string($link, $_POST['email']);
                $updatequery= "UPDATE accounts SET username='$name1',email='$email1',password='$password' WHERE name='$name' ";
                mysqli_query($link,$updatequery);
            }

        ?>
        

    <div class="edit-menu-container" >
           <h4>Edit Profile</h4>  
    </div>

    <div class="edit-main-con">
        <form action="" method="POST">
            <div class="edit-profile-con">
                <label >name</label>
                    <input type="text" value="<?php echo $_SESSION['name'];?>" name="name">
                    <br><br><br>
                <label >email</label>
                   <input type="email" value="<?php echo $email ?>" name="email">
                   <br><br><br>
                <label >password</label>
                    <input type="text" value="<?php echo $password ?>" name="password">
                    <br><br><br>
                <button class="button" type="submit" name="submit">Update Profile</button>
            </div>
        </form>
    </div>
</body>
</html>