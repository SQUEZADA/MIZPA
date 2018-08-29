<!DOCTYPE html>
<html lang="es">
<head>
    <title>MIZPA Libros</title>
    <?php include './inc/link.php'; ?>
</head>
<body id="container-page-index">
    <?php include './inc/navbar.php'; ?>
    <div class="jumbotron" id="jumbotron-index">
      <h1><span class="tittles-pages-logo">Libreria</span> <small style="color: #fff;">Elim</small></h1>
      <p>
          Bienvenido a nuestra tienda en linea, aquí encontrara una gran variedad de Libros.
      </p>
    </div>
    <section id="new-prod-index">
         <div class="container">
            <div class="page-header">
                <h1>Encargados<small>-Contactos</small></h1>
            </div>
            <div class="row">
              <?php
                  include 'library/configServer.php';
                  include 'library/consulSQL.php';
                  $consulta= ejecutarSQL::consultar("select * from contactos");
                  $totalproductos = mysqli_num_rows($consulta);
                  if($totalproductos>0){
                      while($fila=mysqli_fetch_array($consulta)){
                         echo '
                         <div class="col-xs-4 col-sm-2 col-md-4">
                             <div class="thumbnail">
                               <img src="assets/img-contactos/'.$fila['imagencontactos'].'" style="width:600px; height:300px;">
                               <div class="caption" style="width:600px; height:150px;">
                                 <h3>'.$fila['full_name'].'</h3>
                                 <h4>'.$fila['correo'].'</h4>
                                 <h4>'.$fila['telefono'].'</h4>
                                 <p class="text-center">
                                  
                                 </p>

                               </div>
                             </div>
                         </div>     
                         ';
                     }   
                  }else{
                      echo '<h2>Contactos</h2>';
                  }  
              ?>  
            </div>
         </div>
    </section>
    <?php include './inc/footer.php'; ?>
</body>
</html>