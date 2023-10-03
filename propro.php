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
                    <li><a href="">About</a></li>
                    <li><a href="">Contact</a></li>
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
    
        <div class="small-container">
            
            <div class ="row row-2">
        		<h2 class="title">All Products</h2>
        		<select>
        			<option>Default Sorting</option>
        			<option>Sort by price</option>
        			<option>Sort by popularity</option>
        			<option>Sort by rating</option>
        			<option>Sort by sale</option>
        		</select>
            </div>
            
            
            
         <div class="row">
            <div class="col-4">
               <a href="products-details.html"><input type="image" src="./assets/images/feat2.jpg" name="Erasor" width="240px"></a>
                <a href="products-details.html"><h5>Pencils</h5></a>
                <div class="Ratings">
                     <i class="fas fa-star" ></i>
                     <i class="far fa-star" ></i>
                     <i class="fa fa-star" ></i>
                     <i class="fa fa-star" ></i>
                     <i class="fa fa-star-o"></i>
                </div>
               
                <p>$199</p>
                </div>
             <div class="col-4">
              <a href="products-details.html"><input type="image" src="./assets/images/feat2.jpg" name="Erasor" width="240px"></a>
                <a href="products-details.html"><h5>Pencils</h5></a>
                <div class="Ratings">
                     <i class="fas fa-star" ></i>
                     <i class="far fa-star" ></i>
                     <i class="fa fa-star" ></i>
                     <i class="fa fa-star" ></i>
                     <i class="fa fa-star-o"></i>
                </div>
               
                <p>$199</p>
                </div>
                 <div class="col-4">
                <a href="products-details.html"><input type="image" src="./assets/images/feat2.jpg" name="Erasor" width="240px"></a>
                <a href="products-details.html"><h5>Pencils</h5></a>
                <div class="Ratings">
                     <i class="fas fa-star" ></i>
                     <i class="far fa-star" ></i>
                     <i class="fa fa-star" ></i>
                     <i class="fa fa-star-half" ></i>
                     <i class="fa fa-star-o"></i>
                </div>
               
                <p>$199</p>
                </div>
                 <div class="col-4">
               <a href="products-details.html"><input type="image" src="./assets/images/feat2.jpg" name="Erasor" width="240px"></a>
                <a href="products-details.html"><h5>Pencils</h5></a>
                <div class="Ratings">
                     <i class="fas fa-star" ></i>
                     <i class="far fa-star" ></i>
                     <i class="fa fa-star" ></i>
                     <i class="fa fa-star" ></i>
                     <i class="fa fa-star-o"></i>
                </div>
               
                <p>$199</p>
                </div>
                
            </div>
            <h2 class="title">Latest Products</h2>
             <div class="row">
            <div class="col-4">
                <a href="products-details.html"><input type="image" src="./assets/images/feat2.jpg" name="Erasor" width="240px"></a>
                <a href="products-details.html"><h5>Pencils</h5></a>
                <div class="Ratings">
                     <i class="fas fa-star" ></i>
                     <i class="far fa-star" ></i>
                     <i class="fa fa-star" ></i>
                     <i class="fa fa-star" ></i>
                     <i class="fa fa-star-o"></i>
                </div>
               
                <p>$199</p>
                </div>
             <div class="col-4">
                <a href="products-details.html"><input type="image" src="./assets/images/feat2.jpg" name="Erasor" width="240px"></a>
                <a href="products-details.html"><h5>Pencils</h5></a>
                <div class="Ratings">
                     <i class="fas fa-star" ></i>
                     <i class="far fa-star" ></i>
                     <i class="fa fa-star" ></i>
                     <i class="fa fa-star" ></i>
                     <i class="fa fa-star-o"></i>
                </div>
               
                <p>$199</p>
                </div>
                 <div class="col-4">
               <a href="products-details.html"><input type="image" src="./assets/images/feat2.jpg" name="Erasor" width="240px"></a>
                <a href="products-details.html"><h5>Pencils</h5></a>
                <div class="Ratings">
                     <i class="fas fa-star" ></i>
                     <i class="far fa-star" ></i>
                     <i class="fa fa-star" ></i>
                     <i class="fa fa-star-half" ></i>
                     <i class="fa fa-star-o"></i>
                </div>
               
                <p>$199</p>
                </div>
                 <div class="col-4">
                <a href="products-details.html"><input type="image" src="./assets/images/feat2.jpg" name="Erasor" width="240px"></a>
                <a href="products-details.html"><h5>Pencils</h5></a>
                <div class="Ratings">
                     <i class="fas fa-star" ></i>
                     <i class="far fa-star" ></i>
                     <i class="fa fa-star" ></i>
                     <i class="fa fa-star" ></i>
                     <i class="fa fa-star-o"></i>
                </div>
               
                <p>$199</p>
                </div>
                
            </div>
             <div class="row">
                  <div class="col-4">
            <a href="products-details.html"><input type="image" src="./assets/images/feat2.jpg" name="Erasor" width="240px"></a>
                <a href="products-details.html"><h5>Pencils</h5></a>
                <div class="Ratings">
                     <i class="fas fa-star" ></i>
                     <i class="far fa-star" ></i>
                     <i class="fa fa-star" ></i>
                     <i class="fa fa-star" ></i>
                     <i class="fa fa-star-o"></i>
                </div>
               
                <p>$199</p>
              </div>
             <div class="col-4">
                <a href="products-details.html"><input type="image" src="./assets/images/feat2.jpg" name="Erasor" width="240px"></a>
                <a href="products-details.html"><h5>Pencils</h5></a>
                <div class="Ratings">
                     <i class="fas fa-star" ></i>
                     <i class="far fa-star" ></i>
                     <i class="fa fa-star" ></i>
                     <i class="fa fa-star" ></i>
                     <i class="fa fa-star-o"></i>
                </div>
               
                <p>$199</p>
                </div>
                 <div class="col-4">
                <a href="products-details.html"><input type="image" src="./assets/images/feat2.jpg" name="Erasor" width="240px"></a>
                <a href="products-details.html"><h5>Pencils</h5></a>
                <div class="Ratings">
                     <i class="fas fa-star" ></i>
                     <i class="far fa-star" ></i>
                     <i class="fa fa-star" ></i>
                     <i class="fa fa-star-half" ></i>
                     <i class="fa fa-star-o"></i>
                </div>
               
                <p>$199</p>
                </div>
                 <div class="col-4">
               <a href="products-details.html"><input type="image" src="./assets/images/feat2.jpg" name="Erasor" width="240px"></a>
                <a href="products-details.html"><h5>Pencils</h5></a>
                <div class="Ratings">
                     <i class="fas fa-star" ></i>
                     <i class="far fa-star" ></i>
                     <i class="fa fa-star" ></i>
                     <i class="fa fa-star" ></i>
                     <i class="fa fa-star-o"></i>
                </div>
               
                <p>$199</p>
                </div>
                    </div>
             <div class="row">
            <div class="col-4">
                <a href="products-details.html"><input type="image" src="./assets/images/feat2.jpg" name="Erasor" width="240px"></a>
                <a href="products-details.html"><h5>Pencils</h5></a>
                <div class="Ratings">
                     <i class="fas fa-star" ></i>
                     <i class="far fa-star" ></i>
                     <i class="fa fa-star" ></i>
                     <i class="fa fa-star" ></i>
                     <i class="fa fa-star-o"></i>
                </div>
               
                <p>$199</p>
                </div>
             <div class="col-4">
                <a href="products-details.html"><input type="image" src="./assets/images/feat2.jpg" name="Erasor" width="240px"></a>
                <a href="products-details.html"><h5>Pencils</h5></a>
                <div class="Ratings">
                     <i class="fas fa-star" ></i>
                     <i class="far fa-star" ></i>
                     <i class="fa fa-star" ></i>
                     <i class="fa fa-star" ></i>
                     <i class="fa fa-star-o"></i>
                </div>
               
                <p>$199</p>
                </div>
                 <div class="col-4">
               <a href="products-details.html"><input type="image" src="./assets/images/feat2.jpg" name="Erasor" width="240px"></a>
                <a href="products-details.html"><h5>Pencils</h5></a>
                <div class="Ratings">
                     <i class="fas fa-star" ></i>
                     <i class="far fa-star" ></i>
                     <i class="fa fa-star" ></i>
                     <i class="fa fa-star-half" ></i>
                     <i class="fa fa-star-o"></i>
                </div>
               
                <p>$199</p>
                </div>
                 <div class="col-4">
                <a href="products-details.html"><input type="image" src="./assets/images/feat2.jpg" name="Erasor" width="240px"></a>
                <a href="products-details.html"><h5>Pencils</h5></a>
                <div class="Ratings">
                     <i class="fas fa-star" ></i>
                     <i class="far fa-star" ></i>
                     <i class="fa fa-star" ></i>
                     <i class="fa fa-star" ></i>
                     <i class="fa fa-star-o"></i>
                </div>
               
                <p>$199</p>
                </div>
                
            </div>
            
            <div class="page-btn">
                <span>1</span>
                <span>2</span>
                <span>3</span>
                <span>4</span>
                <span>&#8594;</span>
            </div>    
        </div>

        <!---------------footer----------->
        <div class="footer">
        <div class="container">
            <div class="row">
            <div class="footer-col-1">
                <h3>Download Our App</h3>
                <p>zindagi sawar du ek nayi  pyara sa chamatkar huuuu</p>
                <div class="app-logo">
                    <img src="./assets/images/feat.jpg">
                  <img src="./assets/images/feat.jpg">
                </div>
               </div>
            <div class="footer-col-2">
                <img src="./assets/images/feat2.jpg">
                <p>zindagi sawar du ek nayi pyara sa chamatkar huuuu</p>
                </div>
            <div class="footer-col-3">
                <h3>Useful links</h3>
                <ul>
                <li>Coupon</li>
                    <li>Blog post</li>
                    <li>Return Policy</li>
                    <li>jpoint</li>
                </ul>
                <p>zindagi sawar du ek nayi pyara sa chamatkar huuuu</p>
                </div>
               <div class="footer-col-4">
                <h3>Follow us</h3>
                <ul>
                <li>facebook</li>
                    <li>Twitter</li>
                    <li>instagram</li>
                    
                </ul>
                <p>zindagi sawar du ek nayi ahaar du duniya hi badal du mi to pyara sa chamatkar huuuu</p>
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
 <img src="./assets/images/shopping-cart.png" width="30px" height="30px">