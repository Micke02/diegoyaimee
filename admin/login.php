<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>LOGIN</title>
  </head>

  <body>
  
    <div class="container" style="margin-top: 30px">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card">
            <div class="card-header" style="text-align: center;"> LOGIN </div>
            <?php 
               include "../conexion.php";
               include "crud.php";
            ?>
            <div class="card-body">
              <form action="" method="POST">
                
                <div class="form-group">
                  <label>Usuario:</label>
                  <input autocomplete="off" type="text" name="usuario" id="usuario" value="admin" class="form-control" required/>
                </div>

                <div class="form-group">
                  <label>Contraseña:</label>
                   <input autocomplete="off" type="password" class="form-control" placeholder="Password" name="password" id="password" autofocus="autofocus" required/>
                </div>
              
                <input name="btningresar" class="btn btn-success" type="submit" value="Iniciar Sesión">
                <a style="float: right;" type="" href="../index.php" class="btn btn-md btn-warning"><i class="fa-sharp fa-regular fa-circle-xmark fa-lg" style="color: #ffffff;"></i> Cancelar</a>
                
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