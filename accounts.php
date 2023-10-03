<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted 
if($_SERVER["REQUEST_METHOD"] == "POST" AND $_POST['btnName'] == "Register" ) {
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } 
    elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } 
    else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } 
                else{
                    $username = trim($_POST["username"]);
                }
            } 
            else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } 
    elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } 
    else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } 
    else{
        $confirm_password = trim($_POST["confirm_password"]);

        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password is correct, so start a new session
                session_start();
                                
                // Store data in session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;
                $_SESSION["username"] = $username;                            
                
                
                // Redirect to login page
                header("location: index.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
else if( $_SERVER["REQUEST_METHOD"] == "POST" AND $_POST['btnName'] == "Login"  ) {
    // Initialize the session
    session_start();
    
    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: index.php");
        exit;
    }
    
    // Include config file
    require_once "config.php";
    
    // Define variables and initialize with empty values
    $username = $password = "";
    $username_err = $password_err = $login_err = "";
    
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    
        // Check if username is empty
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter username.";
        } else{
            $username = trim($_POST["username"]);
        }
        
        // Check if password is empty
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter your password.";
        } else{
            $password = trim($_POST["password"]);
        }
        
        // Validate credentials
        if(empty($username_err) && empty($password_err)){
            // Prepare a select statement
            $sql = "SELECT id, username, password FROM users WHERE username = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                
                // Set parameters
                $param_username = $username;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Store result
                    mysqli_stmt_store_result($stmt);
                    
                    // Check if username exists, if yes then verify password
                    if(mysqli_stmt_num_rows($stmt) == 1){                    
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                        if(mysqli_stmt_fetch($stmt)){
                            if(password_verify($password, $hashed_password)){
                                // Password is correct, so start a new session
                                session_start();
                                
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;                            
                                
                                // Redirect user to welcome page
                                header("location: index.php");
                            } else{
                                // Password is not valid, display a generic error message
                                $login_err = "Invalid username or password.";
                            }
                        }
                    } else{
                        // Username doesn't exist, display a generic error message
                        $login_err = "Invalid username or password.";
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        
        // Close connection
        mysqli_close($link);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href="cpp2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
          </head>
    <body>
        
        
        <div class="container">
         <div class="navbar">
            <div class="logo">
               <a href="index.php"><img src="./assets/images/logo4.jpeg" width="200px "></a> 
            </div>
            <nav>
                <ul id="MenuItems">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="products.php">All Products</a></li>
                    <li><a href="my_orders.php">My Orders</a></li>
                    <li><a href="accounts.php">Account</a></li>

                </ul>
            </nav>
             <a href="cart.php"><img src="./assets/images/shopping-cart.png" width="30px" height="30px"></a> 
              <img src="./assets/images/menu.png" class="menu-icon" onclick="menutoggle()">
        </div>
           </div>
        
        <!------------account-page----------->
        
          <div class="account-page">
             <div class="container">
              <div class="row">
                
                  <div class="col-2">
                      <div class="form-container">
                          <div class="form-btn">
                            <div class="flex-container">
                                <div class="toggle-button-text" onclick="login()">
                                    <span class="_span">Login</span>
                                </div>
                                <div class="toggle-button-text" onclick="register()">
                                    <span class="_span">Register</span>
                                </div>
                            </div>
                            
                            <hr id="Indicator" style="transform: translateX(150px)">      
                          </div>
  
                          <form id="LoginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" value="Login" method="post" >
                            <input type="text" name="username" placeholder="Username">
                            <input type="password" name="password" placeholder="Password">
                            <div class="login-btn-container">
                                <button type="submit" class="btn btn-primary" name="btnName" value="Login">Login</button>
                                <a href="">Forget password</a>
                            </div>
                            
                          </form>

                          <form id="RegForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"= >
                            <div class="form-group">
                                <input type="text" name="username" placeholder="Username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                                <span class="invalid-feedback"><?php echo $username_err; ?></span>
                            </div>    
                            <div class="form-group">
                                <input type="password" name="password" placeholder="Password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                                <span class="invalid-feedback" style="height: 0px"><?php echo $password_err; ?></span>
                            </div>
                            <div class="form-group">
                                <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="btnName" value="Register">
                            </div>
                        </form>
                      </div>
                  </div>
                     
                 </div>
              
              </div>
        
        
         </div>
      
       

        <!---------------footer----------->
        <div class="footer">
            <div class="container">
                <div class="row">
                <div class="footer-col-1">
                    <h3>Download Our App</h3>
                    <p>download our app for better shopping expirience</p>
                    <div class="app-logo">
                        <img src="./assets/images/feat.jpg">
                      <img src="./assets/images/feat.jpg">
                    </div>
                   </div>
                <div class="footer-col-2">
                    <img src="./assets/images/feat3.jpg">
                    <p>follow us on social medias to get updates on the latest products</p>
                    </div>
                <div class="footer-col-3">
                    <h3>Useful links</h3>
                    <ul>
                    <li>Coupon</li>
                        <li>Blog post</li>
                        <li>Return Policy</li>
                        <li>jpoint</li>
                    </ul>
                    
                    </div>
                   <div class="footer-col-4">
                    <h3>Follow us</h3>
                    <ul>
                    <li>facebook</li>
                        <li>Twitter</li>
                        <li>instagram</li>
                        
                    </ul>
                    
                    </div>
             
                </div>
                
               <hr>
                <p class="copyright">Copyright 2022</p>
                </div>
                </div>
        
        <!-------------js for toggle--->
        <script>
        var MenuItems = document.getElementById("MenuItems");
            MenuItems.style.maxHeight = "0px";
            function menutoggle(){
            if(MenuItems.style.maxHeight =="0px")
                {
                    MenuItems.style.maxHeight = "200px";
                }
                else
                {
                     MenuItems.style.maxHeight = "0px";
                }
            }
            </script>
        
        <!-------------js for toggle form--------------->
        
          <script>
               var LoginForm = document.getElementById("LoginForm");
               var RegForm = document.getElementById("RegForm");
               var Indicator = document.getElementById("Indicator");
         
                    function register(){ 
                        RegForm.style.transform = "translateX(0px)";
                        LoginForm.style.transform = "translateX(0px)";
                        Indicator.style.transform = "translateX(150px)";
                    }
              
                    function login(){
                        RegForm.style.transform = "translateX(300px)";
                        LoginForm.style.transform = "translateX(300px)";
                        Indicator.style.transform = "translateX(-150px)";
                    }
         </script>
             
    </body>
</html>
 