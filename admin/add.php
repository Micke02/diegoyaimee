<?php
if(isset($_POST['create'])){
    include('../conexion.php');
    $name   = $_POST['name'];
    $code  = $_POST['code'];
    $mobile  = $_POST['mobile'];
    $adultos = $_POST['adultos'];
    $ninos = $_POST['ninos'];
    $adultosbk = $_POST['adultos'];
    $ninosbk = $_POST['ninos'];
    $query = "INSERT INTO invitados (id, name, code, mobile, adultos, ninos, adultosbk, ninosbk, status, msg) VALUES (NULL, '$name', '$code', '$mobile', '$adultos','$ninos','$adultosbk','$ninosbk','0','')";
    if($conexion->query($query)) {
        mysqli_close($conexion);
        header("location:admin.php");        
    } else {
        mysqli_close($conexion);
        echo "ERROR!!";
        header("Refresh:2;url=admin.php");
    }
}
?>