<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Check if username already exists
    $db = new Database();
    $result = $db->select("SELECT * FROM users WHERE username = :username", [':username' => $username]);
    if (!empty($result)) {
        $error_message = "Username already exists.";
    } else {
        // Check if passwords match
        if ($password !== $confirm_password) {
            $error_message = "Passwords do not match.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            // Insert new user into the database
            $db->insert("INSERT INTO users (username, password) VALUES (:username, :password)", [':username' => $username, ':password' => $hashed_password]);
            $success_message = "Registration successful!";
            header("Location: index.php");
            exit;
        }
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
    <title>Register</title>
</head>
<body>
<style>
        .form-group {
            margin-top: 200px;
        }
        .btn-lg {
            background-color: #c52d2f;
            border-color: #c52d2f;
        }
        .btn-primary {
            background-color: #c52d2f;
            border-color: #c52d2f;
        }
        .btn-primary:hover {
            background-color: #a12425;
            border-color: #a12425;
        }
    </style>
<div class="container-fluid h-100">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
            <div class="form-group">
                <form method="POST"><br><br>
                    <?php if(isset($error_message)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error_message; ?>
                        </div>
                    <?php } ?>
                    <?php if(isset($success_message)) { ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $success_message; ?>
                        </div>
                    <?php } ?>
                    <input type="text" name="username" placeholder="username"   class="form-control form-control-lg" required><br>
                    <input type="password" name="password" placeholder="password" class="form-control form-control-lg" required><br>
                    <input type="password" name="confirm_password" placeholder="confirm password" class="form-control form-control-lg" required><br>
                    <input type="submit"  class="btn btn-info btn-lg btn-block" ><br>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>