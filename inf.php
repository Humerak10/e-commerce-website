<!DOCTYPE html>
<html>
<head>
    <title>All Products-shop</title>
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
                        session_start();
                        
                        if( isset($_SESSION['loggedin']) && $_SESSION['username'] == 'admin' ) {
                            echo "<li><a href='all_orders.php'>All Orders</a></li>";
                        }
                        else {
                            echo "<li><a href='my_orders.php'>My Orders</a></li>";
                        }

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
           <!---no idea---->
           <?php
   $con = mysqli_connect('localhost','root');
   mysqli_select_db($con,'ecommerce');
   $order_id = $_GET['order_id'];
   $sql = "SELECT* FROM orders WHERE order_id=$order_id";

   $featured = $con->query($sql); 

   // starting the session 
   session_start();
?>
           <!-----try---->
            
                <div class="small-container">
       
            <div class="row">
            
                <?php
                    while ($row = $featured->fetch_assoc()) {
                ?> 
                    <div class="col-4">
                        
                        <a href="products-details.php?order_id=<?php echo $row['name']?>" >
                            <h1> Name:<?php echo $row['name']; ?></h1>
                            <h1> Contact:<?php echo $row['num']; ?></h1>
                            <h1> Email:<?php echo $row['email']; ?></h1>
                            <h1> Address:<?php echo $row['address']; ?></h1>
                        </a>
                       
                    
                       
                    </div>    
                <?php
                    }
                ?>
        
            </div>
<!-----try---->
    
        <div class="small-container">
            
           
            
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
            </body>
</html>