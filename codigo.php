<!DOCTYPE html>
<html>
    <head>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <link rel="stylesheet" href="./Files/estilos.css">
        <meta charset="utf-8">
    </head>
    <body>
        <?php
        
        if(isset($_POST['buscar'])){                
            require_once "conexion.php";
            $codigo = $_POST['codigo'];
            $sql = "SELECT * FROM invitados WHERE code = '$codigo'";
            $sql2 = "SELECT * FROM users WHERE pass = '$codigo'";
            $resultado = $conexion->query($sql);
            $resultado2 = $conexion->query($sql2);
            $consulta2 = mysqli_fetch_array($resultado2);                
            if ($resultado2->num_rows > 0){
                if($consulta2['id']==1 || $consulta2['id']==2){
                    session_start();
                    ?>
                    <center>
                        
                        <div >
                            <h3>Menu Admin</h3>
                        </div>
                        <form method="POST">
                            <input  class='button' name='confirmados' type='submit' value='Resumen'><br> 
                            <a class='button' href="admin/admin.php" target='_top'>Administrar</a>                           
                        </form>                    
                        <input onclick="javascript:location.href='buscar.php'" type="submit" class='button-conf' value="Salir"></td>
                    </center>
                    <?php                         
                }
            }
            else {
                if ($resultado->num_rows > 0){
                    while($consulta = mysqli_fetch_array($resultado)){
                        if($consulta['status']==0){
                            ?>
                            <p style="text-align: center; padding-top: 24px;">
                                <strong>Hola</strong>
                            </p>
                            <p style='text-align: center; color:#b18d7e'>
                                <strong>
                                    <em><?php echo $consulta["name"]?></em>
                                </strong>
                            </p>
                            <p style="text-align: center;">
                                <strong>Esperamos puedan asistir.</strong>
                            </p>                            
                            <?php                                 
                            $adultos = "";
                            $ninos = "";
                            $id = $consulta['id'];
                            $name = $consulta['name'];
                            for ($x = 0; $x <= $consulta['adultos']; $x++) {
                                $adultos = $adultos."<option>".$x."</option>";
                            }                        
                            for ($x = 0; $x <= $consulta['ninos']; $x++) {
                                $ninos = $ninos."<option>".$x."</option>";
                            }                                                    
                            ?> 
                            <form method='POST'>
                            <input type='hidden' name='id' value='<?php echo $id?>'>
                            <input type='hidden' name='nameid' value='<?php echo $name?>'>
                            <div align="center">                      
                                <table style="text-align: center;">
                                    <tr>
                                        <td colspan='2' style="width:50%;">
                                            <strong>PASES DISPONIBLES:</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='width:30%; color:#b18d7e'>
                                            <strong>Adultos</strong>
                                        </td>
                                        <td style='width:30%; color:#b18d7e'>
                                            <strong>Niños</strong>
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td>
                                            <select onchange='getval();' id = 'selectadults' name='selectadultos'>
                                                <?php echo $adultos?>
                                            </select>
                                        </td>
                                        <td>
                                            <select onchange='getval();' id = 'selectnins' name='selectninos'>
                                                <?php echo $ninos?>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                                <div style="width:95%; padding-top: 12px;">
                                    <textarea name="textarea" class="textarea" maxlength="200" placeholder=" Mensaje para los Novios (Opcional)."></textarea>
                                </div>
                                <div id="count">
                                    <span id="current_count">0</span>
                                    <span id="maximum_count">/ 200</span>
                                </div>
                                <input id='confirm' class='button-conf' onclick='getval();' name='confirmar' type='submit' value='Confirmar'>
                                <input onclick="window.location.href = document.referrer; return false;" type="submit" class='button' value="Regresar">
                            </div> 
                            </form> 
                            <script type="text/javascript">
                                    $('textarea').keyup(function() {    
                                        var characterCount = $(this).val().length,
                                            current_count = $('#current_count'),
                                            maximum_count = $('#maximum_count'),
                                            count = $('#count');    
                                            current_count.text(characterCount);        
                                    });

                                    function getval()
                                    {
                                        var sa = document.getElementById("selectadults").value;
                                        var sn = document.getElementById("selectnins").value;
                                        if(sn > 0 && sa < 1){
                                            document.getElementById("confirm").disabled = true;
                                        }else {
                                            document.getElementById("confirm").disabled = false;
                                        }
                                    }
                            </script>                                
                            <?php  
                        }else if($consulta['status']==1){
                            ?>
                            <center>
                                <div style='padding-top: 30px;' class='my_text'>Ya ha confirmado anteriormente por:<BR>
                                    <strong style='color:#b18d7e;'>
                                    <div style='padding-top: 18px;' >
                                        <?php echo $consulta['adultos']?></strong> Adulto(s) y <strong style='color:#b18d7e'><?php echo $consulta['ninos']?></strong> Niño(s).<BR>
                                    </div>
                                    <div style='padding-top: 18px;' >
                                        <button class='button' onclick='location.href=document.referrer; return false;'>Regresar</button>
                                    </div>
                                </div>
                            </center>
                            <?php  
                        }
                    }
                }else{
                    ?>
                    <center>
                        <div style='padding-top: 30px;' class='my_text'>Ingresar Código Valido.
                            <div style='padding-top: 15px;'>
                                <button class='button' onclick='location.href=document.referrer; return false;'>Regresar</button>
                            </div>
                        </div>
                    </center>
                    <?php 
                }  
            }
            mysqli_close($conexion);
        }

        if(isset($_POST['confirmar'])){
            require_once "conexion.php";
            $selectadultos = $_POST["selectadultos"];
            $selectninos = $_POST["selectninos"];
            $nameid = $_POST["nameid"];
            $id = $_POST["id"];
            $text = $_POST["textarea"]; 
            $sql = "UPDATE invitados SET adultos = $selectadultos, ninos = $selectninos, status = 1, msg = '$text' WHERE id = $id";
            $resultado = $conexion->query($sql);         
            mysqli_close($conexion);
            ?>
            <center>
                <div style='padding-top: 30px;' class='my_text'>
                    ¡Confirmación Exitosa!<BR>
                    Gracias.
                </div>
            </center>
            <?php
            if ($selectadultos > 0){
                include('conexion.php');
                $sql = "SELECT * FROM invitados WHERE name = '$nameid'";
                $resultado=mysqli_query($conexion,$sql);
                while($consulta = mysqli_fetch_array($resultado)){
                    $selectadultos = $consulta['adultos'];      
                    $selectninos = $consulta['ninos'];    
                }
                mysqli_close($conexion);
                $imagefile = "Files/P.jpg";
                $imagename = $nameid;
                $image = $imagename.'.jpg';
                if(file_exists($imagefile)){
                    $img = imagecreatefromjpeg($imagefile);
                    $black = imagecolorallocate($img, 110, 110, 110);
                    $font = dirname(__FILE__) . '/Files/Fuente.otf';
                    $size = 35;
                    $size2 = 45;
                    $rotation=0;
            
                    $text = $nameid;
                    $text2 = "Adultos:".$selectadultos."  Niños:".$selectninos." ";
            
                    $bbox = imagettfbbox($size, $rotation, $font, $text);
                    $x = $bbox[0] + (imagesx($img) / 2) - ($bbox[4] / 2);
                    $y = $bbox[1] + (imagesy($img) / 2) - ($bbox[5] / 2) + 220;
                    imagettftext($img, $size, $rotation, $x, $y, $black, $font, $text);
            
                    $bbox2 = imagettfbbox($size2, $rotation, $font, $text2);
                    $x2 = $bbox2[0] + (imagesx($img) / 2) - ($bbox2[4] / 2);
                    $y2 = $bbox2[1] + (imagesy($img) / 2) - ($bbox2[5] / 2) + 275;
                    imagettftext($img, $size2, $rotation, $x2, $y2, $black, $font, $text2);
        
            
                    imagejpeg($img,"./Pases/".$image);
                    ?>
                    <center>
                        <span style='font-size: 20px; padding-bottom: 25px; font-family: Nimbus Roman No9 L'>
                            Presione el Pase para Descargar
                        </span>
                        <a href='./Pases/<?php echo $image?>' download='<?php echo $image?>'>
                            <img src='./Pases/<?php echo $image?>' style='border: #E2E2E2 1px solid;box-shadow: 0 0 12px rgb(140 140 140);width:100%'>
                        </a> 
                    <center> 
                    <?php
                }
            }
            ?>
            <center style="padding-top: 5px;">
                <input onclick="javascript:location.href='buscar.php'" type="submit" class='button-conf' value="Salir">
            </center>
            <?php             
        }

        if(isset($_POST['confirmados'])){ 
            include('conexion.php');
            $sql = "SELECT * FROM invitados WHERE status = 1 ORDER BY id ASC";
            $sql2 = "SELECT SUM(adultos) AS TA, SUM(ninos) AS TN FROM invitados WHERE status = 1";
            $resultado=mysqli_query($conexion,$sql);
            $resultado2=mysqli_query($conexion,$sql2);
            $cons = mysqli_fetch_array($resultado2);
            mysqli_close($conexion);
            ?>
            <center>
                <strong>
                    <div class='my_text' style='color:#b18d7e'>
                        CONFIRMADOS<br>
                        Adultos:
                        <a style='color:black'>
                            <?php echo $cons['TA']?>
                        </a>
                        - Niños: 
                        <a style='color:black'>
                            <?php echo $cons['TN']?>
                        </a>
                    </div>
                </strong>
                <div class='my_text'>
                    <table style='width:100%' border='1px solid black' >
                        <tr>
                            <th>Nombre</th>
                            <th>Adultos</th>
                            <th>Niños</th>
                        </tr>
                        <?php 
                        while($consulta = mysqli_fetch_array($resultado)){
                        ?>
                        <tr>
                            <td><?php echo $consulta['name']?></td>
                            <td><?php echo $consulta['adultos']?></td>
                            <td><?php echo $consulta['ninos']?></td>
                        </tr>        
                        <?php  
                        } 
                        ?>
                    </table>
                </div>
            </center>
            <table style='width:100%' >
                <td>
                    <input onclick="javascript:location.href='buscar.php'" type="submit" class='button-conf' value="Salir">
                </td>
                <td>
                    <form method="POST">
                        <input  class='button' name='sinconfirmar' type='submit' value='Sin Confirmar'>
                    </form>
                </td>
            </table>
            <?php   
        }

        if(isset($_POST['sinconfirmar'])){    
            include('conexion.php');
            $sql = "SELECT * FROM invitados WHERE status = 0 ORDER BY id ASC";
            $sql2 = "SELECT SUM(adultos) AS TA, SUM(ninos) AS TN FROM invitados WHERE status = 0";
            $resultado=mysqli_query($conexion,$sql);
            $resultado2=mysqli_query($conexion,$sql2);
            $cons = mysqli_fetch_array($resultado2);
            mysqli_close($conexion);
            ?>
            <center>
                <strong>
                    <div class='my_text' style='color:#b18d7e'>
                        SIN CONFIRMAR<br>
                        Adultos:
                        <a style='color:black'>
                            <?php echo $cons['TA']?>
                        </a>
                        - Niños: 
                        <a style='color:black'>
                            <?php echo $cons['TN']?>
                        </a>
                    </div>
                </strong>
                <div class='my_text'>
                    <table style='width:100%' border='1px solid black' >
                        <tr>
                            <th>Nombre</th>
                            <th>Adultos</th>
                            <th>Niños</th>
                        </tr>
                        <?php 
                        while($consulta = mysqli_fetch_array($resultado)){
                        ?>
                        <tr>
                            <td><?php echo $consulta['name']?></td>
                            <td><?php echo $consulta['adultos']?></td>
                            <td><?php echo $consulta['ninos']?></td>
                        </tr>        
                        <?php  
                        } 
                        ?>
                    </table>
                </div>
            </center>
            <table style='width:100%' >
                <td>
                    <input onclick="javascript:location.href='buscar.php'" type="submit" class='button-conf' value="Salir">
                </td>
                <td>
                    <form method="POST">
                        <input  class='button' name='confirmados' type='submit' value='confirmados'>
                    </form>
                </td>
            </table>
            <?php     
        }
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script>
        $(document).ready( function() {
        $('body > div:last').remove()
        $('body > script:last').remove()})
    </script>
    </body>
</html>