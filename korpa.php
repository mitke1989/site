<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kupovina</title>
</head>
<body>
<a href="pocetna.php"><button>Ponovite kupovinu</button></a>
<a href="proizvodi.php"><button>Vratite se u korpu</button></a>
<?php
        session_start();

        if(isset($_SESSION['id_korisnika'])) {
            
            $id_korisnika = $_SESSION['id_korisnika'];

        } else {
            header('Location: unosKupca.php');
            exit;
        }

        $db = mysqli_connect("localhost", "root", "", "projekat");

        if (!$db) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT k.*, kp.*, p.naziv, p.cena FROM korpa k 
                JOIN korpa_proizvodi kp ON k.id_korpe = kp.id_korpe 
                JOIN proizvodi p ON kp.id_proizvoda = p.id_proizvoda 
                WHERE k.id_korisnika = '$id_korisnika'";

        $result = mysqli_query($db, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<h1>Korpa</h1>";
            echo "<table>";
            echo "<tr><th>Naziv proizvoda</th><th>Količina</th><th>Cena</th></tr>";
            $ukupna_cena = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>" . $row["naziv"] . "</td><td>" . $row["kolicina"] . "</td><td>" . $row["cena"] . "</td></tr>";
                $ukupna_cena += $row["cena"] * $row["kolicina"];
            }
            echo "</table>";
            echo "<p><b>Ukupna cena: </b>" . $ukupna_cena . " RSD</p>";
        } else {
            echo "Vaša korpa je prazna.";
        }

        $sql = "SELECT * FROM korisnik WHERE id_korisnika = '$id_korisnika'";
        $result = mysqli_query($db, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo "<h2>Podaci o kupcu:</h2>";
            echo "<p>Ime: " . $row["ime"] . "</p>";
            echo "<p>Prezime: " . $row["prezime"] . "</p>";
            echo "<p>Adresa: " . $row["adresa"] . "</p>";
            echo "<p>Email: " . $row["email"] . "</p>";
            echo "<p>Telefon: " . $row["telefon"] . "</p>";
        }

        mysqli_close($db);

    
?>
<form action="korpa.php" method="POST">
<button id="kupiBtn" style="width:70px; height:30px;">Kupi</button>

</form>
<script>
    const kupiBtn = document.querySelector('#kupiBtn');
    kupiBtn.addEventListener('click', function() {
        alert('Uspesno ste kupili proizvode!');
    });
</script>
</body>
</html>