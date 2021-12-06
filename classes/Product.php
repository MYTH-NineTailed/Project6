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
     * haal de gegevens op van alle producten
     * en vul de afzonderlijke private properties
     */
    public function getProduct() {
        $stmt = $this->db->prepare("SELECT * FROM product");
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_NUM);
        list($this->id, 
            $this->title, 
            $this->category, 
            $this->price,
            $this->image_url,
            $this->description) = $data;
    }

    /**
     * het ophalen van de id
     */

    public function getId()
    {
        return $this->id;
    }

    /**
     * het ophalen van de titel
     */

    public function getTitle()
    {
        return $this->title;
    }

    /**
     * het ophalen van de prijs
     */

    public function getPrice($currency = "&euro;")
    {
        return $currency.'&nbsp;'.number_format($this->price, 2, ',','.');
    }
    
    /**
     * het ophalen van de categorie
     */

    public function getCategory()
    {
        return $this->category;
    }
    
    /**
     * het ophalen van de beschrijving
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * het ophalen van de afbeelding.
     */
    public function getImage($wdt=300)
    {
        return '<img width='."$wdt".' src="data:image/jpeg;base64,'
            . base64_encode($this->image_url).'">';
    }
}