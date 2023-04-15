<?php
require_once('db.php');

if(isset($_POST['name']) && isset($_POST['price']) && isset($_POST['description']) && isset($_POST['category_id']) && isset($_POST['id'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];

    if(isset($_FILES['foto']['name']) && $_FILES['foto']['name'] != ''){
        $foto = $_FILES['foto']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["foto"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["foto"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["foto"]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        $foto = null;
    }

    $db = new Database();
    $result = $db->update('products', $id, ['name' => $name, 'price' => $price, 'description' => $description, 'category_id' => $category_id, 'foto' => $foto]);

    if($result){
        echo "Product updated successfully.";
    } else {
        echo "Error updating product.";
    }
}
?>

<!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>UPDATE</title>
 </head>
 <body><br><br>
 <div class="container-fluid h-100">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
    <div class="form-group">
    <h1 class="display-4">UPDATE</h1><br>
 <form method="POST" enctype="multipart/form-data">
    <input  class="form-control form-control-lg" type="text" name="product_merk" value="<?php echo $_GET['product_merk'];?>"><br>
    <input  class="form-control form-control-lg" type="text" name="product_model" value="<?php echo $_GET['product_model'];?>"><br>
    <input  class="form-control form-control-lg" type="text" name="product_nummer" value="<?php echo $_GET['product_nummer'];?>"><br>
    <input  class="form-control form-control-lg"type="text" name="product_prijs" value="<?php echo $_GET['product_prijs'];?>"><br>
    <input  class="form-control form-control-lg"type="file" name="foto" value="<?php echo $_GET['foto'];?>"><br>
    <input type="submit" class="btn btn-info btn-lg btn-block" ><br>
 </form>

 </div>
    </div>
    </div>
</div>

 
 </body>
 </html>