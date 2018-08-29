<?php
    include './library/configServer.php';
    include './library/consulSQL.php';
    include './process/securityPanel.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Admin</title>
    <?php include './inc/link.php'; ?>
    <script type="text/javascript" src="js/admin.js"></script>
</head>
<body id="container-page-configAdmin">
    <?php include './inc/navbar.php'; ?>
    <section id="prove-product-cat-config">
        <div class="container">
            <div class="page-header">
              <h1>Panel de administración <small class="tittles-pages-logo">MIZPA</small></h1>
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#Productos" role="tab" data-toggle="tab">Productos</a></li>
              <li role="presentation"><a href="#Proveedores" role="tab" data-toggle="tab">Proveedores</a></li>
              <li role="presentation"><a href="#Categorias" role="tab" data-toggle="tab">Categorías</a></li>
              <li role="presentation"><a href="#Admins" role="tab" data-toggle="tab">Admin</a></li>
              <li role="presentation"><a href="#Pedidos" role="tab" data-toggle="tab">Pedidos</a></li>
              <li role="presentation"><a href="#Novedades" role="tab" data-toggle="tab">Novedades</a></li>
              <li role="presentation"><a href="#Nosotros" role="tab" data-toggle="tab">Nosotros</a></li>
              <li role="presentation"><a href="#contactos" role="tab" data-toggle="tab">Contactos</a></li>
              <li role="presentation"><a href="#biblioteca" role="tab" data-toggle="tab">Biblioteca</a></li>
            </ul>
            <div class="tab-content">
                <!--==============================Panel productos===============================-->
                <div role="tabpanel" class="tab-pane fade in active" id="Productos">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <br><br>
                        <div id="add-product">
                            <h2 class="text-primary text-center"><small><i class="fa fa-plus"></i></small>&nbsp;&nbsp;Agregar un producto nuevo</h2>
                            <form role="form" action="process/regproduct.php" method="post" enctype="multipart/form-data">
                              <div class="form-group">
                                <label>Código de producto</label>
                                <input type="text" class="form-control"  placeholder="Código" required maxlength="30" name="prod-codigo">
                              </div>
                              <div class="form-group">
                                <label>Nombre de producto</label>
                                <input type="text" class="form-control"  placeholder="Nombre" required maxlength="30" name="prod-name">
                              </div>
                              <div class="form-group">
                                <label>Categoría</label>
                                <select class="form-control" name="prod-categoria">
                                    <?php 
                                        $categoriac=  ejecutarSQL::consultar("select * from categoria");
                                        while($catec=mysqli_fetch_array($categoriac)){
                                            echo '<option value="'.$catec['CodigoCat'].'">'.$catec['Nombre'].'</option>';
                                        }
                                    ?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label>Precio</label>
                                <input type="text" class="form-control"  placeholder="Precio" required maxlength="20" pattern="[0-9]{1,20}" name="prod-price">
                              </div>
                              <div class="form-group">
                                <label>Autor</label>
                                <input type="text" class="form-control"  placeholder="Autor" required maxlength="30" name="prod-model">
                              </div>
                              <div class="form-group">
                                <label>ISBN</label>
                                <input type="text" class="form-control"  placeholder="ISBN" required maxlength="30" name="prod-marca">
                              </div>
                              <div class="form-group">
                                <label>Unidades disponibles</label>
                                <input type="text" class="form-control"  placeholder="Unidades" required maxlength="20" pattern="[0-9]{1,20}" name="prod-stock">
                              </div>
                              <div class="form-group">
                                <label>Proveedor</label>
                                <select class="form-control" name="prod-codigoP">
                                    <?php 
                                        $proveedoresc=  ejecutarSQL::consultar("select * from proveedor");
                                        while($provc=mysqli_fetch_array($proveedoresc)){
                                            echo '<option value="'.$provc['CodProveedor'].'">'.$provc['NombreProveedor'].'</option>';
                                        }
                                    ?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label>Imagen de producto</label>
                                <input type="file" name="img">
                                <p class="help-block">Formato de imagenes admitido png, jpg, gif, jpeg</p>
                              </div>
                                <input type="hidden"  name="admin-name" value="<?php echo $_SESSION['nombreAdmin'] ?>">
                              <p class="text-center"><button type="submit" class="btn btn-primary">Agregar a la tienda</button></p>
                              <div id="res-form-add" style="width: 100%; text-align: center; margin: 0;"></div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <br><br>
                        <div id="del-prod-form">
                            <h2 class="text-danger text-center"><small><i class="fa fa-trash-o"></i></small>&nbsp;&nbsp;Eliminar un producto</h2>
                             <form action="process/delprod.php" method="post" role="form">
                                 <div class="form-group">
                                     <label>Productos</label>
                                     <select class="form-control" name="prod-code">
                                         <?php 
                                             $productoc=  ejecutarSQL::consultar("select * from producto");
                                             while($prodc=mysqli_fetch_array($productoc)){
                                                 echo '<option value="'.$prodc['CodigoProd'].'">'.$prodc['Marca'].'-'.$prodc['NombreProd'].'-'.$prodc['Modelo'].'</option>';
                                             }
                                         ?>
                                     </select>
                                 </div>
                                 <p class="text-center"><button type="submit" class="btn btn-danger">Eliminar</button></p>
                                 <br>
                                 <div id="res-form-del-prod" style="width: 100%; text-align: center; margin: 0;"></div>
                             </form>
                         </div>
                    </div>
                    <div class="col-xs-12">
                        <br><br>
                        <div class="panel panel-info">
                            <div class="panel-heading text-center"><i class="fa fa-refresh fa-2x"></i><h3>Actualizar datos de producto</h3></div>
                          <div class="table-responsive">
                              <table class="table table-bordered">
                                  <thead class="">
                                      <tr>
                                          <th class="text-center">Código</th>
                                          <th class="text-center">Nombre</th>
                                          <th class="text-center">Categoría</th>
                                          <th class="text-center">Precio</th>
                                          <th class="text-center">Autor</th>
                                          <th class="text-center">ISBN</th>
                                          <th class="text-center">Unidades</th>
                                          <th class="text-center">Proveedor</th>
                                          <th class="text-center">Opciones</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                        $productos=  ejecutarSQL::consultar("select * from producto");
                                        $upr=1;
                                        while($prod=mysqli_fetch_array($productos)){
                                            echo '
                                                <div id="update-product">
                                                  <form method="post" action="process/updateProduct.php" id="res-update-product-'.$upr.'">
                                                    <tr>
                                                        <td>
                                                          <input class="form-control" type="hidden" name="code-old-prod" required="" value="'.$prod['CodigoProd'].'">
                                                          <input class="form-control" type="text" name="code-prod" maxlength="30" required="" value="'.$prod['CodigoProd'].'">
                                                        </td>
                                                        <td><input class="form-control" type="text" name="prod-name" maxlength="30" required="" value="'.$prod['NombreProd'].'"></td>
                                                        <td>';
                                                            $categoriac3=  ejecutarSQL::consultar("select * from categoria where CodigoCat='".$prod['CodigoCat']."'");
                                                            while($catec3=mysqli_fetch_array($categoriac3)){
                                                                $codeCat=$catec3['CodigoCat'];
                                                                $nameCat=$catec3['Nombre'];
                                                            }
                                                      echo '<select class="form-control" name="prod-category">';
                                                                echo '<option value="'.$codeCat.'">'.$nameCat.'</option>';
                                                                $categoriac2=  ejecutarSQL::consultar("select * from categoria");
                                                                while($catec2=mysqli_fetch_array($categoriac2)){
                                                                    if($catec2['CodigoCat']==$codeCat){
                                                                        
                                                                    }else{
                                                                      echo '<option value="'.$catec2['CodigoCat'].'">'.$catec2['Nombre'].'</option>';  
                                                                    }
                                                                    
                                                                }
                                                      echo '</select>
                                                        </td>
                                                        <td><input class="form-control" type="text-area" name="price-prod" required="" value="'.$prod['Precio'].'"></td>
                                                        <td><input class="form-control" type="tel" name="model-prod" required="" maxlength="20" value="'.$prod['Modelo'].'"></td>
                                                        <td><input class="form-control" type="text-area" name="marc-prod" maxlength="30" required="" value="'.$prod['Marca'].'"></td>
                                                        <td><input class="form-control" type="text-area" name="stock-prod" maxlength="30" required="" value="'.$prod['Stock'].'"></td>
                                                        <td>';
                                                           $proveedoresc3=  ejecutarSQL::consultar("select * from proveedor where CodProveedor='".$prod['CodProveedor']."'");
                                                           while($provc3=mysqli_fetch_array($proveedoresc3)){
                                                                    $nombreP=$provc3['NombreProveedor'];
                                                                    $CodP=$provc3['CodProveedor'];
                                                            }
                                                       echo '<select class="form-control" name="prod-Prove">';
                                                                echo '<option value="'.$CodP.'">'.$nombreP.'</option>';
                                                                $proveedoresc2=  ejecutarSQL::consultar("select * from proveedor");
                                                                while($provc2=mysqli_fetch_array($proveedoresc2)){
                                                                    if($provc2['CodProveedor']==$CodP){
                                                                        
                                                                    }else{
                                                                      echo '<option value="'.$provc2['CodProveedor'].'">'.$provc2['NombreProveedor'].'</option>';
                                                                    }  
                                                                }  
                                                       echo '</select>
                                                        </td>
                                                        <td class="text-center">
                                                            <button type="submit" class="btn btn-sm btn-primary button-UPR" value="res-update-product-'.$upr.'">Actualizar</button>
                                                            <div id="res-update-product-'.$upr.'" style="width: 100%; margin:0px; padding:0px;"></div>
                                                        </td>
                                                    </tr>
                                                  </form>
                                                </div>
                                                ';
                                            $upr=$upr+1;
                                        }
                                      ?>
                                  </tbody>
                              </table>
                          </div>
                        </div>
                    </div>
                </div>
                </div>
                <!--==============================Panel Proveedores===============================-->
                <div role="tabpanel" class="tab-pane fade" id="Proveedores">
                    <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <br><br>
                        <div id="add-provee">
                            <h2 class="text-primary text-center"><small><i class="fa fa-plus"></i></small>&nbsp;&nbsp;Agregar un proveedor</h2>
                            <form action="process/regprove.php" method="post" role="form">                                                                                                                   
                                <div class="form-group">
                                    <label>Codigo</label>
                                    <input class="form-control" type="text" name="prove-Cod" placeholder="Cod proveedor" maxlength="30" required="">
                                </div>
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input class="form-control" type="text" name="prove-name" placeholder="Nombre proveedor" maxlength="30" required="">
                                </div>
                                <div class="form-group">
                                    <label>Dirección</label>
                                    <input class="form-control" type="text" name="prove-dir" placeholder="Dirección proveedor" required="">
                                </div>
                                <div class="form-group">
                                    <label>Teléfono</label>
                                    <input class="form-control" type="tel" name="prove-tel" placeholder="Número telefónico" pattern="[0-9]{1,20}" maxlength="20" required="">
                                </div>
                                <div class="form-group">
                                    <label>Página web</label>
                                    <input class="form-control" type="text" name="prove-web" placeholder="Página web proveedor" required="">
                                </div>
                                <p class="text-center"><button type="submit" class="btn btn-primary">Añadir proveedor</button></p>
                                <br>
                                <div id="res-form-add-prove" style="width: 100%; text-align: center; margin: 0;"></div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <br><br>
                        <div id="del-prove">
                            <h2 class="text-danger text-center"><small><i class="fa fa-trash-o"></i></small>&nbsp;&nbsp;Eliminar un proveedor</h2>
                            <form action="process/delprove.php" method="post" role="form">
                                <div class="form-group">
                                    <label>Proveedores</label>
                                    <select class="form-control" name="Cod-prove">
                                        <?php 
                                            $proveCod=  ejecutarSQL::consultar("select * from proveedor");
                                            while($PN=mysqli_fetch_array($proveCod)){
                                                echo '<option value="'.$PN['CodProveedor'].'">'.$PN['CodProveedor'].' - '.$PN['NombreProveedor'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <p class="text-center"><button type="submit" class="btn btn-danger">Eliminar proveedor</button></p>
                                <br>
                                <div id="res-form-del-prove" style="width: 100%; text-align: center; margin: 0;"></div>
                            </form>
                        </div>    
                    </div>
                    <div class="col-xs-12">
                        <br><br>
                        <div class="panel panel-info">
                            <div class="panel-heading text-center"><i class="fa fa-refresh fa-2x"></i><h3>Actualizar datos de proveedor</h3></div>
                          <div class="table-responsive">
                              <table class="table table-bordered">
                                  <thead class="">
                                      <tr>
                                          <th class="text-center">Codigo</th>
                                          <th class="text-center">Nombre</th>
                                          <th class="text-center">Dirección</th>
                                          <th class="text-center">Telefono</th>
                                          <th class="text-center">Página web</th>
                                          <th class="text-center">Opciones</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                              $proveedores=  ejecutarSQL::consultar("select * from proveedor");
                                              $up=1;
                                              while($prov=mysqli_fetch_array($proveedores)){
                                                  echo '
                                                      <div id="update-proveedor">
                                                        <form method="post" action="process/updateProveedor.php" id="res-update-prove-'.$up.'">
                                                          <tr>
                                                              <td>
                                                                <input class="form-control" type="hidden" name="Cod-prove-old" required="" value="'.$prov['CodProveedor'].'">
                                                                <input class="form-control" type="text" name="Cod-prove" maxlength="30" required="" value="'.$prov['CodProveedor'].'">
                                                              </td>
                                                              <td><input class="form-control" type="text" name="prove-name" maxlength="30" required="" value="'.$prov['NombreProveedor'].'"></td>
                                                              <td><input class="form-control" type="text-area" name="prove-dir" required="" value="'.$prov['Direccion'].'"></td>
                                                              <td><input class="form-control" type="tel" name="prove-tel" required="" maxlength="20" value="'.$prov['Telefono'].'"></td>
                                                              <td><input class="form-control" type="text-area" name="prove-web" maxlength="30" required="" value="'.$prov['PaginaWeb'].'"></td>
                                                              <td class="text-center">
                                                                  <button type="submit" class="btn btn-sm btn-primary button-UP" value="res-update-prove-'.$up.'">Actualizar</button>
                                                                  <div id="res-update-prove-'.$up.'" style="width: 100%; margin:0px; padding:0px;"></div>
                                                              </td>
                                                          </tr>
                                                        </form>
                                                      </div>
                                                      ';
                                                  $up=$up+1;
                                              }
                                            ?>
                                  </tbody>
                              </table>
                          </div>
                        </div>
                    </div>
                </div>
                </div>
                <!--==============================Panel Categorias===============================-->
                <div role="tabpanel" class="tab-pane fade" id="Categorias">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <br><br>
                            <div id="add-categori">
                                <h2 class="text-info text-center"><small><i class="fa fa-plus"></i></small>&nbsp;&nbsp;Agregar categoría</h2>
                                <form action="process/regcategori.php" method="post" role="form">
                                    <div class="form-group">
                                        <label>Código</label>
                                        <input class="form-control" type="text" name="categ-code" placeholder="Código de categoria" maxlength="9" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input class="form-control" type="text" name="categ-name" placeholder="Nombre de categoria" maxlength="30" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Descripción</label>
                                        <input class="form-control" type="text" name="categ-descrip" placeholder="Descripcióne de categoria" required="">
                                    </div>
                                    <p class="text-center"><button type="submit" class="btn btn-primary">Agregar categoría</button></p>
                                    <br>
                                    <div id="res-form-add-categori" style="width: 100%; text-align: center; margin: 0;"></div>
                                </form>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <br><br>
                            <div id="del-categori">
                                <h2 class="text-danger text-center"><small><i class="fa fa-trash-o"></i></small>&nbsp;&nbsp;Eliminar una categoría</h2>
                                <form action="process/delcategori.php" method="post" role="form">
                                    <div class="form-group">
                                        <label>Categorías</label>
                                        <select class="form-control" name="categ-code">
                                            <?php 
                                                $categoriav=  ejecutarSQL::consultar("select * from categoria");
                                                while($categv=mysqli_fetch_array($categoriav)){
                                                    echo '<option value="'.$categv['CodigoCat'].'">'.$categv['CodigoCat'].' - '.$categv['Nombre'].'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <p class="text-center"><button type="submit" class="btn btn-danger">Eliminar categoría</button></p>
                                    <br>
                                    <div id="res-form-del-cat" style="width: 100%; text-align: center; margin: 0;"></div>
                                </form>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <br><br>
                            <div class="panel panel-info">
                                <div class="panel-heading text-center"><i class="fa fa-refresh fa-2x"></i><h3>Actualizar categoría</h3></div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="">
                                            <tr>
                                                <th class="text-center">Código</th>
                                                <th class="text-center">Nombre</th>
                                                <th class="text-center">Descripción</th>
                                                <th class="text-center">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                              $categorias=  ejecutarSQL::consultar("select * from categoria");
                                              $ui=1;
                                              while($cate=mysqli_fetch_array($categorias)){
                                                  echo '
                                                      <div id="update-category">
                                                        <form method="post" action="process/updateCategory.php" id="res-update-category-'.$ui.'">
                                                          <tr>
                                                              <td>
                                                                <input class="form-control" type="hidden" name="categ-code-old" maxlength="9" required="" value="'.$cate['CodigoCat'].'">
                                                                <input class="form-control" type="text" name="categ-code" maxlength="9" required="" value="'.$cate['CodigoCat'].'">
                                                              </td>
                                                              <td><input class="form-control" type="text" name="categ-name" maxlength="30" required="" value="'.$cate['Nombre'].'"></td>
                                                              <td><input class="form-control" type="text-area" name="categ-descrip" required="" value="'.$cate['Descripcion'].'"></td>
                                                              <td class="text-center">
                                                                  <button type="submit" class="btn btn-sm btn-primary button-UC" value="res-update-category-'.$ui.'">Actualizar</button>
                                                                  <div id="res-update-category-'.$ui.'" style="width: 100%; margin:0px; padding:0px;"></div>
                                                              </td>
                                                          </tr>
                                                        </form>
                                                      </div>
                                                      ';
                                                  $ui=$ui+1;
                                              }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
                <!--==============================Panel Admins===============================-->
                <div role="tabpanel" class="tab-pane fade" id="Admins">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <br><br>
                            <div id="add-admin">
                                <h2 class="text-info text-center"><small><i class="fa fa-plus"></i></small>&nbsp;&nbsp;Agregar administrador</h2>
                                <form action="process/regAdmin.php" method="post" role="form">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input class="form-control" type="text" name="admin-name" placeholder="Nombre" maxlength="9" pattern="[a-zA-Z]{4,9}" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Contraseña</label>
                                        <input class="form-control" type="password" name="admin-pass" placeholder="Contraseña" required="">
                                    </div>
                                    <p class="text-center"><button type="submit" class="btn btn-primary">Agregar administrador</button></p>
                                    <br>
                                    <div id="res-form-add-admin" style="width: 100%; text-align: center; margin: 0;"></div>
                                </form>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <br><br>
                            <div id="del-admin">
                                <h2 class="text-danger text-center"><small><i class="fa fa-trash-o"></i></small>&nbsp;&nbsp;Eliminar administrador</h2>
                                <form action="process/deladmin.php" method="post" role="form">
                                    <div class="form-group">
                                        <label>Administradores</label>
                                        <select class="form-control" name="name-admin">
                                            <?php 
                                                $adminCon=  ejecutarSQL::consultar("select * from administrador");
                                                while($AdminD=mysqli_fetch_array($adminCon)){
                                                    echo '<option value="'.$AdminD['Nombre'].'">'.$AdminD['Nombre'].'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <p class="text-center"><button type="submit" class="btn btn-danger">Eliminar administrador</button></p>
                                    <br>
                                    <div id="res-form-del-admin" style="width: 100%; text-align: center; margin: 0;"></div>
                                </form>
                            </div>
                        </div>
                        <div class="col-xs-12"></div> 
                    </div>
                </div>
                <!--==============================Panel Novedades===============================-->
                <div role="tabpanel" class="tab-pane fade" id="Novedades">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <br><br>
                        <div id="add-product">
                            <h2 class="text-primary text-center"><small><i class="fa fa-plus"></i></small>&nbsp;&nbsp;Agregar Contenido</h2>
                            <form role="form" action="process/regNovedad.php" method="post" enctype="multipart/form-data">
                              <div class="form-group">
                                <label>Titulo</label>
                                <input type="text" class="form-control"  placeholder="Texto" required maxlength="80" name="Titulo">
                              </div>
                              <div class="form-group">
                                <label>Descripcion</label>
                                <textarea type="text"  class="form-control"  placeholder="Texto" required maxlength="1200" name="Descripcion"></textarea>
                              </div>                             
                              <div class="form-group">
                                <label>Imagen</label>
                                <input type="file" name="imagen">
                                <p class="help-block">Formato de imagenes admitido png, jpg, gif, jpeg</p>
                              </div>
                                <input type="hidden"  name="admin-name" value="<?php echo $_SESSION['nombreAdmin'] ?>">
                                <input type="hidden"  name="IdNovedad" value="<?php echo $_SESSION['nombreAdmin'] ?>">
                              <p class="text-center"><button type="submit" class="btn btn-primary">Agregar a Novedades</button></p>
                              <div id="res-form-add" style="width: 100%; text-align: center; margin: 0;"></div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <br><br>
                        <div id="del-nov-form">
                            <h2 class="text-danger text-center"><small><i class="fa fa-trash-o"></i></small>&nbsp;&nbsp;Eliminar Novedad</h2>
                             <form action="process/delnovedad.php" method="post" role="form">
                                 <div class="form-group">
                                     <label>Novedades</label>
                                     <select class="form-control" name="Novedad-code">
                                         <?php 
                                             $novedad=  ejecutarSQL::consultar("select * from Novedad");
                                             while($prod=mysqli_fetch_array($novedad)){ 
                                                 echo '<option value="'.$prod['Idnovedad'].'">'.$prod['Titulo'].'-'.$prod['Descripcion'].'-'.$prod['Imagen'].'</option>';
                                             }
                                         ?>
                                     </select>
                                 </div>
                                 <p class="text-center"><button type="submit" class="btn btn-danger">Eliminar</button></p>
                                 <br>
                                 <div id="res-form-del-nov" style="width: 100%; text-align: center; margin: 0;"></div>
                             </form>
                         </div>
                    </div>
                </div>
             </div>

              <!--==============================Panel Nosotros===============================-->
              <div role="tabpanel" class="tab-pane fade" id="Nosotros">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <br><br>
                        <div id="add-product">
                            <h2 class="text-primary text-center"><small><i class="fa fa-plus"></i></small>&nbsp;&nbsp;Agregar Contenido</h2>
                            <form role="form" action="process/regnosotros.php" method="post" enctype="multipart/form-data">
                              <div class="form-group">
                                <label>Titulo</label>
                                <input type="text" class="form-control"  placeholder="Texto" required maxlength="80" name="Titulo">
                              </div>
                              <div class="form-group">
                                <label>Descripcion</label>
                                <textarea type="text"  class="form-control"  placeholder="Texto" required maxlength="1200" name="Descripcion"></textarea>
                              </div>                             
                              <div class="form-group">
                                <label>Imagen</label>
                                <input type="file" name="imagenNosotros">
                                <p class="help-block">Formato de imagenes admitido png, jpg, gif, jpeg</p>
                              </div>
                                <input type="hidden"  name="admin-name" value="<?php echo $_SESSION['nombreAdmin'] ?>">
                                <input type="hidden"  name="idnosotros" value="<?php echo $_SESSION['nombreAdmin'] ?>">
                              <p class="text-center"><button type="submit" class="btn btn-primary">Agregar a Contenido</button></p>
                              <div id="res-form-add" style="width: 100%; text-align: center; margin: 0;"></div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <br><br>
                        <div id="del-nos-form">
                            <h2 class="text-danger text-center"><small><i class="fa fa-trash-o"></i></small>&nbsp;&nbsp;Eliminar Contenido</h2>
                             <form action="process/delnosotros.php" method="post" role="form">
                                 <div class="form-group">
                                     <label>Nosotros</label>
                                     <select class="form-control" name="nosotros-code">
                                         <?php 
                                             $novedad=  ejecutarSQL::consultar("select * from nosotros");
                                             while($prod=mysqli_fetch_array($novedad)){ 
                                                 echo '<option value="'.$prod['idnosotros'].'">'.$prod['Titulo'].'-'.$prod['Descripcion'].'-'.$prod['imagenNosotros'].'</option>';
                                             }
                                         ?>
                                     </select>
                                 </div>
                                 <p class="text-center"><button type="submit" class="btn btn-danger">Eliminar</button></p>
                                 <br>
                                 <div id="res-form-del-nos" style="width: 100%; text-align: center; margin: 0;"></div>
                             </form>
                         </div>
                    </div>
                </div>
             </div>
              <!--==============================Panel contactos===============================-->
              <div role="tabpanel" class="tab-pane fade" id="contactos">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <br><br>
                        <div id="add-product">
                            <h2 class="text-primary text-center"><small><i class="fa fa-plus"></i></small>&nbsp;&nbsp;Agregar Contactos</h2>
                            <form role="form" action="process/regcontactos.php" method="post" enctype="multipart/form-data">
                              <div class="form-group">
                                <label>Nombre Completo</label>
                                <input type="text" class="form-control"  placeholder="Nombre Completo" required maxlength="80" name="full_name">
                              </div>
                              <div class="form-group">
                                <label>Correo</label>
                                <input type="text" class="form-control"  placeholder="Correo" required maxlength="80" name="Correo">
                              </div>     
                              <div class="form-group">
                                <label>Telefono</label>
                                <input type="text" class="form-control"  placeholder="Numero de telefono" required maxlength="80" name="telefono">
                              </div>         
                              <div class="form-group">
                                <label>Imagen</label>
                                <input type="file" name="imagencontactos">
                                <p class="help-block">Formato de imagenes admitido png, jpg, gif, jpeg</p>
                              </div>
                                <input type="hidden"  name="admin-name" value="<?php echo $_SESSION['nombreAdmin'] ?>">
                                <input type="hidden"  name="idcontactos" value="<?php echo $_SESSION['nombreAdmin'] ?>">
                              <p class="text-center"><button type="submit" class="btn btn-primary">Agregar a Contacto</button></p>
                              <div id="res-form-add" style="width: 100%; text-align: center; margin: 0;"></div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <br><br>
                        <div id="del-cont-form">
                            <h2 class="text-danger text-center"><small><i class="fa fa-trash-o"></i></small>&nbsp;&nbsp;Eliminar Contacto</h2>
                             <form action="process/delcontactos.php" method="post" role="form">
                                 <div class="form-group">
                                     <label>Contactos</label>
                                     <select class="form-control" name="contactos-code">
                                         <?php 
                                             $novedad=  ejecutarSQL::consultar("select * from contactos");
                                             while($prod=mysqli_fetch_array($novedad)){ 
                                                 echo '<option value="'.$prod['idcontactos'].'">'.$prod['full_name'].'-'.$prod['correo'].'-'.$prod['telefono'].'-'.$prod['imagencontactos'].'</option>';
                                             }
                                         ?>
                                     </select>
                                 </div>
                                 <p class="text-center"><button type="submit" class="btn btn-danger">Eliminar</button></p>
                                 <br>
                                 <div id="res-form-del-cont" style="width: 100%; text-align: center; margin: 0;"></div>
                             </form>
                         </div>
                    </div>
                </div>
             </div>
               <!--==============================Panel biblioteca===============================-->
               <div role="tabpanel" class="tab-pane fade" id="biblioteca">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <br><br>
                        <div id="add-product">
                            <h2 class="text-primary text-center"><small><i class="fa fa-plus"></i></small>&nbsp;&nbsp;Agregar Contenido</h2>
                            <form role="form" action="process/regbiblioteca.php" method="post" enctype="multipart/form-data">
                              <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control"  placeholder="Nombre" required maxlength="80" name="Nombre" id='nombre'>
                              </div> 
                              <div class="form-group">
                                <label>Descripcion</label>
                                <textarea type="text"  class="form-control"  placeholder="Texto" required maxlength="1200" name="descripcion"></textarea>
                              </div>       
                              <div class="form-group">
                                <label>Imagen</label>
                                <input type="file" name="imagenlibro">
                                <p class="help-block">Formato de imagenes admitido png, jpg, gif, jpeg</p>
                              </div>
                                <input type="hidden"  name="admin-name" value="<?php echo $_SESSION['nombreAdmin'] ?>">
                                <input type="hidden"  name="idbiblioteca" value="<?php echo $_SESSION['nombreAdmin'] ?>">
                              <p class="text-center"><button type="submit" class="btn btn-primary">Agregar a Contenido</button></p>
                              <div id="res-form-add" style="width: 100%; text-align: center; margin: 0;"></div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <br><br>
                        <div id="del-lib-form">
                            <h2 class="text-danger text-center"><small><i class="fa fa-trash-o"></i></small>&nbsp;&nbsp;Eliminar Contenido</h2>
                             <form action="process/delbiblioteca.php" method="post" role="form">
                                 <div class="form-group">
                                     <label>Contenido</label>
                                     <select class="form-control" name="biblioteca-code">
                                         <?php 
                                             $novedad=  ejecutarSQL::consultar("select * from biblioteca");
                                             while($prod=mysqli_fetch_array($novedad)){ 
                                                 echo '<option value="'.$prod['idbiblioteca'].'">'.$prod['nombre'].'-'.$prod['descripcion'].'-'.$prod['imagenlibro'].'</option>';
                                             }
                                         ?>
                                     </select>
                                 </div>
                                 <p class="text-center"><button type="submit" class="btn btn-danger">Eliminar</button></p>
                                 <br>
                                 <div id="res-form-del-lib" style="width: 100%; text-align: center; margin: 0;"></div>
                             </form>
                         </div>
                    </div>
                </div>
             </div>
                   <!--==============================Panel pedidos===============================-->
                <div role="tabpanel" class="tab-pane fade" id="Pedidos">
                    <div class="row">
                        <div class="col-xs-12">
                            <br><br>
                            <div id="del-pedido">
                                <h2 class="text-danger text-center"><small><i class="fa fa-trash-o"></i></small>&nbsp;&nbsp;Eliminar pedido</h2>
                                <form action="process/delPedido.php" method="post" role="form">
                                    <div class="form-group">
                                        <label>Pedidos</label>
                                        <select class="form-control" name="num-pedido">
                                            <?php 
                                                $pedidoC=  ejecutarSQL::consultar("select * from venta");
                                                while($pedidoD=mysqli_fetch_array($pedidoC)){
                                                    echo '<option value="'.$pedidoD['NumPedido'].'">Pedido #'.$pedidoD['NumPedido'].' - Estado('.$pedidoD['Estado'].') - Fecha('.$pedidoD['Fecha'].')</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <p class="text-center"><button type="submit" class="btn btn-danger">Eliminar pedido</button></p>
                                    <br>
                                    <div id="res-form-del-pedido" style="width: 100%; text-align: center; margin: 0;"></div>
                                </form>
                            </div>
                            <br><br>
                             <div class="panel panel-info">
                               <div class="panel-heading text-center"><i class="fa fa-refresh fa-2x"></i><h3>Actualizar estado de pedido</h3></div>
                              <div class="table-responsive">
                                  <table class="table table-bordered">
                                      <thead class="">
                                          <tr>
                                              <th class="text-center">#</th>
                                              <th class="text-center">Fecha</th>
                                              <th class="text-center">Cliente</th>
                                              <th class="text-center">Descuento</th>
                                              <th class="text-center">Total</th>
                                              <th class="text-center">Estado</th>
                                              <th class="text-center">Opciones</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php
                                            $pedidoU=  ejecutarSQL::consultar("select * from venta");
                                            $upp=1;
                                            while($peU=mysqli_fetch_array($pedidoU)){
                                                echo '
                                                    <div id="update-pedido">
                                                      <form method="post" action="process/updatePedido.php" id="res-update-pedido-'.$upp.'">
                                                        <tr>
                                                            <td>'.$peU['NumPedido'].'<input type="hidden" name="num-pedido" value="'.$peU['NumPedido'].'"></td>
                                                            <td>'.$peU['Fecha'].'</td>
                                                            <td>';
                                                                $conUs= ejecutarSQL::consultar("select * from cliente where Codigo='".$peU['Codigo']."'");
                                                                while($UsP=mysqli_fetch_array($conUs)){
                                                                    echo $UsP['Nombre'];
                                                                }
                                                    echo   '</td>
                                                            <td>'.$peU['Descuento'].'%</td>
                                                            <td>'.$peU['TotalPagar'].'</td>
                                                            <td>
                                                                <select class="form-control" name="pedido-status">';
                                                                    if($peU['Estado']=="Pendiente"){
                                                                       echo '<option value="Pendiente">Pendiente</option>'; 
                                                                       echo '<option value="Entregado">Entregado</option>'; 
                                                                    }
                                                                    if($peU['Estado']=="Entregado"){
                                                                       echo '<option value="Entregado">Entregado</option>';
                                                                       echo '<option value="Pendiente">Pendiente</option>'; 
                                                                    }
                                                    echo        '</select>
                                                            </td>
                                                            <td class="text-center">
                                                                <button type="submit" class="btn btn-sm btn-primary button-UPPE" value="res-update-pedido-'.$upp.'">Actualizar</button>
                                                                <div id="res-update-pedido-'.$upp.'" style="width: 100%; margin:0px; padding:0px;"></div>
                                                            </td>
                                                        </tr>
                                                      </form>
                                                    </div>
                                                    ';
                                                $upp=$upp+1;
                                            }
                                          ?>
                                      </tbody>
                                  </table>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include './inc/footer.php'; ?>
</body>
</html>