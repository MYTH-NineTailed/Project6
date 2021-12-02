<?php 

require 'config/dbconnect.php';
require 'classes/Product.php';

?>
<html>

<head>
<meta charset="UTF-8">
<meta name="author" content="Team ACMR">
<link rel="stylesheet" href="scripts/style.css">
<link rel="stylesheet" href="scripts/navbar.css">
<title>Project 6</title>
</head>

<body>
  
<!-- Navigatie menu -->
<body>  
<ul id="nav_menu" class="nav_class">
<li>
<a href="#">Games</a>
<ul>
<li><a href="#">Actie</a></li>
<li><a href="#">Adventure</a></li>
<li><a href="#">Sport</a></li>
<li><a href="#">Shooter</a></li>
<li><a href="#">Vechten</a></li>
</ul>
</li>
<li>
<a href="#">Consoles</a>
<ul>
<li><a href="#">Playstation</a></li>
<li><a href="#">Xbox</a></li>
<li><a href="#">Nintendo</a></li>
</ul>
</li>
<li>
<a href="#">Accessoires</a>
<ul>
<li><a href="#">Accessoirepakketten</a></li>
<li><a href="#">Consolestandaard</a></li>
<li><a href="#">Gamingmuizen</a></li>
<li><a href="#">Racestuuraccessoires</a></li>
</ul>
</li>

<li><a href="pages/login.php">Login</a></li>
<li><a href="pages/register.php">Registreren</a></li>

<!-- Zoekbalk -->
<li class='search-form'>
<form action='/search' class='searchblog' method='get'>
<input class='searchbar' name='q' placeholder='Zoek hier' size='30' type='text'/>
<input class='searchsubmit' type='submit' value='Zoeken'/>
</form>
  <p class='search-alert'>U heeft niks ingevuld!</p>
</li>    
</ul>
</ul>



<?php $product = new Product();
$product->getproduct() ?>
<!-- Producten -->
<div class="product">
  <div class="product-image"><?php echo $product->getImage();?></div> 
    <span class="price"><?php echo $product->getPrice(); ?></span>
    <p><?php echo $product->getTitle(); ?></p>
</div>

</body>
</html>