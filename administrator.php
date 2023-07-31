<?php 

session_start();

if(isset($_POST['sifra'])){
    if($_POST['sifra'] === 'admin123'){
        $_SESSION['provera'] = true;
    }
    else {
        echo "Pogresno uneta sifra!";
    }
}
if(!isset($_SESSION['provera']) || $_SESSION['provera'] !==true)
{
    echo "
        <form method='POST'>
        <label for='sifra'> Unesite sifru: </label>
        <input type='sifra' name='sifra' required >
        <button type='submit'> Pristupi </button>
        </from> 
    ";
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator</title>
</head>
<body>
    <h1>Dobrodošli na stranu Administrator </h1>
    <a href="unosproizvoda.php"><button>Dodaj proizvod</button></a> <br><br>
    <a href="brisanje.php"><button>Brisanje proizvoda</button></a> <br><br> 
    <a href="izmena.php"><button>Izmena proizvoda</button></a> <br><br> 

   <a href="administrator.php?odjava"><button>Odjava</button></a>
   <?php 
   if(isset($_GET['odjava'])){
    session_unset();
    session_destroy();
    header('Location: administrator.php');
   }
   ?>
   
</body>
</html>