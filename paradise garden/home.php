<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_wishlist'])){

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   
   $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_wishlist_numbers) > 0){
       $message[] = 'already added to wishlist';
   }elseif(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'already added to cart';
   }else{
       mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
       $message[] = 'product added to wishlist';
   }

}

if(isset($_POST['add_to_cart'])){

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'already added to cart';
   }else{

       $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

       if(mysqli_num_rows($check_wishlist_numbers) > 0){
           mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
       }

       mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
       $message[] = 'product added to cart';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
      integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="home">

   <div class="content">
      <h3>new collections</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime reiciendis, modi placeat sit cumque molestiae.</p>
      <a href="about.php" class="btn">discover more</a>
   </div>

</section>

<section class="products" >

   <h1 class="title">latest products</h1>

   <div class="box-container" style="grid-template-columns: repeat(auto-fit, 33rem);">

      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <form action="" method="POST" class="box">
         <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>" class="fas fa-eye"></a>
         <div class="price">ريال<?php echo $fetch_products['price']; ?>/-</div>
         <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" class="image">
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <input type="number" name="product_quantity" value="1" min="0" class="qty">
         <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
         <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
         <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
         <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
         <input type="submit" value="add to wishlist" name="add_to_wishlist" class="option-btn">
         <input type="submit" value="add to cart" name="add_to_cart" class="btn">
      </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>

   </div>

   <div class="more-btn">
      <a href="shop.php" class="option-btn">load more</a>
   </div>

</section>

<section class="home-contact">
   <div >
     
      <video src="855976-hd_1920_1080_25fps.mp4 " id="myVideo"  loop style="width: 65%;" controls autoplay   >

      </video>
    
       </div>

   <div class="content">
      <h3>have any questions?</h3>
      <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Distinctio officia aliquam quis saepe? Quia, libero.</p>
      <a href="contact.php" class="btn">contact us</a>
   </div>
 </section>
<section>
<div class="wrapper">
      <p>The Begninning of a New Asset class</p>
      <h1>Frequently Asked Questions</h1>

      <div class="faq">
        <button class="accordion">
        Where is my delivery?
          <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="pannel">
          <p>
          Delivery not arrived when it said it would? You can track your order and request a new delivery or compensation. 
          </p>
        </div>
      </div>

      <div class="faq">
        <button class="accordion">
        Website issues
          <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="pannel">
          <p>
          We’re so sorry that you've had trouble with our website - this is certainly not what we want! Top tips for resolving any issues before getting in touch:
•	Make sure your internet is connected (either to strong 4G or Wifi).
•	Make sure all fields in the ordering form are completed.
•	Make sure your online browser is updated to the latest version.
•	Try using a different browser or device
If you are still having trouble please reach out to us using contact info or through <a href="contact.php">contact us</a> contact us page

          </p>
        </div>
      </div>

      <div class="faq">
        <button class="accordion">
        My flowers are in poor condition
          <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="pannel">
          <p>
          As our flowers arrive in bud, it’s totally normal for some stems to arrive looking a bit droopy or squashed. Don’t worry! They’ll perk up after a few days once popped in water. If they haven’t perked up, they’ve arrived damaged or with another quality issue, you can request a redelivery or compensation in a few clicks. 
          </p>
        </div>
      </div>

      <div class="faq">
        <button class="accordion">
        Looking droopy?
          <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="pannel">
          <p>
          Don’t worry! We do send all our blooms dry so they will be thirsty when they arrive. Flowers and greenery use water to prop-up their stems, so if yours look sad, they’ll just need a trim and an overnight drink to help them perk up fully. 
          </p>
        </div>
      </div>

      <div class="faq">
        <button class="accordion">
        How do I get the best out of my flowers?
          <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="pannel">
          <p>
          Our blooms are sent out dry and in bud so we do find that upon arrival they do need a good trim and at least 24 hour in water to fully revive and start to bloom.
          </p>
        </div>
      </div>

      
    </div>


</section>



<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>

<script>
      var acc = document.getElementsByClassName("accordion");
      var i;

      for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
          this.classList.toggle("active");
          this.parentElement.classList.toggle("active");

          var pannel = this.nextElementSibling;

          if (pannel.style.display === "block") {
            pannel.style.display = "none";
          } else {
            pannel.style.display = "block";
          }
        });
      }
    </script>
<script>
  // انتظر 5 ثواني ثم قم بتشغيل الفيديو
  setTimeout(function() {
    var video = document.getElementById('myVideo');
    video.play();
  }, 5000); // الوقت معبر عنه بالميلي ثانية (1000 ميلي ثانية = 1 ثانية)
</script>