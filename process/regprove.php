<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';

sleep(5);
$CodProve= $_POST['prove-Cod'];
$nameProve= $_POST['prove-name'];
$dirProve= $_POST['prove-dir'];
$telProve= $_POST['prove-tel'];
$webProve= $_POST['prove-web'];

if(!$CodProve=="" && !$nameProve=="" && !$dirProve=="" && !$telProve=="" && !$webProve==""){
    $verificar=  ejecutarSQL::consultar("select * from proveedor where CodProveedor='".$CodProve."'");
    $verificaltotal = mysqli_num_rows($verificar);
    if($verificaltotal<=0){
        if(consultasSQL::InsertSQL("proveedor", "CodProveedor, NombreProveedor, Direccion, Telefono, PaginaWeb", "'$CodProve','$nameProve','$dirProve','$telProve','$webProve'")){
            echo '<img src="assets/img/correcto.png" class="center-all-contens"><br><p class="lead text-center">Proveedor añadido éxitosamente</p>';
        }else{
           echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Ha ocurrido un error.<br>Por favor intente nuevamente</p>'; 
        }
    }else{
        echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">El Codigo que ha ingresado ya existe.<br>Por favor ingrese otro un nuevo codigo</p>';
    }
}else {
    echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Error los campos no deben de estar vacíos</p>';
}
