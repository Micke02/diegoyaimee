<?php
session_start();
?>
<!doctype html>
<html lang="en" >
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>ADMINISTRAR</title> 

    <script type="text/javascript">
        function confirmDelete() {
            var confirmar = confirm("¿Realmente desea Eliminar el Registro?");
            if (confirmar) {
                return true;                
            } else {
                return false;
            }
        }
        function confirmExit() {
            var confirmar = confirm("¿Realmente desea Salir?");
            if (confirmar) {                   
              return true;                        
            } else {
                return false;
            }
        }
        function confirmSend() {
            var confirmar = confirm("Enviará Mensaje de Invitación, Código y Página al Teléfono de WhatsApp Registrado ¿Desea Continuar?");
            if (confirmar) {
                return true;                
            } else {
                return false;
            }
        }           
      </script>
  </head >

  <body>

    <div class="container" style="margin-top: 30px; width: 120VH;">
      <div class="">
        <div class="">
          <div class="card">
          <div class="card-header" style="text-align: center;">ADMINISTRAR <br> </div><br>
          
          <?php            
            include('../conexion.php');            
            $query = "SELECT *, SUM(adultos) AS APC, SUM(ninos) AS NPC FROM invitados WHERE status = 0";
            $query2 = "SELECT * ,SUM(adultos) AS AC, SUM(ninos) AS NC  ,(SUM(adultosbk)-SUM(adultos)) as AX, (SUM(ninosbk)-SUM(ninos)) as NX FROM invitados WHERE status = 1";
            $result = mysqli_query($conexion, $query);
            $result2 = mysqli_query($conexion, $query2);
            $row = mysqli_fetch_array($result);
            $row2 = mysqli_fetch_array($result2);      
          ?>

          <TABLE align= "center" style=" text-align: center; border:1px; width: 95%">
          
            <TR>
              <TD style="border-radius:10px; background-color: #c0ff81">Adultos Confirmados<br><?php echo $row2['AC'];?></TD>
              <TD > </TD>
              <TD style="border-radius:10px; background-color: #c0ff81">Niños Confirmados<br><?php echo $row2['NC'];?></TD>
              <TD > </TD>
              <TD style="border-radius:10px; background-color: #fef688">Adultos por Confirmar<br><?php echo $row['APC'];?></TD>
              <TD > </TD>
              <TD style="border-radius:10px; background-color: #fef688">Niños por Confirmar<br><?php echo $row['NPC'];?></TD>
              <TD > </TD>
              <TD style="border-radius:10px; background-color: #ff8e8f">Adultos Cancelados<br><?php echo $row2['AX'] ?></TD>
              <TD > </TD>
              <TD style="border-radius:10px; background-color: #ff8e8f">Niños Cancelados<br><?php echo $row2['NX']?></TD>
            </TR>
          </TABLE>          
            <div class="card-body">
            <div style="float: right;"> 
              <form action="crud.php" method="POST">             
                <a href="agregar.php" class="btn btn-md btn-primary" style="color: white; margin-bottom: 10px"><i class="fa-solid fa-user-plus" ></i> Agregar</a>
                <a href="settings.php" name="" class="btn btn-md btn-success" style="color: white; margin-bottom: 10px"><i class="fa-solid fa-wrench"></i> Ajustes</a>
                <button onclick="return confirmExit();" id="logexit" name="logexit" class="btn btn-md btn-warning" style="margin-bottom: 10px">
                  <i class="fa-sharp fa-regular fa-circle-xmark fa-lg" style="color: #ffffff;"></i> Salir
                </button>
              </form>
            </div> 

              <table class="table table-bordered" id="myTable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Código</th>                    
                    <th scope="col">Adultos</th>
                    <th scope="col">Niños</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php                   
                      include('../conexion.php');
                      $no = 1;
                      $sql = "SELECT * FROM invitados WHERE id > 1 ORDER BY id ASC";  
                      $query = $conexion->query($sql);
                      while($row = mysqli_fetch_array($query)){
                        $status="";
                        $color="";
                      if ($row['status']==1){
                          $status = "Confirmado";
                          $color= "#c0ff81";
                      }else{
                          $status = "Sin Confirmar";
                          $color= "#ff8e8f";
                      }
                  ?>

                  <tr >
                      <td><?php echo $no++ ?></td>
                      <td id="name"><?php echo $row['name'] ?></td>
                      <td style="text-align: center;"><?php echo $row['code'] ?></td>
                      <td style="text-align: center;"><?php echo $row['adultos'] ?></td>
                      <td style="text-align: center;"><?php echo $row['ninos'] ?></td>
                      <td id="mobile" style="text-align: center;"><?php echo $row['mobile'] ?></td>
                      <td style="text-align: center; background-color:<?php echo $color ?>;"><?php echo $status ?></td>
                      <td class="text-center">
                        
                        <div class="d-flex" style="text-align: center;">

                          <form action="crud.php" method="POST">
                              <button onclick="return confirmSend();" name="send" class="btn btn-sm btn-success" style="border-radius:20px; margin: 5px; <?php if (strlen($row['mobile'])<10 || $row['status']==1) echo 'display: none' ?>">
                                <i class="fa-brands fa-whatsapp fa-lg" style="color: #ffffff; "></i>
                              </button>
                              <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                          </form>

                          <a href="../Pases/<?php echo $row['name']?>.jpg" download="<?php echo $row['name']?>.jpg" class="btn btn-sm btn-secondary" style="border-radius:20px; margin: 5px; 
                          <?php 
                          $nombre_fichero = '../Pases/'.$row['name'].'.jpg';
                          if (file_exists($nombre_fichero)) ;else echo 'display: none;'                          
                          ?>
                          ">
                          <i class="fa-solid fa-file-arrow-down" style="color: #ffffff;"></i>
                          </a>

                          <a href="edit.php?id=<?php echo $row['id']?>" class="btn btn-sm btn-primary" style="border-radius:20px; margin: 5px">
                            <i class="fa-regular fa-pen-to-square fa-lg" style="color: #ffffff;"></i>
                          </a>

                          <form action="crud.php" method="POST">
                            <button id="delete" name="delete" class="btn btn-sm btn-danger" style="border-radius:20px; margin: 5px">
                              <i class="fa-regular fa-trash-can fa-lg" style="color: #ffffff;"></i>
                            </button>
                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                          </form>
                        </div>
                      </td>
                  </tr>
                 <!--     -->
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready( function () {
          $('#myTable').DataTable();
      } );
    </script>

  </body>
</html>