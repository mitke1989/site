<?php
$db = mysqli_connect("localhost", "root", "", "projekat");
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT id_proizvoda, naziv FROM proizvodi";
$result = mysqli_query($db, $sql);
if (!$result) {
    die("Greška prilikom dohvatanja proizvoda: " . mysqli_error($db));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brisanje</title>
</head>
<body>
    <h1>Brisanje proizvoda</h1>

    <form action="brisanje.php" method="POST">
        <label for="id_proizvoda">Izaberite proizvod za brisanje:</label>
        <select name="id_proizvoda" id="id_proizvoda">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['id_proizvoda'] . "'>" . $row['naziv'] . "</option>";
            }
            ?>
        </select>
        <br><br>
        <input type="submit" value="Obriši">
    </form> <br>
    <a href="administrator.php"><button>Nazad</button></a> 

</body>
</html>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_proizvoda = $_POST["id_proizvoda"];

    // Prvo brišemo povezane zapise iz tabele korpa_proizvodi
    $delete_korpa_proizvodi_sql = "DELETE FROM korpa_proizvodi WHERE id_proizvoda = '$id_proizvoda'";
    if (mysqli_query($db, $delete_korpa_proizvodi_sql)) {
        // Nakon brisanja povezanih zapisa, možemo sada obrisati proizvod iz tabele proizvodi
        $delete_proizvod_sql = "DELETE FROM proizvodi WHERE id_proizvoda = '$id_proizvoda'";
        if (mysqli_query($db, $delete_proizvod_sql)) {
            echo "Proizvod je uspešno obrisan iz baze.";
        } else {
            echo "Greška prilikom brisanja proizvoda: " . mysqli_error($db);
        }
    } else {
        echo "Greška prilikom brisanja povezanih zapisa: " . mysqli_error($db);
    }
}

mysqli_close($db);
?>


