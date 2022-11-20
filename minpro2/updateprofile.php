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
    <meta name="viewport" content=  "with=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleup.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,600;1,400;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script defer src="https://friconix.com/cdn/friconix.js"> </script>

</head>
<body> <div class="loggedin">
        <?php
            $link = mysqli_connect("localhost", "root", "", "phplogin");
            $name=$_SESSION['name'];
            $query=" SELECT * FROM accounts Where username='$name' ";
            $result=mysqli_query($link,$query);
            $row=mysqli_fetch_array($result);
            $username=htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8');
            $password=htmlspecialchars($row['password'], ENT_QUOTES, 'UTF-8');
            $email=htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8');
            $profilepic=htmlspecialchars($row['profilepic'], ENT_QUOTES, 'UTF-8');
            $bio=htmlspecialchars($row['bio'], ENT_QUOTES, 'UTF-8');


            if(isset($_POST['submit']))
            {
                $password1=mysqli_real_escape_string($link, $_POST['password']);
                $email1=mysqli_real_escape_string($link, $_POST['email']);
                $bio1=mysqli_real_escape_string($link, $_POST['bio']);
                $profilepic1=mysqli_real_escape_string($link, $_POST['profilepic']);
                
                $updatequery= "UPDATE accounts SET email='$email1'
                                                  ,password='$password1'
                                                  ,bio='$bio1'
                                                  ,profilepic='$profilepic1'
                                                   WHERE username='$name'";

                $result=mysqli_query($link,$updatequery);
                header('Location: profile.php');
            }


            echo'
            <i class="fa fa-bars" onclick="showMenu()"></i>
           </nav>
           <section class="blog-content">  
			       
            <div class="sign2">  	
                <input type="checkbox" id="chk" aria-hidden="true">

                <!-- SIGN UP -->
        
                    <div class="signup">
                        <form action="signup.php" method="post">
                            <label for="chk" aria-hidden="true">Sign up</label>
                            <input type="text" id="username" name="username" placeholder="User name" required="">
                            <input type="text" id="email" name="email" placeholder="Email" required="">
                            <input type="password" id="password" name="password" placeholder="Password" required="">
                            <button type="submit" name="SignUp">Sign up</button>
                        </form>
                    </div>
				
                    <!-- LOGIN -->
                    
                    <div class="login">
                        <form action="authenticate.php" method ="post">
                            <label for="chk" aria-hidden="true">Login</label>
                            <input type="username" name="username" placeholder="Username" required="">
                            <input type="password" name="password" placeholder="Password" required="">
                            <button type="submit">Login</button>
                        </form>
                    </div>
            </div>
        </section>

        

        </section>
         


<!------Footer---------->
 







    <!---------------javascript for toggle------------->
        <script>
           var navLinks = document.getElementById("navLinks");

           function showMenu(){
               navLinks.style.right = "0";

           }
           function hideMenu(){
               navLinks.style.right = "-200px";

           }
        </script> ';

    // echo'
    // <div class="edit-menu-container" >
    //        <h4>Edit Profile</h4>  
    // </div>
    // <div class="edit-main-con">
    //     <form action="#" method="POST">
    //     <div class="edit-image-con">
    //         <img src="'.$profilepic.'" alt="">
    //         <button>Change Profile<span><input type="file" id="profilepic" name="profilepic" accept="image/png, image/jpeg , image/jpg"></span></button>
    //     </div>
    //         <div class="edit-profile-con">
                
    //             <label >email</label>
    //                <input type="email" name="email" value="'.$email.'" ><br><br>
    //             <label >password</label>
    //                 <input type="text" name="password" value="'.$password.'" ><br><br>
    //             <label >bio</label>
    //                 <input type="text" name="bio" value="'.$bio.'" ><br><br>
    //             <button class="button" type="submit" name="submit">Update Profile</button>
    //         </div>
    //     </form>
    // </div>
    // '; 
    ?></div>
</body>
</html>

<!-- <label >name</label>
                    <input type="text" name="name" value="'.$username.'" ><br><br> -->


