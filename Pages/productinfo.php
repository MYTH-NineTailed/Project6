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

<section class="webshop">

    <h2 class="webshop__title">Product informatie<a href="cart.php" class="cart-icon">Winkelwagen</a></h2>
    <div class="webshop__content">
        <img class="webshop__content--image" src="<?php echo $product->getImage() ?>" alt="<?php echo $product->getTitle() ?>">
        <h2><?php echo $product->getTitle() ?></h2>
        <p><?php echo $product->getDescription() ?></p>
        <p class="price">€ <?php echo $product->getPrice() ?></p>
        <a href="cart.php?action=add_product&code=<?php echo $product->getCode() ?>" class="cart-button">Toevoegen</a>
        <a class="cart-button" href="webshop.php">Naar de producten</a>
    </div>


</section>

</body>
</html>
