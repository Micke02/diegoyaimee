<?php
  session_start();
?>
<?php   
  include('../conexion.php');  
  $id = $_GET['id'];  
  $query = "SELECT * FROM invitados WHERE id = $id LIMIT 1";
  $result = mysqli_query($conexion, $query);
  $row = mysqli_fetch_array($result);
  $status = $row['status'];
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Editar</title>
    <script type="text/javascript">
      function confirmReset() {
          var confirmar = confirm("Restableceras Número de Invitados y Estado al registro inicial. Nota: Despues de Restablecer presione el botón: Guardar.");
          if (confirmar) {
            document.getElementById("adultos").value = "<?php echo $row["adultosbk"]?>"; 
            document.getElementById("ninos").value = "<?php echo $row["ninosbk"] ?>"; 
            document.getElementById("status").value = "0";
              return true;
          } else {
              return false;
          }
      }
    </script>
  </head>
  <body>
    <div class="container" style="margin-top: 30px">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card">
            <div class="card-header" style="text-align: center;">
              EDITAR
            </div>
            <div class="card-body">
              <form action="crud.php" method="POST">                
                <div class="form-group">
                  <label>Nombre:</label>
                  <input autocomplete="off" type="text" name="name" value="<?php echo $row['name'] ?>" placeholder="Nombre" class="form-control" required/>
                  <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                </div>
                <div class="form-group">
                  <label>Código:</label>
                   <input autocomplete="off" type="text" class="form-control" placeholder="Código" maxlength="10" oninput='if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)' name="code" id="code" value="<?php echo $row['code'] ?>" required/>
                    <div id="respuesta">
                </div>                
                <div>
                  <div style="display: none" class="form-group" style="width: 49%; float: left;">
                    <label >Adultos Asignados:</label>
                    <input autocomplete="off" id="adultosbk" style="background-color: #ffffdd;" maxlength="2" oninput='if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)' type="number" name="adultosbk" value="<?php echo $row['adultosbk'] ?>" placeholder="Adultos" class="form-control" min="0" pattern="^[0-9]+">
                    </div>
                  <div class="form-group" style="width: 50%; float: right;">
                    <label>Niños Confirmados:</label>
                    <input autocomplete="off" id="ninos" maxlength="2" oninput='if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)' style="background-color: #ddffe2;" type="number" name="ninos" value="<?php echo $row['ninos'] ?>" placeholder="Niños" class="form-control" min="0" pattern="^[0-9]+" required/>
                  </div>
                </div>
                <div>
                  <div style="display: none" class="form-group" style="width: 49%; float: right;">
                    <label>Niños Asignados:</label>
                    <input autocomplete="off" style="background-color: #ffffdd;" maxlength="2" oninput='if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)' type="number" name="ninosbk" value="<?php echo $row['ninosbk'] ?>" placeholder="Niños" class="form-control" min="0" pattern="^[0-9]+" >
                  </div>
                  <div class="form-group" style="width: 50%; float: right;">
                  <label>Adultos Confirmados:</label>
                  <input autocomplete="off" id="adultos" style="background-color: #ddffe2;" maxlength="2" oninput='if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)' type="number" name="adultos" value="<?php echo $row['adultos'] ?>" placeholder="Adultos" class="form-control" min="0" pattern="^[0-9]+" required/>
                  </div>
                </div>
                <div class="form-group">
                  <label>Teléfono:</label>
                  <input autocomplete="off" min="0" pattern="^[0-9]+" maxlength="10" oninput='if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)' type="number" name="mobile" value="<?php echo $row['mobile'] ?>" placeholder="Teléfono" class="form-control">
                </div>
                <div class="form-group">
                  <label>Estado:</label> <br>    
                  <select class="form-group" name="status" id="status">
                    <option value="<?php echo $status;?>" selected><?php if ($status==1)  echo "Confirmado"; else echo "Sin Confirmar"; ?></option>
                    <option value="<?php if ($status==1) echo "0"; else echo "1"; ?>"><?php if ($status==1)  echo "Sin Confirmar"; else echo "Confirmado"; ?></option>
                  </select> 
                </div>                
                <div class="form-group">
                  <label>Mensaje:</label>
                  <textarea maxlength="200" oninput='if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)' class="form-control" name="msg" placeholder="Mensaje" rows="4"><?php echo $row['msg'] ?></textarea>
                </div>
                <div allign="center">
                  <button type="submit" id="update" name="update" class="btn btn-success"><i class="fa-regular fa-floppy-disk" style="color: #ffffff;"></i> Guardar</button>
                  <a style = "color: white; padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 5px;" onclick="return confirmReset();" class="btn btn-md btn-primary"><i class="fa-solid fa-arrow-rotate-left" style="color: white"></i> Restablecer</a>
                  <a style = "padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 5px; float: right;" type=""  href="admin.php" class="btn btn-md btn-warning"><i class="fa-sharp fa-regular fa-circle-xmark fa-lg" style="color: #ffffff;"></i> Cancelar</a>
                </div>
                <!-- <button type="reset" class="btn btn-secondary">Reset</button> -->
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script src="js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
          $("#code").on("keyup", function() {
            var code = $("#code").val();
            var longitudcode = $("#code").val().length;
            if(longitudcode >= 1){
              var dataString = 'code=' + code;
                $.ajax({
                    url: 'verificar.php',
                    type: "GET",
                    data: dataString,
                    dataType: "JSON",
                    success: function(datos){
                      
                    if( datos.success == 1){
                      $("#respuesta").html(datos.message);
                      $("#update").attr('disabled',true);
                      $("#code").attr('style', 'background-color: #ff8e8f');
                      $("#update").attr('class', 'btn btn-md btn-secondary');
                    }else{
                      $("#respuesta").html(datos.message);
                      $("#update").attr('disabled',false);
                      $("#code").attr('style', 'background-color: #c0ff81');
                      $("#update").attr('class', 'btn btn-success');
                    }
                    }
                });
            }
          });
        });      
    </script>
  </body>
</html>