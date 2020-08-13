<?php    
    include "config.php";
?>
   
   <!DOCTYPE html>
    <html>
        <head>
            <title>
                User Registration | PHP
            </title>
            <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        </head>
        <body>
            <div>
                <?php 
                    if(isset($_POST['create'])) {
                        $full_name   = $_POST['full_name'];
                        $user_name    = $_POST['user_name'];
                        $email       = $_POST['email'];
                        $phone_number = $_POST['phone_number'];
                        $password    = $_POST['password'];
                        $confirm_password    = $_POST['confirm_password'];
                        
                        if(!empty($full_name) && !empty($user_name) && !empty($email) && !empty($phone_number) && !empty($password) && !empty($confirm_password)) {
                            
                        $full_name          = mysqli_real_escape_string($connection, $full_name);
                        $user_name          = mysqli_real_escape_string($connection, $user_name);
                        $email              = mysqli_real_escape_string($connection, $email);
                        $phone_number       = mysqli_real_escape_string($connection, $phone_number);
                        $password           = mysqli_real_escape_string($connection, $password);
                        $confirm_password   = mysqli_real_escape_string($connection, $confirm_password);
                        
                        $query = "SELECT password from users";
                        $select_password_query = mysqli_query($connection, $query);
                        
                        
                        $row = mysqli_fetch_array($select_password_query); 
                        $salt = $row['password'];
                            
                        $password = crypt($password, $salt);
                            
                        $query = "SELECT confirm_password from users";
                        $select_confirm_password_query = mysqli_query($connection, $query);
                        
                        
                        $row = mysqli_fetch_array($select_confirm_password_query); 
                        $salt = $row['confirm_password'];
                            
                        $confirm_password = crypt($confirm_password, $salt);
                        
                        $query = "INSERT INTO users (full_name, user_name, email, phone_number, password, confirm_password) ";
                        $query .= "VALUE('{$full_name}', '{$user_name}', '{$email}', '{$phone_number}', '{$password}', '{$confirm_password}')";
                        $register_user_query = mysqli_query($connection, $query);
                            
                        }
                        
//                        if(!$select_password_query) {
//                            die("Query Failed" . mysqli_error($connection));
//                        }
                        
//                        $hashFormat = "$2y$10$";
//                        
//                        $salt = "iusesomecrazystrings22";
//                        
//                        $hashF_and_salt = $hashFormat . $salt;
//                        
//                        $encrypt_password = crypt($password, $hashF_and_salt);
                    }
                ?>
            </div>
            <section>
                <div>
                    <form action="registration.php" method="post">
                        <div class="container">
                           <div class="row">
                                <div class="col-sm-12">
                                    <h1>Registration</h1>
                                    <p>Fill up the form with correct values</p>

                                    <hr class="mb-3">

                                    <label for="full_name"><b>Full Name</b></label>
                                    <input class="form-control" type="text" name="full_name" required>

                                    <label for="user_name"><b>User Name</b></label>
                                    <input class="form-control" type="text" name="user_name" required>

                                    <label for="email"><b>Email Address</b></label>
                                    <input class="form-control" type="email" name="email" required>

                                    <label for="phone_number"><b>Phone Number</b></label>
                                    <input class="form-control" type="text" name="phone_number" required>
`
                                    <label for="password"><b>Password</b></label>
                                    <input class="form-control" type="password" name="password" required>
                                    
                                    <label for="confirm_password"><b>Confirm Password</b></label>
                                    <input class="form-control" type="password" name="confirm_password" required>

                                    <hr class="mb-3">

                                    <input class="btn btn-primary" type="submit" name="create" value="Sign Up">
                                    
                                    <hr class="mb-3">
                                    
                                    <span>
                                        <p>Already have an account?<a href="#">Sign In</a></p>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </body>
    </html>