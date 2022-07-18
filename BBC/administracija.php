<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Administracija</title>
    <link rel="stylesheet" type="text/css" href="design.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>


<body>
    <header>
        <div class="wrapper">
            <nav>
                <img src="logo.png">
                <a href="index.php">Home</a>
                <a href="kategorija.php?kategorija=vijesti">News</a>
                <a href="kategorija.php?kategorija=sport">Sport</a>
                <a href="administracija.php">Administracija</a>
            </nav>
        </div>
    </header>

    
    <div class="wrapper">
    <form method="post">
    
    <div class="d-flex justify-content-end">
           <span style="display:none;" id="unesi" style="display:"><a href='unos.html' type='button' class='btn btn-info mt-2 mr-2 w-25' >Unesi Članak</a></span>
            <a href="Prijava.php"type="button" class="btn btn-dark mt-2 mr-2 w-25" >Prijavi me</a>
            <button name="LogOut" type="submit" class="btn btn-dark mt-2" >Odjavi me</button>
        
    </div>
    
    <span id="poruka"></span>
    </div>
    </form>
    <?php
    include 'connect.php';
    session_start();
    if(isset($_POST['LogOut'])){
        session_unset();

    }
    
    if (isset($_SESSION['Korisnik'])){
        if($_SESSION['Razina'] == "administrator"){
        define('UPLPATH', 'img/');
        $query = "SELECT * FROM clanci";
        $result = mysqli_query($dbc, $query);
        echo "<script type='text/javascript'>
        document.getElementById('unesi').style.display= 'block'     
        </script>";

        while ($row = mysqli_fetch_array($result)) {
            

            echo '<div class="wrapper">
        <form enctype="multipart/form-data" action="administracija.php" method="POST">
        <input type="hidden" name="id" value="' . $row['id'] . '">

        <label for="naslov">Naslov Vijesti:</label>
        <input type="text" name="naslov" value="' . $row['naslov'] . '">

        <label for="ksad">Kratki sadržaj Vijesti:</label>
        <textarea name="ksad"  rows="3" class="formfield-textual">' . $row['kratki_sadrzaj'] . '</textarea>


        <label for="sadrzaj">Sadržaj vijesti:</label>

        <textarea name="sadrzaj" rows="10" class="formfield-textual">' . $row['sadrzaj'] . '</textarea>


        <label for="slika">Slika:</label>
        <input type="file" name="slika" value=' . $row['slika'] . '/> 
        <br>
        <img src="img/' . $row['slika'] . '">
 

 
        <label for="kategorija">Kategorija Vijesti:</label>

        <select name="kategorija" value="' . $row['kategorija'] . '">
        <option value="Sport">Sport</option>
        <option value="Vijesti">Vijesti</option>
        </select>


        <label>Spremiti u arhivu:';

            if ($row['arhiva'] == 0) {
                echo '<input  type="checkbox" name="arhiva" id="arhiva"/>';
            } else {
                echo '<input type="checkbox" name="arhiva" id="arhiva" checked/>';
            }
            echo '</div>
        </label>
        </div>
        </div>
        <div class="wrapper">
        <button class="btn btn-primary"type="reset" value="Poništi">Poništi</button>
        <button class="btn btn-primary"type="submit" name="azuriraj" value="Prihvati">
        Izmjeni</button>
        <button class="btn btn-danger" type="submit" name="obrisi" value="Izbriši">
        Izbriši</button>
        </div>
        </form>
        <br>';
            echo "</div></div>";
        }

        if (isset($_POST['obrisi'])) {
            $id = $_POST['id'];
            $query = "DELETE FROM clanci WHERE id=$id ";
            $result = mysqli_query($dbc, $query);
            echo "<script type='text/javascript'>
            document.getElementById('poruka').style.fontWeight =700;
            document.getElementById('poruka').innerHTML ='Uspješno izbrisan članak koji ima ID = $id'
            </script>";
            mysqli_close($dbc);
        }
       
       
        if (isset($_POST['azuriraj'])) {

            $slika = $_FILES['slika']['name'];

            $naslov = $_POST['naslov'];
            $krsad = $_POST['ksad'];
            $sadrzaj = $_POST['sadrzaj'];
            $kategorija = $_POST['kategorija'];
            if (isset($_POST['arhiva'])) {
                $arhiva = 1;
            } else {
                $arhiva = 0;
            }
            
               
                $target_dir = 'img/' . $slika;
                move_uploaded_file($_FILES["slika"]["temp_name"], $target_dir);
            
            $id = $_POST['id'];
            $query = 
            $sql = "UPDATE clanci SET naslov=?, kratki_sadrzaj=?, sadrzaj=?, slika=?, kategorija=?, arhiva=? WHERE id=?";
            $stmt = mysqli_stmt_init($dbc);
    
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, 'sssssii', $naslov, $krsad,$sadrzaj,$slika,$kategorija,$arhiva,$id);
                if(mysqli_stmt_execute($stmt)){
    
                   echo "<script type='text/javascript'>
                    document.getElementById('poruka').style.fontWeight =700;
                    document.getElementById('poruka').innerHTML ='Uspješno izmjenjen članak koji ima ID = $id'
                    </script>";
            
                }
                else{
                    echo "Neuspješna izmjena podataka";
                };
            };
            mysqli_close($dbc);
        }
    }else {
        
        echo "<div class='wrapper'>
        Vaš korisnički račun nema administratorske privilegije, Prijavite se ponovne sa administratoskim korisničkim računom
        </div>";
    }
} else {
        echo "<div class='wrapper d-flex justify-content-center'>
        Niste Prijavljeni
        </div>";
    }
    ?>
    
    <footer>
        <div class="wrapper">
            <hr>
            <p><b>Copyright © BBC.</b> The BBC is not resposible for the content of external sites.Read about our approach
                to
                external linking</p>
        </div>
    </footer>

</body>




</html>