<?php
include 'connect.php';
define('UPLPATH', 'img/');
?>

<!DOCTYPE html>
<html>

<head>
    <title>BBC</title>
    <link rel="stylesheet" type="text/css" href="design.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
        <br>
        <h4 id="dat">Welcome to BBC.com</h4>
        <h4 id="dati"><?php echo date('l, F jS, Y'); ?></h4>
        <br>
        <br>
        <h4 id="pnas">&nbspNews</h4>

        <section>            
        <?php
            $query = "SELECT * FROM clanci WHERE arhiva=0 AND kategorija='vijesti' LIMIT 3";
            $result = mysqli_query($dbc, $query);
            echo "<div class='container-fluid'>
            <div class='row'>";
            while($row = mysqli_fetch_array($result)) {
                    echo '<div class="col-lg-4 col-sm-12">';
                    echo '<a id="noh" href="clanak.php?id='.$row['id'].'">';
                    
                    echo '<img width="200" height="150" src="'.UPLPATH.$row['slika'].'">';
                    echo '<h6 id="nas";">'.$row['naslov'].'</h6>';
                    echo '<p id="nasi">'.$row['kratki_sadrzaj'].'</p></a>';
                    echo "</div>";     
            }
           echo "</div>
            </div>";
            ?>
        </section>
            <br>
        <h4 id="pnasi">&nbspSport</h4>
        <section>
        <?php
            $query = "SELECT * FROM clanci WHERE arhiva=0 AND kategorija='sport' LIMIT 3";
            $result = mysqli_query($dbc, $query);
            echo "<div class='container-fluid'>
            <div class='row'>";
            while($row = mysqli_fetch_array($result)) {
                    echo '<div class="col-lg-4 col-sm-12">';
                    echo '<a id="noh" href="clanak.php?id='.$row['id'].'">';
                    
                    echo '<img width="200" height="150" src="'.UPLPATH.$row['slika'].'">';
                    echo '<h6 id="nas";">'.$row['naslov'].'</h6>';
                    echo '<p id="nasi">'.$row['kratki_sadrzaj'].'</p></a>';
                    echo "</div>";      
            }
           echo "</div>
            </div>";
            ?>
        </section>
    </div>



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