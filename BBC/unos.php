<?php
include 'connect.php';
if(isset($_FILES['slika']['name']) && isset($_POST['naslov'])&& isset($_POST['ksad'])&& isset($_POST['kategorija'])&& isset($_POST['sadrzaj'])){
$slika = $_FILES['slika']['name'];
$naslov=$_POST['naslov'];
$ksad=$_POST['ksad'];
$sadrzaj=$_POST['sadrzaj'];
$kategorija=$_POST['kategorija'];
$datum=date('d.m.Y.');

if(isset($_POST['arh'])){
 $arhiva=1;
}
else{
 $arhiva=0;
}
$sql = "INSERT INTO clanci (datum, naslov,kratki_sadrzaj, sadrzaj,kategorija, slika, arhiva)
VALUES (?,?,?,?,?,?,?)";
        $stmt = mysqli_stmt_init($dbc);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 'ssssssi', $datum, $naslov,$ksad,$sadrzaj,$kategorija,$slika,$arhiva);
            if(mysqli_stmt_execute($stmt)){

              echo "Uspješno spremljeno u bazu
              <br> <a href='unos.html'>Povratak na unos</a>";
              
            }
            else{
              mysqli_close($dbc);
              echo "Greška u podacima
              <br> <a href='unos.html'>Povratak na unos</a>";
            };
        }
$target_dir = 'img/'.$slika;
move_uploaded_file($_FILES["slika"]["tmp_name"], $target_dir);


}

?>

