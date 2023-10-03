<?php
    function Cancel_Order( $order_id ) {
        include_once "config.php";

        $con = mysqli_connect('localhost','root');
        mysqli_select_db($con,'ecommerce');

        // Prepare an insert statement
        $sql = "DELETE FROM orders WHERE order_id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $order_id);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                unset($_SESSION['cart_items']);

                // Redirect to home page
                header("location: all_orders.php");

                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    if( isset( $_GET['delivered'] ) ) {
        Cancel_Order( $_GET['delivered'] );
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>All orders-shop</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel = "stylesheet" href="cpp2.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
    </head>
    <body>
        <!-- header -->
        <div class="container">
         <div class="navbar">
            <div class="logo">
               <a href="index.php"><img src="./assets/images/logo4.jpeg" width="200px "></a> 
            </div>
            <nav>
                <ul id="MenuItems">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="products.php">All Products</a></li>
                    <li><a href="all_orders.php">All Orders</a></li>
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


        <!-- main body -->
        </div>
        <table>
            <?php 
                require_once "config.php";
                $items = array();

                if( isset($_SESSION['username'] ) ) {
                    $index=0;
                    $con = mysqli_connect('localhost','root');
                    mysqli_select_db($con,'ecommerce');

                    $username = $_SESSION['username'];
                    $sql = "SELECT * FROM orders";
                    $result= $con->query($sql);
                    // $row = $result->fetch_assoc();

                    while($row = $result->fetch_assoc()) {
                        $items[] = $row;
                        // echo( "<script>console.log('" . $row['order_id'] . "')</script>" );
                    }
                    $GLOBALS['items'] = $items;
                }
                else {
                    header('location:accounts.php');
                }
                

                if( count( $items ) != 0 ) {
                    foreach( $items as $item ) {
                        // echo( "<script>console.log('" . $item['products_id'] . "')</script>" );
                        $prod_ids = $item['products_id'];
                        $prod_ids = explode( ";", $prod_ids);
            ?>
                <tr>
                    <td>
                        <div style="width: 50%; background: rgb(240, 242, 242); margin-left:auto; margin-right: auto; padding: 2px; border: 1px solid rgb(213, 217, 217)">
                        <div style="height: 45px; display:flex; flex-direction: row;">                        
                            <div style="display: flex; flex-direction: row; padding-left: 10px; padding-top: 5px">
                                <p class="small-text">Order ID - </p>
                                <p class="small-text"><?php echo $item['order_id']?></p>
                            </div>
                            <div style="display: flex; flex-direction: column; padding-left: 10px; padding-top: 5px; margin-left: 30px">
                                <p class="x-small-text">Order Placed</p>
                                <p class="x-small-text"><?php echo $item['order_date']?></p>
                            </div>

                            <div style="display: flex; flex-direction: column; padding-left: 10px; padding-top: 5px; margin-left: 30px">
                                <p class="x-small-text">Total</p>
                                <p class="x-small-text">₹1234</p>
                            </div>

                            <div style="display: flex; flex-direction: column; padding-left: 10px; padding-top: 5px; margin-left: auto; margin-right: 20px">
                                <a href="./all_orders.php?delivered=<?php echo $item['order_id'] ?>">Delivered</a>
                            </div>
                            <!---t--->
                            <div style="display: flex; flex-direction: column; padding-left: 10px; padding-top: 5px; margin-left: auto; margin-right: 20px">
                                <a href="./inf.php?order_id=<?php echo $item['order_id'] ?>">Customer information</a>
                            </div>
                            
                        </div>
                        <div style="background: white">
                            <table>
            <?php
                        foreach( $prod_ids as $ids ) {
                            $product_id = explode("-", $ids)[0];
                            $product_quantity = explode("-", $ids)[1];

                            $sql = "SELECT * FROM saket WHERE ID=$product_id";
                            $result= $con->query($sql);
                            $product_details = $result->fetch_assoc();
            ?>
                                <tr>
                                    <td>
                                        <div class="order-list-info">
                                            <img src="<?php echo $product_details['IMAGE']?>">
                                            <div class="item-details">
                                                <div class="name-price">
                                                    <div><?php echo $product_details['NAME'] ?></div>
                                                    <small>Price: ₹<?php echo $product_details['price'] ?></small>
                                                </div>
                                            </div>
                                        </div> 
                                    </td>
                                    <td>
                                        <div class="name-price">
                                            <div>Quantity</div>
                                            <small><?php echo $product_quantity ?></small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="name-price">
                                            <div>Total Price</div>
                                            <small>₹<?php echo intval( $product_details['price'] ) * $product_quantity ?></small>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="width: 30px;"></div>
                                    </td>
                                </tr>
            <?php
                        }
            ?>
                            </table>
                        </div>
                    </div>
                </td>
            </tr>
            <?php
                    }
                }
                else {
            ?>
                        <tr align="center">
                            <td colspan="3">
                                <div class="cart-info-empty">
                                    no Ordered items
                                </div> 
                            </td>
                    </tr>

            <?php
                }

            ?> 
        </table>
        <div>
        </div>

        <div style="height: 50px;"></div>

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
