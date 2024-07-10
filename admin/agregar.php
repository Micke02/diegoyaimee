<?php
session_start();

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>AGREGAR</title>

    <script type="text/javascript">
      function filtro(){
      var tecla = event.key;
      if (['.','e'].includes(tecla))
        event.preventDefault()
      }  
    </script>
  </head>

  <body>  
    <div class="container" style="margin-top: 30px">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card">
            <div class="card-header" style="text-align: center;">
            AGREGAR
            </div>
            <div class="card-body">
              <form action="add.php" method="POST">
                
                <div class="form-group">
                  <label>Nombre:</label>
                  <input autocomplete="off" type="text" id="name" name="name" id="name" placeholder="Nombre" class="form-control" required/>
                </div>
                <div class="form-group">
                  <label>Código:</label>
                   <input autocomplete="off" type="text" class="form-control" placeholder="Código" maxlength="10" oninput='if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)' name="code" id="code" required/>
                    <div id="respuesta">
                </div>
                  <div class="form-group" style="width: 49%; float: left;">
                    <label>Adultos:</label>
                    <input autocomplete="off" onkeydown="filtro()" type="number" maxlength="2" oninput='if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)' name="adultos" placeholder="Adultos" class="form-control" required/>
                  </div>
                  <div class="form-group" style="width: 49%; float: right;">
                    <label>Niños:</label>
                    <input autocomplete="off" onkeydown="filtro()" type="number" maxlength="2" oninput='if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)' name="ninos" placeholder="Niños" class="form-control" required/>
                  </div> 
                <div >
                <div class="form-group">
                  <label>Teléfono:</label>
                  <input autocomplete="off" min="0" pattern="^[0-9]+" maxlength="10" oninput='if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)' type="number" name="mobile" placeholder="Teléfono" class="form-control" >
                </div>                 
                </div>              
                <button type="submit" id="create" name="create" class="btn btn-success"><i class="fa-regular fa-floppy-disk" style="color: #ffffff;"></i> Guardar</button>
                <a style="float: right;" type="" href="admin.php" class="btn btn-md btn-warning"><i class="fa-sharp fa-regular fa-circle-xmark fa-lg" style="color: #ffffff;"></i> Cancelar</a>
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
                        $("#create").attr('disabled',true);
                        $("#code").attr('style',  'background-color: #ff8e8f');
                        $("#create").attr('class',  'btn btn-md btn-secondary');
                      }else{
                        $("#respuesta").html(datos.message);
                        $("#create").attr('disabled',false);
                        $("#code").attr('style',  'background-color: #c0ff81');
                        $("#create").attr('class',  'btn btn-success');
                      }
                    }
                });
              }
          });
        });      
      </script>
  </body>
</html>