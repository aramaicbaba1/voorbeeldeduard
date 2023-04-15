<?php
class Reservation {
    private $start;
    private $end;

    public function __construct($start, $end) {
        $this->start = new DateTime($start);
        $this->end = new DateTime($end);
    }

    public function isValid() {
        return $this->start < $this->end;
    }
}

if($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(isset($_GET['van'], $_GET['tot'])) {
        $reservation = new Reservation($_GET['van'], $_GET['tot']);
        if($reservation->isValid()) {
            $van = urlencode($_GET['van']);
            $tot = urlencode($_GET['tot']);
            header("Location: product_overzicht.php?van=$van&tot=$tot");
            exit();
        } else {
            $error_msg = 'Kan geen reservering maken. Selecteer de juiste datums.';
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
    <title>Reservering maken</title>
</head>
<body>
<style>
    .btn-info {
        background-color: black;
        border-color: black;
    }
    .btn-info:hover {
        background-color: #212529;
        border-color: #212529;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Maak reservering</a>
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
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Selecteer datum</h4>
                    </div>
                    <div class="card-body">
                        <form method="GET">
                            <div class="form-group">
                                <label for="van">Van:</label>
                                <input class="form-control" type="date" name="van" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+365 days'));?>" required>
                            </div>
                            <div class="form-group">
                                <label for="tot">Tot:</label>
                                <input class="form-control" type="date" name="tot" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+365 days'));?>" required>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-info btn-block" type="submit" value="Selecteer">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>