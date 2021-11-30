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
     * het ophalen van de data
     */
    public function getProductsTable()
    {
        $stmt = $this->db->query("SELECT product_id FROM product");
 
        $stl = "font-weight: bold; background-color: navy; color: #eee; text-transform: uppercase;";

        // bouw een html-table op
        // met een kopregel (hier opzettelijk td gebruikt in plaats van th)
        // maar dat is een ontwerp-keuze

        $s = "<table border='1' cellspacing='0' cellpadding='15'>";
        $s .= "<tr style='$stl'>
            <td width='2%'>ID</td>
            <td width='40%'>TITLE</td>
            <td width='13%'>CATEGORY</td>
            <td width='10%' align='right'>PRICE</td>
            <td width='*'>IMAGE</td>
            </tr>";
        
        while($row = $stmt->fetch(PDO::FETCH_OBJ)) {

            $this->getProduct($row->product_id); // haal de properties op van een product!

            // vul een tabelrow voor elk product
            $s .= "<tr valign='top'>
                <td>{$this->getId()}</td>
                <td>{$this->getTitle()}</td>
                <td>{$this->getCategory()}</td>
                <td align='right'>{$this->getPrice()}</td>
                <td>{$this->getImage(250)}</td>
            </tr>";
        }

        // en sluit de table af
        $s .= "</table>";

        return $s; // geef terug aan het aanroeppunt
    }

    
    /**
     * haal de gegevens op van één product
     * en vul de afzonderlijke private properties
     */
    public function getProduct($pid) {
        $stmt = $this->db->prepare("SELECT * FROM product 
                                    WHERE product_id = :pid LIMIT 1");
        $stmt->execute( ["pid" => $pid] );
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
    public function getDescription()
    {
        return $this->description;
    }

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

    /**
     * het ophalen van de afbeelding. Standaardbreedte is 200, maar kan gezet worden
     */
    public function getImage($wdt=200)
    {
        return '<img width='."$wdt".' src="data:image/jpeg;base64,'
            . base64_encode($this->image_url).'">';
    }

}

// testen
$xyz = new Product();

// laat alle producten zien in een overzicht
echo $xyz->getProductsTable();

echo "<br><hr width='50%'><hr width='70%'><hr width='50%'>";

echo "<h3>ANDERE MOGELIJKHEID:</h3>";
//    vul de variabelen voor een bepaald product
//    daarna heb je "toegang" tot de getters
//    getId(), getTitle(), getCategory(), getImage(), getPrice()
//
$xyz->getProduct(4);
echo "<h1>{$xyz->getId()}: De naam van dit product is ".$xyz->getTitle() . "</h1>"
    . "Actieprijs is " . $xyz->getPrice();

// even spelen met de foto...

echo "<br>".$xyz->getImage(12); // piepklein fotootje
echo "<br>".$xyz->getImage(24); // heel klein fotootje
echo "<br>".$xyz->getImage(48); // kleine foto
echo "<br>".$xyz->getImage(148); // foto
echo "<br>".$xyz->getImage(600); // grote foto



