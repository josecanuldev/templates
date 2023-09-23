<?php
(isset($_REQUEST['idEmpresa']) or $_REQUEST['idEmpresa'] != '' or $_REQUEST['idEmpresa'] != 0) ? $idEmpresa = $_REQUEST['idEmpresa'] : header('Location: listEmpresa.php');
function __autoload($ClassName){
    include('clases/'.$ClassName.".php");
}
$seguridad = new seguridad();
$seguridad->candado();
$_MOD = '';
$sort = '';

if(isset($_REQUEST['idProyecto'])){
	$idProyecto = $_REQUEST['idProyecto'];
	$operacion = 'modificarProyecto';
	$palabra = 'Editar Proyecto';
	$_MOD = '1';
	$proyecto = new proyecto($idProyecto);
	$proyecto -> getProyecto();
	
	($proyecto -> portada != '') ? $img = '<img src="../img/proyecto/'.$proyecto -> portada.'" width="auto" height="250" class="paddingx20"/>' : $img = '';
}
else{
	$idProyecto = 0;
	$operacion = 'agregarProyecto';
	$palabra = 'Nuevo Proyecto';
	$_MOD = '0';
	$img = '';
	$proyecto = new proyecto($id);
}

$usuarioPlataforma = new usuarioPlataforma();
$listUP = $usuarioPlataforma -> listUsuarioPlataforma();
$usuarioEmpresa = new usuarioEmpresa();
$usuarioEmpresa -> idEmpresa = $idEmpresa;
$listUE = $usuarioEmpresa -> listUsuarioEmpresa();
$usuarioxproyecto = new usuarioxproyecto($idProyecto);
$permisosPlataforma = new permisosPlataforma();
$permisosPlataforma -> listTipoPermisosPlataforma(2);
$permisoxproyecto = new permisoxproyecto(0,$idProyecto);
$clave = 'per_mod_proyecto';
$clave2='per_sort_img_proyecto';
$sort='galeriaProyecto';
$handle = "";
if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave2)==0){
  $handle = "";
}else{
  $handle = 'handle sortimg';
} 
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php include 'head.php';?>
		<title>Formulario | Proyecto</title>
	</head>
	<body>
		<header>
			<?php include 'header.php';?>
		</header>
		<!--wrapper es el que contiene a toda la pagina-->
    	<div id="wrapper" class="wrapper-movil">
    		<?php include 'menu.php';?>
    		<!-- Page content Sección del contenido de la pagina-->
	        <div id="page-content-wrapper">
	        	<!-- Keep all page content within the page-content inset div! -->
            	<div class="page-content inset">
            		<div class="row rowedit">
            			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
	                        <p class="titulo"><?=$palabra?></p>
	                    </div>
	                    <form id="form-validation" style="display: inline" name="form1" action="operaciones.php" method="post" onsubmit="return validar_campos()" enctype="multipart/form-data">
                    		<input type="hidden" name="MAX_FILE_SIZE" value="600000000"/>
                    		<input type="hidden" value="<?=$proyecto -> idProyecto?>" name="idProyecto">
              				<input type="hidden" value="<?=$idEmpresa?>" name="idEmpresa">
                    		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    			<button type="submit" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> name="operaciones" value="<?=$operacion?>" class="buttonguardar">Guardar y Publicar</button>
                   			</div>
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    	<hr class="hrmenu">
		                    </div>
		                    <div class="clearfix"></div>
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    	<div class='notifications top-right'></div>
		                    </div>
		                    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
		                    	<ul class="nav nav-tabs" role="tablist">
					              	<li role="presentation" class="active"><a href="#usuarios" aria-controls="usuarios" role="tab" data-toggle="tab">Usuarios</a></li>
					              	<li role="presentation"><a href="#datos" aria-controls="datos" role="tab" data-toggle="tab">Datos del proyecto</a></li>
					              	<li role="presentation"><a href="#cuentas" aria-controls="cuentas" role="tab" data-toggle="tab">Cuentas</a></li>
					              	<li role="presentation"><a href="#galeria" aria-controls="galeria" role="tab" data-toggle="tab">Galeria</a></li>
					              	<li role="presentation"><a href="#archivos" aria-controls="archivos" role="tab" data-toggle="tab">Archivos</a></li>
					              	<li role="presentation"><a href="#proveedores" aria-controls="proveedores" role="tab" data-toggle="tab">Proveedores</a></li>
					            </ul>					            
					            <div class="tab-content">
					            	<div role="tabpanel" class="tab-pane fade in active" id="usuarios">
              							<h2>Usuarios del proyecto:</h2>
							            <div class="input-group form-group">
							                <span class="input-group-addon">Usuarios Plataforma</span>
							                <select name="idUsuarioPlataforma[]" id="usuariosPlataforma" multiple="multiple" class="form-control select-plugin">
							            <?php               
							                foreach ($listUP as $userP) {
							                    $usuarioxproyecto -> idUsuario = $userP['idUsuarioPlataforma'];
							                    $usuarioxproyecto -> tipo = 'plataforma';
							                    if($usuarioxproyecto -> existeProyectoxUsuario())
							                       	$selecUserP = ' selected ';
							                    else
							                       	$selecUserP = '';
							            ?>
							                   	<option <?=$selecUserP?> value="<?=$userP['idUsuarioPlataforma']?>"><?=$userP['nombre'].' '.$userP['apellido']?></option>
							            <?php
							                }
							            ?>
							                </select>
							            </div>
							            <div class="input-group form-group">
							                <span class="input-group-addon">Usuarios Cliente</span>
							                <select name="idUsuarioEmpresa[]" multiple="multiple" class="form-control select-plugin">
							            <?php               
							                foreach ($listUE as $userE) {
							                    $usuarioxproyecto -> idUsuario = $userE['idUsuarioEmpresa'];
							                    $usuarioxproyecto -> tipo = 'empresa';
							                    if($usuarioxproyecto -> existeProyectoxUsuario())
							                     	$selecUserE = ' selected ';
							                    else
							                      	$selecUserE = '';
							            ?>
							                   	<option <?=$selecUserE?> value="<?=$userE['idUsuarioEmpresa']?>"><?=$userE['nombre']?></option>
							            <?php
							                }
							            ?>
							                </select>
							            </div>
							            <div class="alert alert-success">Permisos para los usuarios Plataforma</div>
							        <?php
							            $usuarioxproyecto -> tipo = 'plataforma';
							            $usuarioxproyecto -> getUsuarioxProyecto();
							            foreach ($usuarioxproyecto -> usuario as $usuarioP) {
							        ?>
							            	<h4><?=$usuarioP['nombre']?></h4>
							        	<?php							        		
							                foreach ($permisosPlataforma->resultados as $per) {
								                $permisoxproyecto -> idPermiso = $per['idPermisosPlataforma'];
								                $permisoxproyecto -> idUsuario = $usuarioP['idUsuario'];
								                $permisoxproyecto -> tipo = 'plataforma';
								                ($permisoxproyecto -> existePermisoxProyecto()) ? $checkedPxP = 'checked' : $checkedPxP = '';
							            ?>
							                   	<!--<label class="checkbox-inline">
							                       	<input <?=$checkedPxP?> type="checkbox" name="idPermisoP<?=$usuarioP['idUsuario']?>[]" value="<?=$per['idPermiso']?>"> <?=$per['titulo']?>
							                   	</label>-->     
							                   	<input type="checkbox" id="perPlat<?=$per['idPermisosPlataforma'].'-'.$usuarioP['idUsuario']?>" name="idPermisoP<?=$usuarioP['idUsuario']?>[]" <?=$checkedPxP?> value="<?=$per['idPermisosPlataforma']?>">
                                   	 			<label for="perPlat<?=$per['idPermisosPlataforma'].'-'.$usuarioP['idUsuario']?>"><span></span> <?=$per['titulo']?></label>
								       	<?php
								            }
								        ?>
								    <?php
								        }
								    ?>
							            <div class="alert alert-warning">Permisos para los usuarios Empresa</div>
							        <?php
							            $usuarioxproyecto -> tipo = 'empresa';
							            $usuarioxproyecto -> getUsuarioxProyecto();
							            foreach ($usuarioxproyecto -> usuario as $usuarioE) {
							        ?>
							                <h4><?=$usuarioE['nombre']?></h3>
							            <?php
							                foreach ($permisosPlataforma->resultados as $per) {
								                $permisoxproyecto -> idPermiso = $per['idPermisosPlataforma'];
								               	$permisoxproyecto -> idUsuario = $usuarioE['idUsuario'];
								                $permisoxproyecto -> tipo = 'empresa';
								                ($permisoxproyecto -> existePermisoxProyecto()) ? $checkedPxE = 'checked' : $checkedPxE = '';
							            ?>
							                    <!--<label class="checkbox-inline">
							                       	<input <?=$checkedPxE?> type="checkbox" name="idPermisoE<?=$usuarioE['idUsuario']?>[]" value="<?=$per['idPermiso']?>"> <?=$per['titulo']?>
							                    </label>-->
							                    <input type="checkbox" id="perEmp<?=$per['idPermisosPlataforma'].'-'.$usuarioE['idUsuario']?>" name="idPermisoE<?=$usuarioE['idUsuario']?>[]" <?=$checkedPxE?> value="<?=$per['idPermisosPlataforma']?>">
                                   	 			<label for="perEmp<?=$per['idPermisosPlataforma'].'-'.$usuarioE['idUsuario']?>"><span></span> <?=$per['titulo']?></label>
								        <?php
								            }
								        ?>
							        <?php
							            }
							        ?>
              						</div><!--CIERRA DIV TABPANEL #USUARIOS-->
              						<div role="tabpanel" class="tab-pane fade" id="datos">
						                <h2>Datos del proyecto:</h2>
						                <div class="form-group">
						                  	<center>
							                	<span class="textHelper">Previsualizar:</span>
						                    	<div id="preview"><?=$img?></div>
						                    	<input id="files" onchange="showMyImage('preview',this)" name="portada" type="file" class="upload"/>
						                    	<p class="text-center textHelper espacios">
							                        Tipo de archivos permitidos: jpg, jpeg, png, gif.
							                        <br>
							                        Tamaño máximo de archivo: 4MB.
							                    </p>		
							                </center>
						               	</div>
							            <div class="input-group form-group">
							                <span class="input-group-addon">Nombre</span>
							                <input type="text" class="form-control" placeholder="Nombre del proyecto" value="<?=$proyecto -> nombre?>" name="nombre">
							            </div>
							            <div class="input-group form-group">
							                <span class="input-group-addon">Asunto</span>
							                <input type="text" class="form-control" placeholder="Asunto del proyeco" value="<?=$proyecto -> asunto?>" name="asunto">
							            </div>
							            <div class="input-group form-group">
							              	<span class="input-group-addon">Fecha</span>
							               	<input type="text" class="form-control" placeholder="Ingrese la fecha del proyecto" value="<?=$proyecto -> fecha?>" name="fecha">
							            </div>
							            <div class="input-group form-group">
							               	<span class="input-group-addon">Presupuesto</span>
							               	<input type="text" class="form-control" placeholder="Ingrese el presupuesto del proyecto" value="<?=$proyecto -> presupuesto?>" name="presupuesto">
							            </div>
							            <div class="input-group form-group">
							              	<span class="input-group-addon">Descripción</span>
							               	<textarea class="form-control" placeholder="Ingrese una descripcion del proyecto"  name="descripcion"><?=$proyecto -> descripcion?></textarea>
							            </div>
							            <div class="input-group form-group">
							               	<span class="input-group-addon">Avance del proyecto</span>
							               	<input type="text" class="form-control" placeholder="Ingrese el % del avance del proyecto" value="<?=$proyecto -> porcentajeAvance?>" name="porcentajeAvance">
							            </div>
							            <div class="input-group form-group">
							               	<span class="input-group-addon">Fecha Avance del proyecto</span>
							              	<input type="text" class="form-control" placeholder="Ingrese la fecha del avance del proyecto" value="<?=$proyecto -> fechaPorcentaje?>" name="fechaPorcentaje">
							            </div> 
							            <div class="input-group form-group">
							               	<span class="input-group-addon">Latitud</span>
							               	<input type="text" class="form-control" placeholder="Ingrese la latitud del proyecto desde Google Maps" value="<?=$proyecto -> latitud?>" name="latitud">
							               	<span class="input-group-addon">Longitud</span>
							               	<input type="text" class="form-control" placeholder="Ingrese la longitud del proyecto desde Google Maps" value="<?=$proyecto -> longitud?>" name="longitud">
							            </div>    
							            <div class="form-group">
							                <center>
							           	<?php 
							           		if($proyecto -> archivoAvance != ''){ ?>
							                	<img src="../img/icons/icon-pdf.png" width="auto"> <a href="../documentos/avanceProyecto/<?=$proyecto -> archivoAvance?>" target="_blank"> <?=$proyecto -> archivoAvance?></a></br></br>
							            <?php 
							        		}
							        	?>
							                   	<label for="exampleInputFile">Seleccione Programa del proyecto</label>
							                    <input type="file" name="archivoAvance">
							                    <p class="text-center textHelper espacios">
							                        Tipo de archivos permitidos: .pdf
							                        <br>
							                        Tamaño máximo de archivo: 4MB.
							                    </p>
							                </center>
							            </div>
              						</div><!--CIERRA DIV TABPANEL #DATOS-->
              						<div role="tabpanel" class="tab-pane fade" id="cuentas">
							            <h2>Estado de cuenta:</h2>
							            <div class="alert alert-info">ADICIONALES <i class="glyphicon glyphicon-plus-sign pull-right manita" onclick="agregarCuentas('adicional')"></i></div>
							            <div id="adicionalContent">
							        <?php
							            $proyecto -> listarCuenta('adicional');
							            foreach ($proyecto -> cuentaAdicional as $adicional) {
							       	?>
								            <div class="container-ad" id="adicionalMod-<?=$adicional['idCuenta']?>">
									            <div class="input-group form-group">
										            <span class="input-group-addon">Concepto:</span>
										            <input type="hidden" name="ad_idCuenta[]" value="<?=$adicional['idCuenta']?>">
										            <input type="text" class="form-control" placeholder="Ingrese el concepto del adicional" value="<?=$adicional['concepto']?>" name="ad_conceptoMod[]">
										            <span class="input-group-addon">Cantidad:</span>
										            <input type="text" class="form-control" placeholder="Ingrese la cantidad del adicional" value="<?=$adicional['cantidad']?>" name="ad_cantidadMod[]">
										            <span onclick="eliminarElementosProyecto('adicionalMod-<?=$adicional['idCuenta']?>', '<?=$adicional['idCuenta']?>', 'true', 'deleteCuenta')" class="input-group-addon manita"><i class="glyphicon glyphicon-remove-circle"></i></span>
									            </div> 
									           	<div class="input-group form-group">
										            <span class="input-group-addon">Fecha:</span>
										            <input type="text" class="form-control" placeholder="Ingrese la fecha para el adicional" value="<?=$adicional['fecha']?>" name="ad_fechaMod[]">
									            </div>
									            <div class="input-group form-group">
										            <span class="input-group-addon">Descripción:</span>
										            <textarea class="form-control" rows="2" name="ad_descripcionMod[]"><?=$adicional['descripcion']?></textarea>
									            </div>
								            </div>
							        <?php
							            }
							        ?>							                  
							            </div>   
							            <div class="alert alert-success">ABONOS <i class="glyphicon glyphicon-plus-sign pull-right manita" onclick="agregarCuentas('abono')"></i></div>
							            <div id="abonoContent">
							        <?php
							            $proyecto -> listarCuenta('abono');
							            foreach ($proyecto -> cuentaAbono as $abono) {
							        ?>
								           	<div class="container-ab" id="abonoMod-<?=$abono['idCuenta']?>">
									            <div class="input-group form-group">
									                <span class="input-group-addon">Concepto:</span>
									                <input type="hidden" name="ab_idCuenta[]" value="<?=$abono['idCuenta']?>">
									                <input type="text" class="form-control" placeholder="Ingrese el concepto del abono" value="<?=$abono['concepto']?>" name="ab_conceptoMod[]">
									                <span class="input-group-addon">Cantidad:</span>
									                <input type="text" class="form-control" placeholder="Ingrese la cantidad del abono" value="<?=$abono['cantidad']?>" name="ab_cantidadMod[]">
									                <span onclick="eliminarElementosProyecto('abonoMod-<?=$abono['idCuenta']?>', '<?=$abono['idCuenta']?>', 'true', 'deleteCuenta')" class="input-group-addon manita"><i class="glyphicon glyphicon-remove-circle"></i></span>
									            </div> 
									            <div class="input-group form-group">
									                <span class="input-group-addon">Fecha:</span>
									                <input type="text" class="form-control" placeholder="Ingrese la fecha para el abono" value="<?=$abono['fecha']?>" name="ab_fechaMod[]">
									            </div>
									            <div class="input-group form-group">
									                <span class="input-group-addon">Descripción:</span>
									                <textarea class="form-control" rows="2" name="ab_descripcionMod[]"><?=$abono['descripcion']?></textarea>
									            </div>
								            </div>
							        <?php
							            }
							        ?>      
							            </div>                
						            </div><!--CIERRA DIV TABPANEL #CUENTAS-->
						            <div role="tabpanel" class="tab-pane fade" id="galeria">
							            <h2>Galería:</h2>
							            <div class="form-group">
							                <center> 
							                   	<label for="exampleInputFile">Seleccione Imagenes del proyecto</label>
							                   	<input type="file" name="galeria[]" multiple>
							                    <p class="help-block">Archivos JPG o PNG. Máximo 4MB</p>
							                </center>
							            </div>
							            <div class="row">
							        <?php
							            $proyecto -> listarImgProyecto();
							            foreach ($proyecto -> imgProyecto as $img) {
							        ?>
							            <div class="col-md-4">
							            	<div class="img-back" style="background-image: url('../img/proyecto/secundarias/<?=$img['ruta']?>');"></div>
							            </div>
							        <?php
							            }
							        ?>
							                  
							            </div>
							        </div><!--CIERRA DIV TABPANEL #GALERIA-->
							        <div role="tabpanel" class="tab-pane fade" id="archivos">  
						               	<h2>Archivos:</h2>
						               	<div class="alert alert-warning">CARPETAS <i class="glyphicon glyphicon-plus-sign pull-right manita" onclick="agregarCarpetas('archivo')"></i></div>
						               	<div id="archivoContentFiles">
							        <?php
							            $proyecto -> listarCarpeta('archivo'); 
							            foreach ($proyecto -> carpetaArchivo as $carpeta){
							        ?>
							                <div id="archivoMod-<?=$carpeta['idCarpeta']?>">
							                    <div class="input-group form-group">
								                    <span class="input-group-addon">Nombre:</span>
								                    <input type="text" class="form-control" placeholder="Ingrese el nombre de la carpeta" value="<?=$carpeta['titulo']?>" name="ar_carpetaTituloMod[]">
								                    <input type="hidden" name="ar_idCarpeta[]" value="<?=$carpeta['idCarpeta']?>">
								                    <div class="input-group-btn">
										                <button type="button" onclick="agregarArchivos(<?=$carpeta['idCarpeta']?>, 'archivo', 'archivoMod')"  class="btn btn-default"><i class="glyphicon glyphicon-plus-sign"></i></button>
										                <button type="button" onclick="eliminarElementosProyecto('archivoMod-<?=$carpeta['idCarpeta']?>', <?=$carpeta['idCarpeta']?>, 'true', 'deleteCarpeta')" class="btn btn-default" ><i class="glyphicon glyphicon-trash"></i></button>
								                    </div>
								                </div>
							                   	<div id="archivoMod-<?=$carpeta['idCarpeta']?>-content">
							              	<?php
							                	$proyecto -> listarArchivosCarpeta($carpeta['idCarpeta'], 'archivo');
							                	foreach ($proyecto -> listArchivos as $archivo) {
							              	?>
							                      	<div id="archivoMod-<?=$archivo['idArchivosCarpeta']?>-<?=$carpeta['idCarpeta']?>">
								                        <div class="form-group">
									                        <center>
									                            <img src="../img/icons/icon-pdf.png" width="auto"> <a href="documentos/archivos/<?=$archivo['ruta']?>" target="_blank"> <?=$archivo['ruta']?></a></br></br>
									                            <label for="exampleInputFile">Seleccione El archivo</label>
									                            <input type="file" name="archivo_<?=$carpeta['idCarpeta']?>_archivoMod[]">
									                            <p class="help-block">Archivos PDF. Máximo 2MB</p>
									                        </center>
								                        </div>
									                    <div class="input-group form-group">
									                        <span class="input-group-addon">Nombre Archivo:</span>
									                        <input type="hidden" name="<?=$carpeta['idCarpeta']?>_idArchivoCarpeta[]" value="<?=$archivo['idArchivosCarpeta']?>"> 
									                        <input type="text" class="form-control" placeholder="Ingrese el nombre del archivo" value="<?=$archivo['titulo']?>" name="archivo_<?=$carpeta['idCarpeta']?>_archivo_tituloMod[]">
									                       	<span class="input-group-addon">Fecha:</span>
									                        <input type="text" class="form-control" placeholder="Ingrese la fecha del archivo" value="<?=$archivo['fecha']?>" name="archivo_<?=$carpeta['idCarpeta']?>_archivo_fechaMod[]">
									                        <div class="input-group-btn">
									                           	<button type="button" onclick="eliminarElementosProyecto('archivoMod-<?=$archivo['idArchivosCarpeta']?>-<?=$carpeta['idCarpeta']?>', <?=$archivo['idArchivosCarpeta']?>, 'true', 'deleteArchivo')" class="btn btn-default" ><i class="glyphicon glyphicon-trash"></i></button>
									                        </div>
									                    </div>
							                     	</div>
							              	<?php
							                	}
							              	?>
							                    </div>
							                </div>
							        <?php
							              	}
							        ?>      
						                </div>
						            </div><!--CIERRA DIV TABPANEL #ARCHIVOS-->
						            <div role="tabpanel" class="tab-pane fade" id="proveedores">
							            <h2>Proveedores:</h2>
							            <div class="alert alert-danger">CARPETAS <i class="glyphicon glyphicon-plus pull-right manita" onclick="agregarCarpetas('proveedor')"></i></div>
							            <div id="proveedorContentFiles">
								    <?php
								        $proyecto -> listarCarpeta('proveedor'); 
								        foreach ($proyecto -> carpetaProveedor as $carpetaP){
								    ?>
							                <div id="proveedorMod-<?=$carpetaP['idCarpeta']?>">
							                   	<div class="input-group form-group">
								                    <span class="input-group-addon">Nombre:</span>
								                    <input type="text" class="form-control" placeholder="Ingrese el nombre de la carpeta" value="<?=$carpetaP['titulo']?>" name="pr_carpetaTituloMod[]">
								                    <input type="hidden" name="pr_idCarpeta[]" value="<?=$carpetaP['idCarpeta']?>">
								                    <div class="input-group-btn">
								                        <button type="button" onclick="agregarArchivos(<?=$carpetaP['idCarpeta']?>, 'proveedor', 'proveedorMod')"  class="btn btn-default"><i class="glyphicon glyphicon-plus-sign"></i></button>
								                        <button type="button" onclick="eliminarElementosProyecto('proveedorMod-<?=$carpetaP['idCarpeta']?>', <?=$carpetaP['idCarpeta']?>, 'true', 'deleteCarpeta')" class="btn btn-default" ><i class="glyphicon glyphicon-trash"></i></button>
								                    </div>
							                   	</div>
							                 	<div id="proveedorMod-<?=$carpetaP['idCarpeta']?>-content">
							              	<?php
							                	$proyecto -> listarArchivosCarpeta($carpetaP['idCarpeta'], 'proveedor');
							                	foreach ($proyecto -> listArchivosProveedor as $archivoP) {
							              	?>
							                      	<div id="proveedorMod-<?=$archivoP['idArchivosCarpeta']?>-<?=$carpetaP['idCarpeta']?>">
								                        <div class="form-group">
								                          	<center>
								                            	<img src="../img/icons/icon-pdf.png" width="auto"> <a href="documentos/proveedores/<?=$archivoP['ruta']?>" target="_blank"> <?=$archivoP['ruta']?></a></br></br>
								                            	<label for="exampleInputFile">Seleccione El archivo</label>
								                            	<input type="file" name="proveedor_<?=$carpetaP['idCarpeta']?>_archivoMod[]">
								                            	<p class="help-block">Archivos PDF. Máximo 2MB</p>
								                          	</center>
								                        </div>
							                        	<div class="input-group form-group">
							                          		<span class="input-group-addon">Nombre Archivo:</span>
							                          		<input type="hidden" name="<?=$carpetaP['idCarpeta']?>_idProveedorCarpeta[]" value="<?=$archivoP['idArchivosCarpeta']?>"> 
							                          		<input type="text" class="form-control" placeholder="Ingrese el nombre del archivo" value="<?=$archivoP['titulo']?>" name="proveedor_<?=$carpetaP['idCarpeta']?>_archivo_tituloMod[]">
							                          		<span class="input-group-addon">Fecha:</span>
							                          		<input type="text" class="form-control" placeholder="Ingrese la fecha del archivo" value="<?=$archivoP['fecha']?>" name="proveedor_<?=$carpetaP['idCarpeta']?>_archivo_fechaMod[]">
							                          		<div class="input-group-btn">
							                            		<button type="button" onclick="eliminarElementosProyecto('proveedorMod-<?=$archivoP['idArchivosCarpeta']?>-<?=$carpetaP['idCarpeta']?>', <?=$archivoP['idArchivosCarpeta']?>, 'true', 'deleteArchivo')" class="btn btn-default" ><i class="glyphicon glyphicon-trash"></i></button>
							                          		</div>
							                        	</div>
							                      	</div>
							              	<?php
							                	}
							              	?>
							                    </div>
							                </div>
							        <?php
							            }
							        ?>            
							            </div>                
							        </div><!--CIERRA DIV TABPANEL #PROVEEDORES-->
					           	</div><!--CIERRA DIV CONTENT-->
		                    	
		                    </div>
		                    <div class="clearfix"></div>
		                    <!--Este div contiene la barra inferior-->
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    	<hr class="hrmenu">
		                    </div>
		                    <div class="clearfix"></div>
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    	<button type="submit" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> name="operaciones" value="<?=$operacion?>" class="buttonguardar">Guardar y Publicar</button>
		                    </div>
                    	</form>
            		</div>
            	</div>
	        </div>
    	</div>
	</body>
<!--MODAL CARGANDO-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog">
  	<div class="modal-content">
  	  <div class="modal-body">	
    	<div class="progress progress-striped active" style="margin-top: 50px">
			<div class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
				<span class="sr-only">45% Complete</span>
			</div>
		</div>
	</div>
	<div class="modal-footer">
        	Esto puede tomar unos minutos, porfavor no cierres la ventana..
   	</div>
   </div>
  </div>
</div>	
	<footer id="footer">
		<?php include 'footer.php';?>
		<script src="js/functionsProyecto.js"></script>
	</footer>
</html>	