<?php
include 'db.php';
$db = new Database();

session_start();
if (!isset($_SESSION['username'])) {
    header("Location:index.php");
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(!empty($_POST['product_merk']) && !empty($_POST['product_model']) && !empty($_POST['product_nummer']) && !empty($_POST['product_prijs']) && !empty($_FILES['foto']['name'])) {
        $file_name = $_FILES['foto']['name'];
        $file_temp = $_FILES['foto']['tmp_name'];
        $upload_folder = "images/".$file_name;

        try {
            $movefile = move_uploaded_file($file_temp, $upload_folder);
            $sql = "INSERT INTO product_lijst VALUES (:product_id, :product_merk, :product_model, :product_nummer, :product_prijs, :foto)";
            $placeholders = [
                'product_id' => null,
                'product_merk' => $_POST['product_merk'],
                'product_model' => $_POST['product_model'],
                'product_nummer' => $_POST['product_nummer'],
                'product_prijs' => $_POST['product_prijs'],
                'foto' => $file_name
                
            ];
            $db->insert($sql,$placeholders);
            echo "<script>alert('Inserted successfully')</script>";
        }catch (\Exception $e) {
            echo $e->getMessage();
        }
    } else {
        echo "<script>alert('Please enter all information')</script>";
    }
}

$sqlproducts = "Select * from product_lijst";
$result = $db->select($sqlproducts)

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medewerker</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Product toevoegen</a>
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

    <div class="container-fluid h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="form-group">
                    <h1 class="display-4">Voeg een product toe.</h1><br>
                    <form method="POST" enctype="multipart/form-data">
                        <input type="text" name="product_merk" placeholder="Product merk"  class="form-control form-control-lg" ><br>
                        <input type="text" name="product_model" placeholder="Product model"class="form-control form-control-lg" ><br>
                        <input type="text" name="product_nummer" placeholder="Product nummer"class="form-control form-control-lg" ><br>
                        <input type="text" name="product_prijs" placeholder="Product prijs"class="form-control form-control-lg" ><br>
                        <label for="">Foto</label>
                        <input type="file" name="foto" placeholder="foto" class="form-control form-control-lg" ><br>
                        <input type="submit" class="btn btn-dark btn-lg btn-block"><br><br>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <h1>Alle product</h1>
<table class="table table-striped">
  <tr>
    <th>product_id</th>
    <th>product_merk</th>
    <th>product_model</th>
    <th>product_nummer</th>
    <th>product_prijs_per_dag</th>
    <th>foto</th>
    <th colspan="2">Actie</th>
  </tr>
  
  <?php 
  if(!is_null($result)) {
    foreach ($result as $rows) {?>
      <tr>
        <td><?php echo $rows['product_id'] ?></td>
        <td><?php echo $rows['product_merk'] ?></td>
        <td><?php echo $rows['product_model'] ?></td>
        <td><?php echo $rows['product_nummer'] ?></td>
        <td><?php echo $rows['product_prijs'] ?></td>
        <td><img src="images/<?php echo $rows['foto']; ?>" alt="geen foto" style="width: 12rem;"></td>
        <td>
          <a class="btn btn-success btn-lg btn-block" href="edit_product.php?product_id=
          <?php echo trim($rows['product_id']);?> 
          &product_merk=<?php echo trim($rows['product_merk']);?>
          &product_model=<?php echo trim($rows['product_model']);?>
          &product_nummer=<?php echo trim($rows['product_nummer']);?>
          &product_prijs=<?php echo trim($rows['product_prijs']);?>
          &foto=<?php echo $rows['foto'];?>
          ">Edit</a>
        </td>
        <td>
          <a class="btn btn-success btn-lg btn-block" href="delete_product.php?product_id=<?php echo $rows['product_id'];?>">Delete</a>
        </td>
      </tr>
    <?php } 
  } ?>
</table>

</body>
</html>