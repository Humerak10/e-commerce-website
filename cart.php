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
        $ordered_items = '';

        while( $index < count( $_SESSION['cart_items'] ) ) { 
            // ignoring if the value was removed
            if( $_SESSION['cart_items'][$index] == NULL ) {
                $index = $index + 1;
                continue;
            }

            $id = $_SESSION['cart_items'][$index]['ID'];

            $sql = "SELECT * FROM saket WHERE ID=$id";
            $result= $con->query($sql);
            $row = $result->fetch_assoc();

            $ordered_items =  $ordered_items . $row['ID'] . "-" . $_SESSION['cart_items'][$index]['quantity'] . ";";
            
            $index = $index+1;
        }

        $order_date = date("j F Y");   
        $ordered_items = rtrim($ordered_items, "; ");
        $username = $_SESSION['username'];

        header("location: customer_info.php?username=$username&products_id=$ordered_items&date=$order_date");


        // Prepare an insert statement
        $sql = "INSERT INTO orders (order_id, username, products_id, order_date) VALUES (NULL, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $_SESSION['username'], $ordered_items, $order_date);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                unset($_SESSION['cart_items']);

                // Redirect to home page
                header("location: index.php");

                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    if( isset( $_GET['order'] ) ) {
        Order();
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
    <title>My cart</title>
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
                    <?php 
                        if( isset($_SESSION['loggedin']) && $_SESSION['username'] == 'admin' ) {
                            echo "<li><a href='all_orders.php'>All Orders</a></li>";
                        }
                        else {
                            echo "<li><a href='my_orders.php'>My Orders</a></li>";
                        }

                        if( isset( $_SESSION['loggedin'] ) ){ 
                            echo "<li><a class='logout-btn' href='./cart.php?logout=true'>Logout</a></li>";  
                        } 
                        else {
                            echo "<li><a href='accounts.php'>Account</a></li>";
                        }
                    ?>

                </ul>
            </nav>
            <a href="cart.php"> <img src="./assets/images/shopping-cart.png" width="30px" height="30px"></a>
              <img src="./assets/images/menu.png" class="menu-icon" onclick="menutoggle()">
        </div>
           </div>
       
        <!---------------cart items details----------->
          
          <div class="small-container cart-page">
            
              <table>
                  <tr>
                      <th>Product</th>
                      <th>Quantity</th>
                    <th>Amount</th>
                  </tr>

                    <?php 
                        if( isset($_SESSION['cart_items'] ) ) {
                            $index=0;
                            while( $index < count( $_SESSION['cart_items'] ) ) { 
                                // ignoring if the value was removed
                                if( $_SESSION['cart_items'][$index] == NULL ) {
                                    $index = $index + 1;
                                    continue;
                                }
    
    
                                $id = $_SESSION['cart_items'][$index]['ID'];
    
                                $sql = "SELECT * FROM saket WHERE ID=$id";
                                $result= $con->query($sql);
                                $row = $result->fetch_assoc();
    
                                // adding the price to grand total
                                $GLOBALS['grand_total'] = $GLOBALS['grand_total'] +  ( intval( $row['price'] ) * intval( $_SESSION['cart_items'][$index]['quantity'] ) ); 
                    ?>  
                    
                                <tr>
                                    <td>
                                        <div class="cart-info">
                                            <img src="<?php echo $row['IMAGE']?>">
                                            <div class="item-details">
                                                <div class="name-price">
                                                <div><?php echo $row['NAME'] ?></div>
                                                <small>Price: ₹<?php echo $row['price'] ?></small>
                                                </div>
                                                <div class="remove-all">
                                                    <a href="./cart.php?remove-all=true&ID=<?php echo $id ?>">Remove All</a>
                                                </div>
                                                
                                            </div>
                                        </div> 
                                    </td>
                                    <td><input value="<?php echo $_SESSION['cart_items'][$index]['quantity'] ?>" readonly></td>
                                    <td>₹<?php echo intval( $row['price'] ) * $_SESSION['cart_items'][$index]['quantity'] ?></td> 
                                </tr>

                    <?php 
                                $index = $index + 1;
                            }
                            
                        }
                        else {
                    ?>
                             <tr align="center">
                                    <td colspan="3">
                                        <div class="cart-info-empty">
                                            no cart items
                                        </div> 
                                    </td>
                            </tr>

                    <?php
                        }

                    ?> 
                
              </table>
        
            <?php
                if( isset($_SESSION['cart_items'] ) ) {
            ?>
                    <div class="total-price">
                    
                        <table>
                            <tr>
                                <td>Subtotal</td>
                                <td>₹<?php echo $GLOBALS['grand_total'] ?></td>
                            </tr>
                            <tr>
                                <td>Tax (12% GST) </td>
                                <td>₹<?php 
                                    // getting 12% GST of total 
                                    $GLOBALS['tax'] = number_format((float) ($GLOBALS['grand_total'] * 0.12) , 2, '.', '');
                                    echo $GLOBALS['tax'];
                                ?></td>       
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>₹<?php echo $GLOBALS['grand_total'] + $GLOBALS['tax'];?></td>
                            </tr>
                            <tr>
                                <td>Payment method</td>
                                <td>Pay on delivery</td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <!-- <a href="customer_info.php" class="btn">Buy now</a> -->
                                    <a href="./cart.php?order=true" class="order-btn"> Order </a>
                                </td>
                            </tr>
                        </table>
                    </div>
            <?php
                }
            ?>
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
             
    </body>
</html>
 