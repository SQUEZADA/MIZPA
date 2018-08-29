<!DOCTYPE html>
<html lang="es">
<head>
    <title>MIZPA Libros</title>
    <?php include './inc/link.php'; ?>
</head>
<body id="container-page-index">
    <?php include './inc/navbar.php'; ?>
    <div class="jumbotron" id="jumbotron-index">
      <h1><span class="tittles-pages-logo">Elim</span> <small style="color: #fff;">Materiales didacticos</small></h1>
      <p>
          Bienvenido a nuestra tienda en linea, aquí encontrara una gran variedad de Libros.
      </p>
    </div>
    <section id="new-prod-index">
         <div class="container">
            <div class="page-header">
                <h1>Materiales<small>-Didacticos</small></h1>
            </div>
            <div class="row">
              <?php
                  include 'library/configServer.php';
                  include 'library/consulSQL.php';
                  $consulta= ejecutarSQL::consultar("select * from biblioteca");
                  $totalproductos = mysqli_num_rows($consulta);
                  if($totalproductos>0){
                      //<img src="assets/img-biblioteca/'.$fila['imagenlibro'].'" style="width:600px; height:300px;">
                      while($fila=mysqli_fetch_array($consulta)){
                         echo '
                         <div class="col-xs-12 col-sm-8 col-md-4">
                             <div class="thumbnail">
                             <embed src="assets/img-biblioteca/'.$fila['imagenlibro'].'" width="400px" height="400px">
                               <div class="caption" style="width:600px; height:150px;">
                                 <h3>'.$fila['nombre'].'</h3>
                                 <h4>'.$fila['descripcion'].'</h4>
                                 <p class="text-center">
                                  
                                 </p>

                               </div>
                             </div>
                         </div>     
                         ';
                     }   
                  }else{
                      echo '<h2>Materiales didacticos no disponibles</h2>';
                  }  
              ?>  
            </div>
         </div>
    </section>
    <?php include './inc/footer.php'; ?>
</body>
</html>