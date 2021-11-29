<?php 

require 'config/dbconnect.php';
require 'classes/Product.php';

?>
<html>
<head>
<link rel="stylesheet" href="scripts/style.css">
<title>Project 6</title>
</head>

<body>
<!-- Zoekbalk-->
<div class="wrap">
   <div class="search">
      <input type="text" class="searchTerm" placeholder="Welke producten bent u aan het zoeken?">
      <button type="submit" class="searchButton">
        <i class="fas fa-search"></i>
     </button>

<!-- Login knop  -->
<a class="login-btn" href="pages/login.php">Login</a> <!-- <?php echo $_SESSION['userName']; ?>  -->
<a class="signup-btn" href="pages/register.php">Sign-up</a>
  </div>
</div>

<?php $product = new Product(); ?>

<!-- Producten -->
  <h1><?php echo intval($title); ?></h1>
<div class="product">
  <div class="product-image"><?php echo $product->$image ?></div> 
    <span class="price"><?php echo $product->$price; ?></span>
    <p><?php echo $product->$description; ?></p>
</div>

<div class="product">
  <div class="product-image"></div> 
    <span class="price">1.295,-</span>
    <p>Truly Useless 5"</p>
</div>
<div class="product">
  <div class="product-image"></div> 
    <span class="price">625,-</span>
    <p>Such Features</p>
</div>
  <div class="product">
  <div class="product-image"></div> 
    <span class="price">495,-</span>
    <p>Doodle BronzeCast</p>
</div>

<div class="product">
  <div class="product-image"></div> 
    <span class="price">1.795,-</span>
    <p>Truly Useless 5.7"</p>
</div>
<div class="product">
  <div class="product-image"></div> 
    <span class="price">625,-</span>
    <p>Das Produkten</p>
</div>
  <div class="product">
  <div class="product-image"></div> 
    <span class="price">495,-</span>
    <p>Very Product</p>
</div>

<div class="product">
  <div class="product-image"></div> 
    <span class="price">1.195,-</span>
    <p>Super Duper</p>
</div>
<div class="product">
  <div class="product-image"></div> 
    <span class="price">325,-</span>
    <p>Very Cheap</p>
</div>
  
</body>

</html>