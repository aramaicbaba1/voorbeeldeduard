<?php
include 'db.php';
$db = new Database();

$sql = "SELECT * FROM reservering WHERE DATE(van) = CURDATE()";
$result = $db->select($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alle Reserveringen</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Reserveringssysteem</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="medewerker.php">Terug Medewerker</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="alle_res.php">Alle Reserveringen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="res_vandaag.php">Reserveringen vandaag</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="select_date.php">Maak Reservering</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="klanten.php">Klanten</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
            </div>
        </div>
    </nav>
    <div class="container">
    <h1>Alle Reserveringen</h1>
    <table class="table table-striped">
        <tr>
            <th>reservering_id</th>
            <th>van</th>
            <th>tot</th>
            <th>product_id</th>
            <th>klant_id</th>
            <th colspan="2">Action</th>
        </tr>
        <?php if(!is_null($result)) {
        foreach ($result as $rows) {?>
            <tr>
                <td><?php echo $rows['reservering_id'] ?></td>
                <td><?php echo $rows['van'] ?></td>
                <td><?php echo $rows['tot'] ?></td>
                <td><?php echo $rows['product_id'] ?></td>
                <td><?php echo $rows['klant_id'] ?></td>
                <td><a href="edit_res.php?reservering_id=<?php echo trim($rows['reservering_id']);?>&van=<?php echo trim($rows['van']);?>&tot=<?php echo trim($rows['tot']);?>" class="btn btn-success">Edit</a></td>
                <td><a href="delete_res.php?reservering_id=<?php echo $rows['reservering_id'];?>" class="btn btn-danger">Delete</a></td>
            </tr>
        <?php }} ?>
    </table>
</div>