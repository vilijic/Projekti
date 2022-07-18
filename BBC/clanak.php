<?php 

    include 'connect.php';
    define('UPLPATH', 'img/');

    $id=$_GET["id"];
    if(isset($id)){

    $query = "SELECT naslov,sadrzaj,kratki_sadrzaj,slika,kategorija FROM clanci WHERE arhiva=0 AND id=$id";
    $result = mysqli_query($dbc, $query);
    $row=mysqli_fetch_array($result);
    $naslov=$row['naslov'];
    $sadrzaj=$row['sadrzaj'];
    $ksad=$row['kratki_sadrzaj']; 
    $slika=UPLPATH.$row['slika'];
    $kategorija=$row['kategorija'];



    




echo "<!DOCTYPE html>
<html>

<head>
    <title>Članak</title>
    <link rel='stylesheet' type='text/css' href='design.css'>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'
        integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>
</head>";

echo "
<body>
    <header>
        <div class='wrapper'>
            <nav>
                <img src='logo.png'>
                <a href='index.php'>Home</a>
                <a href='kategorija.php?kategorija=vijesti'>News</a>
                <a href='kategorija.php?kategorija=sport'>Sport</a>
                <a href='administracija.php'>Administracija</a>
            </nav>
        </div>
    </header>";
    if($kategorija=='Sport'){
    echo "<div class='drh'>
            <div class='wrapper'>
            <h2>SPORT</h2>";}
    else{
        echo "<div class='vjh'>
        <div class='wrapper'>
            <h2>Vijesti</h2>";
        
    }
    echo "
        </div>
    </div>
    <div class='wrapper'>
        <h2 'dat'>$naslov</h2>
            <section>
                <img src='$slika'>
                <br>
                <br>
                <h5>$ksad</h5>
                <br>
                <p>$sadrzaj</p>



            </section>
    </div>



    <footer>
        <div class='wrapper'>

            <hr>
            <p><b>Copyright © BBC</b>The BBC is not resposible for the content of external sites.Read about our approach
                to
                external linking</p>
        </div>
    </footer>


</body>



</html>";


    }
    else{

        echo "Bad URL";
    }
mysqli_close($dbc);





?>