<?php
require '../classes/Product.php';
require '../classes/ShoppingCart.php';
require '../config/dbconnect.php';

session_start();
/**
 * Als er nog geen winkelwagen is opgeslagen in de sessie
 * dan wordt hij hier aangemaakt en in de sessie opgeslagen
 */
if (empty($_SESSION['cart'])) {
    $_SESSION['cart'] = new ShoppingCart();
}
if(!isset($_GET['code'])) {
    return;
}
$product = $productCatalogue->getProduct($_GET['code']);
?>

<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product info</title>
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../scripts/style1.css">
</head>

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
<li><a href="../Pages/cart.php" class="cart-icon">Winkelwagen</a></li>  

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


    <div class="webshop__content">
        <img class="product-image" src="<?php echo $product->getImage() ?>" alt="<?php echo $product->getTitle() ?>">
        <h2><?php echo $product->getTitle() ?></h2>
        <p><?php echo $product->getDescription() ?></p>
        <p class="price">€ <?php echo $product->getPrice() ?></p>
        <a href="cart.php?action=add_product&product=<?php echo $product->getProduct() ?>" class="cart-button">Toevoegen</a>
        <a class="cart-button" href="index.php">Naar de producten</a>
    </div>

</body>
</html>
