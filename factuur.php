<?php
include 'db.php';

class Reservation {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function generateInvoice() {
        $resNo = $_GET['reservering_id'];
        $product_id = $_GET['product_id'];
        $van = $_GET['van'];
        $tot = $_GET['tot'];

        $firstDate = new DateTime($van);
        $ScndDate = new DateTime($tot);
        $difference = $firstDate->diff($ScndDate)->format("%a");

        $sql = "SELECT product_prijs from product_lijst WHERE product_id='$product_id'";
        $result = $this->db->select($sql);
        $row = $result[0]['product_prijs'];

        $totaal_prijs = $row * $difference;

        echo <<<EOT
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Factuur</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        </head>
        <body>
            <h1>Factuur</h1>
            <table class="table table-striped">
                <tr>
                    <th>reservering_id</th>
                    <th>product_id</th>
                    <th>van</th>
                    <th>tot</th>
                    <th>klant_id</th>
                    <td>voornaam</td>
                    <td>achternaam</td>
                    <td>telefoon_nr</td>
                    <td>adres</td>
                    <th>plaats</th>
                    <td>email</td>
                    <td>totaal prijs</td>
                </tr>
                <tr>
                    <td>{$_GET['reservering_id']}</td>
                    <td>{$_GET['product_id']}</td>
                    <td>{$_GET['van']}</td>
                    <td>{$_GET['tot']}</td>
                    <td>{$_GET['klant_id']}</td>
                    <td>{$_GET['voornaam']}</td>
                    <td>{$_GET['achternaam']}</td>
                    <td>{$_GET['telefoon_nr']}</td>
                    <td>{$_GET['adres']}</td>
                    <td>{$_GET['plaats']}</td>
                    <td>{$_GET['email']}</td> 
                    <td>{$totaal_prijs}</td> 
                </tr>
            </table>
            <button class="btn btn-info btn-lg btn-block" onclick="window.print()"> Print this page</button>
        </body>
        </html>
        EOT;
    }
}

$reservation = new Reservation();
$reservation->generateInvoice();
?>
