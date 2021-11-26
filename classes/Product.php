<?php
// echo "<pre>".print_r($pdo, true)."</pre>" ; exit();

/**
 * Maak connectie met de database
 * Connect de variable
 */
class Product {

    private $title;
    private $image_url;
    private $price;
    private $description;
    private $code;
    private $db;

    /**
     * de constuct function
     */
    public function __construct(/* $code, $title, $image_url, $price, $description */)
    {
        $dsn = "mysql:host=localhost;dbname=project_6;charset=utf8mb4";
        $this->db = new PDO($dsn, 'root', '');


        // $this->code = $code;
        // $this->title = $title;
        // $this->image_url = $image_url;
        // $this->price = $price;
        // $this->description = $description;

    }

    /**
     * het ophalen van de code
     */
    public function getCode()
    {
        // return $this->code;
        
        $stmt = $this->db->prepare("SELECT product_id, product_name, product_price, product_image, product_description FROM product");
        $stmt->execute();

        while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            //echo "<pre>".print_r($row, true)."</pre>" ;
            // echo "<br>Product id {$row->product_id} <br> naam = {$row->product_name} <br> description = {$row->product_description} <br> kost &euro; ". number_format($row->product_price, 2, ',', '.') . "<br>";
            // echo '<img src="data:image/jpeg;base64,'.base64_encode($row->product_image).'"/>';
            // echo "<br>";
        }
 exit();

        if($stmt->execute()) {
            $row == $stmt->fetch(PDO::FETCH_ASSOC);
            print_r($row);
            exit;
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
        return $this->db->prepare("SELECT product_name VALUES 'product_name' FROM product");
    }


    /**
     * het ophalen van de beschrijving
     */
    public function getDescription()
    {
        return $this->db->prepare("SELECT product_description VALUES 'product_description' FROM product");
    }

    /**
     * het ophalen van de afbeelding
     */
    public function getImage()
    {
        return $this->db->prepare("SELECT product_image VALUES 'product_image' FROM product");
    }

    /**
     * het ophalen van de prijs
     */
    public function getPrice()
    {
        return $this->db->prepare("SELECT product_price VALUES 'product_price' FROM product");
    }
}