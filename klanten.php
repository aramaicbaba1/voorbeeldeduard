<?php
require_once 'db.php';
$db = new Database();
$result = $db->select("SELECT * FROM klanten");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>klant</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Klanten toevoegen</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="alle_res.php">Alle Reserveringen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="res_vandaag.php">Reserveringen vandaag</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="medewerker.php">Product toevoegen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="select_date.php">Maak reservering</a>
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
   <h1>Alle klanten</h1>
   <table class="table table-striped">
    <thead>
        <tr>
            <th>klant_id</th>
            <th>voornaam</th>
            <th>achternaam</th>
            <th>telefoo_nr</th>
            <th>adres</th>
            <th>plaats</th>
            <th>email</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($result as $rows): ?>        
        <tr>
            <td><?= $rows['klant_id'] ?></td>
            <td><?= $rows['voornaam'] ?></td>
            <td><?= $rows['achternaam'] ?></td>
            <td><?= $rows['telefoo_nr'] ?></td>
            <td><?= $rows['adres'] ?></td>
            <td><?= $rows['plaats'] ?></td>
            <td><?= $rows['email'] ?></td>
            <td><a class="btn btn-success btn-lg btn-block" href="edit_klant.php?<?= http_build_query($rows) ?>">Edit</a></td>
            <td><a class="btn btn-success btn-lg btn-block" href="delete_klant.php?klant_id=<?= $rows['klant_id'] ?>">Delete</a></td>
            <td><a class="btn btn-success btn-lg btn-block" href="reserveringen_klant.php?klant_id=<?= $rows['klant_id'] ?>">Reserveringen</a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
   </table>
</body>
</html>