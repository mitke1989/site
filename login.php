<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login korisnika</title>
</head>
<body>
    <h1> Logovanje korisnika </h1>
    <form action="login.php" method="POST">
        <label for="kor_ime">Korisnicko ime: </label>
        <input type="text" name="kor_ime" required> <br> <br>

        <label for="sifra">Sifra: </label>
        <input type="password" name="sifra" required> <br> <br>

        <input type="submit" value="Login">
</form>
<?php 

    if(isset($_POST['kor_ime']) and isset($_POST['sifra'])){
        $kor_ime=$_POST['kor_ime'];
        $sifra=$_POST['sifra'];
        
        $db = mysqli_connect("localhost", "root", "", "projekat");

        if(!$db){
            die('Greska: ' .mysqli_connect_error());
        }
        $sql = "SELECT * FROM korisnik WHERE  username='$kor_ime' AND sifra='$sifra'";
        $rez = mysqli_query($db,$sql);
        
        if(mysqli_num_rows($rez)==1){
            $row=mysqli_fetch_assoc($rez);
            session_start();
            $_SESSION['id_korisnika'] = $row['id_korisnika'];
            header('Location: proizvodi.php');
            exit;
        }
        else{
            echo "Pogresno ste uneli username ili lozinku!";
        }
        mysqli_close($db);
    }

?>
</body>
</html>