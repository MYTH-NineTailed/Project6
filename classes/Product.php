<?php
/**
 * Maak connectie met de database
 * Connect de variable
 */
class Product {

    private $id;
    private $title;
    private $image_url;
    private $price;
    private $description;
    private $code;
    private $db;

    /**
     * de constuct function
     */
    public function __construct( )
    {
        $dsn = "mysql:host=localhost;dbname=project_6;charset=utf8mb4";
        $this->db = new PDO($dsn, 'root', '');
    }
    
    /**
     * haal de gegevens op van één product
     * en vul de afzonderlijke private properties
     */
    public function getProduct() {
        $stmt = $this->db->prepare("SELECT * FROM product");
        $stmt->execute();
        list($this->id, 
            $this->title, 
            $this->category, 
            $this->price,
            $this->image_url,
            $this->description) = $stmt->fetch(PDO::FETCH_NUM);
    }

    /**
     * het ophalen van de beschrijving
     */

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getPrice($currency = "&euro;")
    {
        return $currency.'&nbsp;'.number_format($this->price, 2, ',','.');
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getDescription()
    {
        return $this->description;
    }

    /**
     * het ophalen van de afbeelding. Standaardbreedte is 200, maar kan gezet worden
     */
    public function getImage($wdt=300)
    {
        return '<img width='."$wdt".' src="data:image/jpeg;base64,'
            . base64_encode($this->image_url).'">';
    }
}