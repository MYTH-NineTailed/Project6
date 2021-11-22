<?php
require '../config/dbconnect.php';

/**
 * Maak connectie met de database
 * Connect de variable
 */
class Product
{

    private $title;
    private $image_url;
    private $price;
    private $description;
    private $code;

    /**
     * de constuct function
     */
    public function __construct($code, $title, $image_url, $price, $description)
    {

        $this->code = $code;
        $this->title = $title;
        $this->image_url = $image_url;
        $this->price = $price;
        $this->description = $description;

    }

    /**
     * het ophalen van de code
     */
    public function getCode()
    {
        return $this->code;
        
        $stmt = $this->db->prepare("SELECT product (product_name, product_price, product_image, product_description) VALUES (?,?,?,?)");
        $stmt->bind_param("sss", $pname, $pprice, $pimage, $pdescription);
        
        if($stmt->execute()) {
            return true;
        } else {
            return $stmt->error;
        }
    }

    /**
     * het ophalen van de titel
     */
    public function getTitle()
    {
        return $this->title;
    }


    /**
     * het ophalen van de beschrijving
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * het ophalen van de afbeelding
     */
    public function getImage()
    {
        return $this->image_url;
    }

    /**
     * het ophalen van de prijs
     */
    public function getPrice()
    {
        return $this->price;
    }


}
