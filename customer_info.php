

<?php
    session_start();
    $con = mysqli_connect('localhost','root');
    mysqli_select_db($con,'ecommerce');

    function Logout() {
        unset($_SESSION['username']);
        session_destroy();
        header("location: accounts.php");
    }

    if( isset( $_GET['logout'] ) ) {
        Logout();
    }

    function Order() {
        require_once "config.php";

        $index=0;
        $con = $GLOBALS['con'];


		$name = $_POST['name'];
		$email = $_POST['email']; 
		$num  = $_POST['num'];
		$address = $_POST['address'];

		session_start();

		$username = $_SESSION['username'];
    	$products_id = $_SESSION['products_id'];
    	$order_date = $_SESSION['order_date'];

    	session_write_close();

        // Prepare an insert statement
        $sql = "INSERT INTO orders (order_id, username, products_id, order_date, name, email, num, address) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $username, $products_id, $order_date, $name, $email, $num, $address );
            

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                unset($_SESSION['cart_items']);
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
            

        }
        $sql = "INSERT INTO order_history (order_id, username, products_id, order_date, name, email, num, address) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $username, $products_id, $order_date, $name, $email, $num, $address );
            

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                unset($_SESSION['cart_items']);
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
            //hist
            
        }

    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        Order();
    }
    else if($_SERVER['REQUEST_METHOD'] === 'GET') {
    	session_start();

    	$username = $_GET['username'];
		$products_id = $_GET['products_id'];
		$order_date = $_GET['date']; 	

		$_SESSION['username'] = $username;
		$_SESSION['products_id'] = $products_id;
		$_SESSION['order_date'] = $order_date;

		session_write_close();
    }
	

    $grand_total = 0;
    $tax=0;

    // checking if remove was fired
    if( isset($_GET['remove-all'] ) ) {
        // removing clicked item
        $index=0;
        while( $index < count( $_SESSION['cart_items'] ) ) { 

            if( $_SESSION['cart_items'][$index]['ID'] == $_GET['ID'] ) {
                $_SESSION['cart_items'][$index] = NULL;
                header("location: ./cart.php");
                break;
            }

            $index = $index + 1;
        }
    }
    else if ( isset($_GET['remove-one'] ) ) {
        // reducing quantity of the element by one
        $index=0;
        while( $index < count( $_SESSION['cart_items'] ) ) { 

            if( $_SESSION['cart_items'][$index]['ID'] == $_GET['ID'] ) {

                // checking if there is only one item 
                if( $_SESSION['cart_items'][$index]['quantity'] == 1 ) {
                    $_SESSION['cart_items'][$index] = NULL;
                }
                else {
                    $_SESSION['cart_items'][$index]['quantity'] = intval( $_SESSION['cart_items'][$index]['quantity'] ) - 1 ;
                }
                header("location: ./cart.php");
                break;
                

                
            }

            $index = $index + 1;
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
                    <?php 
                        session_start();
                        if( isset( $_SESSION['loggedin'] ) ){ 
                            echo "<li><a class='logout-btn' href='./index.php?logout=true'>Logout</a></li>" ;  
                        } 
                        else {
                            echo "<li><a href='accounts.php'>Account</a></li>";
                        }
                    ?>
                </ul>
            </nav>
             <a href="cart.php"><img src="./assets/images/shopping-cart.png" width="30px" height="30px"></a> 
              <img src="./assets/images/menu.png" class="menu-icon" onclick="menutoggle()">
          </div>
        </div>

          </head>
    <body class="customer-info">
    	 <div class="account-page">
    	<div class="container">
    		<div class="row">
                
                  <div class="col-2">
                      <div class="form-container">
                      	<div class="form-btn">
                            <div class="flex-container">
                            	 
                            <form method="POST">
                            	<div class="form-group">
	                      			<span class="_spanc">Contact details </span>
	                            	<br>
									<input type="text"  placeholder="name" name="name" value="<?php echo $name;?>">
									<br>
									<input type="text"  name="num" pattern="[0-9]{10}" placeholder="Contact number"  value="<?php echo $number;?>">
									<br>
									 <input type="text"  name="email"   placeholder="Email" value="<?php echo $email;?>">
									<br>
									<br>
									<span class="_spanc">Shipping Address</span>
									<br>
									<textarea name="address" placeholder="Address" rows="5" cols="30"><?php echo $address;?></textarea>
									<input type="submit" class="btn" name="btnName" value="Place order">
								</div>
								</div>
                            </form>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
	<!-----validate---->
	
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
</body>
</html>