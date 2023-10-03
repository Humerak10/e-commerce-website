<!-- laoading images from datbase -->
<?php 
    $con = mysqli_connect('localhost','root');
    mysqli_select_db($con,'ecommerce');

    $id = $_GET['ID'];
    $sql = "SELECT * FROM saket WHERE ID= $id";
    $result= $con->query($sql);

    $row= $result->fetch_assoc();

    function addToCart() {
        $quantity = $_POST['quantity'];

        // starting the session 
        session_start();

        if( !isset($_SESSION['cart_items']) ) {
            $_SESSION['cart_items'] = array();
        }

        $current_items = $_SESSION['cart_items'];   

        $flag = true;
        $index=0;
        while( $index < count( $current_items ) ) 
        {   
            if( $current_items[$index]['ID'] == $_GET['ID'] ) {
                
                $current_items[$index]['quantity'] = intval( $current_items[$index]['quantity'] ) + intval( $quantity );
                  
                $flag = false;
                break;
            }


            $index = $index+1;
        }

        if( $flag == true ) {
            $current_items = array_merge( $current_items, array( array( "ID" => $_GET["ID"], "quantity" => $quantity ) ) );
        }

        $_SESSION['cart_items'] = $current_items;

        print_r( $_SESSION['cart_items'] );

        header("location: ./cart.php");

    }    

   if( $_SERVER["REQUEST_METHOD"] == "POST" ) {
       addToCart();
   }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Products-details</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
        <link rel ="stylesheet" href="cpp2.css">
    </head>
    <body>
        
        
        <div class="container">
         <div class="navbar">
            <div class="logo">
               <a href="index.php"> <img src="./assets/images/logo4.jpeg" width="200px "></a>
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
            <a href="cart.php"> <img src="./assets/images/shopping-cart.png" width="30px" height="30px"></a>
              <img src="./assets/images/menu.png" class="menu-icon" onclick="menutoggle()">
        </div>
           </div>
        <!--------------------single product details------------------->
        <div class="small-container single-product" >
              <div class="row">
            <div class="col-2">
                  <img src="<?php echo $row['IMAGE'] ?>" width="100%" id="ProductImg">
                <div class="small-img-row">

                    <?php 
                        foreach( unserialize( $row['more_images'] ) as $image ) {   
                    ?>
                        <div class="small-img-col">
                        <img src="<?php echo $image?>" width="120px" height="120px" class="small-img">
                        </div>
                    <?php
                        }    
                    ?>
                </div>  
                
                  </div>
                  <div class="col-2">
               <h1><?php echo $row['NAME'] ?></h1>
               <h5>₹ <?php echo $row['price'] ?></h5>
               
               <form action="./products-details.php?ID=<?php echo $_GET['ID']?>" method="POST">
                <input id="quantity" name="quantity" type="number" value="1">
                <button type="submit" value="submit" class="btn"> Add to cart </button>
               </form>
                
                <h3>product details</h3>
                <p> <?php echo $row['description'] ?> </p>
            </div>
            </div>  
            </div>

        <!------title------>
        
        
        <!-------products---------->
        

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
        <!--------------js for product gallery------->
    <script>
        var ProductImg = document.getElementById("ProductImg");
        var SmallImg = document.getElementsByClassName("small-img");
         SmallImg [0].onclick= function()
         {
          ProductImg.src =  SmallImg [0].src;  
         }
          SmallImg [1].onclick= function()
         {
          ProductImg.src =  SmallImg [1].src;  
         }
           SmallImg [2].onclick= function()
         {
          ProductImg.src =  SmallImg [2].src;  
         }
            SmallImg [3].onclick= function()
         {
          ProductImg.src =  SmallImg [3].src;  
         }
        </script>     
    </body>
</html>
 