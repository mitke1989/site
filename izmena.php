<?php
$db = mysqli_connect("localhost", "root", "", "projekat");
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_proizvoda = $_POST["id_proizvoda"];
    $nova_cena = $_POST["nova_cena"];

    $update_sql = "UPDATE proizvodi SET cena = '$nova_cena' WHERE id_proizvoda = '$id_proizvoda'";
    if (mysqli_query($db, $update_sql)) {
        echo "Cena proizvoda je uspešno izmenjena.";
    } else {
        echo "Greška prilikom izmene cene proizvoda: " . mysqli_error($db);
    }
}

$sql = "SELECT id_proizvoda, naziv, cena FROM proizvodi";
$result = mysqli_query($db, $sql);
if (!$result) {
    die("Greška prilikom dohvatanja proizvoda: " . mysqli_error($db));
}

mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Izmena</title>
</head>
<body>
    <h1>Izmena cene proizvoda</h1>

    <form action="izmena.php" method="POST">
        <label for="id_proizvoda">Izaberite proizvod:</label>
        <select name="id_proizvoda" id="id_proizvoda">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $option_label = $row['naziv'] . " - " . $row['cena'];
                echo "<option value='" . $row['id_proizvoda'] . "'>" . $option_label . "</option>";            }
            ?>
        </select>
        <br><br>
        <label for="nova_cena">Nova cena:</label>
        <input type="number" name="nova_cena" id="nova_cena">
        <br><br>
        <input type="submit" value="Izmeni"> <br><br>
         

    </form>
    <a href="administrator.php"><button>Nazad</button></a> <br>
</body>
</html>
