<?php
  include('../conexion.php');
  $code    = $_REQUEST['code'];
  $jsonData = array();
  $selectQuery   = ("SELECT code FROM invitados WHERE code='".$code."'");
  $query         = mysqli_query($conexion, $selectQuery);
  $totalCliente  = mysqli_num_rows($query);
    if( $totalCliente <= 0 ){
      $jsonData['success'] = 0;
      $jsonData['message'] = '';
  } else{
      $jsonData['success'] = 1;
      $jsonData['message'] = '<p style="color:red;">Ya existe: <strong>(' .$code.')<strong></p>';
    }
  header('Content-type: application/json; charset=utf-8');
  echo json_encode( $jsonData );
?>