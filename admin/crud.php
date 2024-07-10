<?php   

    if(isset($_POST['update'])){
        include('../conexion.php');
        $id = $_POST['id'];
        $name = $_POST['name'];
        $code = $_POST['code'];
        $adultos = $_POST['adultos'];
        $ninos = $_POST['ninos'];
        $adultosbk = $_POST['adultosbk'];
        $ninosbk = $_POST['ninosbk'];
        $mobile = $_POST['mobile'];
        $status = $_POST['status'];
        $msg = $_POST['msg'];
        $query = "UPDATE invitados SET name = '$name', code = '$code', mobile = '$mobile', adultos = '$adultos', ninos = '$ninos',adultosbk = '$adultosbk', ninosbk = '$ninosbk',status = '$status', msg = '$msg' WHERE id = '$id'";
        if($conexion->query($query)) {
            mysqli_close($conexion);
            header("location:admin.php");        
        } else {
            mysqli_close($conexion);
            echo "ERROR!!";
            header("Refresh:2;url=admin.php");
        }
    }

    if(isset($_POST['delete'])){
        include('../conexion.php');
        $id = $_POST['id'];
        $query = "DELETE FROM invitados WHERE id = '$id'";
        if($conexion->query($query)) {
            mysqli_close($conexion);
            header("location:admin.php");      
        } else {
            mysqli_close($conexion);
            echo "ERROR!!";
            header("Refresh:2;url=admin.php");
        }
    }

    if(isset($_POST['btnpass'])){
        include('../conexion.php');
        $newpass= $_POST['newpass'];
        $user=2;
        $query = "UPDATE users SET pass = '$newpass' WHERE id='$user'";
        if($conexion->query($query)) {
            mysqli_close($conexion);
            header("location:admin.php");     
        } else {
            mysqli_close($conexion);
            echo "ERROR!!";
            header("Refresh:2;url=admin.php");
        }
    }

    if(isset($_POST['btnmsg'])){
        include('../conexion.php');
        $msg1 = $_POST['msg1'];
        $msg2 = $_POST['msg2'];
        $msg3 = $_POST['msg3'];
        $msg4 = $_POST['msg4'];
        $link = $_POST['link'];
        $query = "UPDATE whatsapp SET msg1 = '$msg1', msg2 = '$msg2', msg3 = '$msg3', msg4 = '$msg4', link = '$link'";
        if($conexion->query($query)) {
            mysqli_close($conexion);
            header("location:admin.php");      
        } else {
            mysqli_close($conexion);
            echo "ERROR!!";
            header("Refresh:2;url=admin.php");
        }
    }

    if(isset($_POST['logexit'])){
        session_start();
        session_destroy();            
        header("Location: ../index.php"); 
    }

    if (!empty($_POST["btningresar"]))
    {    if (!empty($_POST["usuario"]) and !empty($_POST["password"])){
            include "../conexion.php";
            $usuario=$_POST["usuario"];
            $password=$_POST["password"];
            $sql=$conexion->query("select * from users where name = '$usuario' and pass = '$password'");        
            if ($datos=$sql->fetch_object()) {
                session_start();
                $_SESSION["id"]=$datos->id;
                $_SESSION["name"]=$datos->name;
                header("location: admin.php");
            } else {
                echo "<div class='alert alert-danger'>Acceso Denegado</div>";
            }        
        }else{
            echo "Campos Vacios";
        }
    }

    if(isset($_POST['send'])){
        include('../conexion.php');
        $id = $_POST['id'];
        $query = "SELECT * FROM invitados WHERE id = '$id'";
        $query2 = "SELECT * FROM whatsapp";
        $result = mysqli_query($conexion, $query);
        $result2 = mysqli_query($conexion, $query2);
        $row = mysqli_fetch_array($result);
        $row2 = mysqli_fetch_array($result2);
        $name = $row['name'];
        $code = $row['code'];
        $mobile = $row['mobile'];
        $msg1 = $row2['msg1'];
        $msg2 = $row2['msg2'];
        $msg3 = $row2['msg3'];
        $msg4 = $row2['msg4'];
        $link = $row2['link'];        
        ?>
        <html>
            <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=https://api.whatsapp.com/send/?phone=52<?php echo $mobile?>&text=<?php echo $msg1?>%0A<?php echo $name?>%0A<?php echo $msg2?>%0A<?php echo $msg3?>%0A<?php echo $code?>%0A<?php echo $msg4?>%0A<?php echo $link?>">
        </html>
        <?php  
    }
?>