<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Prijava</title>
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
            <br/>
            <input id="KorIme" name="KorIme" type="text" />
            <span id="PorKor"></span>
            <br/>
            <label for="Loz">Lozinka:</label>
            <br/>
            <input id="Loz" name="Loz" type="password" />
            <span id="PorLoz"></span>
            <br/>
            <br/>
            <button type="reset" value="Ponisti">Poništi</button>
            <button type="submit" id="posalji" value="Prihvati">Prihvati</button>
            </form>
    
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
            if (sndFrm == false) {
                event.preventDefault();
            }

        };
    </script>
        

     <?php
    include 'connect.php';
    session_start();
   
    if (isset($_POST['KorIme']) && isset($_POST['Loz'])) {
        $KorIme = $_POST['KorIme'];
        $Loz = $_POST['Loz'];
        
        $sql="SELECT username, lozinka,razina FROM korisnik WHERE Username=?";
        $stmt=mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $sql)){
        mysqli_stmt_bind_param($stmt,'s',$KorIme);
        mysqli_stmt_execute($stmt);
            
            
    
        mysqli_stmt_store_result($stmt);
        }
        mysqli_stmt_bind_result($stmt, $BKorIme, $BLoz, $BRazina);
        mysqli_stmt_fetch($stmt);

        if (mysqli_stmt_num_rows($stmt)>0){
    
        if(password_verify($Loz,$BLoz)){
            $_SESSION['Korisnik']=$BKorIme;
            $_SESSION['Razina']=$BRazina;
            $_SESSION['Prijava']=1;
            echo "Uspješan Login <br>
            Dobrodošao, ".$_SESSION['Korisnik'];
        }
        else{
            echo "Pogrešna lozinka";
        

        }
    }
    else{
        echo "Ne postoji korisnik sa tim korisničkim imenom!
        <br><a href='Registracija.php'>Registracija</a>";
    }
    
    mysqli_close($dbc);
    }


   





?>
</div>
     <footer>
        <div class="wrapper">
            <hr>
            <p><b>Copyright © BBC</b> The BBC is not resposible for the content of external sites.Read about our approach
                to
                external linking</p>
        </div>
    </footer>
</body>

</html>