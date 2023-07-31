
<?php

session_start();

if(isset($_SESSION['id_korisnika'])) {
    
    $id_korisnika = $_SESSION['id_korisnika'];
    
} 
else {
    echo "Morate se prvo ulogovati!";
    exit;

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proizvodi</title>
</head>
<body>
    <h1> Dobrodošli na online prodavnicu suplementacije</h1>
    <hr>
    <?php 
    
    $db = mysqli_connect('localhost','root','','projekat');
    if(!$db)
    {
        die("Connection failed: " . mysqli_connect_error());
    }
    else {
        $sql="SELECT * FROM proizvodi";
        $k=mysqli_query($db,$sql);

        if($k->num_rows > 0){
            echo "<form action='proizvodi.php' method='POST'>";
            while($rows = $k->fetch_assoc())
            {
                echo "<p>" .$rows["naziv"] . " <br><br> Cena " .$rows["cena"] .  " RSD</p>";
                echo "<input type='number' name='kolicina" . $rows["id_proizvoda"] . "' value='0'>";

                echo "<br>";
            }
            echo "<hr>";
            echo "<p><b>UKUPNA CENA: </b> <span id='sb'>0</span> RSD </p>";
            echo "<input type='hidden' id='ukupna_cena' name='ukupna_cena' value=''>";
            echo "<button type='submit' name='submit' style='width: 150px; height: 40px; font-size:20px;'>Dodaj u korpu </button>";
            
            echo "</form>";
        }
        else {
            echo "Nema vise proizvoda na stanju!";
        }
        mysqli_close($db);
    }
    if (isset($_POST['submit'])) {
        $id_korisnika = $_SESSION['id_korisnika'];
    
        $db = mysqli_connect("localhost", "root", "", "projekat");
        if (!$db) {
            die('Greska: ' . mysqli_connect_error());
        }
    
        $ukupna_cena = $_POST['ukupna_cena'];
        $sql = "INSERT INTO korpa (id_korisnika, ukupna_cena) VALUES ('$id_korisnika','$ukupna_cena')";
        mysqli_query($db, $sql);
        $id_korpe = mysqli_insert_id($db);
    
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'kolicina') === 0 && $value > 0) {
                $id_proizvoda = substr($key, strlen('kolicina'));
                $kolicina = $value;
                $sql = "INSERT INTO korpa_proizvodi (id_korpe, id_proizvoda, kolicina) VALUES ('$id_korpe','$id_proizvoda','$kolicina')";
                mysqli_query($db, $sql);
            }
        }
        
        mysqli_close($db);
        echo "Predjite na stranu da obavite kupovinu <a href='korpa.php'>Korpa </a>";
    }

    
    ?>
    <script> 
        var kolicine = document.querySelectorAll('input[type="number"]');
        kolicine.forEach(function(input){
            input.addEventListener('change', function(){
                var ukupnaCena=0;
                kolicine.forEach(function(input){
                    var kol= parseInt(input.value);
                    var cena = parseFloat(input.previousSibling.textContent.split('Cena')[1]);
                    ukupnaCena+=kol*cena;
                });
                document.getElementById('sb').textContent=ukupnaCena.toFixed(2);
                document.getElementById('ukupna_cena').value=ukupnaCena.toFixed(2);
            });
            
        });
    </script>


</body>
</html>
