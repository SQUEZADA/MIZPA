<!DOCTYPE html>
<html lang="es">
<head>
    <title>MIZPA Libros</title>
    <?php include './inc/link.php'; ?>
</head>
<body id="container-page-index">
    <?php include './inc/navbar.php'; ?>
    <div class="jumbotron" id="jumbotron-index">
      <h1><span class="tittles-pages-logo">Libreia</span> <small style="color: #fff;">-Elim</small></h1>
      <p>
          Bienvenido a nuestra tienda en linea, aquí encontrara una gran variedad de Libros.
      </p>
    </div>
    <section id="new-prod-index">
         <div class="container">
            <div class="page-header">
                <h1>Nosotros<small>-Objetivos</small></h1>
            </div>
            <div class="row">
              <?php
                  include 'library/configServer.php';
                  include 'library/consulSQL.php';
                  $consulta= ejecutarSQL::consultar("select * from nosotros");
                  $totalproductos = mysqli_num_rows($consulta);
                  if($totalproductos>0){
                      while($fila=mysqli_fetch_array($consulta)){
                         echo '
                         <div class="col-xs-6 col-sm-4 col-md-4">
                             <div class="thumbnail">
                               <img src="assets/img-nosotros/'.$fila['imagenNosotros'].'" style="width:600px; height:400px;">
                               <div class="caption" style="width:600px; height:400px;">
                                 <h3>'.$fila['Titulo'].'</h3>
                                 <div  class="col-xs-6 col-sm-6 col-md-6">
                                 <p style=" text-align: justify; white-space: pre-line;">'.$fila['Descripcion'].'</p>
                                 </div>
                                 <p class="text-center">
                                  
                                 </p>

                               </div>
                             </div>
                         </div>     
                         ';
                     }   
                  }else{
                      echo '<h2>Contenido en proceso</h2>';
                  }  
              ?>  
            </div>
         </div>
    </section>
  
    <?php include './inc/footer.php'; ?>
</body>
</html>