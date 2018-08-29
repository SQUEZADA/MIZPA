<?php
 include '../library/configServer.php';
 include '../library/consulSQL.php';

 sleep(2);
 
 $idcontactos= $_POST['contactos-code'];
 $cons=  ejecutarSQL::consultar("select * from contactos where idcontactos='$idcontactos'");
 $totalproductos = mysqli_num_rows($cons);
 $tmp=  mysqli_fetch_array($cons);
 $imagen=$tmp['imagencontactos'];
 if($totalproductos>0){
    if(consultasSQL::DeleteSQL('contactos', "idcontactos='".$idcontactos."'")){
        $carpeta='../assets/img-contactos/';
        $directorio=$carpeta.$imagen;
        chmod($directorio, 0777);
        unlink($directorio);
        echo '<img src="assets/img/correcto.png" class="center-all-contens"><br><p class="lead text-center">El contenido se elimino con éxito</p>';
    }else{
        echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Ha ocurrido un error.<br>Por favor intente nuevamente</p>'; 
    }
 }else{
     echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">El código no existe</p>';
 }