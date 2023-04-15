<?php
include 'db.php';
$db = new Database();

if(isset($_GET['van']) && isset($_GET['tot'])) {
    $van = $_GET['van'];
    $tot = $_GET['tot'];
    $sql = "SELECT * FROM product_lijst WHERE product_id NOT IN (SELECT product_id FROM reservering WHERE van BETWEEN '$van' AND '$tot' AND tot BETWEEN '$van' AND '$tot')";
    $result = $db->select($sql);
} else {
    header("location:select_data.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Beschikbare producten</title>
</head>
<body>
    <div class="container">
        <br><br>
        <h1>Beschikbare producten</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Merk</th>
                    <th>Model</th>
                    <th>Nummer</th>
                    <th>Prijs per dag</th>
                    <th>Foto</th> 
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(!empty($result)) {
                    foreach($result as $row) { ?>
                        <tr>
                            <td><?php echo $row['product_id'] ?></td>
                            <td><?php echo $row['product_merk'] ?></td>
                            <td><?php echo $row['product_model'] ?></td>
                            <td><?php echo $row['product_nummer'] ?></td>
                            <td><?php echo $row['product_prijs'] ?></td>
                            <td><img src="images/<?php echo $row['foto']; ?>" alt="geen foto" style="width: 12rem;"></td>
                            <td><a class="btn btn-success btn-lg btn-block" href="reserveer_product.php?product_id=<?php echo $row['product_id'];?>&van=<?php echo $van;?>&tot=<?php echo $tot;?>">Reserveer</a></td>  
                        </tr>
                    <?php } 
                } else {
                    echo '<tr><td colspan="7">Geen product beschikbaar tussen de geselecteerde datum.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>