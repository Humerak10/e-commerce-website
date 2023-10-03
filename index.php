<?php
   $con = mysqli_connect('localhost','root');
   mysqli_select_db($con,'ecommerce');
   $sql = "SELECT* FROM saket WHERE featured=2";

   $featured = $con->query($sql); 

   // starting the session 
   session_start();
?>


<!DOCTYPE html>
<html>
<head>
    <title>shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href="cpp2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
          </head>
    <body>
        
        <div class="apple">
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
                        function Logout() {
                            unset($_SESSION['username']);
                            session_destroy();
                            header("location: accounts.php");
                        }

                        if( isset( $_GET['logout'] ) ) {
                            Logout();
                        }

                        if( isset($_SESSION['loggedin']) && $_SESSION['username'] == 'admin' ) {
                            echo "<li><a href='all_orders.php'>All Orders</a></li>";
                            echo"<li><a href='order_history.php'>Order History</a></li>";
                        }
                        else {
                            echo "<li><a href='my_orders.php'>My Orders</a></li>";
                        }

                        if( isset( $_SESSION['loggedin'] ) ) { 
                            echo "<li><a class='logout-btn' href='./index.php?logout=true'>Logout</a></li>" ;  
                        } 
                        else {
                            echo "<li><a href='accounts.php'>Account</a></li>";
                        }
                    ?>
                    

                </ul>
            </nav>
           <a href="cart.php"> <input type="image" src="./assets/images/shopping-cart.png" name="cart" width="30px" height="30px" alt="cart"/> </a>
              
  
            
              <img src="./assets/images/menu.png" class="menu-icon" onclick="menutoggle()">
        </div>
            <div class="row">
                <div class="col-2">
                    <h1>A Big Mall of <br> Stationary and books <br>at your sevice...</h1>
                    <p><h2>Now fulfil your needs of all types of stationary items necessary for school, college, offices and other organisation <br>Academic books and classic literature also available under single roof... </h2></p>
      <a href="products.php" class="btn">Click To Explore..</a>
                </div>
                <div class="col=2">
                    <img src="./assets/images/big.jpeg">
                </div>
            </div>
                </div>
        <!---------featured categories---->
        <div class="small-container"></div>
        
        
        
        <!---------featured prpducts---->
        <div class="small-container">
        <h2 class="title">Featured Products</h2>
            <div class="row">
            
                <?php
                    while ($row = $featured->fetch_assoc()) {
                ?> 
                    <div class="col-4">
                        <a href="products-details.php?ID=<?php echo $row['ID']?>"> <input type="image" src="<?php echo $row['IMAGE'] ?>" name="Erasor" width="240px" height="240px"></a>
                        <a href="products-details.php?ID=<?php echo $row['ID']?>" ><h5> <?php echo $row['NAME']; ?></h5>
                           <h5> <?php echo  $row['price']; ?></h5>
                        </a>
                       
                    </div>    
                <?php
                    }
                ?>
        
            </div>
           </div>
        <!---------offer-------->
        <div class="offer">
            <div class="small-container">
            <div class="row">
                <div class="col-2">
                    <img src="./stationary/products/stump.jpeg" class="offer-img">
                     
                    </div>
                    <div class="col-2">
                    <p>
                        Exlusively available on Saket Books</p>
                        <h1>Blending Stump</h1>
                        <small>Blending stumps are premium quality paper stumps useful in sketching...gives u a flawless shade...</small>
                   <br>
                    <a href="products.php" class="btn">Buy Now &#8594;</a>
                
                </div>
                
                </div> 
                 </div>
        </div>
        <!----------------testimonial------->
        <div class="testimonial">
        <div class="small-container">
            <div class="row">
            <div class="col-3">
                <i class="fa fa-qoute-left"></i>
                <p>the quality of product is very nice and price is also appropriate</p>
                     
                <img src="./assets/user.png">
                <h3>customer</h3>
                
                </div>
                 <div class="col-3">
                <i class="fa fa-qoute-left"></i>
                <p>  all my stationary needs are fulfilled here</p>
                     
                <img src="./assets/user.png">
                <h3>customer</h3>
                
                </div>
                 <div class="col-3">
                <i class="fa fa-qoute-left"></i>
                <p> the painting colours are beautiful good quality and right in time</p>
                    
                <img src="./assets/user.png">
                <h3>customer</h3>
                
                </div>
            </div>
            </div>
        </div>
        
        <!-----------------brands--------------->
        <div class="brands">
        <div class="small-container">
            <div class="row">
            <div class="col-5">
                <img src="./assets/images/natraj.png">
                </div>
                <div class="col-5">
                <img src="./assets/images/casio.jpeg">
                </div>
                <div class="col-5">
                <img src="./assets/images/classmate.jpeg"> 
                </div>
                <div class="col-5">
                <img src="./assets/images/apsara.jpeg">  
                </div>
                <div class="col-5">
                <img src="./assets/images/navneet.jpeg">
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
              <?php
                    while($product = mysqli_fetch_assoc($featured)):
              ?>
                <div class="row">

                <div class="col-4">
                 <h3><?=$product['title'];?></h3>
                 <img src="<?=$product['image'];?>" alt="<?=$product['title'];?>"/>
                 <p class="lprice">Rs <?=$product['price'];?></p>
                 <a= href="deatails.php">
                     <button type="button" class="btn" data-toggle="modal" data-target="#details-1">more</button>
                    </a>
                    <?php endwhile; ?>
                    </div>
                    </div>
        
            </body>
</html>