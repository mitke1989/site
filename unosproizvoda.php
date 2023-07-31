<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unos</title>
</head>
<body>
    <h1> Unos proizvoda u bazu</h1>
    <form action="unosproizvoda.php" method="post" > 
    <label for="naziv">Naziv proizvoda: </label> <input type="text" name="naziv" id="naziv" required> </input> <br> <br>
    <label for="cena"> Cena proizvoda: </label> <input type="number" name="cena" id="cena" required> </input> <br> <br>
    <label for="kolicina">Kolicina: </label><input type="number" name="kolicina" id="kolicna" > </input> <br> <br>
    <hr>
    <input type="submit" name="dugme" id="dugme" value="Unesite proizvod"></input>
    </form> <br> 
    <a href="administrator.php"><button>Administrator</button></a>

</body>
</html>
<?php 

    
    
    if(isset($_POST['naziv']) && isset($_POST['cena']) && isset($_POST['kolicina']))
    {
        $naziv=$_POST['naziv'];
        $cena=$_POST['cena'];
        $kolicina=$_POST['kolicina'];

        if(empty($naziv) || empty($cena) || empty($kolicina)) {
            echo "Niste popunili sve informacije o proizvodu!";
        }   else {
            $db = mysqli_connect('localhost','root','','projekat');
            if (!$db) {
            die("Connection failed: " . mysqli_connect_error());
                        }
            $sql = "INSERT INTO proizvodi (naziv, cena, kolicina) VALUES ('$naziv', '$cena', '$kolicina')";
            if(mysqli_query($db, $sql)) {
                echo "Proizvod je dodat uspesno";
            } else {
            echo "Greska " . mysqli_error($db);
            }
    
        mysqli_close($db);
    }
    }

   
?>
<script> 
        var kolicina = document,querySelectorAll('input[type="number"]');
        kolicina.foreach(function(input){
            input.addEventListener('change', function(){
                var ukupnaCena=0;
                kolicina.foreach(function(input){
                    var kol= praseInt(input.value);
                    var cena = praseFloat(input.previousSibling.textContent.split('Cena ')[1]);
                    ukupnaCena+=kol*cena;
                });
                document.getElementById('sb').textContent=ukupnaCena,toFixed(2);
                document.getElementById('ukupnac').value=ukupnaCena.toFixed(2);
            });
            
        });
    </script>
