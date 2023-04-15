<?php
include 'db.php';
$db = new Database();

$product_id = $_GET['product_id'];

$sql = "DELETE FROM product_lijst WHERE product_id=:product_id";
$placeholders = [
    'product_id' => $product_id
];

$db->delete($sql, $placeholders);
header("Location: medewerker.php");
?>