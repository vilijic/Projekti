<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Registracija</title>
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
    <br>

    <div class="wrapper">
        <form class="untek" enctype="multipart/form-data" id="forma" method='post' action=''>
            <label for="KorIme">Korisničko ime:</label>
            <br />
            <input id="KorIme" name="KorIme" type="text" />
            <span id="PorKor"></span>
            <br />
            <label for="Ime">Ime:</label>
            <br />
            <input id="Ime" name="Ime" type="text" />
            <span id="PorIme"></span>
            <br />
            <label for="Prez">Prezime:</label>
            <br />
            <input id="Prez" name="Prez" type="text" />
            <span id="PorPrez"></span>
            <br />
            <label for="Loz">Lozinka:</label>
            <br />
            <input id="Loz" name="Loz" type="password" />
            <span id="PorLoz"></span>
            <br />

            <label for="PLoz">Ponovljena Lozinka:</label>
            <input id="PLoz" name="PLoz" type="password" />
            <span id="PorPloz"></span>
            <br>
            <br>
            <label for="Lvl">Razina privilegija-administrator:
            <input class="siri" id="Lvl" name="Lvl" type="checkbox" value=0>
            </label>
            <br>
            <button type="reset" value="Ponisti">Poništi</button>
            <button type="submit" id="posalji" value="Prihvati">Prihvati</button>
        </form>
    </div>
    <script type="text/javascript">
        document.getElementById("posalji").onclick = function(event) {
            var sndFrm = true;
            var PKorIme = document.getElementById("KorIme");
            var KorIme = document.getElementById("KorIme").value;
            if (KorIme.length == 0) {
                sndFrm = false;
                PKorIme.style.border = "3px solid red";
                document.getElementById("PorKor").innerHTML = "Korisničko ime ne smije biti prazno!";
                document.getElementById("PorKor").style.color = "red";
            } else {
                PKorIme.style.border = "3px solid green";
                document.getElementById("PorKor").innerHTML = "";

            }

            var PIme = document.getElementById("Ime");
            var Ime = document.getElementById("Ime").value;
            if (Ime.length == 0) {
                sndFrm = false;
                PIme.style.border = "3px solid red";
                document.getElementById("PorIme").innerHTML = "Ime ne smije biti prazno!";
                document.getElementById("PorIme").style.color = "red";
            } else {
                PIme.style.border = "3px solid green";
                document.getElementById("PorIme").innerHTML = "";
            }

            var PPrez = document.getElementById("Prez");
            var Prez = document.getElementById("Prez").value;
            if (Prez.length == 0) {
                sndFrm = false;
                PPrez.style.border = "3px solid red";
                document.getElementById("PorPrez").innerHTML = "Prezime ne smije biti prazno!";
                document.getElementById("PorPrez").style.color = "red";
            } else {
                PPrez.style.border = "3px solid green";
                document.getElementById("PorPrez").innerHTML = "";
            }

            var PLoz = document.getElementById("Loz");
            var Loz = document.getElementById("Loz").value;
            if (Loz.length == 0) {
                sndFrm = false;
                PLoz.style.border = "3px solid red";
                document.getElementById("PorLoz").innerHTML = "Lozinka ne smije biti prazna!";
                document.getElementById("PorLoz").style.color = "red";
            } else {
                PLoz.style.border = "3px solid green";
                document.getElementById("PorLoz").innerHTML = "";
            }
            var PPloz = document.getElementById("PLoz");
            var PoLoz = document.getElementById("PLoz").value;
            if (PoLoz.length == 0) {
                sndFrm = false;
                PPloz.style.border = "3px solid red";
                document.getElementById("PorPloz").innerHTML = "Ponovljena lozinka ne smije biti prazna!";
                document.getElementById("PorPloz").style.color = "red";
            } else if (PoLoz != Loz) {
                sndFrm = false;
                PPloz.style.border = "3px solid red";
                document.getElementById("PorPloz").innerHTML = "Ponovljena lozinka mora biti ista kao i lozinka";
                document.getElementById("PorPloz").style.color = "red";
            } else {
                PPloz.style.border = "3px solid green";
                document.getElementById("PorPloz").innerHTML = "";
            }

            if (sndFrm == false) {
                event.preventDefault();
            }

        };
    </script>

    <?php
    include 'connect.php';
    if (isset($_POST['KorIme']) && isset($_POST['Ime']) && isset($_POST['Prez']) && isset($_POST['Loz'])) {
        $KorIme = $_POST['KorIme'];
        $Ime = $_POST['Ime'];
        $Prez = $_POST['Prez'];
        $Loz = $_POST['Loz'];
        $HLoz=password_hash($Loz, CRYPT_BLOWFISH);
        if(isset($_POST['Lvl'])){
        $Lvl="administrator";
        }
        else{
            $Lvl="";
        }
        
        
        $sql = "INSERT INTO korisnik (username,ime,prezime,lozinka,razina) values (?,?,?,?,?)";
        $stmt = mysqli_stmt_init($dbc);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 'sssss', $KorIme, $Ime,$Prez,$HLoz,$Lvl);
            if(mysqli_stmt_execute($stmt)){

                echo "Uspješna registracija
                <br><a href='Prijava.php'>Prijava</a>";

            }
            else{
                echo "Već postoji korisnik sa tim imenom";
            };
        }

        mysqli_close($dbc);
        
    }


?>

    <footer>
        <div class="wrapper">

            <hr>
            <p><b>Copyright © BBC</b>The BBC is not resposible for the content of external sites.Read about our approach
                to
                external linking</p>
        </div>
    </footer>
</body>

</html>


