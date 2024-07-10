<?php
session_start();


  include('../conexion.php');  
  $query = "SELECT * FROM whatsapp";
  $result = mysqli_query($conexion, $query);
  $row = mysqli_fetch_array($result);
  $msg1 = $row['msg1'];
  $msg2 = $row['msg2'];
  $msg3 = $row['msg3'];
  $msg4 = $row['msg4'];
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>AJUSTES</title>
    
    <script type="text/javascript">
      function confirmSave() {
            var confirmar = confirm("¿Esta Seguro de Guardar Cambios?");
            if (confirmar) {
              return true;
            } else {
                return false;
            }
        }      
        </script>
        <script>
        window.onload = function () {
          document.getElementById("ejemplo").value = document.getElementById("msg1").value+"\n *NOMBRE REGISTRADO* \n"+document.getElementById("msg2").value+"\n"+document.getElementById("msg3").value+"\n *CÓDIGO* \n"+document.getElementById("msg4").value+"\n"+document.getElementById("link").value;
          }; 
    
          function myFunction() {
          document.getElementById("ejemplo").value = document.getElementById("msg1").value+"\n *NOMBRE REGISTRADO* \n"+document.getElementById("msg2").value+"\n"+document.getElementById("msg3").value+"\n *CÓDIGO* \n"+document.getElementById("msg4").value+"\n"+document.getElementById("link").value;
        }
</script>
  </head>
  <body>

    <div class="container" style="margin-top: 30px">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card">
            <div class="card-header" style="text-align: center;">Nueva Contraseña</div>
            <div class="card-body">
              <form action="crud.php" method="POST">
                <div class="form-group">
                  <label>Nueva Contraseña:</label>
                  <div class="d-flex" >
                  <input autocomplete="off" align="left" type="text" id="newpass" name="newpass" style="width: 70%; margin: 2px"  placeholder="Nueva Contraseña" class="form-control">
                  <button onclick="return confirmSave();" name="btnpass" type="submit" class="btn btn-primary" style="width: 30%; margin: 2px"><i class="fa-regular fa-floppy-disk" style="color: #ffffff;"></i> Guardar</button>
                </div>
              </div> 
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container" style="margin-top: 30px">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card">
            <div class="card-header" style="text-align: center;">Mensaje WhatsApp</div>
            <div class="card-body">
              <form action="crud.php" method="POST">
              <div class="form-group">
                  <label>Saludo:</label>
                  <textarea onkeyup="myFunction()" class="form-control" id="msg1" name="msg1" placeholder="" rows="1"><?php echo $row['msg1'] ?></textarea>
                </div>
                <div class="form-group">
                  <label>Mensaje 1:</label>
                  <textarea onkeyup="myFunction()" class="form-control" id="msg2" name="msg2" placeholder="" rows="4"><?php echo $row['msg2'] ?></textarea>
                </div>
                <div class="form-group">
                  <label>Mensaje 2:</label>
                  <textarea onkeyup="myFunction()" class="form-control" id="msg3" name="msg3" placeholder="" rows="2"><?php echo $row['msg3'] ?></textarea>
                </div>
                <div class="form-group">
                  <label>Mensaje 3:</label>
                  <textarea onkeyup="myFunction()" class="form-control" id="msg4" name="msg4" placeholder="" rows="2"><?php echo $row['msg4'] ?></textarea>
                </div>   
                <div class="form-group">
                  <label>Link:</label>
                  <input autocomplete="off" onkeyup="myFunction()" type="text" id="link" name="link" value="<?php echo $row['link'] ?>" placeholder="Link" class="form-control">
                </div>
                <div class="form-group">
                  <label>Ejemplo:</label>
                  <textarea class="form-control" id="ejemplo" rows="8" disabled></textarea>
                </div>                
                <button onclick="return confirmSave();" name="btnmsg" type="submit" class="btn btn-success"><i class="fa-regular fa-floppy-disk" style="color: #ffffff;"></i> Guardar</button>
                <a type="" style="float: right;" href="admin.php" class="btn btn-md btn-warning"><i class="fa-sharp fa-regular fa-circle-xmark fa-lg" style="color: #ffffff;"></i> Salir</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  </body>
</html>