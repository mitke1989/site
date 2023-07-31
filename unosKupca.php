<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unos kupca</title>
</head>
<body> 
  <h1> Unesite podatke o kupcu </h1>
    <form action="unosKupca.php" method="POST">
     Ime: <input type="text" name="ime"><br> <br>
    Prezime: <input type="text" name="prezime"><br> <br>
    Username: <input type="text" name="username"><br> <br>
    Sifra: <input type="text" name="sifra"><br> <br>
    Email: <input type="text" name="email"><br> <br>
    Adresa: <input type="text" name="adresa"><br> <br>
    Telefon: <input type="text" name="telefon"><br> <br>
  <button type="submit"> Unesi podatke </button>
</form>
</body>
</html>

<?php

// Uspostavljanje konekcije sa bazom
$db=mysqli_connect("localhost", "root", "", "projekat");
mysqli_query($db, "SET NAMES utf8");

// Proveravanje da li su svi podaci poslani iz forme
if(isset($_POST['ime']) and isset($_POST['prezime']) and isset($_POST['username']) and 
isset($_POST['sifra']) and isset($_POST['email']) and isset($_POST['adresa']) and isset($_POST['telefon'])){
    $ime=$_POST['ime'];
    $prezime=$_POST['prezime'];
    $username=$_POST['username'];
    $sifra=$_POST['sifra'];
    $email=$_POST['email'];
    $adresa=$_POST['adresa'];
    $telefon=$_POST['telefon'];

    if($ime!="" && $prezime!="" && $username!="" && $sifra!="" && $email!="" && $adresa!="" && $telefon!="")
    {
        // Kreiranje upita za ubacivanje podataka u bazu
        $query="INSERT INTO korisnik (ime, prezime, username, sifra, email, adresa, telefon) 
        VALUES ('$ime', '$prezime', '$username', '$sifra', '$email', '$adresa', '$telefon')";

        // Izvršavanje upita
        if(mysqli_query($db, $query)){
            // Hvatanje id_korisnika iz baze
            $id_korisnika = mysqli_insert_id($db);
            
            // Stavljanje id_korisnika u sesiju
            session_start();
            $_SESSION['id_korisnika'] = $id_korisnika;
        
            echo "Podaci su uspesno uneseni!";
            header('Location: login.php');
            exit;
        }
       
    }
    else {
        echo "Svi podaci su obavezni";
    }
}
?>

