<?php
require '../config/dbconnect.php';

class ShoppingCart
{

    private $products;
    private $fullPrice;

    public function __construct()
    {
        $this->products = [];
    }

    /**
     * voeg een product toe
     */
    public function addProduct($product)
    {
        $this->products[] = $product;
    }

    /**
     * verwijder een product uit de winkelwagen
     */
    public function removeItem($position)
    {
        array_splice($this->products, $position, 1);
    }

    public function removeAllItems() {
    session_destroy();
}
    /**
     * haalt producten op in de winkelwagen.
     */
    public function getProducts()
    {
        return $this->products;
    }

    public function hasProducts()
    {
        return !empty($this->products);
    }

    /**
     * berekent de volledige prijs in de winkelwagen.
     */
    public function getFullPrice() {
      $fullPrice = 0;
      foreach ($this->products as $product) {
        $fullPrice += $product->getPrice();

      }
      return $fullPrice;
    }

}
