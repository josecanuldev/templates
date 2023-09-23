<?php
session_start();
function __autoload($nombre_clase) {
	//$nombre_clase = strtolower($nombre_clase);
    include 'clases/'.$nombre_clase .'.php';
}
$operaciones=$_REQUEST['operaciones'];

switch($operaciones){
///////////////////////////////////////////////
///	ORDENAR ELEMENTOS
///////////////////////////////////////////////
	case 'ordenar':
		if($_REQUEST['desde'] == 'slide'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			$_initFor = $_REQUEST['initfor'];
			$_hastaFor = count($val2) + $_initFor - 1;
			$_index = 0;
			for($i = $_initFor; $i <= $_hastaFor; $i++)
			{
				$slide = new slide($val2[$_index]);
				$slide -> updateOrdenSlide($i);
				$_index++;
			}
		}

    if($_REQUEST['desde'] == 'banner'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			$_initFor = $_REQUEST['initfor'];
			$_hastaFor = count($val2) + $_initFor - 1;
			$_index = 0;
			for($i = $_initFor; $i <= $_hastaFor; $i++)
			{
				$slide = new banner($val2[$_index]);
				$slide -> updateOrdenSlide($i);
				$_index++;
			}
		}

		if($_REQUEST['desde'] == 'producto'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			$_initFor = $_REQUEST['initfor'];
			$_hastaFor = count($val2) + $_initFor - 1;
			$_index = 0;
			for($i = $_initFor; $i <= $_hastaFor; $i++)
			{
				$producto = new producto($val2[$_index]);
				$producto -> updateOrdenProducto($i);
				$_index++;
			}
		}
		if($_REQUEST['desde'] == 'galeriaProducto'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			for($i=0; $i < count($val2); $i++)
			{
				$producto = new producto();
				$producto -> modificarOrdenGaleria($val2[$i], $i);
			}
		}
		if($_REQUEST['desde'] == 'categoria'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			$_initFor = $_REQUEST['initfor'];
			$_hastaFor = count($val2) + $_initFor - 1;
			$_index = 0;
			for($i = $_initFor; $i <= $_hastaFor; $i++)
			{
				$categoria = new categoria($val2[$_index]);
				$categoria -> updateOrdenCategoria($i);
				$_index++;
			}
		}
		if($_REQUEST['desde'] == 'talla'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			$_initFor = $_REQUEST['initfor'];
			$_hastaFor = count($val2) + $_initFor - 1;
			$_index = 0;
			for($i = $_initFor; $i <= $_hastaFor; $i++)
			{
				$talla = new talla($val2[$_index]);
				$talla -> updateOrdenTalla($i);
				$_index++;
			}
		}

		if($_REQUEST['desde'] == 'etiqueta'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			$_initFor = $_REQUEST['initfor'];
			$_hastaFor = count($val2) + $_initFor - 1;
			$_index = 0;
			for($i = $_initFor; $i <= $_hastaFor; $i++)
			{
				$etiqueta = new etiqueta($val2[$_index]);
				$etiqueta -> updateOrdenEtiqueta($i);
				$_index++;
			}
		}
		if($_REQUEST['desde'] == 'blog'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			$_initFor = $_REQUEST['initfor'];
			$_hastaFor = count($val2) + $_initFor - 1;
			$_index = 0;
			for($i = $_initFor; $i <= $_hastaFor; $i++)
			{
				$blog = new blog($val2[$_index]);
				$blog -> updateOrdenBlog($i);
				$_index++;
			}
		}

		if($_REQUEST['desde'] == 'galeriaBlog'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			for($i=0; $i < count($val2); $i++)
			{
				$blog = new blog();
				$blog -> modificarOrdenGaleriaBlog($val2[$i], $i);
			}
		}

		if($_REQUEST['desde'] == 'noticia'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			for($i=0; $i < count($val2); $i++)
			{
				$noticia = new noticia($val2[$i]);
				$noticia -> ordenaNoticia($i);

			}
		}
		if($_REQUEST['desde'] == 'seccion'){
			$val2 = ($_REQUEST['idorden']);
			//$val2 = array_reverse($val);
			for($i=0; $i < count($val2); $i++)
			{
				$seccion = new seccion($val2[$i]);
				$seccion -> updateOrdenSeccion($i);
			}
		}
		if($_REQUEST['desde'] == 'ingrediente'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			$_initFor = $_REQUEST['initfor'];
			$_hastaFor = count($val2) + $_initFor - 1;
			$_index = 0;
			for($i = $_initFor; $i <= $_hastaFor; $i++)
			{
				$ingrediente = new ingrediente($val2[$_index]);
				$ingrediente -> updateOrdenIngrediente($i);
				$_index++;
			}
		}
		if($_REQUEST['desde'] == 'consideracion'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			$_initFor = $_REQUEST['initfor'];
			$_hastaFor = count($val2) + $_initFor - 1;
			$_index = 0;
			for($i = $_initFor; $i <= $_hastaFor; $i++)
			{
				$consideracion = new consideracion($val2[$_index]);
				$consideracion -> updateOrdenConsideracion($i);
				$_index++;
			}
		}
		if($_REQUEST['desde'] == 'incentivo'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			$_initFor = $_REQUEST['initfor'];
			$_hastaFor = count($val2) + $_initFor - 1;
			$_index = 0;
			for($i = $_initFor; $i <= $_hastaFor; $i++)
			{
				$incentivo = new incentivo($val2[$_index]);
				$incentivo -> updateOrdenIncentivo($i);
				$_index++;
			}
		}

		/** Servicio */
		if ($_REQUEST['desde'] == 'servicio') {
			foreach ($_REQUEST['idorden'] as $orden => $id) {
				$servicio = new servicio($id);
				$servicio -> editarOrdenServicio($orden);
			}
		}

		/** Tour */
		if ($_REQUEST['desde'] == 'experiencia') {
			foreach ($_REQUEST['idorden'] as $orden => $id) {
				$experiencia = new experiencia($id);
				$experiencia -> editarOrdenExperiencia($orden);
			}
		}

		/** Galeria */
		if ($_REQUEST['desde'] == 'galeria') {
			foreach ($_REQUEST['idorden'] as $orden => $id) {
				$galeria = new galeria($id);
				$galeria -> editarOrdenGaleria($orden);
			}
		}

		/** Características */
		if ($_REQUEST['desde'] == 'testimonio') {
			foreach ($_REQUEST['idorden'] as $orden => $id) {
				$testimonio = new testimonio($id);
				$testimonio -> editarOrdenTestimonio($orden);
			}
		}

		/** Slider destinos */
		if ($_REQUEST['desde'] == 'testimonio2') {
			foreach ($_REQUEST['idorden'] as $orden => $id) {
				$testimonio = new testimonio2($id);
				$testimonio -> editarOrdenTestimonio($orden);
			}
		}

		/** Slider destinos */
		/*if ($_REQUEST['desde'] == 'testimonio3') {
			foreach ($_REQUEST['idorden'] as $orden => $id) {
				$testimonio = new testimonio3($id);
				$testimonio -> editarOrdenTestimonio($orden);
			}
		}*/

    if($_REQUEST['desde'] == 'testimonio3'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			$_initFor = $_REQUEST['initfor'];
			$_hastaFor = count($val2) + $_initFor - 1;
			$_index = 0;
			for($i = $_initFor; $i <= $_hastaFor; $i++)
			{
				$testimonio = new testimonio3($val2[$_index]);
				$testimonio -> editarOrdenTestimonio($i);
				$_index++;
			}
		}

    /*Precios*/
    if ($_REQUEST['desde'] == 'precios') {
			foreach ($_REQUEST['idorden'] as $orden => $id) {
				$experiencia = new experiencia($id);
				$experiencia -> editarOrdenExperiencia($orden);
			}
		}

	break;
/////////////////////////////////////////////////
/// CONROLADORES COMPRESION DE IMAGENES
/////////////////////////////////////////////////
 	case 'modificarconfigimg':
		$imgconfig = new imgConfig($_REQUEST['idconfiguracion'],$_REQUEST['altomaximo'],$_REQUEST['anchomaximo'],$_REQUEST['calidad'],$_REQUEST['prefijo']);
		$listimgconfig=$imgconfig->listarimgconfig();
		$contador=count($listimgconfig);
			 if($contador < 1){

				$imgconfig->insertarimgconfig();
			 }
			 else{
			 	$imgconfig->modificarimgconfig();
			 }

		header('location: formImgConfiguracion.php?success=2');
	break;
/////////////////////////////////////////////////
/// CONTROLADORES SETTINGS EMAIL
/////////////////////////////////////////////////
	case 'modificarsettingsEmail':
		$settingsEmail = new settingsEmail(1,$_REQUEST['host'], $_REQUEST['port'], $_REQUEST['username'], $_REQUEST['password'], $_REQUEST['noReply'], $_REQUEST['fromname'], $_REQUEST['addCC']);
		$settingsEmail -> modificar_settingsEmail();
		header('location: formSettingsEmail.php?success=1');
	break;
	case 'pruebaCorreo':
		$correo = new correo();
		$correo -> emailPrueba = $_REQUEST['email'];

		if($correo -> enviar()){
			echo 1;
		}else{
			echo 2;
		}
	break;

/////////////////////////////////////////////////
/// CONROLADORES SEO
/////////////////////////////////////////////////
	case 'modificarSeo':
		$seo = new seo(1,$_REQUEST['metaDescription'], $_REQUEST['metaKeywords'], $_REQUEST['metaAuthor'], $_REQUEST['metaOgTitle'], $_REQUEST['metaOgUrl'], $_REQUEST['metaOgType'], $_REQUEST['metaOgDescription'], $_REQUEST['metaOgLocale'], $_REQUEST['metaOgSiteName'], $_REQUEST['idAnalitics'], $_REQUEST['sitenameAnalitics'], $_REQUEST['conversionFacebook'], $_REQUEST['conversionGoogle']);
		$seo -> modificar_seo();

		if(isset($_FILES['archivoFavicon']['name'])){
			if($_FILES['archivoFavicon']['name'] != ''){
				$ruta = $seo -> obtenerExtensionArchivo($_FILES['archivoFavicon']['name']);
				$tmp = $_FILES['archivoFavicon']['tmp_name'];
				$seo -> modificarImgSeo(1, $ruta, $tmp);
			}
		}

		if(isset($_FILES['archivoPin']['name'])){
			if($_FILES['archivoPin']['name'] != ''){
				$ruta = $seo -> obtenerExtensionArchivo($_FILES['archivoPin']['name']);
				$tmp = $_FILES['archivoPin']['tmp_name'];
				$seo -> modificarImgSeo(2, $ruta, $tmp);
			}
		}

		if(isset($_FILES['archivoOgImagen']['name'])){
			if($_FILES['archivoOgImagen']['name'] != ''){
				$ruta = $seo -> obtenerExtensionArchivo($_FILES['archivoOgImagen']['name']);
				$tmp = $_FILES['archivoOgImagen']['tmp_name'];
				$seo -> modificarImgSeo(3, $ruta, $tmp);
			}
		}
		header('Location: formSeo.php');
	break;
/* ============================
 * CRUD _SLIDE
 * ============================ */
	case 'agregarslide':
		$slide = new slide(0, $_REQUEST['titulo'], $_REQUEST['link'], $_FILES['imagen']['name'], $_FILES['imagen']['tmp_name'], $_REQUEST['tituloEn'], $_REQUEST['descripcion'], $_REQUEST['descripcionEn'], $_REQUEST['textoBoton'], $_REQUEST['textoBotonEn'], $_REQUEST['linkVideo'], $_REQUEST['tipo']);
		$slide -> addSlide();
		if($_FILES['imgMovil']['name'] != ''){
			$slide -> updateImgMovil($_FILES['imgMovil']['name'], $_FILES['imgMovil']['tmp_name']);
		}
		header('location: listSlide.php?success=1&tipo='.$_REQUEST['tipo'].'');
	break;
	case 'modificarslide':
		if($_FILES['imagen']['name'] != ''){
			$_name = $_FILES['imagen']['name'];
			$_tmp = $_FILES['imagen']['tmp_name'];
		}else{
			$_name = '';
			$_tmp = '';
		}

		$slide = new slide($_REQUEST['id'], $_REQUEST['titulo'], $_REQUEST['link'], $_name, $_tmp, $_REQUEST['tituloEn'], $_REQUEST['descripcion'], $_REQUEST['descripcionEn'], $_REQUEST['textoBoton'], $_REQUEST['textoBotonEn'], $_REQUEST['linkVideo']);
		$slide -> updateSlide();
		if($_FILES['imgMovil']['name'] != ''){
			$slide -> updateImgMovil($_FILES['imgMovil']['name'], $_FILES['imgMovil']['tmp_name']);
		}
		header('location: listSlide.php?success=2&tipo='.$_REQUEST['tipo'].'');
	break;
	case 'operaslide':
		if(isset($_REQUEST['idSlide'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idSlide'] as $elemento) {
					$slide = new slide($elemento);
					$slide -> deleteSlide();
				}
				header('location: listSlide.php?success=3&tipo='.$_REQUEST['tipo'].'');
			}
			if ($select == 'Activar'){
				foreach ($_REQUEST['idSlide'] as $elemento) {
					$slide = new slide($elemento);
					$slide -> updateStatusSlide(1);
				}
				header('location: listSlide.php?success=4&tipo='.$_REQUEST['tipo'].'');
			}
			if ($select == 'Desactivar'){
				foreach ($_REQUEST['idSlide'] as $elemento) {
					$slide = new slide($elemento);
					$slide -> updateStatusSlide(0);
				}
				header('location: listSlide.php?success=5&tipo='.$_REQUEST['tipo'].'');
			}
		}else {
			header('location: listSlide.php?success=0&tipo='.$_REQUEST['tipo'].'');
		}
	break;
	case 'changeStatusSlide':
		$slide = new slide($_REQUEST['id']);
		$slide -> updateStatusSlide($_REQUEST['status']);
	break;
/**
 * CRUD - BANNERS
 */
	case 'agregarbanners':
		$slide = new banners(0, $_REQUEST['titulo'], $_REQUEST['link'], $_FILES['imagen']['name'], $_FILES['imagen']['tmp_name'], $_REQUEST['tituloEn'], $_REQUEST['descripcion'], $_REQUEST['descripcionEn'], $_REQUEST['textoBoton'], $_REQUEST['textoBotonEn'], $_REQUEST['linkVideo'], $_REQUEST['tipo']);
		$slide -> addSlide();
		if($_FILES['imgMovil']['name'] != ''){
			$slide -> updateImgMovil($_FILES['imgMovil']['name'], $_FILES['imgMovil']['tmp_name']);
		}
		header('location: otros-servicios.php?success=1');
	break;
	
	case 'modificarbanners':
		if($_FILES['imagen']['name'] != ''){
			$_name = $_FILES['imagen']['name'];
			$_tmp = $_FILES['imagen']['tmp_name'];
		}else{
			$_name = '';
			$_tmp = '';
		}

		$slide = new banners($_REQUEST['id'], $_REQUEST['titulo'], $_REQUEST['link'], $_name, $_tmp, $_REQUEST['tituloEn'], $_REQUEST['descripcion'], $_REQUEST['descripcionEn'], $_REQUEST['textoBoton'], $_REQUEST['textoBotonEn'], $_REQUEST['linkVideo']);
		$slide -> updateSlide();
		// if($_FILES['imgMovil']['name'] != ''){
		// 	$slide -> updateImgMovil($_FILES['imgMovil']['name'], $_FILES['imgMovil']['tmp_name']);
		// }
		header('location: otros-servicios.php?success=2');
	break;

	case 'deleteBanners':
		if(isset($_REQUEST['idBanner'])){
			$slide = new banners($_REQUEST['idBanner']);
			$slide -> deleteSlide();
			header('location: otros-servicios.php?success=3');
		}else {
			header('location: otros-servicios.php?success=0');
		}
	break;
/* ============================
 * CRUD _CATEGORIA
 * ============================ */
	case 'agregarcategoria':
		(isset($_REQUEST['color'])) ? $_color = $_REQUEST['color'] : $_color = '';
 		$categoria = new categoria(0, $_REQUEST['titulo'], '', $_REQUEST['tipo'], $_REQUEST['tituloEn'], $_REQUEST['frase'], $_REQUEST['fraseEn'], $_FILES['imagen']['name'], $_FILES['imagen']['tmp_name']);
		$categoria -> addCategoria();
		if(isset($_REQUEST['nombre-sub'])){
			for($i = 0; $i < count($_REQUEST['nombre-sub']); $i++){
				if($_REQUEST['nombre-sub'][$i] != ''){
					$categoria -> agregarSubcategoria($_REQUEST['nombre-sub'][$i]);
				}
			}
		}

		header('Location: listCategoria.php?t='.$_REQUEST['tipo'].'&success=1');
	break;
	case 'modificarcategoria':
		if($_FILES['imagen']['name'] != ''){
			$_name = $_FILES['imagen']['name'];
			$_tmp = $_FILES['imagen']['tmp_name'];
		}else{
			$_name = '';
			$_tmp = '';
		}
		$categoria = new categoria($_REQUEST['id'], $_REQUEST['titulo'], $_REQUEST['color'], '', $_REQUEST['tituloEn'], $_REQUEST['frase'], $_REQUEST['fraseEn'],  $_name, $_tmp);
		$categoria -> updateCategoria();
		if(isset($_REQUEST['nombre-sub'])){
			for($i = 0; $i < count($_REQUEST['nombre-sub']); $i++){
				if($_REQUEST['nombre-sub'][$i] != ''){
					$categoria -> agregarSubcategoria($_REQUEST['nombre-sub'][$i]);
				}
			}
		}
		if(isset($_REQUEST['nombre-sub-mod'])){
			for($i = 0; $i < count($_REQUEST['nombre-sub-mod']); $i++){
				if($_REQUEST['nombre-sub-mod'][$i] != ''){
					$_idSubcategoria = $_REQUEST['idSubcategoria'][$i];
					$categoria -> modificarSubcategoria($_idSubcategoria, $_REQUEST['nombre-sub-mod'][$i]);
				}
			}
		}
		header('Location: listCategoria.php?t='.$_REQUEST['tipo'].'&success=2');
	break;
	case 'operacategoria':
		if(isset($_REQUEST['idCategoria'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idCategoria'] as $elemento) {
					$categoria = new categoria($elemento);
					/*$categoria -> eliminarSubcategoria(0, true);
					$categoria -> deleteCategoria();*/
					$categoria -> updateStatusCategoria(3);
				}
				header('location: listCategoria.php?t='.$_REQUEST['tipo'].'&success=3');
			}
			if ($select == 'Activar'){
				foreach ($_REQUEST['idCategoria'] as $elemento) {
					$categoria = new categoria($elemento);
					$categoria -> updateStatusCategoria(1);
				}
				header('location: listCategoria.php?t='.$_REQUEST['tipo'].'&success=4');
			}
			if ($select == 'Desactivar'){
				foreach ($_REQUEST['idCategoria'] as $elemento) {
					$categoria = new categoria($elemento);
					$categoria -> updateStatusCategoria(0);
				}
				header('location: listCategoria.php?t='.$_REQUEST['tipo'].'&success=5');
			}
		}else {
			header('location: listCategoria.php?t='.$_REQUEST['tipo'].'&success=0');
		}
	break;
	case 'changeStatusCategoria':
		$categoria = new categoria($_REQUEST['id']);
		$categoria -> updateStatusCategoria($_REQUEST['status']);
	break;
	case 'deleteSubcategoria':
		$subcategoria = new subcategoria($_REQUEST['id']);
		$subcategoria -> deleteSubcategoria();
	break;
	case 'changeStatusSubcategoria':
		$subcategoria = new subcategoria($_REQUEST['id']);
		$subcategoria -> updateStatusSubcategoria($_REQUEST['status']);
	break;
	case 'listSubcategoria':
		$subcategoria = new subcategoria(0, $_REQUEST['idCategoria']);
		$_subcategorias = $subcategoria -> listSubcategoria();
		if(isset($_subcategorias)){
			foreach ($_subcategorias as $_sub) {
				if($_sub['status'] == 1){
					$_func = 'changeStatusOneBtn('.$_sub['idSubcategoria'].', 0, \'changeStatusSubcategoria\')';
					$_icon = 'fa-eye';
				}else{
					$_func = 'changeStatusOneBtn('.$_sub['idSubcategoria'].', 1, \'changeStatusSubcategoria\')';
					$_icon = 'fa-eye-slash';
				}
				$_html .= '		<div class="input-group espacios" id="input-mod-'.$_sub['idSubcategoria'].'">
				                    <span class="input-group-addon">Título</span>
				                    <input type="text" name="nombre-sub-mod[]" data-validate="true" class="form-control" placeholder="Ingresa el título de la subcategoría..." value="'.$_sub['nombre'].'">
				                    <input type="hidden" name="idSubcategoria[]" value="'.$_sub['idSubcategoria'].'">
				                    <div class="input-group-btn">
				                    	<div class="btn btn-default" onclick="deleteElement('.$_sub['idSubcategoria'].', \'input-mod-\', \'deleteSubcategoria\', \'true\')"> <i class="fa fa-trash"></i> </div>
				                    	<div class="btn btn-default" onclick="'.$_func.'"> <i id="btn-'.$_sub['idSubcategoria'].'" class="fa '.$_icon.'"></i> </div>
				                    </div>
				                </div>';
			}

			echo $_html;
		}
	break;
/* ============================
 * CRUD _ETIQUETA
 * ============================ */
	case 'agregaretiqueta':
		$etiqueta = new etiqueta(0, $_REQUEST['tituloEs'], '');
		$etiqueta -> addEtiqueta();
		header('Location: listEtiqueta.php?success=1');
	break;
	case 'modificaretiqueta':
		$etiqueta = new etiqueta($_REQUEST['id'], $_REQUEST['tituloEs'], '');
		$etiqueta -> updateEtiqueta();
		header('Location: listEtiqueta.php?success=2');
	break;
	case 'operaetiqueta':
		if(isset($_REQUEST['idEtiqueta'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idEtiqueta'] as $elemento) {
					$etiqueta = new etiqueta($elemento);
					$etiqueta -> deleteEtiqueta();
				}
				header('location: listEtiqueta.php?success=3');
			}
			if ($select == 'Activar'){
				foreach ($_REQUEST['idEtiqueta'] as $elemento) {
					$etiqueta = new etiqueta($elemento);
					$etiqueta -> updateStatusEtiqueta(1);
				}
				header('location: listEtiqueta.php?success=4');
			}
			if ($select == 'Desactivar'){
				foreach ($_REQUEST['idEtiqueta'] as $elemento) {
					$etiqueta = new etiqueta($elemento);
					$etiqueta -> updateStatusEtiqueta(0);
				}
				header('location: listEtiqueta.php?success=5');
			}
		}else {
			header('location: listEtiqueta.php?success=0');
		}
	break;
	case 'changeStatusEtiqueta':
		$etiqueta = new etiqueta($_REQUEST['id']);
		$etiqueta -> updateStatusEtiqueta($_REQUEST['status']);
	break;
/* ============================
 * CRUD _LOOKBOOK
 * ============================ */
	case 'agregarlookbook':
		$lookbook = new lookbook(0, $_REQUEST['titulo'], '', '');
		$lookbook -> addLookbook();
		/*if(isset($_FILES['galeria']['name'])){
			for($i = 0; $i < count($_FILES['galeria']['name']); $i++){
				if($_FILES['galeria']['name'][$i] != ''){
					$_name = $_FILES['galeria']['name'][$i];
					$_tmp = $_FILES['galeria']['tmp_name'][$i];
					$lookbook -> _addGaleriaLB($_name, $_tmp);
				}
			}
		}*/
		if(isset($_REQUEST['seccion'])){
			for($a = 0; $a < count($_REQUEST['seccion']); $a++){
				$_seccion = $_REQUEST['seccion'][$a];
				$_tipo = $_REQUEST['seccion-tipo'][$a];
				$seccion = new seccion(0, $lookbook -> _idLookbook, $_tipo);
				$seccion -> addSeccion();
				for($b = 0; $b < count($_FILES['archivo-contenido-'.$_seccion]['name']); $b++){
					$_ruta = $_FILES['archivo-contenido-'.$_seccion]['name'][$b];
					$_tmp = $_FILES['archivo-contenido-'.$_seccion]['tmp_name'][$b];
					$seccion -> agregarContenido($_ruta, $_tmp);
				}
			}
		}

		header('Location: listLookBook.php?success=1');
	break;
	case 'modificarlookbook':
		$lookbook = new lookbook($_REQUEST['idLookbook'], $_REQUEST['titulo'], '', '');
		$lookbook -> updateLookbook();
		/*if(isset($_FILES['galeria']['name'])){
			for($i = 0; $i < count($_FILES['galeria']['name']); $i++){
				if($_FILES['galeria']['name'][$i] != ''){
					$_name = $_FILES['galeria']['name'][$i];
					$_tmp = $_FILES['galeria']['tmp_name'][$i];
					$lookbook -> _addGaleriaLB($_name, $_tmp);
				}
			}
		}
		if(isset($_FILES['galeriaMod']['name'])){
			for($i = 0; $i < count($_FILES['galeriaMod']['name']); $i++){
				if($_FILES['galeriaMod']['name'][$i] != ''){
					$_idGaleria = $_REQUEST['idGaleria'][$i];
					$_name = $_FILES['galeriaMod']['name'][$i];
					$_tmp = $_FILES['galeriaMod']['tmp_name'][$i];
					$lookbook -> _updateGaleriaLB($_idGaleria, $_name, $_tmp);
				}
			}
		}*/
		if(isset($_REQUEST['seccion'])){
			for($a = 0; $a < count($_REQUEST['seccion']); $a++){
				$_seccion = $_REQUEST['seccion'][$a];
				$_tipo = $_REQUEST['seccion-tipo'][$a];
				$seccion = new seccion(0, $lookbook -> _idLookbook, $_tipo);
				$seccion -> addSeccion();
				for($b = 0; $b < count($_FILES['archivo-contenido-'.$_seccion]['name']); $b++){
					$_ruta = $_FILES['archivo-contenido-'.$_seccion]['name'][$b];
					$_tmp = $_FILES['archivo-contenido-'.$_seccion]['tmp_name'][$b];
					$seccion -> agregarContenido($_ruta, $_tmp);
				}
			}
		}
		if(isset($_REQUEST['seccion-mod'])){
			for($c = 0; $c < count($_REQUEST['seccion-mod']); $c++){
				$_seccion = $_REQUEST['seccion-mod'][$c];
				$seccion = new seccion();
				//$_total = count($_FILES['archivo-contenido-mod-'.$_seccion]['name']);
				//echo 'Total Seccion'.$_seccion.'-'.$_total.'<br>';
				for($d = 0; $d < count($_FILES['archivo-contenido-mod-'.$_seccion]['name']); $d++){
					if($_FILES['archivo-contenido-mod-'.$_seccion]['name'][$d] != ''){
						$_idContenido = $_REQUEST['idContenido-'.$_seccion][$d];
						$_ruta = $_FILES['archivo-contenido-mod-'.$_seccion]['name'][$d];
						$_tmp = $_FILES['archivo-contenido-mod-'.$_seccion]['tmp_name'][$d];
						$seccion -> modificarContenido($_idContenido, $_ruta, $_tmp);
					}
				}
			}
		}
		header('location: listLookBook.php?success=2');
	break;
	case 'operalookbook':
		if(isset($_REQUEST['idLookbook'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idLookbook'] as $elemento) {
					$lookbook = new lookbook($elemento);
					$lookbook -> _listGaleriaLB();
					foreach ($lookbook -> _galeriaLB as $_g) {
						$lookbook -> _deleteGaleriaLB($_g['idGaleriaLB']);
					}
					$lookbook -> deleteLookbook();
				}
				header('location: listLookBook.php?success=3');
			}
			if ($select == 'Activar'){
				foreach ($_REQUEST['idLookbook'] as $elemento) {
					$lookbook = new lookbook($elemento);
					$lookbook -> updateStatusLookbook(1);
				}
				header('location: listLookBook.php?success=4');
			}
			if ($select == 'Desactivar'){
				foreach ($_REQUEST['idLookbook'] as $elemento) {
					$lookbook = new lookbook($elemento);
					$lookbook -> updateStatusLookbook(0);
				}
				header('location: listLookBook.php?success=5');
			}
		}else {
			header('location: listLookBook.php?success=0');
		}
	break;
	case 'listarLookbook':
		$herramientas = new herramientas();
		$temporal = new lookbook();
		($_REQUEST['registrosPorPagina'] != '-1') ? $_rpp = $_REQUEST['registrosPorPagina'] : $_rpp = 20;
		//$_pagina = 1, $_paginador = true, $_status = '', $_busqueda = '', $_registrosPorPagina = 20, $_lastID = '', $_frontEnd = false
		$listaTemporal = $temporal -> listLookbook($_REQUEST['pagina'], true, '', $_REQUEST['cadena'], $_rpp);
		($_REQUEST['permisoSortable'] != 0) ? $handle = '<span class="fa-stack fa-1x mover handle"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-arrows fa-stack-1x fa-inverse"></i></span>' : $handle = '';
		foreach($listaTemporal as $elementoTemporal){
			if($_REQUEST['permisoAcDc'] == 0){
				if($elementoTemporal['status']!=0){
					$img='img/visible.png';
					$funcion='';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='';
					$class = 'ver';
				}
			}else{
				if($elementoTemporal['status']!=0){
					$img='img/visible.png';
					$funcion='changeStatus('.$elementoTemporal['idLookbook'].',0,\'changeStatusLookbook\')';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='changeStatus('.$elementoTemporal['idLookbook'].',1,\'changeStatusLookbook\')';
					$class = 'ver';
				}
			}
			$tabla .= ' <tr>
				            <td>
				                <input type="hidden" name="idorden" class="idorden" value="'.$elementoTemporal['idLookbook'].'">
				                <input type="checkbox" id="'.$elementoTemporal['idLookbook'].'" name="idLookbook[]" value="'.$elementoTemporal['idLookbook'].'">
								<label for="'.$elementoTemporal['idLookbook'].'"><span></span></label>
				            </td>
				            <td>
				                <a href="formLookBook.php?idLookbook='.$elementoTemporal['idLookbook'].'">
				                	<img src="../img/lookbook/'.$elementoTemporal['imgPortada'].'" class="img-responsive">
				                </a>
				            </td>
				            <td>
				                <a href="formLookBook.php?idLookbook='.$elementoTemporal['idLookbook'].'">
				                    '.$elementoTemporal['tituloEs'].'
				                </a>
				            </td>
				            <!--<td>'.$elementoTemporal['fecha'].'</td>-->
				            <td class="text-center">
				            	'.$handle.'
				                <img class="manita '.$class.'" onclick="'.$funcion.'" id="temp'.$elementoTemporal['idLookbook'].'" src="'.$img.'">
				            </td>
				        </tr>';
		}
		$_lastPage = count($listaTemporal)-1;
		$_de = $listaTemporal[$_lastPage]['orden'];

		$htmlpaginador = $herramientas -> paginador($listaTemporal[0]['ultimapagina'], $listaTemporal[0]['pagina'], $listaTemporal[0]['paginaanterior'], $listaTemporal[0]['paginasiguiente'], 4);
		$htmlpaginador .= '<input type="hidden" id="initfor" value="'.$_de.'">';
		$arrayJson = Array (
			0 => Array ( "tabla" => $tabla, "paginador" => $htmlpaginador)
		);
		echo json_encode($arrayJson);
	break;
	case 'changeStatusLookbook':
	 	$lookbook = new lookbook($_REQUEST['id']);
		$lookbook -> updateStatusLookbook($_REQUEST['status']);
	break;
	case 'deleteSeccion':
	$seccion = new seccion($_REQUEST['id']);
	$seccion -> listarContenido();
	foreach ($seccion -> _contenido as $_contenido) {
		$seccion -> eliminarContenido($_contenido['idContenido']);
	}
	$seccion -> deleteSeccion();
	break;
	case 'changeStatusSeccion':
		$seccion = new seccion($_REQUEST['id']);
		$seccion -> updateStatusSeccion($_REQUEST['status']);
	break;
/* ============================
 * CRUD _BLOG
 * ============================ */
	case 'agregarblog':
		if($_FILES['archivo']['name'] != ''){
			$name = $_FILES['archivo']['name'];
			$tmp = $_FILES['archivo']['tmp_name'];
		}else{
			$name = '';
			$tmp = '';
		}

		$blog = new blog(0, $_REQUEST['idCategoria'],$_REQUEST['idSubcategoria'], $name, $tmp, $_REQUEST['idioma'], $_REQUEST['descripcionCorta'], $_REQUEST['subtitulo']);
		$blog -> addBlog();

		for($i = 0; $i < count($_REQUEST['lang']); $i++){
			$_lang = $_REQUEST['lang'][$i];
			$_titulo = $_REQUEST['titulo'][$i];
			//$_subtitulo = $_REQUEST['subtitulo'][$i];
			$_descripcion = $_REQUEST['descripcion'][$i];
			$_tags = $_REQUEST['tags'][$i];
			$blog ->  agregarDatosBlog($_titulo, '', $_descripcion, $_tags, $_lang);
		}

		if(isset($_REQUEST['temporal-id'])){
			for($i = 0; $i < count($_REQUEST['temporal-id']); $i++){
				$_temporalID = $_REQUEST['temporal-id'][$i];
				$_tipo = $_REQUEST['tipo-contenido'][$i];
				$_idContenidoBlog = $blog -> agregarContenidoBlog($_tipo);
				if($_tipo == 1){
					if($_REQUEST['descripcion-contenido-'.$_temporalID] != ''){
						$blog -> agregarTexto($_idContenidoBlog, $_REQUEST['descripcion-contenido-'.$_temporalID]);
					}
				}else if($_tipo == 2){
					if( $_FILES['img-contenido-'.$_temporalID]['name'] != ''){
						$blog -> agregarImagen($_idContenidoBlog, $_FILES['img-contenido-'.$_temporalID]['name'], $_FILES['img-contenido-'.$_temporalID]['tmp_name']);
					}
				}else if($_tipo == 3){
					if($_FILES['video-contenido-'.$_temporalID]['name'] != ''){
						$blog -> agregarVideo($_idContenidoBlog,$_REQUEST['url-contenido-'.$_temporalID],$_FILES['video-contenido-'.$_temporalID]['name'],$_FILES['video-contenido-'.$_temporalID]['tmp_name']);
					}

				}else if($_tipo == 4){
					if(isset($_FILES['galeria-contenido-'.$_temporalID])){
						for($t = 0; $t < count($_FILES['galeria-contenido-'.$_temporalID]); $t++){
							if($_FILES['galeria-contenido-'.$_temporalID]['name'][$t] != ''){
								$_name = $_FILES['galeria-contenido-'.$_temporalID]['name'][$t];
								$_tmp = $_FILES['galeria-contenido-'.$_temporalID]['tmp_name'][$t];
								$blog -> insertarGaleriaContenido($_idContenidoBlog, $_name, $_tmp);
							}
						}
					}
				}

			}
		}
		if(count($_REQUEST['idproductos']) > 0){
			foreach ($_REQUEST['idproductos'] as $key) {
				$blog->agregarProductosxSoluciones($key);
			}
		}

    $blog ->  addRatingDefault();
    $blog ->  addVisitaDefault();

		/*for($i = 0; $i < count($_FILES['galeriaBlog']['name']); $i++){
			if($_FILES['galeriaBlog']['name'][$i] != ''){
				$ruta = $_FILES['galeriaBlog']['name'][$i];
				$tmp = $_FILES['galeriaBlog']['tmp_name'][$i];
				$blog -> agregarGaleriaBlog('imagen', 'estefy', '', $ruta, $tmp);
			}
		}
		if(isset($_FILES['galeriaVideo']['name'])){
			for($i = 0; $i < count($_FILES['galeriaVideo']['name']); $i++){
				if($_FILES['galeriaVideo']['name'][$i] != ''){
					$ruta = $_FILES['galeriaVideo']['name'][$i];
					$tmp = $_FILES['galeriaVideo']['tmp_name'][$i];
					$url = $_REQUEST['urlVideo'][$i];
					$blog -> agregarGaleriaBlog('video', 'estefy', $url, $ruta, $tmp);
				}
			}
		}*/
		header('Location: listSoluciones.php?tipo=2&success=1');
	break;
	case 'modificarblog':
		if($_FILES['archivo']['name'] != ''){
			$name = $_FILES['archivo']['name'];
			$tmp = $_FILES['archivo']['tmp_name'];
		}else{
			$name = '';
			$tmp = '';
		}
		$blog = new blog($_REQUEST['idBlog'], $_REQUEST['idCategoria'],$_REQUEST['idSubcategoria'], $name, $tmp, $_REQUEST['idioma'], $_REQUEST['descripcionCorta'],$_REQUEST['subtitulo']);
		$blog -> updateBlog();

		for($i = 0; $i < count($_REQUEST['lang']); $i++){
			$_lang = $_REQUEST['lang'][$i];
			$_titulo = $_REQUEST['titulo'][$i];
			//$_subtitulo = $_REQUEST['subtitulo'][$i];
			$_descripcion = $_REQUEST['descripcion'][$i];
			$_tags = $_REQUEST['tags'][$i];
			$blog ->  modificarDatosBlog($_titulo, '', $_descripcion, $_tags, $_lang);
		}

		if(isset($_REQUEST['temporal-id'])){
			for($i = 0; $i < count($_REQUEST['temporal-id']); $i++){
				$_temporalID = $_REQUEST['temporal-id'][$i];
				$_tipo = $_REQUEST['tipo-contenido'][$i];
				$_idContenidoBlog = $blog -> agregarContenidoBlog($_tipo);
				if($_tipo == 1){
					if($_REQUEST['descripcion-contenido-'.$_temporalID] != ''){
						$blog -> agregarTexto($_idContenidoBlog, $_REQUEST['descripcion-contenido-'.$_temporalID]);
					}
				}else if($_tipo == 2){
					if( $_FILES['img-contenido-'.$_temporalID]['name'] != ''){
						$blog -> agregarImagen($_idContenidoBlog, $_FILES['img-contenido-'.$_temporalID]['name'], $_FILES['img-contenido-'.$_temporalID]['tmp_name']);
					}
				}else if($_tipo == 3){
					if($_FILES['video-contenido-'.$_temporalID]['name'] != ''){
						$blog -> agregarVideo($_idContenidoBlog,$_REQUEST['url-contenido-'.$_temporalID],$_FILES['video-contenido-'.$_temporalID]['name'],$_FILES['video-contenido-'.$_temporalID]['tmp_name']);
					}

				}else if($_tipo == 4){
					if(isset($_FILES['galeria-contenido-'.$_temporalID])){
						for($t = 0; $t < count($_FILES['galeria-contenido-'.$_temporalID]); $t++){
							if($_FILES['galeria-contenido-'.$_temporalID]['name'][$t] != ''){
								$_name = $_FILES['galeria-contenido-'.$_temporalID]['name'][$t];
								$_tmp = $_FILES['galeria-contenido-'.$_temporalID]['tmp_name'][$t];
								$blog -> insertarGaleriaContenido($_idContenidoBlog, $_name, $_tmp);
							}
						}
					}
				}

			}
		}

		if(isset($_REQUEST['temporal-id-mod'])){
			for($i = 0; $i < count($_REQUEST['temporal-id-mod']); $i++){
				$_temporalID = $_REQUEST['temporal-id-mod'][$i];
				$_tipo = $_REQUEST['tipo-contenido-mod'][$i];
				//$_idContenidoBlog = $blog -> agregarContenidoBlog($_tipo);
				if($_tipo == 1){
					if($_REQUEST['descripcion-contenido-mod-'.$_temporalID] != ''){
						$blog -> agregarTexto($_temporalID, $_REQUEST['descripcion-contenido-mod-'.$_temporalID]);
					}
				}else if($_tipo == 2){
					if( $_FILES['img-contenido-mod-'.$_temporalID]['name'] != ''){
						$blog -> agregarImagen($_temporalID, $_FILES['img-contenido-mod-'.$_temporalID]['name'], $_FILES['img-contenido-mod-'.$_temporalID]['tmp_name']);
					}
				}else if($_tipo == 3){
					if($_FILES['video-contenido-mod-'.$_temporalID]['name'] != ''){
						$blog -> agregarVideo($_temporalID,$_REQUEST['url-contenido-mod-'.$_temporalID],$_FILES['video-contenido-mod-'.$_temporalID]['name'],$_FILES['video-contenido-mod-'.$_temporalID]['tmp_name']);
					}else{
						$blog -> agregarVideo($_temporalID,$_REQUEST['url-contenido-mod-'.$_temporalID],'','');
					}

				}else if($_tipo == 4){
					if(isset($_FILES['galeria-contenido-mod-'.$_temporalID])){
						for($t = 0; $t < count($_FILES['galeria-contenido-mod-'.$_temporalID]); $t++){
							if($_FILES['galeria-contenido-mod-'.$_temporalID]['name'][$t] != ''){
								$_name = $_FILES['galeria-contenido-mod-'.$_temporalID]['name'][$t];
								$_tmp = $_FILES['galeria-contenido-mod-'.$_temporalID]['tmp_name'][$t];
								$blog -> insertarGaleriaContenido($_temporalID, $_name, $_tmp);
							}
						}
					}

					if(isset($_FILES['img-galeria-mod-'.$_temporalID])){
						for($c = 0; $c < count($_FILES['img-galeria-mod-'.$_temporalID]['name']); $c++){
							if($_FILES['img-galeria-mod-'.$_temporalID]['name'][$c] != ''){
								$_name = $_FILES['img-galeria-mod-'.$_temporalID]['name'][$c];
								$_tmp = $_FILES['img-galeria-mod-'.$_temporalID]['tmp_name'][$c];
								$_idGaleriaContenido = $_REQUEST['idGaleriaContenido-'.$_temporalID][$c];
								$blog -> modGaleriaContenido($_idGaleriaContenido, $_name, $_tmp);
							}
						}
					}
				}

			}
		}
		$blog -> eliminarProductosxSoluciones();
		if(count($_REQUEST['idproductos']) > 0){
			foreach ($_REQUEST['idproductos'] as $key) {
				$blog->agregarProductosxSoluciones($key);
			}
		}

		/*for($i = 0; $i < count($_FILES['galeriaBlog']['name']); $i++){
			if($_FILES['galeriaBlog']['name'][$i] != ''){
				$ruta = $_FILES['galeriaBlog']['name'][$i];
				$tmp = $_FILES['galeriaBlog']['tmp_name'][$i];
				$blog -> agregarGaleriaBlog('imagen', 'logra', '', $ruta, $tmp);
			}
		}
		if(isset($_FILES['galeriaBlogMod']['name'])){
			for($i = 0; $i < count($_FILES['galeriaBlogMod']['name']); $i++){
				if($_FILES['galeriaBlogMod']['name'][$i] != ''){
					$ruta = $_FILES['galeriaBlogMod']['name'][$i];
					$tmp = $_FILES['galeriaBlogMod']['tmp_name'][$i];
					$idGaleriaBlog = $_REQUEST['idGaleriaBlog'][$i];
					$blog -> modificarGaleriaBlog($idGaleriaBlog, $ruta, '', $ruta, $tmp);
				}
			}
		}
		if(isset($_FILES['galeriaVideo']['name'])){
			for($i = 0; $i < count($_FILES['galeriaVideo']['name']); $i++){
				if($_FILES['galeriaVideo']['name'][$i] != ''){
					$ruta = $_FILES['galeriaVideo']['name'][$i];
					$tmp = $_FILES['galeriaVideo']['tmp_name'][$i];
					$url = $_REQUEST['urlVideo'][$i];
					$blog -> agregarGaleriaBlog('video', 'logra', $url, $ruta, $tmp);
				}
			}
		}
		if(isset($_FILES['galeriaVideoMod']['name'])){
			for($i = 0; $i < count($_FILES['galeriaVideoMod']['name']); $i++){
				if($_FILES['galeriaVideoMod']['name'][$i] != ''){
					$ruta = $_FILES['galeriaVideoMod']['name'][$i];
					$tmp = $_FILES['galeriaVideoMod']['tmp_name'][$i];
					$idGaleriaBlog = $_REQUEST['idGaleriaBlogVideo'][$i];
					$url = $_REQUEST['urlVideoMod'][$i];
					$blog -> modificarGaleriaBlog($idGaleriaBlog, $ruta, $url, $ruta, $tmp);
				}
			}
		}

		if(isset($_REQUEST['urlVideoMod'])){
			for($i = 0; $i < count($_REQUEST['urlVideoMod']); $i++){
				if($_REQUEST['urlVideoMod'][$i] != ''){
					$idGaleriaBlog = $_REQUEST['idGaleriaBlogVideo'][$i];
					$url = $_REQUEST['urlVideoMod'][$i];
					$blog -> modificarGaleriaBlog($idGaleriaBlog, '', $url, '', '');
				}
			}
		}*/

		header('Location: listSoluciones.php?tipo=2&success=2');
	break;
	case 'operablog':
		if(isset($_REQUEST['idBlog'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idBlog'] as $elemento) {
					$blog = new blog($elemento);
					$blog -> listarContenidoBlog();
					foreach ($blog -> _contenidoBlog as $_g) {
						$_galeria = $blog -> listarGaleriaContenido($_g['idContenidoBlog']);
						if(count($_galeria) > 0){
							foreach ($_galeria as $_gal) {
								$blog -> delGaleriaContenido($_gal['idGaleriaContenido']);
							}
						}
						$blog -> eliminarContenidoBlog($_g['idContenidoBlog']);
					}
					$blog -> eliminarDatosBlog();
					$blog -> deleteBlog();
					$blog -> eliminarProductosxSoluciones();
				}
				header('location: listSoluciones.php?success=3');
			}
			if ($select == 'Mostrar'){
				foreach ($_REQUEST['idBlog'] as $elemento) {
					$blog = new blog($elemento);
					$blog -> updateStatusBlog(1);
				}
				header('location: listSoluciones.php?success=4');
			}
			if ($select == 'No Mostrar'){
				foreach ($_REQUEST['idBlog'] as $elemento) {
					$blog = new blog($elemento);
					$blog -> updateStatusBlog(0);
				}
				header('location: listSoluciones.php?success=5');
			}
		}else {
			header('location: listSoluciones.php?success=0');
		}
	break;
	case 'listarBlog':
		$herramientas = new herramientas();
		$temporal = new blog();
		($_REQUEST['registrosPorPagina'] != '-1') ? $_rpp = $_REQUEST['registrosPorPagina'] : $_rpp = 20;
		//listBlog($_pagina = 1, $_paginador = true, $_idCategoria = '', $_status = '', $_busqueda = '', $_tags = '', $_registrosPorPagina = 20, $_frontEnd = true, $_lang = 'ES')
		$listaTemporal = $temporal -> listBlog($_REQUEST['pagina'], true, '', '', $_REQUEST['cadena'], '', 20);
		($_REQUEST['permisoSortable'] != 0) ? $handle = '<span class="fa-stack fa-1x mover handle"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-arrows fa-stack-1x fa-inverse"></i></span>' : $handle = '';
		foreach($listaTemporal as $elementoTemporal){
			if($_REQUEST['permisoAcDc'] == 0){
				if($elementoTemporal['status']!=0){
					$img='img/visible.png';
					$funcion='';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='';
					$class = 'ver';
				}
			}else{
				if($elementoTemporal['status']!=0){
					$img='img/visible.png';
					$funcion='changeStatus('.$elementoTemporal['idBlog'].',0,\'changeStatusBlog\')';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='changeStatus('.$elementoTemporal['idBlog'].',1,\'changeStatusBlog\')';
					$class = 'ver';
				}
			}
			if($elementoTemporal['idioma']==0){
				$idiomaDestino='Español';
			}
			else{
				$idiomaDestino='Inglés';
			}

			$categoria=new categoria($elementoTemporal['idCategoria']);
			$categoria->getCategoria();

			$tabla .= ' <tr>
				            <td>
				                <input type="hidden" name="idorden" class="idorden" value="'.$elementoTemporal['idBlog'].'">
				                <input type="checkbox" id="'.$elementoTemporal['idBlog'].'" name="idBlog[]" value="'.$elementoTemporal['idBlog'].'">
								<label for="'.$elementoTemporal['idBlog'].'"><span></span></label>
				            </td>
				            <td>
				                <a href="formSoluciones.php?idBlog='.$elementoTemporal['idBlog'].'"><img class="img-responsive" src="../img/imgBlog/'.$elementoTemporal['portada'].'"></a>
				            </td>
				            <td>
				            	<a href="formSoluciones.php?idBlog='.$elementoTemporal['idBlog'].'">
				                	'.$elementoTemporal['titulo'].'
				            	</a>
				            </td>
				            <td>'.$elementoTemporal['fechaCreacion'].'</td>
							<td>'.$idiomaDestino.'</td>
							<td>'.$categoria->_tituloEs.'</td>
				            <td class="text-center">
				                '.$handle.'
				                <img class="manita '.$class.'" onclick="'.$funcion.'" id="temp'.$elementoTemporal['idBlog'].'" src="'.$img.'">
				            </td>
				        </tr>';
		}
		$_lastPage = count($listaTemporal)-1;
		$_de = $listaTemporal[$_lastPage]['orden'];

		$htmlpaginador = $herramientas -> paginador($listaTemporal[0]['ultimapagina'], $listaTemporal[0]['pagina'], $listaTemporal[0]['paginaanterior'], $listaTemporal[0]['paginasiguiente'], 4);
		$htmlpaginador .= '<input type="hidden" id="initfor" value="'.$_de.'">';
		$arrayJson = Array (
			0 => Array ( "tabla" => $tabla, "paginador" => $htmlpaginador)
		);
		echo json_encode($arrayJson);
	break;
	case 'changeStatusBlog':
		$blog = new blog($_REQUEST['id']);
		$blog -> updateStatusBlog($_REQUEST['status']);
	break;
	case 'deleteContenidoBlog':
		$blog = new blog();
		$_galeria = $blog -> listarGaleriaContenido($_REQUEST['id']);
		if(count($_galeria)){
			foreach ($_galeria as $_gal) {
				$blog -> delGaleriaContenido($_gal['idGaleriaContenido']);
			}
		}
		$blog -> eliminarContenidoBlog($_REQUEST['id']);
	break;
	case 'deleteGaleriaContenido':
		$blog = new blog();
		$blog -> delGaleriaContenido($_REQUEST['id']);
	break;
/* ============================
 * CRUD _PORTADA
 * ============================ */
	case 'updatePortada':
		// echo '<textarea>'.json_encode($_REQUEST).'</textarea>';
		// echo '<textarea>'.json_encode($_FILES['imgPortada']).'</textarea>';
		if($_FILES['imgPortada']['name'] != ''){
			$name = $_FILES['imgPortada']['name'];
			$tmp = $_FILES['imgPortada']['tmp_name'];
		}else{
			$name = '';
			$tmp = '';
		}

		if($_FILES['imgPortadaMobile']['name'] != ''){
			$nameMovil = $_FILES['imgPortadaMobile']['name'];
			$tmpMovil = $_FILES['imgPortadaMobile']['tmp_name'];
		}else{
			$nameMovil = '';
			$tmpMovil = '';
		}

		$portada = new portada($_REQUEST['id'], $_REQUEST['titulo'], $_REQUEST['tituloEn'], $_REQUEST['subtitulo'], $_REQUEST['subtituloEn'], 1, $name, $nameMovil, $tmp, $tmpMovil);
		$success = $portada -> updatePortada();

		header('Location: listaPortadaForm.php?success='.$success);
	break;
/* ============================
 * CRUD _PAGE_INFO
 * ============================ */
	case 'updatePaginaInfo':
		// echo '<textarea>'.json_encode($_REQUEST).'</textarea>';
		// echo '<textarea>'.json_encode($_FILES['archivoLogoPage']).'</textarea>';
		if($_FILES['archivoLogoPage']['name'] != ''){
			$name = $_FILES['archivoLogoPage']['name'];
			$tmp = $_FILES['archivoLogoPage']['tmp_name'];
		}else{
			$name = '';
			$tmp = '';
		}

		$page = new pageInfo($_REQUEST['id'], $_REQUEST['nombre'], $name, $_REQUEST['url'], $_REQUEST['whatsapp1'], $_REQUEST['whatsapp2'], $_REQUEST['correo1'], $_REQUEST['correo2'], $_REQUEST['telefono1'], $_REQUEST['telefono2'], $_REQUEST['facebook'], '', $tmp);
		$success = $page -> updatePage();

		header('Location: formInfo.php?success='.$success);
	break;
/* ============================
 * CRUD _PRODUCTO
 * ============================ */
	case 'agregarproducto':
		if($_FILES['archivo']['name'] != ''){
			$name = $_FILES['archivo']['name'];
			$tmp = $_FILES['archivo']['tmp_name'];
		}else{
			$name = '';
			$tmp = '';
		}
		if($_FILES['archivo2']['name'] != ''){
			$name2 = $_FILES['archivo2']['name'];
			$tmp2 = $_FILES['archivo2']['tmp_name'];
		}else{
			$name2 = '';
			$tmp2 = '';
		}

		$producto = new producto(0, $_REQUEST['idCategoria'], $_REQUEST['precio'], $_REQUEST['peso'], $_REQUEST['stock'], $_REQUEST['codigoProducto']);
		$_success = $producto -> addProducto();
		$producto -> agregarGaleria($name, 'portada', $tmp);
		$producto -> agregarGaleria($name2, 'fondo', $tmp2);
		$producto -> updateDescuento($_REQUEST['aplicarDescuento'], $_REQUEST['tipoDescuento'], $_REQUEST['valorDescuento']);

		for($i = 0; $i < count($_REQUEST['lang']); $i++){
			$_lang = $_REQUEST['lang'][$i];
			$_titulo = $_REQUEST['titulo'][$i];
			$_descripcion = $_REQUEST['descripcion'][$i];
			$_tags = $_REQUEST['tags'][$i];
			$producto ->  agregarDatosProducto($_titulo, $_descripcion, $_tags, $_lang);
		}

		for($i = 0; $i < count($_FILES['galeria']['name']); $i++){
			if($_FILES['galeria']['name'][$i] != ''){
				$ruta = $_FILES['galeria']['name'][$i];
				$tmp = $_FILES['galeria']['tmp_name'][$i];
				$producto -> agregarGaleria($ruta, 'secundaria', $tmp);
			}
		}
		if(isset($_REQUEST['transporte'])){
			for($i = 0; $i < count($_REQUEST['transporte']); $i++){
				if($_REQUEST['transporte'][$i] != 0 and $_REQUEST['transporte'][$i] != ''){
					$transportexproducto = new transportexproducto($producto -> _idProducto, $_REQUEST['transporte'][$i]);
					$transportexproducto -> addProductoxTransporte();
				}
			}
		}

		if(count($_REQUEST['idingredientes']) > 0){
			foreach ($_REQUEST['idingredientes'] as $key) {
				$producto->agregarIngredientesxProductos($key);
			}
		}

		if(count($_REQUEST['idconsideraciones']) > 0){
			foreach ($_REQUEST['idconsideraciones'] as $key) {
				$producto->agregarConsideracionesxProductos($key);
			}
		}
		header('Location: formProducto.php?idProducto='.$producto -> _idProducto);
	break;
	case 'modificarproducto':
		if($_FILES['archivo']['name'] != ''){
			$name = $_FILES['archivo']['name'];
			$tmp = $_FILES['archivo']['tmp_name'];
		}else{
			$name = '';
			$tmp = '';
		}
		if($_FILES['archivo2']['name'] != ''){
			$name2 = $_FILES['archivo2']['name'];
			$tmp2 = $_FILES['archivo2']['tmp_name'];
		}else{
			$name2 = '';
			$tmp2 = '';
		}
		$producto = new producto($_REQUEST['idProducto'], $_REQUEST['idCategoria'], $_REQUEST['precio'], $_REQUEST['peso'], $_REQUEST['stock'], $_REQUEST['codigoProducto']);
		$producto -> updateProducto();
		$producto -> modificarGaleria($_REQUEST['idPortada'],$name, $tmp);
		$producto -> modificarGaleria($_REQUEST['idFondo'],$name2, $tmp2);
		$producto -> updateDescuento($_REQUEST['aplicarDescuento'], $_REQUEST['tipoDescuento'], $_REQUEST['valorDescuento']);

		for($i = 0; $i < count($_REQUEST['lang']); $i++){
			$_lang = $_REQUEST['lang'][$i];
			$_titulo = $_REQUEST['titulo'][$i];
			$_descripcion = $_REQUEST['descripcion'][$i];
			$_tags = $_REQUEST['tags'][$i];
			$producto ->  modificarDatosProducto($_titulo, $_descripcion, $_tags, $_lang);
		}

		$producto -> removerCategoriaxProducto();
		for($i = 0; $i < count($_REQUEST['idCategoria']); $i++){
			$producto -> agregarCategoriaxProducto($_REQUEST['idCategoria'][$i]);
		}

		for($i = 0; $i < count($_FILES['galeria']['name']); $i++){
			if($_FILES['galeria']['name'][$i] != ''){
				$ruta = $_FILES['galeria']['name'][$i];
				$tmp = $_FILES['galeria']['tmp_name'][$i];
				$producto -> agregarGaleria($ruta, 'secundaria', $tmp);
			}
		}
		if(isset($_FILES['galeriaMod']['name'])){
			for($i = 0; $i < count($_FILES['galeriaMod']['name']); $i++){
				if($_FILES['galeriaMod']['name'][$i] != ''){
					$ruta = $_FILES['galeriaMod']['name'][$i];
					$tmp = $_FILES['galeriaMod']['tmp_name'][$i];
					$idGaleria = $_REQUEST['idGaleria'][$i];
					$producto -> modificarGaleria($idGaleria,$ruta, $tmp);
				}
			}
		}
		$transportexproducto = new transportexproducto($producto -> _idProducto);
		$transportexproducto -> removeTransportexProducto();
		for($i = 0; $i < count($_REQUEST['transporte']); $i++){
			if($_REQUEST['transporte'][$i] != 0 and $_REQUEST['transporte'][$i] != ''){
				$transportexproducto -> idTransporte = $_REQUEST['transporte'][$i];
				$transportexproducto -> addProductoxTransporte();
			}
		}

		$producto -> eliminarIngredientesxProductos();
		if(count($_REQUEST['idingredientes']) > 0){
			foreach ($_REQUEST['idingredientes'] as $key) {
				$producto->agregarIngredientesxProductos($key);
			}
		}

		$producto -> eliminarConsideracionesxProductos();
		if(count($_REQUEST['idconsideraciones']) > 0){
			foreach ($_REQUEST['idconsideraciones'] as $key) {
				$producto->agregarConsideracionesxProductos($key);
			}
		}

		header('Location: listProducto.php?success=2');
	break;
	case 'operaproducto':
		if(isset($_REQUEST['idProducto'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idProducto'] as $elemento) {
					$producto = new producto($elemento);
					$producto -> listarGaleria();
					$producto -> listarCombinaciones();
					foreach ($producto -> _galeria as $_g) {
						$producto -> eliminarGaleria($_g['idGaleria']);
					}
					foreach ($producto -> _combinaciones as $_com) {
						$combinacion = new combinacion($_com['idCombinacion']);
						$combinacion -> deleteCombinacion();
					}
					$producto -> eliminarDatosProducto();
					$producto -> deleteProducto();

				}
				header('location: listProducto.php?success=3');
			}
			if ($select == 'Activar'){
				foreach ($_REQUEST['idProducto'] as $elemento) {
					$producto = new producto($elemento);
					$producto -> updateStatusProducto(1);
				}
				header('location: listProducto.php?success=4');
			}
			if ($select == 'Desactivar'){
				foreach ($_REQUEST['idProducto'] as $elemento) {
					$producto = new producto($elemento);
					$producto -> updateStatusProducto(0);
				}
				header('location: listProducto.php?success=5');
			}
		}else {
			header('location: listProducto.php?success=0');
		}
	break;
	case 'listarProducto':
		$herramientas = new herramientas();
		$temporal = new producto();
		($_REQUEST['registrosPorPagina'] != '-1') ? $_rpp = $_REQUEST['registrosPorPagina'] : $_rpp = 20;
		$listaTemporal = $temporal -> listProducto($_REQUEST['pagina'], true,'', $_REQUEST['cadena'], $_rpp);
		($_REQUEST['permisoSortable'] != 0) ? $handle = '<span class="fa-stack fa-1x mover handle"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-arrows fa-stack-1x fa-inverse"></i></span>' : $handle = '';
		foreach($listaTemporal as $elementoTemporal){
			if($_REQUEST['permisoAcDc'] == 0){
				if($elementoTemporal['status']!=0){
					$img='img/visible.png';
					$funcion='';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='';
					$class = 'ver';
				}
			}else{
				if($elementoTemporal['status']!=0){
					$img='img/visible.png';
					$funcion='changeStatus('.$elementoTemporal['idProducto'].',0,\'changeStatusProducto\')';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='changeStatus('.$elementoTemporal['idProducto'].',1,\'changeStatusProducto\')';
					$class = 'ver';
				}
			}
			if($elementoTemporal['destacado'] != 0){
				$_fa = 'fa-toggle-on';
				$_funcion = 'changeDestacado('.$elementoTemporal['idProducto'].',0,\'changeDestacadoProducto\')';
			}else{
				$_fa = 'fa-toggle-off';
				$_funcion = 'changeDestacado('.$elementoTemporal['idProducto'].',1,\'changeDestacadoProducto\')';
			}

			$tabla .= ' <tr>
				            <td>
				                <input type="hidden" name="idorden" class="idorden" value="'.$elementoTemporal['idProducto'].'">
				                <input type="checkbox" id="'.$elementoTemporal['idProducto'].'" name="idProducto[]" value="'.$elementoTemporal['idProducto'].'">
								<label for="'.$elementoTemporal['idProducto'].'"><span></span></label>
				            </td>
				            <td>
				                <a href="formProducto.php?idProducto='.$elementoTemporal['idProducto'].'"><img class="img-responsive" src="../img/producto/galeria/'.$elementoTemporal['imgPortada'].'"></a>
				            </td>
				            <td>
				            	<a href="formProducto.php?idProducto='.$elementoTemporal['idProducto'].'">
				                	'.$elementoTemporal['titulo'].'
				            	</a>
				            </td>
				            <td>'.$elementoTemporal['nombreCat'].'</td>
				            <td class="text-center">
				                '.$handle.'
				                <img class="manita '.$class.'" onclick="'.$funcion.'" id="temp'.$elementoTemporal['idProducto'].'" src="'.$img.'">
				            </td>
				        </tr>';
		}
		$_lastPage = count($listaTemporal)-1;
		$_de = $listaTemporal[$_lastPage]['orden'];

		$htmlpaginador = $herramientas -> paginador($listaTemporal[0]['ultimapagina'], $listaTemporal[0]['pagina'], $listaTemporal[0]['paginaanterior'], $listaTemporal[0]['paginasiguiente'], 4);
		$htmlpaginador .= '<input type="hidden" id="initfor" value="'.$_de.'">';
		$arrayJson = Array (
			0 => Array ( "tabla" => $tabla, "paginador" => $htmlpaginador)
		);
		echo json_encode($arrayJson);
	break;
	case 'changeStatusProducto':
		$producto = new producto($_REQUEST['id']);
		$producto -> updateStatusProducto($_REQUEST['status']);
	break;
	case 'changeDestacadoProducto':
		$producto = new producto($_REQUEST['id']);
		$_success = $producto -> updateDestacarProducto($_REQUEST['status']);
		echo $_success;
	break;
	case 'modificartituloseccion':
		$tituloPagina = new tituloPagina($_REQUEST['id'], $_REQUEST['tituloEs'], $_REQUEST['tituloEn']);
		$tituloPagina -> updateTituloPagina();
		header('Location: listProducto.php');
	break;
	case 'deleteGaleriaProducto':
		$producto = new producto();
		$producto -> eliminarGaleria($_REQUEST['id']);
	break;
	case 'agregarCombinacion':
		$combinacion = new combinacion(0, $_REQUEST['idProducto'], $_REQUEST['stock'], $_REQUEST['precio'], $_REQUEST['peso']);
		$combinacion -> addCombinacion();
		$combinacion -> _addValorXCombinacion($_REQUEST['idTalla'], $_REQUEST['idColor'], $_REQUEST['idGaleria']);
		for($i = 0; $i < count($_REQUEST['galeria-combinacion']); $i++){
			$combinacion -> agregarCombinacioxGaleria($_REQUEST['galeria-combinacion'][$i]);
		}
		$_lastCombinacion = $combinacion -> _listNombreValorxCombinacion();
		foreach ($_lastCombinacion as $_vxc) {
			if(isset($_vxc['galeria'])){
				$_totalGal = count($_vxc['galeria']);
				$_cont = 0;
				$_result = '';
				foreach ($_vxc['galeria'] as $_gal) {
					if($_cont == 0){
						$_alpha = '[';
						$_omega = '';
					}else if($_cont == $_totalGal - 1){
						$_alpha = '';
						$_omega = ']';
					}else{
						$_alpha = '';
						$_omega = '';
					}
					($_cont == $_totalGal - 1) ? $_signo = '' : $_signo = ',';
					$_result .= $_alpha.'"'.$_gal['idGaleria'].'"'.$_signo.$_omega;
					$_cont++;
				}
			}
			$_html .= ' <tr id="idCombinacion-'.$_vxc['idCombinacion'].'">
							<td>
								<img src="../img/producto/galeria/'.$_vxc['ruta'].'" class="img-responsive">
							</td>
							<td>
								'.$_vxc['talla'].'
							</td>
							<td>
								'.$_vxc['precio'].'
							</td>
							<td>
								'.$_vxc['stock'].'
							</td>
							<td>
								'.$_vxc['peso'].'
							</td>
							<td>
								<button data-galeria='.$_result.' type="button" class="btn btn-panel trigger-edit-combinacion" data-idTalla="'.$_vxc['idTalla'].'" data-idGaleria="'.$_vxc['idGaleria'].'" data-idColor="'.$_vxc['idColor'].'" data-stock="'.$_vxc['stock'].'" data-precio="'.$_vxc['precio'].'" data-peso="'.$_vxc['peso'].'" data-idCombinacion="'.$_vxc['idCombinacion'].'">Editar</button> <button type="button" class="btn btn-danger" onclick="deleteElement('.$_vxc['idCombinacion'].', \'idCombinacion-\', \'deleteCombinacion\', \'true\')"> <i class="fa fa-trash"></i> </button>
							</td>
						</tr>';
		}
		$_response = Array(
			0 => Array('_html' => $_html)
		);
		echo json_encode($_response);
	break;
	case 'modificarCombinacion':
		$combinacion = new combinacion($_REQUEST['idCombinacion'], $_REQUEST['idProducto'], $_REQUEST['stock'], $_REQUEST['precio'], $_REQUEST['peso']);
		$combinacion -> updateCombinacion();

		$combinacion -> _removeValorxCombinacion();
		$combinacion -> _addValorXCombinacion($_REQUEST['idTalla'], $_REQUEST['idColor'], $_REQUEST['idGaleria']);

		$combinacion -> removerGaleriaxCombinacion();
		for($i = 0; $i < count($_REQUEST['galeria-combinacion']); $i++){
			$combinacion -> agregarCombinacioxGaleria($_REQUEST['galeria-combinacion'][$i]);
		}

		$_lastCombinacion = $combinacion -> _listNombreValorxCombinacion();
		foreach ($_lastCombinacion as $_vxc) {
			if(isset($_vxc['galeria'])){
				$_totalGal = count($_vxc['galeria']);
				$_cont = 0;
				$_result = '';
				foreach ($_vxc['galeria'] as $_gal) {
					if($_cont == 0){
						$_alpha = '[';
						$_omega = '';
					}else if($_cont == $_totalGal - 1){
						$_alpha = '';
						$_omega = ']';
					}else{
						$_alpha = '';
						$_omega = '';
					}
					($_cont == $_totalGal - 1) ? $_signo = '' : $_signo = ',';
					$_result .= $_alpha.'"'.$_gal['idGaleria'].'"'.$_signo.$_omega;
					$_cont++;
				}
			}
			$_html .= '
							<td>
								<img src="../img/producto/galeria/'.$_vxc['ruta'].'" class="img-responsive">
							</td>
							<td>
								'.$_vxc['talla'].'
							</td>
							<td>
								'.$_vxc['precio'].'
							</td>
							<td>
								'.$_vxc['stock'].'
							</td>
							<td>
								'.$_vxc['peso'].'
							</td>
							<td>
								<button data-galeria='.$_result.' type="button" class="btn btn-panel trigger-edit-combinacion" data-idTalla="'.$_vxc['idTalla'].'" data-idGaleria="'.$_vxc['idGaleria'].'" data-idColor="'.$_vxc['idColor'].'" data-stock="'.$_vxc['stock'].'" data-precio="'.$_vxc['precio'].'" data-peso="'.$_vxc['peso'].'" data-idCombinacion="'.$_vxc['idCombinacion'].'">Editar</button> <button type="button" class="btn btn-danger" onclick="deleteElement('.$_vxc['idCombinacion'].', \'idCombinacion-\', \'deleteCombinacion\', \'true\')"> <i class="fa fa-trash"></i> </button>
							</td>';
		}
		$_response = Array(
			0 => Array('_html' => $_html)
		);
		echo json_encode($_response);
	break;
	case 'deleteCombinacion':
		$combinacion = new combinacion($_REQUEST['id']);
		$combinacion -> getCombinacion();
		$combinacion -> _removeValorxCombinacion();
		$combinacion -> deleteCombinacion();
	break;
	case 'getProductoxCategoria':
		$productoxcategoria = new productoxcategoria(0,$_REQUEST['idCategoria']);
		$productoxcategoria -> listNombreProductoxCategoria();
		echo json_encode($productoxcategoria -> _productos);
	break;
/* ============================
 * CRUD _DESCUENTO
 * ============================ */
	case 'agregardescuento':
		$descuento = new descuento(0, $_REQUEST['idCategoria'], $_REQUEST['nombre'], $_REQUEST['fechaFinalInicio'], $_REQUEST['fechaFinalExp'], 1, 0, $_REQUEST['tipoDescuento'], $_REQUEST['descuento'], $_REQUEST['prioridad']);
		$descuento -> addDescuento();
		/*$_tipo = 1;
		for($i = 0; $i < count($_REQUEST['productos']); $i++){
			if($_REQUEST['productos'][$i] != '' AND $_REQUEST['productos'][$i] != 0 ){
				$descuento -> _addDescuentoxProducto($_REQUEST['productos'][$i]);
				$_tipo = 2;
			}
		}
		$descuento -> updateTipo($_tipo);*/
		header('Location: listDescuento.php?success=1');
	break;
	case 'modificardescuento':
		$descuento = new descuento($_REQUEST['idDescuento'], $_REQUEST['idCategoria'], $_REQUEST['nombre'], $_REQUEST['fechaFinalInicio'], $_REQUEST['fechaFinalExp'], 1, 0, $_REQUEST['tipoDescuento'], $_REQUEST['descuento'], $_REQUEST['prioridad']);
		$descuento -> updateDescuento();
		/*$_tipo = 1;
		$descuento -> _removeProductoxDescuento();
		for($i = 0; $i < count($_REQUEST['productos']); $i++){
			if($_REQUEST['productos'][$i] != '' AND $_REQUEST['productos'][$i] != 0 ){
				$descuento -> _addDescuentoxProducto($_REQUEST['productos'][$i]);
				$_tipo = 2;
			}
		}
		$descuento -> updateTipo($_tipo);*/
		header('Location: listDescuento.php?success=2');
	break;
	case 'operadescuento':
		if(isset($_REQUEST['idDescuento'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idDescuento'] as $elemento) {
					$descuento  = new descuento ($elemento);
					$descuento  -> deleteDescuento();
				}
				header('location: listDescuento.php?success=3');
			}
			if ($select == 'Activar'){
				foreach ($_REQUEST['idDescuento'] as $elemento) {
					$descuento  = new descuento($elemento);
					$descuento  -> updateStatusDescuento(1);
				}
				header('location: listDescuento.php?success=4');
			}
			if ($select == 'Desactivar'){
				foreach ($_REQUEST['idDescuento'] as $elemento) {
					$descuento  = new descuento($elemento);
					$descuento  -> updateStatusDescuento(0);
				}
				header('location: listDescuento.php?success=5');
			}
		}else {
			header('location: listDescuento.php?success=0');
		}
	break;
	case 'listarDescuento':
		$herramientas = new herramientas();
		$temporal = new descuento();
		($_REQUEST['registrosPorPagina'] != '-1') ? $_rpp = $_REQUEST['registrosPorPagina'] : $_rpp = 20;
		//$_pagina = 1, $_paginador = true, $_status = '', $_busqueda = '', $_registrosPorPagina = 20, $_lastID = '', $_frontEnd = false
		$listaTemporal = $temporal -> listDescuento($_REQUEST['pagina'], $_REQUEST['cadena'], false, $_rpp);
		($_REQUEST['permisoSortable'] != 0) ? $handle = '<span class="fa-stack fa-1x mover handle"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-arrows fa-stack-1x fa-inverse"></i></span>' : $handle = '';
		foreach($listaTemporal as $elementoTemporal){
			if($_REQUEST['permisoAcDc'] == 0){
				if($elementoTemporal['status']!=0){
					$img='img/visible.png';
					$funcion='';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='';
					$class = 'ver';
				}
			}else{
				if($elementoTemporal['status']!=0){
					$img='img/visible.png';
					$funcion='changeStatus('.$elementoTemporal['idDescuento'].',0,\'changeStatusLookbook\')';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='changeStatus('.$elementoTemporal['idDescuento'].',1,\'changeStatusLookbook\')';
					$class = 'ver';
				}
			}
			$tabla .= ' <tr>
				            <td>
				                <input type="hidden" name="idorden" class="idorden" value="'.$elementoTemporal['idDescuento'].'">
				                <input type="checkbox" id="'.$elementoTemporal['idDescuento'].'" name="idDescuento[]" value="'.$elementoTemporal['idDescuento'].'">
								<label for="'.$elementoTemporal['idDescuento'].'"><span></span></label>
				            </td>
				            <td>
				                <a href="formDescuento.php?idDescuento='.$elementoTemporal['idDescuento'].'">
				                	'.$elementoTemporal['nombre'].'
				                </a>
				            </td>
				            <td>
				                '.$elementoTemporal['tipoMostrar'].'
				            </td>
				            <td>
								Fecha de inicio: '.$elementoTemporal['fechaInicioMostrar'].' <br>
				                Fecha de expiración: '.$elementoTemporal['fechaExpiracionMostrar'].'
				            </td>
				            <td>
				            	'.$elementoTemporal['tipoDescuentoMostrar'].'
				            </td>
				            <td>
				            	'.$elementoTemporal['descuento'].'
				            </td>
				            <td class="text-center">
				            	'.$handle.'
				                <img class="manita '.$class.'" onclick="'.$funcion.'" id="temp'.$elementoTemporal['idDescuento'].'" src="'.$img.'">
				            </td>
				        </tr>';
		}
		$_lastPage = count($listaTemporal)-1;
		$_de = $listaTemporal[$_lastPage]['orden'];

		$htmlpaginador = $herramientas -> paginador($listaTemporal[0]['ultimapagina'], $listaTemporal[0]['pagina'], $listaTemporal[0]['paginaanterior'], $listaTemporal[0]['paginasiguiente'], 4);
		$htmlpaginador .= '<input type="hidden" id="initfor" value="'.$_de.'">';
		$arrayJson = Array (
			0 => Array ( "tabla" => $tabla, "paginador" => $htmlpaginador)
		);
		echo json_encode($arrayJson);
	break;
	case 'changeStatusDescuento':
	 	$descuento = new descuento($_REQUEST['id']);
		$descuento -> updateStatusDescuento($_REQUEST['status']);
	break;
////////////////////////////////////
///		OPERACIONES SUBCATEGORIA
///////////////////////////////////
	case 'agregarsubcategoria':
		$subcategoria = new subcategoria(0, $_REQUEST['nombre'], $_REQUEST['descripcion'], $_FILES['archivo']['name'], $_FILES['archivo']['tmp_name']);
		$subcategoria -> addSubcategoria();
		if($_FILES['archivo2']['name'] != ''){
			$subcategoria -> updateRuta2($_FILES['archivo2']['name'], $_FILES['archivo2']['tmp_name']);
		}
		header('Location: listSubcategoria.php?success=1');
	break;
	case 'modificarsubcategoria':
		if(isset($_FILES['archivo']) and $_FILES['archivo']['name'] != ''){
			$name = $_FILES['archivo']['name'];
			$tmp = $_FILES['archivo']['tmp_name'];
		}else{
			$name = '';
			$tmp = '';
		}

		$subcategoria = new subcategoria($_REQUEST['idSubcategoria'], $_REQUEST['nombre'], $_REQUEST['descripcion'], $name, $tmp);
		$subcategoria -> updateSubcategoria();

		if($_FILES['archivo2']['name'] != ''){
			$subcategoria -> updateRuta2($_FILES['archivo2']['name'], $_FILES['archivo2']['tmp_name']);
		}

		header('Location: listSubcategoria.php?success=2');
	break;
	case 'operasubcategoria':
		if(isset($_REQUEST['idSubcategoria'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idSubcategoria'] as $elemento) {
					$subcategoria = new subcategoria($elemento);
					$subcategoria -> deleteSubcategoria();
				}
				header('location: listSubcategoria.php?success=3');
			}
			if ($select == 'Mostrar'){
				foreach ($_REQUEST['idSubcategoria'] as $elemento) {
					$subcategoria = new subcategoria($elemento);
					$subcategoria -> updateStatusSubcategoria(1);
				}
				header('location: listSubcategoria.php?success=4');
			}
			if ($select == 'No Mostrar'){
				foreach ($_REQUEST['idSubcategoria'] as $elemento) {
					$subcategoria = new subcategoria($elemento);
					$subcategoria -> updateStatusSubcategoria(0);
				}
				header('location: listSubcategoria.php?success=5');
			}
		}else {
			header('location: listSubcategoria.php?success=0');
		}
	break;
	case 'changeStatusSubcategoria':
		$subcategoria = new subcategoria($_REQUEST['id']);
		$subcategoria -> updateStatusSubcategoria($_REQUEST['status']);
	break;
	case 'listarSubcategoria':
		$herramientas = new herramientas();
		$temporal = new subcategoria();
		$listaTemporal = $temporal -> listSubcategoria($_REQUEST['pagina'], $_REQUEST['cadena']);
		($_REQUEST['permisoSortable'] != 0) ? $handle = '<span class="fa-stack fa-1x mover handle"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-arrows fa-stack-1x fa-inverse"></i></span>' : $handle = '';
		foreach($listaTemporal as $elementoTemporal){
			if($_REQUEST['permisoAcDc'] == 0){
				if($elementoTemporal['status'] != 0){
					$img='img/visible.png';
					$funcion='';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='';
					$class = 'ver';
				}
			}else{
				if($elementoTemporal['status'] != 0){
					$img='img/visible.png';
					$funcion='changeStatus('.$elementoTemporal['idSubcategoria'].',0,\'changeStatusSubcategoria\')';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='changeStatus('.$elementoTemporal['idSubcategoria'].',1,\'changeStatusSubcategoria\')';
					$class = 'ver';
				}
			}
			$tabla .= ' <tr>
				            <td>
				                <input type="hidden" name="idorden" class="idorden" value="'.$elementoTemporal['idSubcategoria'].'">
				                <input type="checkbox" id="'.$elementoTemporal['idSubcategoria'].'" name="idSubcategoria[]" value="'.$elementoTemporal['idSubcategoria'].'">
								<label for="'.$elementoTemporal['idSubcategoria'].'"><span></span></label>
				            </td>
				            <td>
				                <a href="formSubcategoria.php?idSubcategoria='.$elementoTemporal['idSubcategoria'].'">
				                    <img class="width100x" src="../img/imgSubcategoria/'.$elementoTemporal['ruta'].'">
				                </a>
				            </td>
				            <td>'.$elementoTemporal['nombre'].'</td>
				            <td class="text-center">
				            	'.$handle.'
				                <img class="manita '.$class.'" onclick="'.$funcion.'" id="temp'.$elementoTemporal['idSubcategoria'].'" src="'.$img.'">
				            </td>
				        </tr>';
		}
		$_lastPage = count($listaTemporal)-1;
		$_de = $listaTemporal[$_lastPage]['orden'];

		$htmlpaginador = $herramientas -> paginador($listaTemporal[0]['ultimapagina'], $listaTemporal[0]['pagina'], $listaTemporal[0]['paginaanterior'], $listaTemporal[0]['paginasiguiente'], 4);
		$htmlpaginador .= '<input type="hidden" id="initfor" value="'.$_de.'">';
		$arrayJson = Array (
			0 => Array ( "tabla" => $tabla, "paginador" => $htmlpaginador)
		);
		echo json_encode($arrayJson);
	break;

/* ============================
 * CRUD _TALLA
 * ============================ */
	case 'agregartalla':
		$talla = new talla(0, $_REQUEST['titulo']);
		$talla -> addTalla();
		header('Location: listPresentaciones.php?success=1');
	break;
	case 'modificartalla':
		$talla = new talla($_REQUEST['id'], $_REQUEST['titulo']);
		$talla -> updateTalla();
		header('Location: listPresentaciones.php?success=2');
	break;
	case 'operatalla':
		if(isset($_REQUEST['idTalla'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idTalla'] as $elemento) {
					$talla = new talla($elemento);
					$talla -> deleteTalla();
				}
				header('location: listPresentaciones.php?success=3');
			}
			if ($select == 'Activar'){
				foreach ($_REQUEST['idTalla'] as $elemento) {
					$talla = new talla($elemento);
					$talla -> updateStatusTalla(1);
				}
				header('location: listPresentaciones.php?success=4');
			}
			if ($select == 'Desactivar'){
				foreach ($_REQUEST['idTalla'] as $elemento) {
					$talla = new talla($elemento);
					$talla -> updateStatusTalla(0);
				}
				header('location: listPresentaciones.php?success=5');
			}
		}else {
			header('location: listPresentaciones.php?success=0');
		}
	break;
	case 'changeStatusTalla':
		$talla = new talla($_REQUEST['id']);
		$talla -> updateStatusTalla($_REQUEST['status']);
	break;
/* ============================
 * CRUD _DISTRIBUIDOR
 * ============================ */
	case 'agregardistribuidor':
		$distribuidor = new distribuidor(0, $_REQUEST['titulo'], $_REQUEST['descripcion'], $_REQUEST['latitud'], $_REQUEST['longitud']);
		$distribuidor -> addDistribuidor();
		if(isset($_REQUEST['nombre-dist'])){
			for($i = 0; $i < count($_REQUEST['nombre-dist']); $i++){
				$distribuidor -> agregarDatosDistribuidor($_REQUEST['nombre-dist'][$i], $_REQUEST['desc-dist'][$i]);
			}
		}
		header('Location: listDistribuidor.php?success=1');
	break;
	case 'modificardistribuidor':
		$distribuidor = new distribuidor($_REQUEST['id'], $_REQUEST['titulo'], $_REQUEST['descripcion'], $_REQUEST['latitud'], $_REQUEST['longitud']);
		$distribuidor -> updateDistribuidor();
		if(isset($_REQUEST['nombre-dist'])){
			for($i = 0; $i < count($_REQUEST['nombre-dist']); $i++){
				$distribuidor -> agregarDatosDistribuidor($_REQUEST['nombre-dist'][$i], $_REQUEST['desc-dist'][$i]);
			}
		}

		if(isset($_REQUEST['idDatosDistribuidor'])){
			for($i = 0; $i < count($_REQUEST['nombre-dist-mod']); $i++){
				$distribuidor -> modificarDatosDistribuidor($_REQUEST['idDatosDistribuidor'][$i], $_REQUEST['nombre-dist-mod'][$i], $_REQUEST['desc-dist-mod'][$i]);
			}
		}

		header('Location: listDistribuidor.php?success=2');
	break;
	case 'operadistribuidor':
		if(isset($_REQUEST['idDistribuidor'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idDistribuidor'] as $elemento) {
					$distribuidor = new distribuidor($elemento);
					$distribuidor -> eliminarDatosDistribuidor(0, true);
					$distribuidor -> deleteDistribuidor();
				}
				header('location: listDistribuidor.php?success=3');
			}
			if ($select == 'Activar'){
				foreach ($_REQUEST['idDistribuidor'] as $elemento) {
					$distribuidor = new distribuidor($elemento);
					$distribuidor -> updateStatusDistribuidor(1);
				}
				header('location: listDistribuidor.php?success=4');
			}
			if ($select == 'Desactivar'){
				foreach ($_REQUEST['idDistribuidor'] as $elemento) {
					$distribuidor = new distribuidor($elemento);
					$distribuidor -> updateStatusDistribuidor(0);
				}
				header('location: listDistribuidor.php?success=5');
			}
		}else {
			header('location: listDistribuidor.php?success=0');
		}
	break;
	case 'changeStatusDistribuidor':
		$distribuidor = new distribuidor($_REQUEST['id']);
		$distribuidor -> updateStatusDistribuidor($_REQUEST['status']);
	break;
	case 'listDatosDistribuidor':
		$distribuidor = new distribuidor($_REQUEST['idDistribuidor']);
		$distribuidor -> listarDatosDistribuidor();
		foreach ($distribuidor -> _datosDistribuidor as $_datos) {
			$_html .= ' <div class="input-group espacios" id="input-mod-'.$_datos['idDatosDistribuidor'].'">
							<input type="hidden" name="idDatosDistribuidor[]" value="'.$_datos['idDatosDistribuidor'].'">
						    <span class="input-group-addon">Titulo</span>
						    <input type="text" name="nombre-dist-mod[]" data-validate="true" class="form-control" placeholder="Ingresa el titulo" value="'.$_datos['nombre'].'">
						    <span class="input-group-addon">Descripción</span>
						    <input type="text" name="desc-dist-mod[]" data-validate="true" class="form-control" placeholder="Ingresa la descripción" value="'.$_datos['descripcion'].'">
						    <div class="input-group-btn">
						        <div class="btn btn-default" onclick="deleteElement('.$_datos['idDatosDistribuidor'].', \'input-mod-\', \'deleteDatosDistribuidor\', \'true\')"> <i class="fa fa-trash"></i> </div>
						    </div>
						</div>';
		}
		echo $_html;
	break;
	case 'deleteDatosDistribuidor':
		$datosDistribuidor = new datosDistribuidor($_REQUEST['id']);
		$datosDistribuidor -> deleteDatosDistribuidor();
	break;
/* ============================
 * CRUD _PAIS
 * ============================ */
	case 'agregarpais':
		$pais = new pais(0, $_REQUEST['titulo']);
		$pais -> addPais();
		header('Location: listPais.php?success=1');
	break;
	case 'modificarpais':
		$pais = new pais($_REQUEST['id'], $_REQUEST['titulo']);
		$pais -> updatePais();
		header('Location: listPais.php?success=2');
	break;
	case 'operapais':
		if(isset($_REQUEST['idPais'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idPais'] as $elemento) {
					$pais = new pais($elemento);
					$pais -> deletePais();
				}
				header('location: listPais.php?success=3');
			}
			if ($select == 'Activar'){
				foreach ($_REQUEST['idPais'] as $elemento) {
					$pais = new pais($elemento);
					$pais -> updateStatusPais(1);
				}
				header('location: listPais.php?success=4');
			}
			if ($select == 'Desactivar'){
				foreach ($_REQUEST['idPais'] as $elemento) {
					$pais = new pais($elemento);
					$pais -> updateStatusPais(0);
				}
				header('location: listPais.php?success=5');
			}
		}else {
			header('location: listPais.php?success=0');
		}
	break;
	case 'changeStatusPais':
		$pais = new pais($_REQUEST['id']);
		$pais -> updateStatusPais($_REQUEST['status']);
	break;
/* ============================
 * CRUD _COLOR
 * ============================ */
	case 'agregarcolor':
		if($_FILES['imagen']['name'] != ''){
			$_name = $_FILES['imagen']['name'];
			$_tmp = $_FILES['imagen']['tmp_name'];
		}else{
			$_name = '';
			$_tmp = '';
		}
		$color = new color(0, $_REQUEST['nombre'], $_REQUEST['color'], $_REQUEST['tipo'], $_name, $_tmp);
		$color -> addColor();
		header('Location: listColor.php?success=1');
	break;
	case 'modificarcolor':
		if($_FILES['imagen']['name'] != ''){
			$_name = $_FILES['imagen']['name'];
			$_tmp = $_FILES['imagen']['tmp_name'];
		}else{
			$_name = '';
			$_tmp = '';
		}
		$color = new color($_REQUEST['id'], $_REQUEST['nombre'], $_REQUEST['color'], $_REQUEST['tipo'], $_name, $_tmp);
		$color -> updateColor();
		header('Location: listColor.php?success=2');
	break;
	case 'operacolor':
		if(isset($_REQUEST['idColor'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idColor'] as $elemento) {
					$color = new color($elemento);
					$color -> deleteColor();
				}
				header('location: listColor.php?success=3');
			}
			if ($select == 'Activar'){
				foreach ($_REQUEST['idColor'] as $elemento) {
					$color = new color($elemento);
					$color -> updateStatusColor(1);
				}
				header('location: listColor.php?success=4');
			}
			if ($select == 'Desactivar'){
				foreach ($_REQUEST['idColor'] as $elemento) {
					$color = new color($elemento);
					$color -> updateStatusColor(0);
				}
				header('location: listColor.php?success=5');
			}
		}else {
			header('location: listColor.php?success=0');
		}
	break;
	case 'changeStatusColor':
		$color = new color($_REQUEST['id']);
		$color -> updateStatusColor($_REQUEST['status']);
	break;
////////////////////////////////////
///		OPERACIONES MARCA
///////////////////////////////////
	case 'agregarmarca':
		$marca = new marca(0, $_REQUEST['nombre'], $_FILES['archivo']['name'], $_FILES['archivo']['tmp_name']);
		$marca -> addMarca();

		header('Location: listMarca.php?success=1');
	break;
	case 'modificarmarca':
		if(isset($_FILES['archivo']) and $_FILES['archivo']['name'] != ''){
			$name = $_FILES['archivo']['name'];
			$tmp = $_FILES['archivo']['tmp_name'];
		}else{
			$name = '';
			$tmp = '';
		}

		$marca = new marca($_REQUEST['idMarca'], $_REQUEST['nombre'], $name, $tmp);
		$marca -> updateMarca();

		header('Location: listMarca.php?success=2');
	break;
	case 'operamarca':
		if(isset($_REQUEST['idMarca'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idMarca'] as $elemento) {
					$marca = new marca($elemento);
					$marca -> deleteMarca();
				}
				header('location: listMarca.php?success=3');
			}
			if ($select == 'Mostrar'){
				foreach ($_REQUEST['idMarca'] as $elemento) {
					$marca = new marca($elemento);
					$marca -> updateStatusMarca(1);
				}
				header('location: listMarca.php?success=4');
			}
			if ($select == 'No Mostrar'){
				foreach ($_REQUEST['idMarca'] as $elemento) {
					$marca = new marca($elemento);
					$marca -> updateStatusMarca(0);
				}
				header('location: listMarca.php?success=5');
			}
		}else {
			header('location: listMarca.php?success=0');
		}
	break;
	case 'changeStatusMarca':
		$marca = new marca($_REQUEST['id']);
		$marca -> updateStatusMarca($_REQUEST['status']);
	break;
	case 'listarMarca':
		$herramientas = new herramientas();
		$temporal = new marca();
		$listaTemporal = $temporal -> listMarca($_REQUEST['pagina'], $_REQUEST['cadena']);
		($_REQUEST['permisoSortable'] != 0) ? $handle = '<span class="fa-stack fa-1x mover handle"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-arrows fa-stack-1x fa-inverse"></i></span>' : $handle = '';
		foreach($listaTemporal as $elementoTemporal){
			if($_REQUEST['permisoAcDc'] == 0){
				if($elementoTemporal['status'] != 0){
					$img='img/visible.png';
					$funcion='';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='';
					$class = 'ver';
				}
			}else{
				if($elementoTemporal['status'] != 0){
					$img='img/visible.png';
					$funcion='changeStatus('.$elementoTemporal['idMarca'].',0,\'changeStatusMarca\')';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='changeStatus('.$elementoTemporal['idMarca'].',1,\'changeStatusMarca\')';
					$class = 'ver';
				}
			}
			$tabla .= ' <tr>
				            <td>
				                <input type="hidden" name="idorden" class="idorden" value="'.$elementoTemporal['idMarca'].'">
				                <input type="checkbox" id="'.$elementoTemporal['idMarca'].'" name="idMarca[]" value="'.$elementoTemporal['idMarca'].'">
								<label for="'.$elementoTemporal['idMarca'].'"><span></span></label>
				            </td>
				            <td>
				                <a href="formMarca.php?idMarca='.$elementoTemporal['idMarca'].'">
				                    <img class="width100x" src="../img/imgMarca/'.$elementoTemporal['ruta'].'">
				                </a>
				            </td>
				            <td>'.$elementoTemporal['nombre'].'</td>
				            <td class="text-center">
				            	'.$handle.'
				                <img class="manita '.$class.'" onclick="'.$funcion.'" id="temp'.$elementoTemporal['idMarca'].'" src="'.$img.'">
				            </td>
				        </tr>';
		}
		$_lastPage = count($listaTemporal)-1;
		$_de = $listaTemporal[$_lastPage]['orden'];

		$htmlpaginador = $herramientas -> paginador($listaTemporal[0]['ultimapagina'], $listaTemporal[0]['pagina'], $listaTemporal[0]['paginaanterior'], $listaTemporal[0]['paginasiguiente'], 4);
		$htmlpaginador .= '<input type="hidden" id="initfor" value="'.$_de.'">';
		$arrayJson = Array (
			0 => Array ( "tabla" => $tabla, "paginador" => $htmlpaginador)
		);
		echo json_encode($arrayJson);
	break;
////////////////////////////////////
///		OPERACIONES PRODUCTO
///////////////////////////////////
	case 'agregarproducto':
		if(isset($_REQUEST['idSubcategoria']))
			$idSubcategoria = $_REQUEST['idSubcategoria'];
		else
			$idSubcategoria = 0;
		$producto = new producto(0, $_REQUEST['idCategoria'], $idSubcategoria, $_REQUEST['idMarca'], $_REQUEST['nombre'], $_REQUEST['descripcion'], $_REQUEST['tiempoEntrega'], $_REQUEST['material'], $_FILES['archivo']['name'], $_FILES['archivo']['tmp_name']);
		$producto -> addProducto();

		if($_REQUEST['sincombinacion'] == 1){
			if($_REQUEST['descuento'] != '')
				$_descuento = $_REQUEST['descuento'];
			else
				$_descuento = '0';
			$producto -> addPrecioStock($_REQUEST['precioProducto'], $_REQUEST['pesoProducto'], $_REQUEST['stockProducto'], $_descuento, $_REQUEST['tipoDescuento']);
		}

		if(isset($_FILES['fichaTecnica']) and $_FILES['fichaTecnica']['name'] != ''){
			$producto -> addFichaTecnica($_FILES['fichaTecnica']['name'], $_FILES['fichaTecnica']['tmp_name']);
		}
		if(isset($_FILES['galeria'])){
			for($i = 0; $i < count($_FILES['galeria']); $i++){
				if($_FILES['galeria']['name'][$i] != ''){
					$ruta = $_FILES['galeria']['name'][$i];
					$tmp = $_FILES['galeria']['tmp_name'][$i];
					$producto -> agregarGaleria($ruta, $tmp);
				}

			}
		}
		if(isset($_REQUEST['atributos']) and $_REQUEST['sincombinacion'] == 0){
			for($i = 0; $i < count($_REQUEST['atributos']); $i++){
				if($_REQUEST['atributos'][$i] != ''){
					$productoxatributo = new productoxatributo($producto -> idProducto, $_REQUEST['atributos'][$i], $i);
					$productoxatributo -> addProductoxAtributo();
				}
			}
		}
		if(isset($_REQUEST['transporte'])){
			for($i = 0; $i < count($_REQUEST['transporte']); $i++){
				if($_REQUEST['transporte'][$i] != 0 and $_REQUEST['transporte'][$i] != ''){
					$transportexproducto = new transportexproducto($producto -> idProducto, $_REQUEST['transporte'][$i]);
					$transportexproducto -> addProductoxTransporte();
				}
			}
		}
		if($_REQUEST['sincombinacion'] == 0)
			header('Location: formProducto.php?idProducto='.$producto -> idProducto.'&tabProducto=active');
		else
			header('Location: listProducto.php?success=1');
	break;
	case 'modificarproducto':
		if(isset($_FILES['archivo']) and $_FILES['archivo']['name']){
			$ruta = $_FILES['archivo']['name'];
			$tmp = $_FILES['archivo']['tmp_name'];
		}else{
			$ruta = '';
			$tmp = '';
		}
		if(isset($_REQUEST['idSubcategoria']))
			$idSubcategoria = $_REQUEST['idSubcategoria'];
		else
			$idSubcategoria = 0;
		$producto = new producto($_REQUEST['idProducto'], $_REQUEST['idCategoria'], $idSubcategoria, $_REQUEST['idMarca'], $_REQUEST['nombre'], $_REQUEST['descripcion'], $_REQUEST['tiempoEntrega'], $_REQUEST['material'], $ruta, $tmp);
		$producto -> updateProducto();

		if($_REQUEST['sincombinacion'] == 1){
			if($_REQUEST['descuento'] != '')
				$_descuento = $_REQUEST['descuento'];
			else
				$_descuento = '0';
			$producto ->  addPrecioStock($_REQUEST['precioProducto'], $_REQUEST['pesoProducto'], $_REQUEST['stockProducto'], $_descuento, $_REQUEST['tipoDescuento']);
		}

		if(isset($_FILES['fichaTecnica']) and $_FILES['fichaTecnica']['name'] != ''){
			$producto -> addFichaTecnica($_FILES['fichaTecnica']['name'], $_FILES['fichaTecnica']['tmp_name']);
		}

		if(isset($_FILES['galeria'])){
			for($i = 0; $i < count($_FILES['galeria']); $i++){
				if($_FILES['galeria']['name'][$i] != ''){
					$ruta = $_FILES['galeria']['name'][$i];
					$tmp = $_FILES['galeria']['tmp_name'][$i];
					$producto -> agregarGaleria($ruta, $tmp);
				}

			}
		}
		if(isset($_FILES['galeriaMod'])){
			for($i = 0; $i < count($_FILES['galeriaMod']); $i++){
				if($_FILES['galeriaMod']['name'][$i] != ''){
					$idGaleria = $_REQUEST['idGaleria'][$i];
					$ruta = $_FILES['galeriaMod']['name'][$i];
					$tmp = $_FILES['galeriaMod']['tmp_name'][$i];
					$producto -> modificarGaleria($idGaleria, $ruta, $tmp);
				}
			}
		}
		/**
		 * AÑADIR TRANSPORTES
		 */

			$transportexproducto = new transportexproducto($producto -> idProducto);
			$transportexproducto -> removeTransportexProducto();
			for($i = 0; $i < count($_REQUEST['transporte']); $i++){
				if($_REQUEST['transporte'][$i] != 0 and $_REQUEST['transporte'][$i] != ''){
					$transportexproducto -> idTransporte = $_REQUEST['transporte'][$i];
					$transportexproducto -> addProductoxTransporte();
				}
			}

		/**
		 * AÑADIR O ELIMINAR ATRIBUTOS RESPETANDO EL ORDEN DE LAS COLUMNAS
		 * VALIDANDO QUE EXISTAN COMBINACIONES PARA ESTE PRODUCTO.
		 */
		if($_REQUEST['sincombinacion'] == 0){
			if(isset($_REQUEST['atributos'])){
				$productoxatributo = new productoxatributo($producto -> idProducto);
				$productoxatributo -> removeAtributoxProducto();
				$orden = count($_REQUEST['atributos']);
				for($i = 0; $i < count($_REQUEST['atributos']); $i++){
					if($_REQUEST['atributos'][$i] != ''){
						$productoxatributo -> idAtributo = $_REQUEST['atributos'][$i];
						$productoxatributo -> orden = $orden;
						$productoxatributo -> addProductoxAtributo();
					}
				}
			}
			if(isset($_REQUEST['orden-columna'])){
				for($i = 0; $i < count($_REQUEST['orden-columna']); $i++){
					$productoxatributo -> idAtributo = $_REQUEST['orden-columna'][$i];
					$productoxatributo -> updateOrdenProductoxAtributo($i);
				}
			}
			$productoxatributo -> listNombreAtributoxProducto();
			if(isset($_REQUEST['temporalID'])){
				$_temporalID = $_REQUEST['temporalID'];
				for($i = 0; $i < count($_temporalID); $i++){
					if($_REQUEST['Precio'][$i] != '' and $_REQUEST['Peso'][$i] != '' and $_REQUEST['Stock'][$i] != ''){
						$precio = $_REQUEST['Precio'][$i];
						$peso = $_REQUEST['Peso'][$i];
						$stock = $_REQUEST['Stock'][$i];
						$tipoDescuento = $_REQUEST['TipoDescuento'][$i];
						$descuento = $_REQUEST['Descuento'][$i];
						$combinacion = new combinacion(0, $producto -> idProducto, $precio, $peso, $stock, $descuento, $tipoDescuento);
						$combinacion -> addCombinacion();
						foreach ($productoxatributo -> atributos as $keyAttr) {
							$valor = $_REQUEST[$keyAttr['name_input'].'-'.$_temporalID[$i]];
							$valoresxcombinacion = new valoresxcombinacion($combinacion -> idCombinacion, $keyAttr['idAtributo'], $producto -> idProducto, $valor);
							$valoresxcombinacion -> addProductoxAtributo();
						}
					}
				}
			}
			if(isset($_REQUEST['idCombinacion'])){
				$_idCombinacion = $_REQUEST['idCombinacion'];
				for($i = 0; $i < count($_idCombinacion); $i++){
					if($_REQUEST['PrecioMod'][$i] != '' and $_REQUEST['PesoMod'][$i] != '' and $_REQUEST['StockMod'][$i] != ''){
						$precio = $_REQUEST['PrecioMod'][$i];
						$peso = $_REQUEST['PesoMod'][$i];
						$stock = $_REQUEST['StockMod'][$i];
						$tipoDescuento = $_REQUEST['TipoDescuentoMod'][$i];
						$descuento = $_REQUEST['DescuentoMod'][$i];
						$combinacion = new combinacion($_idCombinacion[$i], $producto -> idProducto, $precio, $peso, $stock, $descuento, $tipoDescuento);
						$combinacion -> updateCombinacion();
						$valoresxcombinacion = new valoresxcombinacion($_idCombinacion[$i]);
						$valoresxcombinacion -> removeAtributoxCombinacion();
						foreach ($productoxatributo -> atributos as $keyAttr) {
							$valoresxcombinacion -> idAtributo = $keyAttr['idAtributo'];
							$valoresxcombinacion -> idProducto = $producto -> idProducto;
							$valoresxcombinacion -> valor = $_REQUEST[$keyAttr['name_input'].'-'.$_idCombinacion[$i].'-mod'];
							$valoresxcombinacion -> addProductoxAtributo();
						}
					}
				}
			}
		}
		header('Location: listProducto.php?success=2');
	break;
	case 'listarProducto':
		$herramientas = new herramientas();
		$temporal = new producto();
		$listaTemporal = $temporal -> listProducto($_REQUEST['pagina'], $_REQUEST['idCategoria'], $_REQUEST['idSubcategoria'], $_REQUEST['idMarca'], $_REQUEST['cadena']);
		($_REQUEST['permisoSortable'] != 0) ? $handle = '<span class="fa-stack fa-1x mover handle"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-arrows fa-stack-1x fa-inverse"></i></span>' : $handle = '';
		foreach($listaTemporal as $elementoTemporal){
			if($_REQUEST['permisoAcDc'] == 0){
				if($elementoTemporal['status'] != 0){
					$img='img/visible.png';
					$funcion='';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='';
					$class = 'ver';
				}
			}else{
				if($elementoTemporal['status'] != 0){
					$img='img/visible.png';
					$funcion='changeStatus('.$elementoTemporal['idProducto'].',0,\'changeStatusProducto\')';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='changeStatus('.$elementoTemporal['idProducto'].',1,\'changeStatusProducto\')';
					$class = 'ver';
				}
			}
			if($elementoTemporal['destacado'] != 0){
				$_fa = 'fa-toggle-on';
				$_funcion = 'changeDestacado('.$elementoTemporal['idProducto'].',0,\'changeDestacadoProducto\')';
			}else{
				$_fa = 'fa-toggle-off';
				$_funcion = 'changeDestacado('.$elementoTemporal['idProducto'].',1,\'changeDestacadoProducto\')';
			}
			$tabla .= ' <tr>
				            <td>
				                <input type="hidden" name="idorden" class="idorden" value="'.$elementoTemporal['idProducto'].'">
				                <input type="checkbox" id="'.$elementoTemporal['idProducto'].'" name="idProducto[]" value="'.$elementoTemporal['idProducto'].'">
								<label for="'.$elementoTemporal['idProducto'].'"><span></span></label>
				            </td>
				            <td>
				                <a href="formProducto.php?idProducto='.$elementoTemporal['idProducto'].'">
				                    <img class="width100x" src="../img/imgProducto/'.$elementoTemporal['ruta'].'">
				                </a>
				            </td>
				            <td>'.$elementoTemporal['nombre'].'</td>
				            <td>'.$elementoTemporal['nombreCategoria'].'</td>
				            <td>'.$elementoTemporal['nombreSubcategoria'].'</td>
				            <td>'.$elementoTemporal['nombreMarca'].'</td>
				            <td class="text-center">
				                <span class="btn btn-default btn-xs"><i id="dest'.$elementoTemporal['idProducto'].'" class="fa '.$_fa.'" onclick="'.$_funcion.'"></i><span>
				            </td>
				            <td class="text-center">
				            	'.$handle.'
				                <img class="manita '.$class.'" onclick="'.$funcion.'" id="temp'.$elementoTemporal['idProducto'].'" src="'.$img.'">
				            </td>
				        </tr>';
		}
		$_lastPage = count($listaTemporal)-1;
		$_de = $listaTemporal[$_lastPage]['orden'];

		$htmlpaginador = $herramientas -> paginador($listaTemporal[0]['ultimapagina'], $listaTemporal[0]['pagina'], $listaTemporal[0]['paginaanterior'], $listaTemporal[0]['paginasiguiente'], 4);
		$htmlpaginador .= '<input type="hidden" id="initfor" value="'.$_de.'">';
		$arrayJson = Array (
			0 => Array ( "tabla" => $tabla, "paginador" => $htmlpaginador)
		);
		echo json_encode($arrayJson);
	break;
	case 'getSubcategorias':
		$categoria = new categoria($_REQUEST['idCategoria']);
		$categoria -> listarSubcategoria(1);
		echo json_encode($categoria -> _subcategorias);
	break;
	case 'changeStatusProducto':
		$producto = new producto($_REQUEST['id']);
		$producto -> updateStatusProducto($_REQUEST['status']);
	break;
	case 'changeDestacadoProducto':
		$producto = new producto($_REQUEST['id']);
		if($producto -> validarProductoDestacado() AND $_REQUEST['status'] == 1){
			$producto -> updateDestacadoProducto($_REQUEST['status']);
			echo 1;
		}else{
			$producto -> updateDestacadoProducto(0);
			echo 0;
		}
	break;
	case 'operaproducto':
		if(isset($_REQUEST['idProducto'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idProducto'] as $elemento) {
					$producto = new producto($elemento);
					$producto -> listarGaleria();
					foreach ($producto -> galeria as $key) {
						$producto -> eliminarGaleria($key['idGaleria']);
					}
					$producto -> deleteProducto();
				}
				header('location: listProducto.php?success=3');
			}
			if ($select == 'Mostrar'){
				foreach ($_REQUEST['idProducto'] as $elemento) {
					$producto = new producto($elemento);
					$producto -> updateStatusProducto(1);
				}
				header('location: listProducto.php?success=4');
			}
			if ($select == 'No Mostrar'){
				foreach ($_REQUEST['idProducto'] as $elemento) {
					$producto = new producto($elemento);
					$producto -> updateStatusProducto(0);
				}
				header('location: listProducto.php?success=5');
			}
		}else {
			header('location: listProducto.php?success=0');
		}
	break;
/* ==========================================
 * ORDENAR COMBINACIONES
 * ========================================== */
	case 'ordenarCombinacion':
		$_orden = $_REQUEST['orden'];
		for($i = 0; $i < count($_orden); $i++){
			$combinacion = new combinacion($_orden[$i]);
			$combinacion -> updateOrdenCombinacion($i);
		}
	break;
/* ==========================================
 * ORDENAR COLUMNAS
 * ========================================== */
	case 'ordenarColumna':
		$_orden = $_REQUEST['orden'];
		for($i = 0; $i < count($_orden); $i++){
			$productoxatributo = new productoxatributo($_REQUEST['idProducto'], $_orden[$i]);
			$productoxatributo -> updateOrdenProductoxAtributo($i);
		}
	break;
/* ==========================================
 * CAMBIAR STATUS COMBINACION
 * ========================================== */
	case 'changeStatusCombinacion':
		$combinacion = new combinacion($_REQUEST['idCombinacion']);
		$combinacion -> updateStatusCombinacion($_REQUEST['status']);
	break;
/* ==========================================
 * ELIMINAR COMBINACION
 * ========================================== */
	case 'deleteCombinacion':
		$combinacion = new combinacion($_REQUEST['idCombinacion']);
		$combinacion -> deleteCombinacion();
		$valoresxcombinacion = new valoresxcombinacion($_REQUEST['idCombinacion']);
		$valoresxcombinacion -> removeAtributoxCombinacion();
	break;

////////////////////////////////////
///		OPERACIONES ATRIBUTO
///////////////////////////////////
	case 'agregaratributo':
		$atributo = new atributo(0,$_REQUEST['nombre']);
		$atributo -> addAtributo();
		header('Location: listAtributo.php?success=1');
	break;
	case 'modificaratributo':
		$atributo = new atributo($_REQUEST['idAtributo'], $_REQUEST['nombre']);
		header('Location: listAtributo.php?success=2');
		$atributo -> updateAtributo();
	break;
	case 'operaatributo':
		if(isset($_REQUEST['idAtributo'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idAtributo'] as $elemento) {
					$atributo = new atributo ($elemento);
					$atributo  -> deleteAtributo();
				}
				header('location: listAtributo.php?success=3');
			}
			if ($select == 'Mostrar'){
				foreach ($_REQUEST['idAtributo'] as $elemento) {
					$atributo = new atributo($elemento);
					$atributo-> updateStatusAtributo(1);
				}
				header('location: listAtributo.php?success=4');
			}
			if ($select == 'No Mostrar'){
				foreach ($_REQUEST['idAtributo'] as $elemento) {
					$atributo = new atributo($elemento);
					$atributo -> updateStatusAtributo(0);
				}
				header('location: listAtributo.php?success=5');
			}
		}else {
			header('location: listAtributo.php?success=0');
		}
	break;
	case 'changeStatusAtributo':
		$atributo = new atributo($_REQUEST['id']);
		$atributo -> updateStatusAtributo($_REQUEST['status']);
	break;
	case 'listarAtributo':
		$herramientas = new herramientas();
		$temporal = new atributo();
		$listaTemporal = $temporal -> listAtributo($_REQUEST['pagina'], $_REQUEST['cadena']);
		($_REQUEST['permisoSortable'] != 0) ? $handle = '<span class="fa-stack fa-1x mover handle"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-arrows fa-stack-1x fa-inverse"></i></span>' : $handle = '';
		foreach($listaTemporal as $elementoTemporal){
			if($_REQUEST['permisoAcDc'] == 0){
				if($elementoTemporal['status'] != 0){
					$img='img/visible.png';
					$funcion='';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='';
					$class = 'ver';
				}
			}else{
				if($elementoTemporal['status'] != 0){
					$img='img/visible.png';
					$funcion='changeStatus('.$elementoTemporal['idAtributo'].',0,\'changeStatusAtributo\')';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='changeStatus('.$elementoTemporal['idAtributo'].',1,\'changeStatusAtributo\')';
					$class = 'ver';
				}
			}
			$tabla .= ' <tr>
				            <td>
				                <input type="hidden" name="idorden" class="idorden" value="'.$elementoTemporal['idAtributo'].'">
				                <input type="checkbox" id="'.$elementoTemporal['idAtributo'].'" name="idAtributo[]" value="'.$elementoTemporal['idAtributo'].'">
								<label for="'.$elementoTemporal['idAtributo'].'"><span></span></label>
				            </td>
				            <td>
				                <a href="formAtributo.php?idAtributo='.$elementoTemporal['idAtributo'].'">
				                    '.$elementoTemporal['nombre'].'
				                </a>
				            </td>
				            <td class="text-center">
				            	'.$handle.'
				                <img class="manita '.$class.'" onclick="'.$funcion.'" id="temp'.$elementoTemporal['idAtributo'].'" src="'.$img.'">
				            </td>
				        </tr>';
		}
		$_lastPage = count($listaTemporal)-1;
		$_de = $listaTemporal[$_lastPage]['orden'];

		$htmlpaginador = $herramientas -> paginador($listaTemporal[0]['ultimapagina'], $listaTemporal[0]['pagina'], $listaTemporal[0]['paginaanterior'], $listaTemporal[0]['paginasiguiente'], 4);
		$htmlpaginador .= '<input type="hidden" id="initfor" value="'.$_de.'">';
		$arrayJson = Array (
			0 => Array ( "tabla" => $tabla, "paginador" => $htmlpaginador)
		);
		echo json_encode($arrayJson);
	break;
/* ==========================================
 * OPERACIONES DE TRANSPORTE
 * ========================================== */
	case 'agregartransporte':
		$transporte = new transporte(0, $_REQUEST['nombre'], $_REQUEST['tiempoTransito'], $_REQUEST['gratis'], $_REQUEST['cantidadGratis'], $_FILES['archivo']['name'], $_FILES['archivo']['tmp_name']);
		$transporte -> addTransporte();
		header('Location: formTransporte.php?idTransporte='.$transporte -> idTransporte.'&tabRango=active');
	break;
	case 'modificartransporte':
		if(isset($_FILES['archivo']) and $_FILES['archivo']['name'] != ''){
			$archivo = $_FILES['archivo']['name'];
			$tmp = $_FILES['archivo']['tmp_name'];
		}else{
			$archivo = '';
			$tmp = '';
		}
		$transporte = new transporte($_REQUEST['idTransporte'],  $_REQUEST['nombre'], $_REQUEST['tiempoTransito'], $_REQUEST['gratis'], $_REQUEST['cantidadGratis'], $archivo, $tmp);
		$transporte -> updateTransporte();

		if(isset($_REQUEST['rango']['pesoMinimo'])){
			/*for($i = 0; $i < count($_REQUEST['rango']['pesoMinimo']); $i++){
				$_ID = $_REQUEST['rango']['id-tmp'][$i];
				$_rangos = '';
				for($c = 0; $c < count($_REQUEST['montos']['pais-'.$_ID]); $c++){
					$_rangos .= 'idPAis : '.$_REQUEST['montos']['pais-'.$_ID][$c].' PRECIO: '.$_REQUEST['montos']['precio-'.$_ID][$c].'<br>';
				}
				echo '<pre style="border: 1px solid red;">PESO MIN: '.$_pesoMin = $_REQUEST['rango']['pesoMinimo'][$i].' PESO MAX: '.$_REQUEST['rango']['pesoMaximo'][$i].'  RANGOS : <br> '.$_rangos.'</pre>';
			}*/
			for($i = 0; $i < count($_REQUEST['rango']['pesoMinimo']); $i++){
				if($_REQUEST['rango']['pesoMinimo'][$i] != ''){
					$_pesoMin = $_REQUEST['rango']['pesoMinimo'][$i];
					$_pesoMax = $_REQUEST['rango']['pesoMaximo'][$i];
					$_ID = $_REQUEST['rango']['id-tmp'][$i];
					$_idRangoTransporte = $transporte -> agregarRango($_pesoMin, $_pesoMax, 0);
					for($c = 0; $c < count($_REQUEST['montos']['pais-'.$_ID]); $c++){
						$_idPais = $_REQUEST['montos']['pais-'.$_ID][$c];
						$_precio = $_REQUEST['montos']['precio-'.$_ID][$c];
						$rangoxpais = new rangoxpais($_REQUEST['idTransporte'], $_idRangoTransporte, $_idPais, $_precio);
						$rangoxpais -> addRangoxPais();
					}
				}
			}
		}
		if(isset($_REQUEST['rango-mod']['pesoMinimo'])){
			for($i = 0; $i < count($_REQUEST['rango-mod']['pesoMinimo']); $i++){
				if($_REQUEST['rango-mod']['pesoMinimo'][$i] != ''){
					$_idRango = $_REQUEST['rango-mod']['idRangoTransporte'][$i];
					$_pesoMin = $_REQUEST['rango-mod']['pesoMinimo'][$i];
					$_pesoMax = $_REQUEST['rango-mod']['pesoMaximo'][$i];
					//$_cargo = $_REQUEST['cargoPorEnvioMod'][$i];
					$transporte -> modificarRango($_idRango, $_pesoMin, $_pesoMax, 0);
					$rangoxpais = new rangoxpais($_REQUEST['idTransporte'], $_idRango);
					$rangoxpais -> removeRangoxPais();
					for($c = 0; $c < count($_REQUEST['montos-mod']['pais-'.$_idRango]); $c++){
						$_idPais = $_REQUEST['montos-mod']['pais-'.$_idRango][$c];
						$_precio = $_REQUEST['montos-mod']['precio-'.$_idRango][$c];
						$rangoxpais -> _idPais = $_idPais;
						$rangoxpais -> _precio = $_precio;
						$rangoxpais -> addRangoxPais();
					}
				}
			}
		}
		header('Location: listTransporte.php?success=2');
	break;
	case 'operatransporte':
		if(isset($_REQUEST['idTransporte'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idTransporte'] as $elemento) {
					$transporte = new transporte($elemento);
					$transporte  -> deleteTransporte();
				}
				header('location: listTransporte.php?success=3');
			}
			if ($select == 'Activar'){
				foreach ($_REQUEST['idTransporte'] as $elemento) {
					$transporte = new transporte($elemento);
					$transporte -> updateStatusTransporte(1);
				}
				header('location: listTransporte.php?success=4');
			}
			if ($select == 'Desactivar'){
				foreach ($_REQUEST['idTransporte'] as $elemento) {
					$transporte = new transporte($elemento);
					$transporte -> updateStatusTransporte(0);
				}
				header('location: listTransporte.php?success=5');
			}
		}else {
			header('location: listTransporte.php?success=0');
		}
	break;
	case 'changeStatusTransporte':
		$transporte = new transporte($_REQUEST['id']);
		$transporte -> updateStatusTransporte($_REQUEST['status']);
	break;
	case 'deleteTransporte':
		$transporte = new transporte();
		$transporte -> eliminarRango($_REQUEST['idRangoTransporte']);
	break;
	case 'changeStatusRango':
		$transporte = new transporte();
		$transporte -> modificarStatusRango($_REQUEST['idRango'], $_REQUEST['status']);
	break;
	case 'listarTransporte':
		$herramientas = new herramientas();
		$temporal = new transporte();
		$listaTemporal = $temporal -> listTransporte($_REQUEST['pagina'], $_REQUEST['cadena']);
		($_REQUEST['permisoSortable'] != 0) ? $handle = '<span class="fa-stack fa-1x mover handle"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-arrows fa-stack-1x fa-inverse"></i></span>' : $handle = '';
		foreach($listaTemporal as $elementoTemporal){
			if($_REQUEST['permisoAcDc'] == 0){
				if($elementoTemporal['status'] != 0){
					$img='img/visible.png';
					$funcion='';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='';
					$class = 'ver';
				}
			}else{
				if($elementoTemporal['status'] != 0){
					$img='img/visible.png';
					$funcion='changeStatus('.$elementoTemporal['idTransporte'].',0,\'changeStatusTransporte\')';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='changeStatus('.$elementoTemporal['idTransporte'].',1,\'changeStatusTransporte\')';
					$class = 'ver';
				}
			}
			$tabla .= ' <tr>
				            <td>
				                <input type="hidden" name="idorden" class="idorden" value="'.$elementoTemporal['idTransporte'].'">
				                <input type="checkbox" id="'.$elementoTemporal['idTransporte'].'" name="idTransporte[]" value="'.$elementoTemporal['idTransporte'].'">
								<label for="'.$elementoTemporal['idTransporte'].'"><span></span></label>
				            </td>
				            <td>
				                <a href="formTransporte.php?idTransporte='.$elementoTemporal["idTransporte"].'">
				                    <img class="width100x" src="../img/imgTransporte/'.$elementoTemporal["ruta"].'"></img>
				                </a>
				            </td>
				            <td>
				                <a href="formTransporte.php?idTransporte='.$elementoTemporal["idTransporte"].'">
				                    '.$elementoTemporal["nombre"].'
				                </a>
				            </td>
				            <td>'.$elementoTemporal["tiempoTransito"].'</td>
				            <td class="text-center">
				            	'.$handle.'
				                <img class="manita '.$class.'" onclick="'.$funcion.'" id="temp'.$elementoTemporal['idAtributo'].'" src="'.$img.'">
				            </td>
				        </tr>';
		}
		$_lastPage = count($listaTemporal)-1;
		$_de = $listaTemporal[$_lastPage]['orden'];

		$htmlpaginador = $herramientas -> paginador($listaTemporal[0]['ultimapagina'], $listaTemporal[0]['pagina'], $listaTemporal[0]['paginaanterior'], $listaTemporal[0]['paginasiguiente'], 4);
		$htmlpaginador .= '<input type="hidden" id="initfor" value="'.$_de.'">';
		$arrayJson = Array (
			0 => Array ( "tabla" => $tabla, "paginador" => $htmlpaginador)
		);
		echo json_encode($arrayJson);
	break;
////////////////////////////////////
///		OPERACIONES ASPIRANTE
///////////////////////////////////
	case 'listarAspirante':
		$herramientas = new herramientas();
		$temporal = new aspirante();
		$listaTemporal = $temporal -> listAspirante($_REQUEST['pagina'], $_REQUEST['tipo'], $_REQUEST['cadena']);

		foreach($listaTemporal as $elementoTemporal){
			$tabla .= ' <tr>
							<td>
				                <input type="hidden" name="idorden" class="idorden" value="'.$elementoTemporal['idAspirante'].'">
				                <input type="checkbox" id="'.$elementoTemporal['idAspirante'].'" name="idAspirante[]" value="'.$elementoTemporal['idAspirante'].'">
								<label for="'.$elementoTemporal['idAspirante'].'"><span></span></label>
				            </td>
				            <td>'.$elementoTemporal['nombre'].' '.$elementoTemporal['apellido'].'</td>
				            <td>'.$elementoTemporal['correo'].'</td>
				            <td>'.$elementoTemporal['telefono'].'</td>
				            <td>'.$elementoTemporal['puesto'].'</td>
				            <td>'.$elementoTemporal['ciudad'].', '.$elementoTemporal['estado'].'</td>
				            <td><a href="../curriculums/'.$elementoTemporal['curriculum'].'" download="../curriculums/'.$elementoTemporal['curriculum'].'">DESCARGAR</a></td>
				        </tr>';
		}
		$_lastPage = count($listaTemporal)-1;
		$_de = $listaTemporal[$_lastPage]['orden'];
		$htmlpaginador = '<input type="hidden" id="initfor" value="'.$_de.'">';
		$htmlpaginador = $herramientas -> paginador($listaTemporal[0]['ultimapagina'], $listaTemporal[0]['pagina'], $listaTemporal[0]['paginaanterior'], $listaTemporal[0]['paginasiguiente'], 4);

		$arrayJson = Array (
			0 => Array ( "tabla" => $tabla, "paginador" => $htmlpaginador)
		);
		echo json_encode($arrayJson);
	break;
	case 'operaaspirante':
		if(isset($_REQUEST['idAspirante'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idAspirante'] as $elemento) {
					$aspirante = new aspirante($elemento);
					$aspirante -> deleteAspirante();
				}
				header('location: listAspirantes.php?success=3');
			}
		}else {
			header('location: listAspirantes.php?success=0');
		}
	break;
	////////////////////////////////////
	///		OPERACIONES NEWSLETTER
	///////////////////////////////////

	case 'listarNewsletter':
		$herramientas = new herramientas();
		$temporal = new newsletter();
		$listaTemporal = $temporal -> listNewsletter($_REQUEST['pagina'], true, '', $_REQUEST['cadena'], 50, false, $_REQUEST['tipoNews']);
		foreach($listaTemporal as $elementoTemporal){
			if($_REQUEST['permisoAcDc'] == 0){
				if($elementoTemporal['status'] != 0){
					$img='img/visible.png';
					$funcion='';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='';
					$class = 'ver';
				}
			}else{
				if($elementoTemporal['status'] != 0){
					$img='img/visible.png';
					$funcion='changeStatus('.$elementoTemporal['idNewsletter'].',0,\'changeStatusNewsletter\')';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='changeStatus('.$elementoTemporal['idNewsletter'].',1,\'changeStatusNewsletter\')';
					$class = 'ver';
				}
			}
			$tabla .= '<tr>
							<td>
				                <input type="hidden" name="idorden" class="idorden" value="'.$elementoTemporal['idNewsletter'].'">
				                <input type="checkbox" id="'.$elementoTemporal['idNewsletter'].'" name="idNewsletter[]" value="'.$elementoTemporal['idNewsletter'].'">
								<label for="'.$elementoTemporal['idNewsletter'].'"><span></span></label>
				            </td>
				            <td>'.$elementoTemporal['correo'].'</td>
				            <td>'.$elementoTemporal['fecha'].'</td>
				            <td class="text-center">
				                <img class="manita '.$class.'" onclick="'.$funcion.'" id="temp'.$elementoTemporal['idNewsletter'].'" src="'.$img.'">
				            </td>
				        </tr> ';
		}
		$_lastPage = count($listaTemporal)-1;
		$_de = $listaTemporal[$_lastPage]['orden'];
		$htmlpaginador = '<input type="hidden" id="initfor" value="'.$_de.'">';
		$htmlpaginador = $herramientas -> paginador($listaTemporal[0]['ultimapagina'], $listaTemporal[0]['pagina'], $listaTemporal[0]['paginaanterior'], $listaTemporal[0]['paginasiguiente'], 4);

		$arrayJson = Array (
			0 => Array ( "tabla" => $tabla, "paginador" => $htmlpaginador)
		);
		echo json_encode($arrayJson);
	break;
	case 'changeStatusNewsletter':
	 	$newsletter = new newsletter($_REQUEST['id']);
		$newsletter -> updateStatusNewsletter($_REQUEST['status']);
	break;
	case 'operanewsletter':
		if(isset($_REQUEST['idNewsletter'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idNewsletter'] as $elemento) {
					$newsletter = new newsletter($elemento);
					$newsletter -> deleteNewsletter();
				}
				header('location: listNewsletter.php?success=3');
			}
			if ($select == 'Mostrar'){
				foreach ($_REQUEST['idNewsletter'] as $elemento) {
					$newsletter = new newsletter($elemento);
					$newsletter -> updateStatusNewsletter(1);
				}
				header('location: listNewsletter.php?success=4');
			}
			if ($select == 'No Mostrar'){
				foreach ($_REQUEST['idNewsletter'] as $elemento) {
					$newsletter = new newsletter($elemento);
					$newsletter -> updateStatusNewsletter(0);
				}
				header('location: listNewsletter.php?success=5');
			}
		}else {
			header('location: listNewsletter.php?success=0');
		}
	break;
	///////////////////////////////////////////////////////////////////
	///				OPERACIONES REDES
	///////////////////////////////////////////////////////////////////
	case 'modificarcontacto':
		$correo = $_REQUEST['correo'];
		$emisor = $_REQUEST['emisor'];
		$contacto = new contacto(1,$correo, $emisor,$_REQUEST['tituloAvisoPrivacidad'],$_REQUEST['descripcionAvisoPrivacidad'],$_REQUEST['tituloAvisoPrivacidadEn'],$_REQUEST['descripcionAvisoPrivacidadEn'],$_REQUEST['tituloFaqs'],$_REQUEST['descripcionFaqs'],$_REQUEST['tituloFaqsEn'],$_REQUEST['descripcionFaqsEn'],$_REQUEST['tituloMensajeBlog'],$_REQUEST['descripcionMensajeBlog'],$_REQUEST['tituloMensajeBlogEn'],$_REQUEST['descripcionMensajeBlogEn']);
		$contacto->modificar_contacto();

    if($_REQUEST['precioBase'] != ""){
      if($_REQUEST['precioBase'] > 0){
        $precioBase=$_REQUEST["precioBase"];
        $lote = new tarifaDatos();
        $listaLote=$lote->listaTarifaDatosUpdate();
        foreach($listaLote as $elementoLote){
          //echo 'Lote: '.$elementoLote['lote'].' ';
          $precioFinal=$elementoLote["conceptoEn"];
          $precioFinalPrecio=$precioFinal*$precioBase;
          $precioFinalPrecio=number_format($precioFinalPrecio, 2, '.', '');
          $updateLote=new tarifaDatos($elementoLote["idTarifaDatos"]);
          $updateLote->editarTarifaDatosUpdate($precioFinalPrecio);
        }
      }
    }

		header('location: formcontacto.php?success=2');
	break;
	case 'modificarotraconfiguracion':
		$modoSitio = $_REQUEST['modoSitio'];
		$contacto = new contacto(1);
		$contacto->modificarConfiguracion($modoSitio);
		header('location: formOtraConfiguracion.php?success=2');
	break;
	case 'modificarredes':
		if(isset($_REQUEST['contacto']) or $_REQUEST['contacto'] != ''){
			$correo = $_REQUEST['contacto'];
			$contacto = new contacto(1,$correo,'');
			$contacto->modificar_contacto();
		}

		$redes  = new redes();

		if(isset($_REQUEST['nombre'])){
			$cont = count($_REQUEST['nombre']);
			for ($i=0; $i < $cont ; $i++) {
				if($_REQUEST['nombre'][$i] != ''){
					$redes->titulo = $_REQUEST['nombre'][$i];
					$redes->url = $_REQUEST['url'][$i];
					$redes->status = 1;
					$redes->insertaredes();
				}

			}
		}
		if(isset($_REQUEST['nombremod'])){
			$cont = count($_REQUEST['nombremod']);
			for ($i=0; $i < $cont ; $i++) {
				if($_REQUEST['nombremod'][$i] != ''){
					$redes->idredes = $_REQUEST['idredes'][$i];
					$redes->titulo = $_REQUEST['nombremod'][$i];
					$redes->url = $_REQUEST['urlmod'][$i];
					$redes->modificaredes();
				}

			}
		}
		header('location: formredes.php?success=1');
	break;
	case 'activared':
		$redes = new redes($_REQUEST['id']);
		$redes -> activarredes();
	break;
	case 'desactivared':
	 	$redes = new redes($_REQUEST['id']);
		$redes -> desactivarredes();
	break;
	case 'eliminared':
		$redes = new redes($_REQUEST['id']);
		$redes -> eliminaredes();
	break;
	/**********************************************************
	* Procesos de Usuarios
	**********************************************************/
	case 'agregarusuario':
			$usuario= new usuario($_REQUEST['idusuario'], $_REQUEST['nomuser'], $_REQUEST['pass'],$_REQUEST['status'],$_REQUEST['tipo']);
			$usuario->inserta_usuario();
			$usuario->insertar_datos_usuario($_REQUEST['nombre'], $_REQUEST['email'], $_REQUEST['telefono']);
			header('Location: listusuarios.php');
	break;
	case 'modificarusuario':
			if($_REQUEST['nameuser'] == 'nameuser'){
				$nameuser=$_REQUEST['nomuser'];
			}
			else{
				$nameuser='';
			}
			if($_REQUEST['contra'] == 'pass'){
				$pass = $_REQUEST['pass'];
			}
			else{
				$pass='';
			}
			if($_REQUEST['emailControl'] == 'emailControl'){
				$email = $_REQUEST['email'];
			}
			else{
				$email='';
			}
			$usuario= new usuario($_REQUEST['idusuario'], $nameuser, $pass, $_REQUEST['status'],$_REQUEST['tipo']);
			$usuario->modifica_usuario();
			$usuario->modificar_datos_usuario($_REQUEST['nombre'], $email, $_REQUEST['telefono']);
			header('Location: listusuarios.php');
	break;
	case 'operausuario':
			if(isset($_REQUEST['idusuario'])){
				$select=$_REQUEST['operador'];
				if ($select == 'Eliminar'){
					foreach ($_REQUEST['idusuario'] as $elementoUsuario) {
						$usuario = new usuario($elementoUsuario);
						$usuario ->eliminar_datos_usuario();
						$usuario->elimina_usuario();
					}
					header('location: listusuarios.php');
				}
				if ($select == 'Mostrar'){
					foreach ($_REQUEST['idusuario'] as $elementoUsuario) {
						$usuario = new usuario($elementoUsuario);
						$usuario -> ActivaUsuario();
					}
					header('location: listusuarios.php');
				}
				if ($select == 'No Mostrar'){
					foreach ($_REQUEST['idusuario'] as $elementoUsuario) {
						$usuario = new usuario($elementoUsuario);
						$usuario->DesactivaUsuario();
					}
					header('location: listusuarios.php');
				}
			}
			else {
				header('location: listusuarios.php');
			}
	break;
	case 'activausuario':
			$usuario= new usuario($_REQUEST['id']);
			$usuario->ActivaUsuario();
	break;
	case 'desactivausuario':
			$usuario= new usuario($_REQUEST['id']);
			$usuario->DesactivaUsuario();
	break;
	case 'buscarusuario':
			$usuario= new usuario();
			$usuario->listaUsuarioBusqueda($_REQUEST['cadena']);
	break;
	case 'listausuario':
			$usuario= new usuario();
			$usuario->lista_usuario_Ajax();
	break;
	case 'agregartipousuario':
			$tipousuario= new tipousuario($_REQUEST['idtipousuario'],$_REQUEST['titulo'],$_REQUEST['status']);
			$tipousuario->insertar_tipousuario();
			$idtipousuario=$tipousuario->idtipousuario;
			if(isset($_REQUEST['idpermiso']))
			{
				$tipousuarioxpermiso = new tiposusuarioxpermiso(0,0);
				$tipousuarioxpermiso->idtipousuario=$idtipousuario;
				$tipousuarioxpermiso->desasigna_permiso_rol();

				foreach($_REQUEST['idpermiso'] as $elementoPermiso)
				{
					$tipousuarioxpermiso->idpermiso=$elementoPermiso;
					$tipousuarioxpermiso->asigna_permiso_rol();
				}
			}
		header('location:listtipousuario.php');
	break;
	case 'modificartipousuario':
		$tipousuario=new tipousuario($_REQUEST['idtipousuario'],$_REQUEST['titulo'],$_REQUEST['status']);
		$tipousuario->modificar_tipousuario();
		if(isset($_REQUEST['idpermiso']))
		{
			$tipousuarioxpermiso = new tiposusuarioxpermiso(0,0);
			$tipousuarioxpermiso->idtipousuario=$_REQUEST['idtipousuario'];
			$tipousuarioxpermiso->desasigna_permiso_rol();

			foreach($_REQUEST['idpermiso'] as $elementoPermiso)
			{
				$tipousuarioxpermiso->idpermiso=$elementoPermiso;
				$tipousuarioxpermiso->asigna_permiso_rol();
			}
		}
		else
		{
			$tipousuarioxpermiso = new tiposusuarioxpermiso();
			$tipousuarioxpermiso->idtipousuario=$_REQUEST['idtipousuario'];
			$tipousuarioxpermiso->desasigna_permiso_rol();

			foreach($_REQUEST['idpermiso'] as $elementoPermiso)
			{
				$tipousuarioxpermiso->idpermiso=$elementoPermiso;
				$tipousuarioxpermiso->asigna_permiso_rol();
			}
		}
		header('location:listtipousuario.php');
	break;
	case 'operatipousuario':
			if(isset($_REQUEST['idtipousuario'])){
				$select=$_REQUEST['operador'];
				if ($select == 'Eliminar'){
					foreach ($_REQUEST['idtipousuario'] as $elementoUsuario) {
						$tipousuario = new tipousuario($elementoUsuario);
						$tipousuarioxpermiso = new tiposusuarioxpermiso($elementoUsuario);
						$tipousuarioxpermiso->desasigna_permiso_rol();
						$tipousuario->elimina_Tipousuario();
					}
					header('location: listtipousuario.php');
				}

				if ($select == 'Mostrar'){
					foreach ($_REQUEST['idtipousuario'] as $elementoUsuario) {
						$tipousuario = new tipousuario($elementoUsuario);
						$tipousuario->ActivaTipousuario();
					}
					header('location: listtipousuario.php');
				}
				if ($select == 'No Mostrar'){
					foreach ($_REQUEST['idtipousuario'] as $elementoUsuario) {
						$tipousuario = new tipousuario($elementoUsuario);
						$tipousuario -> DesactivaTipousuario();
					}
					header('location: listtipousuario.php');
				}
			}
			else {
				header('location: listtipousuario.php');
			}
	break;
	case 'activatipoU':
			$tipousuario= new tipousuario($_REQUEST['id']);
			$tipousuario->ActivaTipousuario();
	break;
	case 'desactivatipoU':
			$tipousuario= new tipousuario($_REQUEST['id']);
			$tipousuario->DesactivaTipousuario();
	break;
	case 'buscartipousuario':
			$tipousuario= new tipousuario();
			$tipousuario->listaTipousuarioBusqueda($_REQUEST['cadena']);
	break;
	case 'listatipousuario':
			$tipousuario= new tipousuario();
			$tipousuario->listado_tipousuarioAjax();
	break;
 	case 'agregarpermiso':
			$permiso = new permiso($_REQUEST['idpermiso'],$_REQUEST['titulo'],$_REQUEST['clave'],$_REQUEST['idSeccionPermiso'],$_REQUEST['status']);
			$permiso->insertar_permiso();
			header('Location: listpermisos.php');
	break;
	case 'modificarpermiso':
			$permiso = new permiso($_REQUEST['idpermiso'],$_REQUEST['titulo'],$_REQUEST['clave'], $_REQUEST['idSeccionPermiso'],$_REQUEST['status']);
			$permiso->modificar_permiso();
			header('Location: listpermisos.php');
	break;
	case 'operapermiso':
		if(isset($_REQUEST['idpermiso'])){
			$select=$_REQUEST['operador'];
			$imgp=0;
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idpermiso'] as $elemento) {
					$permiso = new permiso($elemento);
					$permiso->eliminarPermiso();
				}
				header('location: listpermisos.php?success=3');
			}
			if ($select == 'Mostrar'){
				foreach ($_REQUEST['idpermiso'] as $elemento) {
					$permiso = new permiso($elemento);
					$permiso->ActivaPermiso();
				}
				header('location: listpermisos.php?success=4');
			}
			if ($select == 'No Mostrar'){
				foreach ($_REQUEST['idpermiso'] as $elemento) {
					$permiso = new permiso($elemento);
					$permiso->DesactivaPermiso();
				}
				header('location: listpermisos.php?success=5');
			}
		}
		else {
			header('location: listpermisos.php');
		}
	break;
	case 'activapermiso':
		$permiso = new permiso($_REQUEST['id']);
		$permiso->ActivaPermiso();
	break;
	case 'desactivapermiso':
	 	$permiso = new permiso($_REQUEST['id']);
		$permiso->DesactivaPermiso();
	break;
	case 'verificarusuario':
			if($_REQUEST['username']!=''){
				$total=0;
				$username = $_REQUEST['username'];
				$usuario= new usuario(0,$username,'','','');
				$verificar=$usuario->VerficarDisponibilidadNomUsuario($username);
				$total=count($verificar);

				if($total != 0)
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Advertencia!</strong> Este usuario ya existe o es su actual nombre de usuario, para poder continuar intente con otro nombre.</div>';
				else
					echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Bien hecho!</strong> Nombre de usuario disponible.</div>';
			}
			else
				echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Advertencia!</strong> Se requiere de este campo para poder continuar.</div>';
	break;
	case 'ingresar':
			$user=new usuario(0,$_REQUEST['usuario'],$_REQUEST['pass'],0,0);
			$user->login();
			if($user->idusuario!=0){
				//session_start();
				$_SESSION['idusuario']=$user->idusuario;
				header('Location:listusuarios.php');
			}

			else{
				session_start();
				if(isset($_SESSION['idusuario']));
				session_destroy();
				header('Location:index.php?success=0');
			}
	break;
	case 'verificarCorreo':
		$usuario = new usuario();
		if($usuario->disponibilidadCorreo($_POST['correo']))
			echo 1;
		else
			echo 0;
	break;
	case 'recuperapass':
			if($_REQUEST['email']!='')
			{
				$usuario = new usuario();
				$usuario->datosusuario->email=$_REQUEST['email'];
				$lista = $usuario->datosusuario->buscaremail();
				$total = count($lista);
				$resp = 0;
				if($total > 0)
				{
					foreach($lista as $elementoCliente)
					{
						$idusuario = $elementoCliente['idusuario'];
						$correoRecu= new correoRecuperacion($idusuario);
						$correoRecu->enviar();
						$resp = 2;
					}
				}
				else
					$resp = 1;
			}
			else
				$resp = 0;
			echo $resp;
	break;
	case 'cerrarsesion':
			//session_start();
			if(isset($_SESSION['idusuario']));
			session_destroy();
			echo 1;
	break;
////////////////////////////////////
///		OPERACIONES ORDEN
///////////////////////////////////
	case 'operaorden':
		if(isset($_REQUEST['idOrden'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idOrden'] as $elemento) {
					$orden = new orden($elemento);
					$orden -> deleteOrden();
				}
				header('location: listOrden.php?success=3');
			}
		}else {
			header('location: listOrden.php?success=0');
		}
	break;
	case 'listarOrden':
		$herramientas = new herramientas();
		$temporal = new orden();
		$listaTemporal = $temporal -> listOrden($_REQUEST['pagina'], false, false, $_REQUEST['cadena']);
		foreach($listaTemporal as $elementoTemporal){
			if($elementoTemporal['estatus'] == 0){
			  $label = '<span class="label label-default">Proceso Incompleto</span>';
			  $funcion =' <img class="manita nover" style="float:right" onclick="eliminarOrden('.$elemento['idOrden'].')" id="temp'.$elemento['idOrden'].'" src="img/invisible.png">';
			}
			if($elementoTemporal['status'] == 1){
			  $label = '<span class="label label-warning">Pendiente de Pago</span>';
			  $funcion = '';
			}
			if($elementoTemporal['status'] == 2){
			  $label = '<span class="label label-warning">Pendiente de Pago</span>';
			  $funcion = '';
			}
			if($elementoTemporal['status'] == 3){
			  //$label = '<span class="label label-success">Pagado</span>';
			  $label = '<span class="label label-danger">Pagado sin Enviar</span>';
			  $funcion = '';
			}
			if($elementoTemporal['status'] == 4){
			  //$label = '<span class="label label-success">Pagado</span>';
			  $label = '<span class="label label-success">Pagado y Enviado</span>';
			  $funcion = '';
			}
			if($elementoTemporal['status'] == 5){
			  //$label = '<span class="label label-success">Pagado</span>';
			  $label = '<span class="label label-info">Pedido Completado</span>';
			  $funcion = '';
			}

			$importeTotal=$elementoTemporal['importeTotal'];
			$datosOrden=new datosOrden($elementoTemporal['idOrden']);
			$datosOrden->getDatosOrden();
			$descuento=$datosOrden->descuento;
			$precioTransporte=$datosOrden->precioTransporte;
			$precioFinal=($importeTotal-$descuento)+$precioTransporte;
			$tabla .= ' <tr>
				            <td>
				                <input type="hidden" name="idorden" class="idorden" value="'.$elementoTemporal['idOrden'].'">
				                <input type="checkbox" id="'.$elementoTemporal['idOrden'].'" name="idOrden[]" value="'.$elementoTemporal['idOrden'].'">
								<label for="'.$elementoTemporal['idOrden'].'"><span></span></label>
				            </td>
				            <td>
								<a href="formOrden.php?idOrden='.$elementoTemporal['idOrden'].'">
									'.$elementoTemporal['idOrden'].'
								</a>
							</td>
							<td class="text-center"><a href="formOrden.php?idOrden='.$elementoTemporal['idOrden'].'">'.$elementoTemporal['nombre'].' '.$elementoTemporal['apellido'].'</a></td>
							<td class="text-center">'.$elementoTemporal['fecha'].'</td>
							<td class="text-center">'.$elementoTemporal['cantidad'].'</td>
							<td class="text-center">$'.number_format($precioFinal, 2, '.', '').'</td>
							<td class="">'.$label.' '.$elementoTemporal['metodo'].'</td>
				        </tr>';
		}
		$_lastPage = count($listaTemporal)-1;
		$_de = $listaTemporal[$_lastPage]['orden'];

		$htmlpaginador = $herramientas -> paginador($listaTemporal[0]['ultimapagina'], $listaTemporal[0]['pagina'], $listaTemporal[0]['paginaanterior'], $listaTemporal[0]['paginasiguiente'], 4);
		$htmlpaginador .= '<input type="hidden" id="initfor" value="'.$_de.'">';
		$arrayJson = Array (
			0 => Array ( "tabla" => $tabla, "paginador" => $htmlpaginador)
		);
		echo json_encode($arrayJson);
	break;
	case 'correoPedidoEnviado':
		$datosOrden = new datosOrden($_POST['idorden']);
		$datosOrden -> updateNumeroGuia($_REQUEST['numGuia']);

		$correoEnvioProductos = new correoEnvioProductos($_POST['idorden']);
		$send = $correoEnvioProductos->enviar();
		$orden = new orden($_POST['idorden']);
		$orden->updateStatus(4);
		if($send){
			echo 1;
		}else{
			echo 0;
		}
	break;
	case 'envioentregado':
		$orden = new orden($_POST['idorden']);
		$orden->updateStatus(5);
		header('location: formOrden.php?idOrden='.$_POST['idorden'].'');
	break;

	/* ============================
 * CRUD _INGREDIENTE
 * ============================ */
	case 'agregaringrediente':
		$ingrediente = new ingrediente(0, $_REQUEST['titulo'], $_REQUEST['tituloEn']);
		$ingrediente -> addIngrediente();
		header('Location: listIngrediente.php?success=1');
	break;
	case 'modificaringrediente':
		$ingrediente = new ingrediente($_REQUEST['id'], $_REQUEST['titulo'], $_REQUEST['tituloEn']);
		$ingrediente -> updateIngrediente();
		header('Location: listIngrediente.php?success=2');
	break;
	case 'operaingrediente':
		if(isset($_REQUEST['idIngrediente'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idIngrediente'] as $elemento) {
					$ingrediente = new ingrediente($elemento);
					$ingrediente -> deleteIngrediente();
				}
				header('location: listIngrediente.php?success=3');
			}
			if ($select == 'Activar'){
				foreach ($_REQUEST['idIngrediente'] as $elemento) {
					$ingrediente = new ingrediente($elemento);
					$ingrediente -> updateStatusIngrediente(1);
				}
				header('location: listIngrediente.php?success=4');
			}
			if ($select == 'Desactivar'){
				foreach ($_REQUEST['idIngrediente'] as $elemento) {
					$ingrediente = new ingrediente($elemento);
					$ingrediente -> updateStatusIngrediente(0);
				}
				header('location: listIngrediente.php?success=5');
			}
		}else {
			header('location: listIngrediente.php?success=0');
		}
	break;
	case 'changeStatusIngrediente':
		$ingrediente = new ingrediente($_REQUEST['id']);
		$ingrediente -> updateStatusIngrediente($_REQUEST['status']);
	break;

	/* ============================
 * CRUD _CONSIDERACIÓN
 * ============================ */
	case 'agregarconsideracion':
		$consideracion = new consideracion(0, $_REQUEST['titulo'], $_REQUEST['tituloEn']);
		$consideracion -> addConsideracion();
		header('Location: listConsideracion.php?success=1');
	break;
	case 'modificarconsideracion':
		$consideracion = new consideracion($_REQUEST['id'], $_REQUEST['titulo'], $_REQUEST['tituloEn']);
		$consideracion -> updateConsideracion();
		header('Location: listConsideracion.php?success=2');
	break;
	case 'operaconsideracion':
		if(isset($_REQUEST['idConsideracion'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idConsideracion'] as $elemento) {
					$consideracion = new consideracion($elemento);
					$consideracion -> deleteConsideracion();
				}
				header('location: listConsideracion.php?success=3');
			}
			if ($select == 'Activar'){
				foreach ($_REQUEST['idConsideracion'] as $elemento) {
					$consideracion = new consideracion($elemento);
					$consideracion -> updateStatusConsideracion(1);
				}
				header('location: listConsideracion.php?success=4');
			}
			if ($select == 'Desactivar'){
				foreach ($_REQUEST['idConsideracion'] as $elemento) {
					$consideracion = new consideracion($elemento);
					$consideracion -> updateStatusConsideracion(0);
				}
				header('location: listConsideracion.php?success=5');
			}
		}else {
			header('location: listConsideracion.php?success=0');
		}
	break;
	case 'changeStatusConsideracion':
		$consideracion = new consideracion($_REQUEST['id']);
		$consideracion -> updateStatusConsideracion($_REQUEST['status']);
	break;

	/* ============================
 * CRUD _INCENTIVO
 * ============================ */
	case 'agregarincentivo':
		$incentivo = new incentivo(0, $_REQUEST['titulo'], $_REQUEST['link'], $_FILES['imagen']['name'], $_FILES['imagen']['tmp_name'], $_REQUEST['tituloEn'], $_REQUEST['descripcion'], $_REQUEST['descripcionEn']);
		$incentivo -> addIncentivo();
		if($_FILES['imgMovil']['name'] != ''){
			$incentivo -> updateImgMovil($_FILES['imgMovil']['name'], $_FILES['imgMovil']['tmp_name']);
		}
		header('location: listIncentivo.php?success=1');
	break;
	case 'modificarincentivo':
		if($_FILES['imagen']['name'] != ''){
			$_name = $_FILES['imagen']['name'];
			$_tmp = $_FILES['imagen']['tmp_name'];
		}else{
			$_name = '';
			$_tmp = '';
		}

		$incentivo = new incentivo($_REQUEST['id'], $_REQUEST['titulo'], $_REQUEST['link'], $_name, $_tmp, $_REQUEST['tituloEn'], $_REQUEST['descripcion'], $_REQUEST['descripcionEn'], $_REQUEST['textoBoton'], $_REQUEST['textoBotonEn'], $_REQUEST['linkVideo']);
		$incentivo -> updateIncentivo();
		if($_FILES['imgMovil']['name'] != ''){
			$incentivo -> updateImgMovil($_FILES['imgMovil']['name'], $_FILES['imgMovil']['tmp_name']);
		}
		header('location: listIncentivo.php?success=2');
	break;
	case 'operaincentivo':
		if(isset($_REQUEST['idIncentivo'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idIncentivo'] as $elemento) {
					$incentivo = new incentivo($elemento);
					$incentivo -> deleteIncentivo();
				}
				header('location: listIncentivo.php?success=3');
			}
			if ($select == 'Activar'){
				foreach ($_REQUEST['idIncentivo'] as $elemento) {
					$incentivo = new incentivo($elemento);
					$incentivo -> updateStatusIncentivo(1);
				}
				header('location: listIncentivo.php?success=4');
			}
			if ($select == 'Desactivar'){
				foreach ($_REQUEST['idIncentivo'] as $elemento) {
					$incentivo = new incentivo($elemento);
					$incentivo -> updateStatusIncentivo(0);
				}
				header('location: listIncentivo.php?success=5');
			}
		}else {
			header('location: listIncentivo.php?success=0');
		}
	break;
	case 'changeStatusIncentivo':
		$incentivo = new incentivo($_REQUEST['id']);
		$incentivo -> updateStatusIncentivo($_REQUEST['status']);
	break;


	/* ==========================================================================
	   DESTINO
	   ========================================================================== */
	/** 2016-11-16 */
	case 'agregarservicio':
		// print_r($_REQUEST);
		// print_r($_FILES);
		// exit;
		$name = '';
		$tmp  = '';
		if ($_FILES['portada']['name'] !== '') {
			$name = $_FILES['portada']['name'];
			$tmp  = $_FILES['portada']['tmp_name'];
		}

		$servicio = new servicio(0, $_REQUEST['latitud'], $_REQUEST['longitud'], $_REQUEST['titulo']['en'], $name, $tmp);
		$success = $servicio -> agregarServicio();

		if ($success > 0) {
			$servicio -> agregarServicioDatos($_REQUEST['titulo']['en'], $_REQUEST['ubicacion']['en'], $_REQUEST['descripcion']['en'], $_REQUEST['actividades']['en'], 'en');
			$servicio -> agregarServicioDatos($_REQUEST['titulo']['es'], $_REQUEST['ubicacion']['es'], $_REQUEST['descripcion']['es'], $_REQUEST['actividades']['es'], 'es');

			$name2 = '';
			$tmp2  = '';
			if ($_FILES['imagen']['name'] !== '') {
				$name2 = $_FILES['imagen']['name'];
				$tmp2  = $_FILES['imagen']['tmp_name'];
			}
			$servicio -> agregarImagenContenido($name2, $tmp2);
		}

		header('location: listaServicio.php?success='. $success);
		break;
	/** 2016-11-16 */
	case 'modificarservicio':
		// print_r($_REQUEST);
		// print_r($_FILES);
		// exit;
		$name = '';
		$tmp  = '';
		if ($_FILES['portada']['name'] !== '') {
			$name = $_FILES['portada']['name'];
			$tmp  = $_FILES['portada']['tmp_name'];
		}

		$servicio = new servicio($_REQUEST['id'], $_REQUEST['latitud'], $_REQUEST['longitud'], $_REQUEST['titulo']['es'], $name, $tmp);
		$success = $servicio -> editarServicio();

		if ($success > 0) {
			$servicio -> editarServicioDatos($_REQUEST['titulo']['en'], $_REQUEST['ubicacion']['en'], $_REQUEST['descripcion']['en'], $_REQUEST['actividades']['en'], 'en');
			$servicio -> editarServicioDatos($_REQUEST['titulo']['es'], $_REQUEST['ubicacion']['es'], $_REQUEST['descripcion']['es'], $_REQUEST['actividades']['es'], 'es');
			$name2 = '';
			$tmp2  = '';
			if ($_FILES['imagen']['name'] !== '') {
				$name2 = $_FILES['imagen']['name'];
				$tmp2  = $_FILES['imagen']['tmp_name'];
			}
			$servicio -> editarImagenContenido($name2, $tmp2);

			// Si hay nuevo slide
			if ($_FILES['slider']['name'] !== '') {
				$servicio -> agregarGaleria($_REQUEST['slider']['titulo']['en'][0], $_REQUEST['slider']['subtitulo']['en'][0], $_REQUEST['slider']['texto']['en'][0], '', 'en', $_FILES['slider']['name'], $_FILES['slider']['tmp_name']);
			}

			if (count($_REQUEST['galeria']) > 0) {
				// print_r($_FILES['galeria']);
				// exit;
				foreach ($_REQUEST['galeria']['id'] as $idioma => $valores) {
					// print_r($valores);
					foreach ($valores as $indice => $valor) {
						// echo $_REQUEST['galeria']['titulo'][$idioma][$indice];
						// echo '<br>';
						$img  = '';
						$temp = '';
						if ($_FILES['galeria']['name'][$idioma][$indice] !== '') {
							$img  = $_FILES['galeria']['name'][$idioma][$indice];
							$temp = $_FILES['galeria']['tmp_name'][$idioma][$indice];
						}
						$servicio -> editarGaleria($_REQUEST['galeria']['id'][$idioma][$indice], $_REQUEST['galeria']['titulo'][$idioma][$indice], $_REQUEST['galeria']['subtitulo'][$idioma][$indice], $_REQUEST['galeria']['texto'][$idioma][$indice], '', $idioma, $img, $temp);
					}
				}
			}
			// exit;
		}

		header('location: listaServicio.php?success='. $success);
		break;
	/** 2016-11-16 */
	case 'operaservicio':
		if (isset($_REQUEST['idServicio'])) {
			$select = $_REQUEST['operador'];
			if ($select == 'Eliminar') {
				foreach ($_REQUEST['idServicio'] as $elemento) {
					$servicio = new servicio($elemento);
					// eliminar galeria
					$galeria = $servicio -> listaGaleria();
					if (count($galeria) > 0) {
						foreach ($galeria as $sk => $slide) {
							$galeria = new galeria($slide['idGaleria'], 0, '', '', '', '', 'Servicio');
							$galeria -> borrarGaleria();
						}
					}
					$servicio -> borrarServicioDatos();
					$servicio -> borrarServicio();
				}
				header('location: listaServicio.php?success=3');
			}
			if ($select == 'Activar') {
				foreach ($_REQUEST['idServicio'] as $elemento) {
					$servicio = new servicio($elemento);
					$servicio -> cambiarStatusServicio(1);
				}
				header('location: listaServicio.php?success=4');
			}
			if ($select == 'Desactivar') {
				foreach ($_REQUEST['idServicio'] as $elemento) {
					$servicio = new servicio($elemento);
					$servicio -> cambiarStatusServicio(0);
				}
				header('location: listaServicio.php?success=5');
			}
		} else {
			header('location: listaServicio.php?success=0');
		}
		break;
	/** 2016-11-16 */
	case 'changeStatusServicio':
		$servicio = new servicio($_REQUEST['id']);
		$servicio -> cambiarStatusServicio($_REQUEST['status']);
		break;
	/** 2016-11-16 */
	case 'borrarserviciogaleria':
		$success = 0;
		if ($_REQUEST['id'] > 0) {
			$galeria = new galeria($_REQUEST['id'], 0, '', '', '', '', 'Servicio');
			$success = $galeria -> borrarGaleria();
		}

		echo json_encode(array('success' => $success));
		break;
	/** 2016-11-28 */
	case 'changeDestacadoServicio':
		$servicio = new servicio($_REQUEST['id']);
		$success = $servicio -> destacarServicio($_REQUEST['status']);

		echo $success;
		break;

	case 'listarServicio':
		$herramientas  = new herramientas();
		$temporal      = new servicio();
		$_rpp          = ($_REQUEST['registrosPorPagina'] != '-1') ? $_REQUEST['registrosPorPagina'] : 20;
		$listaTemporal = $temporal -> listaServicio($_REQUEST['pagina'], true, '', 'en', $_REQUEST['cadena'], $_rpp);
		$handle        = ($_REQUEST['permisoAcDc'] != 0) ? '<span class="fa-stack fa-1x mover handle"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-arrows fa-stack-1x fa-inverse"></i></span>' : '';

		foreach ($listaTemporal as $elementoTemporal) {
			if ($_REQUEST['permisoAcDc'] == 0) {
				if ($elementoTemporal['status']!=0) {
					$img     ='img/visible.png';
					$funcion ='';
					$class   = 'nover';
				} else {
					$img     ='img/invisible.png';
					$funcion ='';
					$class   = 'ver';
				}
			} else {
				if ($elementoTemporal['status']!=0) {
					$img     ='img/visible.png';
					$funcion ='changeStatus('.$elementoTemporal['idServicio'].',0,\'changeStatusServicio\')';
					$class   = 'nover';
				} else {
					$img     ='img/invisible.png';
					$funcion ='changeStatus('.$elementoTemporal['idServicio'].',1,\'changeStatusServicio\')';
					$class   = 'ver';
				}
			}

			if ($elementoTemporal['destacado'] > 0) {
				$_fa      = 'fa-toggle-on';
				$_funcion = 'changeDestacado('.$elementoTemporal['idServicio'].',0,\'changeDestacadoServicio\')';
			} else {
				$_fa      = 'fa-toggle-off';
				$_funcion = 'changeDestacado('.$elementoTemporal['idServicio'].',1,\'changeDestacadoServicio\')';
			}
			$tabla .= ' <tr>
				            <td>
				                <input type="hidden" name="idorden" class="idorden" value="'.$elementoTemporal['idServicio'].'">
				                <input type="checkbox" id="'.$elementoTemporal['idServicio'].'" name="idServicio[]" value="'.$elementoTemporal['idServicio'].'">
								<label for="'.$elementoTemporal['idServicio'].'"><span></span></label>
				            </td>
				            <td>
				                <a href="formularioServicio.php?id='.$elementoTemporal['idServicio'].'" class="">
				                	<img src="../img/imgServicio/'.$elementoTemporal['imgPortada'].'" class="img-responsive">
				                </a>
				            </td>
				            <td>
				                <a href="formularioServicio.php?id='.$elementoTemporal['idServicio'].'" class="">
				                    '.$elementoTemporal['titulo'].'
				                </a>
				            </td>
				            <td class="text-center">
				            	'.$handle.'
				                <img class="manita '.$class.'" onclick="'.$funcion.'" id="temp'.$elementoTemporal['idServicio'].'" src="'.$img.'">
				            </td>
				        </tr>';
		}
		$_lastPage = count($listaTemporal)-1;
		$_de       = $listaTemporal[$_lastPage]['orden'];

		$htmlpaginador = $herramientas -> paginador($listaTemporal[0]['ultimapagina'], $listaTemporal[0]['pagina'], $listaTemporal[0]['paginaanterior'], $listaTemporal[0]['paginasiguiente'], 4);
		$htmlpaginador .= '<input type="hidden" id="initfor" value="'.$_de.'">';

		$arrayJson = Array (
			0 => Array ( "tabla" => $tabla, "paginador" => $htmlpaginador)
		);

		echo json_encode($arrayJson);
		break;

	/* Experiencias (tours y circuitos)
	   ========================================================================== */
	/** 2016-12-01 */
	case 'agregarexperiencia':
		//print_r($_REQUEST);
		// print_r($_FILES);
		// exit;
		$name = '';
		$tmp  = '';
		if ($_FILES['portada']['name'] !== '') {
			$name = $_FILES['portada']['name'];
			$tmp  = $_FILES['portada']['tmp_name'];
		}

		$experiencia = new experiencia(0, "", $_REQUEST['seccion'], $_REQUEST['nombre'], $name, $tmp);
		$success     = $experiencia -> agregarExperiencia();

		if ($success > 0) {
			// function agregarExperienciaDatos($nombre = '', $subnombre = '', $inicial = '', $titulo = '', $descripcion = '', $capacidad1 = 0, $capacidad2 = 0, $duracion = '', $politicas = '', $idioma = 'en')
			$experiencia -> agregarExperienciaDatos($_REQUEST['nombre'], $_REQUEST['subnombre'], $_REQUEST['inicial'], $_REQUEST['concepto_inicial'], $_REQUEST['titulo'], $_REQUEST['descripcion'], $_REQUEST['capacidad1'], $_REQUEST['capacidad2'], $_REQUEST['duracion'], $_REQUEST['politicas'], 'en', $_REQUEST['descripcionEn'], $_REQUEST['politicasEn'], $_REQUEST['nombreEn']);

			$tarifa   = new tarifa(0, $experiencia -> idExperiencia, '', '', '', '', '', 'en', $_REQUEST['seccion']);
			$success2 = $tarifa -> agregarTarifa();

			// Para agregar las 2 tarifas de Unique
			if ($_REQUEST['seccion'] === 'Unique') {
				for ($i = 1; $i < 3; $i++) {
					$tarifa -> agregarTarifaDatos('', 0, 0, 'USD', 'en');
				}
			}
		}

		header('location: lista'. $_REQUEST['seccion'] .'.php?success='. $success);
		break;
	/** 2016-12-02 */
	case 'modificarexperiencia':
		// print_r($_REQUEST);
		// print_r($_FILES);
		// exit;
		$name = '';
		$tmp  = '';
		if ($_FILES['portada']['name'] !== '') {
			$name = $_FILES['portada']['name'];
			$tmp  = $_FILES['portada']['tmp_name'];
		}

		$experiencia = new experiencia($_REQUEST['id'], "", $_REQUEST['seccion'], $_REQUEST['nombre'], $name, $tmp);
		$success     = $experiencia -> editarExperiencia();
		$experiencia -> editarExperienciaDatos($_REQUEST['nombre'], $_REQUEST['subnombre'], $_REQUEST['inicial'], $_REQUEST['concepto_inicial'], $_REQUEST['titulo'], $_REQUEST['descripcion'], $_REQUEST['capacidad1'], $_REQUEST['capacidad2'], $_REQUEST['duracion'], $_REQUEST['politicas'], 'en', $_REQUEST['descripcionEn'], $_REQUEST['politicasEn'], $_REQUEST['nombreEn']);

		// Si hay nuevos slides
		if (count($_FILES['slider']['name']) > 0) {
			foreach ($_FILES['slider']['name'] as $i => $nombre) {
				if ($nombre !== '') {
					$experiencia -> agregarGaleria('', '', '', '', $_REQUEST['seccion'], 'en', $_FILES['slider']['name'][$i], $_FILES['slider']['tmp_name'][$i]);
				}
			}
		}

		// galeria actual
		if (count($_FILES['galeria']) > 0) {
			foreach ($_REQUEST['galeria']['id'] as $i => $id) {
				$img  = '';
				$temp = '';
				if ($_FILES['galeria']['name'][$i] !== '') {
					$img  = $_FILES['galeria']['name'][$i];
					$temp = $_FILES['galeria']['tmp_name'][$i];
				}

				$experiencia -> editarGaleria($_REQUEST['galeria']['id'][$i], '', '', '', '', $_REQUEST['seccion'], 'en', $img, $temp);
			}
		}

		// reseñas
		if (count($_REQUEST['resenia']['id']) > 0) {
			foreach ($_REQUEST['resenia']['id'] as $i => $id) {
				if ($_REQUEST['resenia']['nombre'][$i] !== '' AND $id == 0) {
					$experiencia -> agregarResenia($_REQUEST['resenia']['nombre'][$i], $_REQUEST['resenia']['fecha'][$i], $_REQUEST['resenia']['texto'][$i], 'en', $_REQUEST['seccion'], $_REQUEST['resenia']['textoEn'][$i]);
				}

				if ($_REQUEST['resenia']['nombre'][$i] !== '' AND $id > 0) {
					$experiencia -> editarResenia($id, $_REQUEST['resenia']['nombre'][$i], $_REQUEST['resenia']['fecha'][$i], $_REQUEST['resenia']['texto'][$i], 'en', $_REQUEST['seccion'], $_REQUEST['resenia']['textoEn'][$i]);
				}
			}
		}

		// Datos tarifas
		if (isset($_REQUEST['tarifa'])) {
			$tarifa = new tarifa($_REQUEST['tarifa']['id'], $_REQUEST['id'], '', '', $_REQUEST['tarifa']['incluye'], $_REQUEST['tarifa']['noincluye'], '', 'en', $_REQUEST['seccion']);

			// if ($_REQUEST['tarifa']['id'] == '' OR $_REQUEST['tarifa']['id'] == 0) {
			// 	$success2 = $tarifa -> agregarTarifa();
			// } else {
				$success2 = $tarifa -> editarTarifa();
			// }

			if ($success2 > 0) {
				if (count($_REQUEST['precios']['concepto']) > 0) {
					foreach ($_REQUEST['precios']['concepto'] as $i => $concepto) {
						if ($_REQUEST['precios']['id'][$i] == '' OR $_REQUEST['precios']['id'][$i] == 0) {
							$tarifa -> agregarTarifaDatos($concepto, $_REQUEST['precios']['periodo1'][$i], 0, 'USD', 'en', $_REQUEST['precios']['conceptoEn'][$i], $_REQUEST['precios']['horaEn'][$i]);
						} else {
							$tarifa -> editarTarifaDatos($_REQUEST['precios']['id'][$i], $concepto, $_REQUEST['precios']['periodo1'][$i], 0, 'USD', 'en', $_REQUEST['precios']['conceptoEn'][$i], $_REQUEST['precios']['horaEn'][$i]);
						}
					}
				}
			}
		}

		// print_r($_REQUEST['premios']);exit;
		if (isset($_REQUEST['premios'])) {
			foreach ($_REQUEST['premios']['id'] as $i => $pid) {
				if ($_REQUEST['premios']['titulo'][$i]) {
					$anexo = new experienciaAnexo($pid, $_REQUEST['id'], $_REQUEST['premios']['titulo'][$i], $_REQUEST['premios']['periodo'][$i], $_REQUEST['premios']['descripcion'][$i], 'Premio');

					if ($pid > 0)
						$anexo -> editarExperienciaAnexo();
					else
						$anexo -> agregarExperienciaAnexo();
				}
			}
		}

		if (isset($_REQUEST['agenda'])) {
			foreach ($_REQUEST['agenda']['id'] as $i => $aid) {
				if ($_REQUEST['agenda']['titulo'][$i]) {
					$anexo = new experienciaAnexo($aid, $_REQUEST['id'], $_REQUEST['agenda']['titulo'][$i], $_REQUEST['agenda']['periodo'][$i], $_REQUEST['agenda']['descripcion'][$i], 'Agenda');

					if ($aid > 0)
						$anexo -> editarExperienciaAnexo();
					else
						$anexo -> agregarExperienciaAnexo();
				}
			}
		}

		if (isset($_REQUEST['reglas'])) {
			foreach ($_REQUEST['reglas']['id'] as $i => $rid) {
				if ($_REQUEST['reglas']['titulo'][$i]) {
					$anexo = new experienciaAnexo($rid, $_REQUEST['id'], $_REQUEST['reglas']['titulo'][$i], $_REQUEST['reglas']['periodo'][$i], $_REQUEST['reglas']['descripcion'][$i], 'Regla');

					if ($rid > 0)
						$anexo -> editarExperienciaAnexo();
					else
						$anexo -> agregarExperienciaAnexo();
				}
			}
		}

		header('location: formulario'. $_REQUEST['seccion'] .'.php?id='. $_REQUEST['id'] .'&success='. $success);
		break;
	/** 2016-12-02 */
	case 'changeStatusExperiencia':
		$experiencia = new experiencia($_REQUEST['id']);
		$experiencia -> cambiarStatusExperiencia($_REQUEST['status']);
		break;
	case 'operaexperiencia':
		// print_r($_REQUEST);
		// exit;
		if (isset($_REQUEST['idExperiencia'])) {
			$select = $_REQUEST['operador'];
			if ($select == 'Eliminar') {
				foreach ($_REQUEST['idExperiencia'] as $elemento) {
					$experiencia = new experiencia($elemento);
					// eliminar galeria
					$galeria = $experiencia -> listaGaleria('en', $_REQUEST['tipo']);
					if (count($galeria) > 0) {
						foreach ($galeria as $sk => $slide) {
							$galeria = new galeria($slide['idGaleria'], 0, '', '', '', '', $_REQUEST['tipo']);
							$galeria -> borrarGaleria();
						}
					}
					// Eliminar reseñas
					$resenias = $experiencia -> listaResenia('en', $_REQUEST['tipo']);
					if (count($resenias) > 0) {
						foreach ($resenias as $i => $r) {
							$resenia = new resenia($r['idResenia']);
							$resenia -> borrarResenia();
						}
					}
					// Obtener tarifa
					$experiencia -> obtenerTarifa('en', $_REQUEST['tipo']);
					if ($experiencia -> tarifa -> idTarifa > 0) {
						// Eliminar tarifas
						$tarifa = new tarifa($experiencia -> tarifa -> idTarifa);
						$tarifa -> borrarTodosTarifaDatos();
						$tarifa -> borrarTarifa();
					}
					$experiencia -> borrarExperienciaDatos();
					$experiencia -> borrarExperiencia();
				}
				header('location: lista'. $_REQUEST['tipo'] .'.php?success=3');
			}
			if ($select == 'Activar') {
				foreach ($_REQUEST['idExperiencia'] as $elemento) {
					$experiencia = new experiencia($elemento);
					$experiencia -> cambiarStatusExperiencia(1);
				}
				header('location: lista'. $_REQUEST['tipo'] .'.php?success=4');
			}
			if ($select == 'Desactivar') {
				foreach ($_REQUEST['idExperiencia'] as $elemento) {
					$experiencia = new experiencia($elemento);
					$experiencia -> cambiarStatusExperiencia(0);
				}
				header('location: lista'. $_REQUEST['tipo'] .'.php?success=5');
			}
		} else {
			header('location: lista'. $_REQUEST['tipo'] .'.php?success=0');
		}
		break;
	/** 2016-12-02 */
	case 'listarExperiencia':
		$herramientas  = new herramientas();
		$temporal      = new experiencia();

		$_rpp          = ($_REQUEST['registrosPorPagina'] != '-1') ? $_REQUEST['registrosPorPagina'] : 20;
		$listaTemporal = $temporal -> listaExperiencia($_REQUEST['pagina'], true, '', $_REQUEST['tipo'], 'en', $_REQUEST['cadena']);
		$handle        = ($_REQUEST['permisoAcDc'] != 0) ? '<span class="fa-stack fa-1x mover handle"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-arrows fa-stack-1x fa-inverse"></i></span>' : '';

		$tabla = '';
		foreach ($listaTemporal as $elementoTemporal) {
			if ($_REQUEST['permisoAcDc'] == 0) {
				if ($elementoTemporal['status']!=0) {
					$img     = 'img/visible.png';
					$funcion = '';
					$class   = 'nover';
				}
				else{
					$img     ='img/invisible.png';
					$funcion ='';
					$class   = 'ver';
			   }
			} else {
				if ($elementoTemporal['status']!=0) {
					$img='img/visible.png';
					$funcion='changeStatus('.$elementoTemporal['idServicio'].',0,\'changeStatusServicio\')';
					$class = 'nover';
				} else {
			  		$img='img/invisible.png';
					$funcion='changeStatus('.$elementoTemporal['idServicio'].',1,\'changeStatusServicio\')';
					$class = 'ver';
			   }
			}

			if($_REQUEST['tipo']=='Destino'){
				$estiloAdicional='style="display:none"';
			}
			else{
				$estiloAdicional='';
			}

		$tabla .= '<tr>
	          	<td>
	             	<input type="hidden" name="idorden" class="idorden" value="'. $elementoTemporal['idExperiencia'] .'">
	            	<input type="checkbox" id="'. $elementoTemporal['idExperiencia'] .'" name="idExperiencia[]" value="'. $elementoTemporal['idExperiencia'] .'">
					<label for="'. $elementoTemporal['idExperiencia'] .'"><span></span></label>
	            </td>
	           	<td>
	            	<a href="formulario'. $_REQUEST['tipo'] .'.php?id='. $elementoTemporal['idExperiencia'] .'">
	            		<img src="../img/img'. $_REQUEST['tipo'] .'/'. $elementoTemporal['imgPortada'] .'" class="img-responsive">
	            	</a>
	            </td>
	            <td>
	            	<a href="formulario'. $_REQUEST['tipo'] .'.php?id='. $elementoTemporal['idExperiencia'] .'">
	            		'. $elementoTemporal['nombre'] .'
	            	</a>
	            </td>
	            <td class="text-center">
	            	'. $handle .'
	            	<img class="manita '. $class .'" onclick="'. $funcion .'" id="temp'. $elementoTemporal['idExperiencia'] .'" src="'. $img .'">
	            </td>
	        </tr>';
    	}

        $_lastPage = count($listaTemporal)-1;
		$_de       = $listaTemporal[$_lastPage]['orden'];

		$htmlpaginador = $herramientas -> paginador($listaTemporal[0]['ultimapagina'], $listaTemporal[0]['pagina'], $listaTemporal[0]['paginaanterior'], $listaTemporal[0]['paginasiguiente'], 4);
		$htmlpaginador .= '<input type="hidden" id="initfor" value="'.$_de.'">';

		$arrayJson = Array (
			0 => Array ( "tabla" => $tabla, "paginador" => $htmlpaginador)
		);

		echo json_encode($arrayJson);
		break;
	/** 2016-12-02 */
	case 'borrarGaleriaExperiencia':
		$success = 0;
		if ($_REQUEST['id'] > 0) {
			$galeria = new galeria($_REQUEST['id'], 0, '', '', '', '', $_REQUEST['seccion']);
			$success = $galeria -> borrarGaleria();
		}

		echo json_encode(array('success' => $success));
		break;

	case 'borrarReseniaExperiencia':
		$success = 0;
		if ($_REQUEST['id'] > 0) {
			$resenia = new resenia($_REQUEST['id']);
			$success = $resenia -> borrarResenia();
		}

		echo json_encode(array('success' => $success));
		break;

	case 'borrarTarifaExperiencia':
		$success = 0;
		if ($_REQUEST['id'] > 0) {
			$tarifaDatos = new tarifaDatos($_REQUEST['id']);
			$success = $tarifaDatos -> borrarTarifaDatos();
		}

		echo json_encode(array('success' => $success));
		break;


	/* ==========================================================================
	   CARACTERÍSTICAS DESTINOS
	   ========================================================================== */
	case 'agregartestimonio':
		$name = '';
		$tmp  = '';
		if ($_FILES['imagen']['name'] !== '') {
			$name = $_FILES['imagen']['name'];
			$tmp  = $_FILES['imagen']['tmp_name'];
		}

		$testimonio = new testimonio(0, $_REQUEST['nombre'], $_REQUEST['ubicacion'], $_REQUEST['comentario'], 'en', $name, $tmp, $_REQUEST['comentarioEn'], $_REQUEST['idDestino']);
		$success    = $testimonio -> agregarTestimonio();

		header('location: listaTestimonio.php?idDestino='.$_REQUEST['idDestino'].'&success='. $success);
		break;

	case 'actualizartestimonio':
		$name = '';
		$tmp  = '';
		if ($_FILES['imagen']['name'] !== '') {
			$name = $_FILES['imagen']['name'];
			$tmp  = $_FILES['imagen']['tmp_name'];
		}
		$testimonio = new testimonio($_REQUEST['id'], $_REQUEST['nombre'], $_REQUEST['ubicacion'], $_REQUEST['comentario'], 'en', $name, $tmp, $_REQUEST['comentarioEn'], $_REQUEST['idDestino']);
		$success = $testimonio -> editarTestimonio();

		header('location: listaTestimonio.php?idDestino='.$_REQUEST['idDestino'].'&success='. $success);
		break;
	/** 2016-11-15 */
	case 'changeStatusTestimonio':
		$testimonio = new testimonio($_REQUEST['id']);
		$testimonio -> cambiarStatusTestimonio($_REQUEST['status']);
		break;
	/** 2016-11-15 */
	case 'operatestimonio':
		if (isset($_REQUEST['idTestimonio'])) {
			$select = $_REQUEST['operador'];
			if ($select == 'Eliminar') {
				foreach ($_REQUEST['idTestimonio'] as $elemento) {
					$testimonio = new testimonio($elemento);
					$testimonio -> borrarTestimonio();
				}
				header('location: listaTestimonio.php?success=3&idDestino='.$_REQUEST['idDestino'].'');
			}
			if ($select == 'Activar') {
				foreach ($_REQUEST['idTestimonio'] as $elemento) {
					$testimonio = new testimonio($elemento);
					$testimonio -> cambiarStatusTestimonio(1);
				}
				header('location: listaTestimonio.php?success=4&idDestino='.$_REQUEST['idDestino'].'');
			}
			if ($select == 'Desactivar') {
				foreach ($_REQUEST['idTestimonio'] as $elemento) {
					$testimonio = new testimonio($elemento);
					$testimonio -> cambiarStatusTestimonio(0);
				}
				header('location: listaTestimonio.php?success=5&idDestino='.$_REQUEST['idDestino'].'');
			}
		} else {
			header('location: listaTestimonio.php?success=0&idDestino='.$_REQUEST['idDestino'].'');
		}
		break;
	/** 2016-11-15 */
	case 'listarTestimonio':
		$herramientas  = new herramientas();
		$temporal      = new testimonio();
		$_rpp          = ($_REQUEST['registrosPorPagina'] != '-1') ? $_REQUEST['registrosPorPagina'] : 20;
		$listaTemporal = $temporal -> listaTestimonio($_REQUEST['pagina'], true, '', $_REQUEST['idDestino'], 'en', $_REQUEST['cadena']);
		$handle        = ($_REQUEST['permisoAcDc'] != 0) ? '<span class="fa-stack fa-1x mover handle"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-arrows fa-stack-1x fa-inverse"></i></span>' : '';

		foreach ($listaTemporal as $elementoTemporal) {
			if ($_REQUEST['permisoAcDc'] == 0) {
				if ($elementoTemporal['status']!=0) {
					$img     ='img/visible.png';
					$funcion ='';
					$class   = 'nover';
				} else {
					$img     ='img/invisible.png';
					$funcion ='';
					$class   = 'ver';
				}
			} else {
				if ($elementoTemporal['status']!=0) {
					$img     ='img/visible.png';
					$funcion ='changeStatus('.$elementoTemporal['idTestimonio'].',0,\'changeStatusTestimonio\')';
					$class   = 'nover';
				} else {
					$img     ='img/invisible.png';
					$funcion ='changeStatus('.$elementoTemporal['idTestimonio'].',1,\'changeStatusTestimonio\')';
					$class   = 'ver';
				}
			}
			$tabla .= ' <tr>
				            <td>
				                <input type="hidden" name="idorden" class="idorden" value="'.$elementoTemporal['idTestimonio'].'">
				                <input type="checkbox" id="'.$elementoTemporal['idTestimonio'].'" name="idTestimonio[]" value="'.$elementoTemporal['idTestimonio'].'">
								<label for="'.$elementoTemporal['idTestimonio'].'"><span></span></label>
				            </td>
				            <td>
				                <a href="javascript:;" class="edit" data-id="'.$elementoTemporal['idTestimonio'].'" data-nombre="'.$elementoTemporal['nombre'].'" data-ubicacion="'.$elementoTemporal['ubicacion'].'" data-comentario="'.$elementoTemporal['texto'].'" data-texto="'.$elementoTemporal['textoEn'].'" data-portada="'.$elementoTemporal['imgPortada'].'">
				                	<img src="../img/imgTestimonio/'.$elementoTemporal['imgPortada'].'" class="img-responsive">
				                </a>
				            </td>
				            <td>
				                <a href="javascript:;" class="edit" data-id="'.$elementoTemporal['idTestimonio'].'" data-nombre="'.$elementoTemporal['nombre'].'" data-ubicacion="'.$elementoTemporal['ubicacion'].'" data-comentario="'.$elementoTemporal['texto'].'" data-texto="'.$elementoTemporal['textoEn'].'" data-portada="'.$elementoTemporal['imgPortada'].'">
				                    '.$elementoTemporal['nombre'].'
				                </a>
				            </td>
				            <td class="text-center">
				            	'.$handle.'
				                <img class="manita '.$class.'" onclick="'.$funcion.'" id="temp'.$elementoTemporal['idTestimonio'].'" src="'.$img.'">
				            </td>
				        </tr>';
		}
		$_lastPage = count($listaTemporal)-1;
		$_de       = $listaTemporal[$_lastPage]['orden'];

		$htmlpaginador = $herramientas -> paginador($listaTemporal[0]['ultimapagina'], $listaTemporal[0]['pagina'], $listaTemporal[0]['paginaanterior'], $listaTemporal[0]['paginasiguiente'], 4);
		$htmlpaginador .= '<input type="hidden" id="initfor" value="'.$_de.'">';

		$arrayJson = Array (
			0 => Array ( "tabla" => $tabla, "paginador" => $htmlpaginador)
		);

		echo json_encode($arrayJson);
		break;

	   /* ==========================================================================
	   SLIDERS DESTINOS
	   ========================================================================== */
	case 'agregartestimonio2':
		$name = '';
		$tmp  = '';
		if ($_FILES['imagen']['name'] !== '') {
			$name = $_FILES['imagen']['name'];
			$tmp  = $_FILES['imagen']['tmp_name'];
		}

		$testimonio = new testimonio2(0, $_REQUEST['nombre'], $_REQUEST['ubicacion'], $_REQUEST['comentario'], 'en', $name, $tmp, $_REQUEST['comentarioEn'], $_REQUEST['idDestino']);
		$success    = $testimonio -> agregarTestimonio();

		header('location: listaTestimonio2.php?idDestino='.$_REQUEST['idDestino'].'&success='. $success);
		break;

	case 'actualizartestimonio2':
		$name = '';
		$tmp  = '';
		if ($_FILES['imagen']['name'] !== '') {
			$name = $_FILES['imagen']['name'];
			$tmp  = $_FILES['imagen']['tmp_name'];
		}
		$testimonio = new testimonio2($_REQUEST['id'], $_REQUEST['nombre'], $_REQUEST['ubicacion'], $_REQUEST['comentario'], 'en', $name, $tmp, $_REQUEST['comentarioEn'], $_REQUEST['idDestino']);
		$success = $testimonio -> editarTestimonio();

		header('location: listaTestimonio2.php?idDestino='.$_REQUEST['idDestino'].'&success='. $success);
		break;
	/** 2016-11-15 */
	case 'changeStatusTestimonio2':
		$testimonio = new testimonio2($_REQUEST['id']);
		$testimonio -> cambiarStatusTestimonio($_REQUEST['status']);
		break;
	/** 2016-11-15 */
	case 'operatestimonio2':
		if (isset($_REQUEST['idTestimonio'])) {
			$select = $_REQUEST['operador'];
			if ($select == 'Eliminar') {
				foreach ($_REQUEST['idTestimonio'] as $elemento) {
					$testimonio = new testimonio2($elemento);
					$testimonio -> borrarTestimonio();
				}
				header('location: listaTestimonio2.php?success=3&idDestino='.$_REQUEST['idDestino'].'');
			}
			if ($select == 'Activar') {
				foreach ($_REQUEST['idTestimonio'] as $elemento) {
					$testimonio = new testimonio2($elemento);
					$testimonio -> cambiarStatusTestimonio(1);
				}
				header('location: listaTestimonio2.php?success=4&idDestino='.$_REQUEST['idDestino'].'');
			}
			if ($select == 'Desactivar') {
				foreach ($_REQUEST['idTestimonio'] as $elemento) {
					$testimonio = new testimonio2($elemento);
					$testimonio -> cambiarStatusTestimonio(0);
				}
				header('location: listaTestimonio2.php?success=5&idDestino='.$_REQUEST['idDestino'].'');
			}
		} else {
			header('location: listaTestimonio2.php?success=0&idDestino='.$_REQUEST['idDestino'].'');
		}
		break;
	/** 2016-11-15 */
	case 'listarTestimonio2':
		$herramientas  = new herramientas();
		$temporal      = new testimonio2();
		$_rpp          = ($_REQUEST['registrosPorPagina'] != '-1') ? $_REQUEST['registrosPorPagina'] : 20;
		$listaTemporal = $temporal -> listaTestimonio($_REQUEST['pagina'], true, '', $_REQUEST['idDestino'], 'en', $_REQUEST['cadena']);
		$handle        = ($_REQUEST['permisoAcDc'] != 0) ? '<span class="fa-stack fa-1x mover handle"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-arrows fa-stack-1x fa-inverse"></i></span>' : '';

		foreach ($listaTemporal as $elementoTemporal) {
			if ($_REQUEST['permisoAcDc'] == 0) {
				if ($elementoTemporal['status']!=0) {
					$img     ='img/visible.png';
					$funcion ='';
					$class   = 'nover';
				} else {
					$img     ='img/invisible.png';
					$funcion ='';
					$class   = 'ver';
				}
			} else {
				if ($elementoTemporal['status']!=0) {
					$img     ='img/visible.png';
					$funcion ='changeStatus('.$elementoTemporal['idTestimonio'].',0,\'changeStatusTestimonio2\')';
					$class   = 'nover';
				} else {
					$img     ='img/invisible.png';
					$funcion ='changeStatus('.$elementoTemporal['idTestimonio'].',1,\'changeStatusTestimonio2\')';
					$class   = 'ver';
				}
			}
			$tabla .= ' <tr>
				            <td>
				                <input type="hidden" name="idorden" class="idorden" value="'.$elementoTemporal['idTestimonio'].'">
				                <input type="checkbox" id="'.$elementoTemporal['idTestimonio'].'" name="idTestimonio[]" value="'.$elementoTemporal['idTestimonio'].'">
								<label for="'.$elementoTemporal['idTestimonio'].'"><span></span></label>
				            </td>
				            <td>
				                <a href="javascript:;" class="edit" data-id="'.$elementoTemporal['idTestimonio'].'" data-nombre="'.$elementoTemporal['nombre'].'" data-ubicacion="'.$elementoTemporal['ubicacion'].'" data-comentario="'.$elementoTemporal['texto'].'" data-texto="'.$elementoTemporal['textoEn'].'" data-portada="'.$elementoTemporal['imgPortada'].'">
				                	<img src="../img/imgTestimonio2/'.$elementoTemporal['imgPortada'].'" class="img-responsive">
				                </a>
				            </td>
				            <td>
				                <a href="javascript:;" class="edit" data-id="'.$elementoTemporal['idTestimonio'].'" data-nombre="'.$elementoTemporal['nombre'].'" data-ubicacion="'.$elementoTemporal['ubicacion'].'" data-comentario="'.$elementoTemporal['texto'].'" data-texto="'.$elementoTemporal['textoEn'].'" data-portada="'.$elementoTemporal['imgPortada'].'">
				                    '.$elementoTemporal['nombre'].'
				                </a>
				            </td>
				            <td class="text-center">
				            	'.$handle.'
				                <img class="manita '.$class.'" onclick="'.$funcion.'" id="temp'.$elementoTemporal['idTestimonio'].'" src="'.$img.'">
				            </td>
				        </tr>';
		}
		$_lastPage = count($listaTemporal)-1;
		$_de       = $listaTemporal[$_lastPage]['orden'];

		$htmlpaginador = $herramientas -> paginador($listaTemporal[0]['ultimapagina'], $listaTemporal[0]['pagina'], $listaTemporal[0]['paginaanterior'], $listaTemporal[0]['paginasiguiente'], 4);
		$htmlpaginador .= '<input type="hidden" id="initfor" value="'.$_de.'">';

		$arrayJson = Array (
			0 => Array ( "tabla" => $tabla, "paginador" => $htmlpaginador)
		);

		echo json_encode($arrayJson);
		break;


	   /* ==========================================================================
	   CLIENTES
	   ========================================================================== */
	case 'agregartestimonio3':
		$name = '';
		$tmp  = '';
		if ($_FILES['imagen']['name'] !== '') {
			$name = $_FILES['imagen']['name'];
			$tmp  = $_FILES['imagen']['tmp_name'];
		}

		$testimonio = new testimonio3(0, $_REQUEST['nombre'], $_REQUEST['ubicacion'], $_REQUEST['comentario'], 'en', $name, $tmp, $_REQUEST['comentarioEn'], $_REQUEST['idDestino']);
		$success    = $testimonio -> agregarTestimonio();

		header('location: listaTestimonio3.php?success='. $success);
		break;

	case 'actualizartestimonio3':
		$name = '';
		$tmp  = '';
		if ($_FILES['imagen']['name'] !== '') {
			$name = $_FILES['imagen']['name'];
			$tmp  = $_FILES['imagen']['tmp_name'];
		}
		$testimonio = new testimonio3($_REQUEST['id'], $_REQUEST['nombre'], $_REQUEST['ubicacion'], $_REQUEST['comentario'], 'en', $name, $tmp, $_REQUEST['comentarioEn'], $_REQUEST['idDestino']);
		$success = $testimonio -> editarTestimonio();

		header('location: listaTestimonio3.php?success='. $success);
		break;
	/** 2016-11-15 */
	case 'changeStatusTestimonio3':
		$testimonio = new testimonio3($_REQUEST['id']);
		$testimonio -> cambiarStatusTestimonio($_REQUEST['status']);
		break;
	/** 2016-11-15 */
	case 'operatestimonio3':
		if (isset($_REQUEST['idTestimonio'])) {
			$select = $_REQUEST['operador'];
			if ($select == 'Eliminar') {
				foreach ($_REQUEST['idTestimonio'] as $elemento) {
					$testimonio = new testimonio3($elemento);
					$testimonio -> borrarTestimonio();
				}
				header('location: listaTestimonio3.php?success=3');
			}
			if ($select == 'Activar') {
				foreach ($_REQUEST['idTestimonio'] as $elemento) {
					$testimonio = new testimonio3($elemento);
					$testimonio -> cambiarStatusTestimonio(1);
				}
				header('location: listaTestimonio3.php?success=4');
			}
			if ($select == 'Desactivar') {
				foreach ($_REQUEST['idTestimonio'] as $elemento) {
					$testimonio = new testimonio3($elemento);
					$testimonio -> cambiarStatusTestimonio(0);
				}
				header('location: listaTestimonio3.php?success=5');
			}
		} else {
			header('location: listaTestimonio3.php?success=0');
		}
		break;
	/** 2016-11-15 */
	case 'listarTestimonio3':
		$herramientas  = new herramientas();
		$temporal      = new testimonio3();
		$_rpp          = ($_REQUEST['registrosPorPagina'] != '-1') ? $_REQUEST['registrosPorPagina'] : 20;
		$listaTemporal = $temporal -> listaTestimonio($_REQUEST['pagina'], true, '', $_REQUEST['idDestino'], 'en', $_REQUEST['cadena']);
		$handle        = ($_REQUEST['permisoAcDc'] != 0) ? '<span class="fa-stack fa-1x mover handle"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-arrows fa-stack-1x fa-inverse"></i></span>' : '';

		foreach ($listaTemporal as $elementoTemporal) {
			if ($_REQUEST['permisoAcDc'] == 0) {
				if ($elementoTemporal['status']!=0) {
					$img     ='img/visible.png';
					$funcion ='';
					$class   = 'nover';
				} else {
					$img     ='img/invisible.png';
					$funcion ='';
					$class   = 'ver';
				}
			} else {
				if ($elementoTemporal['status']!=0) {
					$img     ='img/visible.png';
					$funcion ='changeStatus('.$elementoTemporal['idTestimonio'].',0,\'changeStatusTestimonio3\')';
					$class   = 'nover';
				} else {
					$img     ='img/invisible.png';
					$funcion ='changeStatus('.$elementoTemporal['idTestimonio'].',1,\'changeStatusTestimonio3\')';
					$class   = 'ver';
				}
			}
			$tabla .= ' <tr>
				            <td>
				                <input type="hidden" name="idorden" class="idorden" value="'.$elementoTemporal['idTestimonio'].'">
				                <input type="checkbox" id="'.$elementoTemporal['idTestimonio'].'" name="idTestimonio[]" value="'.$elementoTemporal['idTestimonio'].'">
								<label for="'.$elementoTemporal['idTestimonio'].'"><span></span></label>
				            </td>
				            <td>
				                <a href="javascript:;" class="edit" data-id="'.$elementoTemporal['idTestimonio'].'" data-nombre="'.$elementoTemporal['nombre'].'" data-ubicacion="'.$elementoTemporal['ubicacion'].'" data-comentario="'.$elementoTemporal['texto'].'" data-texto="'.$elementoTemporal['textoEn'].'" data-portada="'.$elementoTemporal['imgPortada'].'">
				                	<img src="../img/imgTestimonio3/'.$elementoTemporal['imgPortada'].'" class="img-responsive">
				                </a>
				            </td>
				            <td>
				                <a href="javascript:;" class="edit" data-id="'.$elementoTemporal['idTestimonio'].'" data-nombre="'.$elementoTemporal['nombre'].'" data-ubicacion="'.$elementoTemporal['ubicacion'].'" data-comentario="'.$elementoTemporal['texto'].'" data-texto="'.$elementoTemporal['textoEn'].'" data-portada="'.$elementoTemporal['imgPortada'].'">
				                    '.$elementoTemporal['nombre'].'
				                </a>
				            </td>
				            <td class="text-center">
				            	'.$handle.'
				                <img class="manita '.$class.'" onclick="'.$funcion.'" id="temp'.$elementoTemporal['idTestimonio'].'" src="'.$img.'">
				            </td>
				        </tr>';
		}
		$_lastPage = count($listaTemporal)-1;
		$_de       = $listaTemporal[$_lastPage]['orden'];

		$htmlpaginador = $herramientas -> paginador($listaTemporal[0]['ultimapagina'], $listaTemporal[0]['pagina'], $listaTemporal[0]['paginaanterior'], $listaTemporal[0]['paginasiguiente'], 4);
		$htmlpaginador .= '<input type="hidden" id="initfor" value="'.$_de.'">';

		$arrayJson = Array (
			0 => Array ( "tabla" => $tabla, "paginador" => $htmlpaginador)
		);

		echo json_encode($arrayJson);
		break;

    //código de descuento

		case 'agregarcodigo':
			$codigo = new codigo($_REQUEST['idCodigo'],$_REQUEST['codigo'],$_REQUEST['fechaInicio'],$_REQUEST['fechaTermino'],$_REQUEST['codigoUsuario'],$_REQUEST['tipoDescuento'],$_REQUEST['valor'],$_REQUEST['tipoCodigo'],$_REQUEST['limite'],$_REQUEST['descripcionEs'],$_REQUEST['descripcionEn'],$_REQUEST['status']);
			$codigo -> insertacodigo();
			header('location: listaCodigo.php?success=1');
		break;
		case 'modificarcodigo':
			$codigo = new codigo($_REQUEST['idCodigo'],$_REQUEST['codigo'],$_REQUEST['fechaInicio'],$_REQUEST['fechaTermino'],$_REQUEST['codigoUsuario'],$_REQUEST['tipoDescuento'],$_REQUEST['valor'],$_REQUEST['tipoCodigo'],$_REQUEST['limite'],$_REQUEST['descripcionEs'],$_REQUEST['descripcionEn'],$_REQUEST['status']);
			$codigo->modificacodigo();
			header('location: listaCodigo.php?success=2');
			break;
			case 'operacodigo':
				if(isset($_REQUEST['idCodigo'])){
					$select=$_REQUEST['operador'];
					$imgp=0;
					if ($select == 'Eliminar'){
						foreach ($_REQUEST['idCodigo'] as $elementoCodigo) {
							$codigo = new codigo();
							$codigo -> idCodigo=$elementoCodigo;
							$codigo->eliminacodigo();
						}
						header('location: listaCodigo.php?success=3');
					}
					if ($select == 'Mostrar'){
						foreach ($_REQUEST['idCodigo'] as $elemento) {
							$codigo = new codigo();
							$codigo -> idCodigo=$elemento;
							$codigo -> activacodigo();
						}
						header('location: listaCodigo.php?success=4');
					}
					if ($select == 'No Mostrar'){
						foreach ($_REQUEST['idCodigo'] as $elemento) {
							$codigo = new codigo();
							$codigo -> idCodigo=$elemento;
							$codigo -> Desactivacodigo();
						}
						header('location: listaCodigo.php?success=5');
					}
				}
				else {
					header('location: listaCodigo.php?success=0');
				}
			break;
			case 'activacodigo':
				 $codigo = new codigo();
				 $codigo -> idCodigo = $_REQUEST['id'];
				 $codigo -> activacodigo();
			break;
			case 'desactivacodigo':
				 $codigo = new codigo();
				 $codigo -> idCodigo = $_REQUEST['id'];
				 $codigo -> Desactivacodigo();
			break;

      /* ==========================================================================
    	   ORDEN
    	   ========================================================================== */
    	case 'operaorden':
    		if (isset($_REQUEST['idOrden'])) {
    			$select=$_REQUEST['operador'];
    			if ($select == 'Eliminar') {
    				foreach ($_REQUEST['idOrden'] as $elemento) {
    					$orden = new orden($elemento);
    					$orden -> deleteOrden();
    				}
    				header('location: listaOrden.php?success=3');
    			}
    		} else {
    			header('location: listaOrden.php?success=0');
    		}
    	break;
    	case 'listarOrden':
    		$herramientas = new herramientas();
    		$temporal = new orden();
    		$listaTemporal = $temporal -> listOrden($_REQUEST['pagina'], false, false, $_REQUEST['cadena']);
    		foreach($listaTemporal as $elementoTemporal) {
    			if ($elementoTemporal['estatus'] == 0) {
    			  $label = '<span class="label label-danger">Proceso Incompleto</span>';
    			  $funcion =' <img class="manita nover" style="float:right" onclick="eliminarOrden('.$elemento['idOrden'].')" id="temp'.$elemento['idOrden'].'" src="img/invisible.png">';
    			}
    			if ($elementoTemporal['status'] == 1) {
    			  $label = '<span class="label label-warning">Pendiente de Pago</span>';
    			  $funcion = '';
    			}
    			if ($elementoTemporal['status'] == 2) {
    			  $label = '<span class="label label-warning">Pendiente de Pago</span>';
    			  $funcion = '';
    			}
    			if ($elementoTemporal['status'] == 3) {
    			  //$label = '<span class="label label-success">Pagado</span>';
    			  $label = '<span class="label label-success">Pagado sin Enviar</span>';
    			  $funcion = '';
    			}
    			if ($elementoTemporal['status'] == 4) {
    			  //$label = '<span class="label label-success">Pagado</span>';
    			  $label = '<span class="label label-info">Pagado y Enviado</span>';
    			  $funcion = '';
    			}
    			if ($elementoTemporal['status'] == 5) {
    			  //$label = '<span class="label label-success">Pagado</span>';
    			  $label = '<span class="label label-primary">Pedido Completado</span>';
    			  $funcion = '';
    			}

    			$importeTotal=$elementoTemporal['importeTotal'];
    			$datosOrden=new datosOrden($elementoTemporal['idOrden']);
    			$datosOrden->getDatosOrden();
    			$descuento=$datosOrden->descuento;
    			$precioTransporte=$datosOrden->precioTransporte;
    			$precioFinal=($importeTotal-$descuento)+$precioTransporte;
    			$tabla .= ' <tr>
    				            <td>
    				                <input type="hidden" name="idorden" class="idorden" value="'.$elementoTemporal['idOrden'].'">
    				                <input type="checkbox" id="'.$elementoTemporal['idOrden'].'" name="idOrden[]" value="'.$elementoTemporal['idOrden'].'">
    								<label for="'.$elementoTemporal['idOrden'].'"><span></span></label>
    				            </td>
    				            <td>
    								<a href="formularioOrden.php?idOrden='.$elementoTemporal['idOrden'].'">
    									'.$elementoTemporal['idOrden'].'
    								</a>
    							</td>
    							<td class="text-center"><a href="formularioOrden.php?idOrden='.$elementoTemporal['idOrden'].'">'.$elementoTemporal['nombre'].' '.$elementoTemporal['apellido'].'</a></td>
    							<td class="text-center">'.$elementoTemporal['fecha'].'</td>
    							<td class="text-center">'.$elementoTemporal['cantidad'].'</td>
    							<td class="text-center">$'.number_format($precioFinal, 2, '.', '').'</td>
    							<td class="">'.$label.' '.$elementoTemporal['metodo'].'</td>
    				        </tr>';
    		}
    		$_lastPage = count($listaTemporal)-1;
    		$_de = $listaTemporal[$_lastPage]['orden'];

    		$htmlpaginador = $herramientas -> paginador($listaTemporal[0]['ultimapagina'], $listaTemporal[0]['pagina'], $listaTemporal[0]['paginaanterior'], $listaTemporal[0]['paginasiguiente'], 4);
    		$htmlpaginador .= '<input type="hidden" id="initfor" value="'.$_de.'">';
    		$arrayJson = Array (
    			0 => Array ( "tabla" => $tabla, "paginador" => $htmlpaginador)
    		);
    		echo json_encode($arrayJson);
    	break;
    	case 'correoPedidoEnviado':
    		$datosOrden = new datosOrden($_POST['idorden']);
    		$datosOrden -> updateNumeroGuia($_REQUEST['numGuia']);

    		$correoEnvioCatalogos = new correoEnvioCatalogos($_POST['idorden']);
    		$send = $correoEnvioCatalogos->enviar();
    		$orden = new orden($_POST['idorden']);
    		$orden->updateStatus(4);
    		if ($send) {
    			echo 1;
    		} else {
    			echo 0;
    		}
    	break;
    	case 'envioentregado':
    		$orden = new orden($_POST['idorden']);
    		$orden->updateStatus(5);
    		header('location: formularioOrden.php?idOrden='.$_POST['idorden'].'');
    	break;
    	case 'operareservatour':
    		if(isset($_REQUEST['id'])){
    			$select=$_REQUEST['operador'];
    			if ($select == 'Eliminar'){
    				foreach ($_REQUEST['id'] as $elemento) {


    					$reservaTransporte =  new reservatour();
    					$reservaTransporte->idreserva = $elemento;
    					$reservaTransporte->eliminareserva();
    				}
    				header('location: listReservaTour.php?success=3');
    			}
    		}
    		else {
    			header('location: listReservaTour.php?success=0');
    		}
    	break;

      ////////////////////////////////////
    	///		OPERACIONES NEWSLETTER
    	///////////////////////////////////

    	case 'listarNewsletterBlog':
    		$herramientas = new herramientas();
    		$temporal = new newsletterblog();
    		$listaTemporal = $temporal -> listNewsletter($_REQUEST['pagina'], true, '', $_REQUEST['cadena'], 50, false, $_REQUEST['tipoNews']);
    		foreach($listaTemporal as $elementoTemporal){
    			if($_REQUEST['permisoAcDc'] == 0){
    				if($elementoTemporal['status'] != 0){
    					$img='img/visible.png';
    					$funcion='';
    					$class = 'nover';
    				}else{
    					$img='img/invisible.png';
    					$funcion='';
    					$class = 'ver';
    				}
    			}else{
    				if($elementoTemporal['status'] != 0){
    					$img='img/visible.png';
    					$funcion='changeStatus('.$elementoTemporal['idNewsletter'].',0,\'changeStatusNewsletterBlog\')';
    					$class = 'nover';
    				}else{
    					$img='img/invisible.png';
    					$funcion='changeStatus('.$elementoTemporal['idNewsletter'].',1,\'changeStatusNewsletterBlog\')';
    					$class = 'ver';
    				}
    			}
    			$tabla .= '<tr>
    							<td>
    				                <input type="hidden" name="idorden" class="idorden" value="'.$elementoTemporal['idNewsletter'].'">
    				                <input type="checkbox" id="'.$elementoTemporal['idNewsletter'].'" name="idNewsletter[]" value="'.$elementoTemporal['idNewsletter'].'">
    								<label for="'.$elementoTemporal['idNewsletter'].'"><span></span></label>
    				            </td>
    				            <td>'.$elementoTemporal['correo'].'</td>
                        <td>'.$elementoTemporal['nombre'].'</td>
                        <td>'.$elementoTemporal['pais'].'</td>
                        <td>'.$elementoTemporal['ciudad'].'</td>
                        <td>'.$elementoTemporal['genero'].'</td>
                        <td>'.$elementoTemporal['tema'].'</td>
    				            <td>'.$elementoTemporal['fecha'].'</td>
    				            <td class="text-center">
    				                <img class="manita '.$class.'" onclick="'.$funcion.'" id="temp'.$elementoTemporal['idNewsletter'].'" src="'.$img.'">
    				            </td>
    				        </tr> ';
    		}
    		$_lastPage = count($listaTemporal)-1;
    		$_de = $listaTemporal[$_lastPage]['orden'];
    		$htmlpaginador = '<input type="hidden" id="initfor" value="'.$_de.'">';
    		$htmlpaginador = $herramientas -> paginador($listaTemporal[0]['ultimapagina'], $listaTemporal[0]['pagina'], $listaTemporal[0]['paginaanterior'], $listaTemporal[0]['paginasiguiente'], 4);

    		$arrayJson = Array (
    			0 => Array ( "tabla" => $tabla, "paginador" => $htmlpaginador)
    		);
    		echo json_encode($arrayJson);
    	break;
    	case 'changeStatusNewsletterBlog':
    	 	$newsletter = new newsletterblog($_REQUEST['id']);
    		$newsletter -> updateStatusNewsletter($_REQUEST['status']);
    	break;
    	case 'operanewsletterblog':
    		if(isset($_REQUEST['idNewsletter'])){
    			$select=$_REQUEST['operador'];
    			if ($select == 'Eliminar'){
    				foreach ($_REQUEST['idNewsletter'] as $elemento) {
    					$newsletter = new newsletterblog($elemento);
    					$newsletter -> deleteNewsletter();
    				}
    				header('location: listNewsletterBlog.php?success=3');
    			}
    			if ($select == 'Mostrar'){
    				foreach ($_REQUEST['idNewsletter'] as $elemento) {
    					$newsletter = new newsletterblog($elemento);
    					$newsletter -> updateStatusNewsletter(1);
    				}
    				header('location: listNewsletterBlog.php?success=4');
    			}
    			if ($select == 'No Mostrar'){
    				foreach ($_REQUEST['idNewsletter'] as $elemento) {
    					$newsletter = new newsletterblog($elemento);
    					$newsletter -> updateStatusNewsletter(0);
    				}
    				header('location: listNewsletterBlog.php?success=5');
    			}
    		}else {
    			header('location: listNewsletterBlog.php?success=0');
    		}
    	break;

      //Banner
      case 'agregarbanner':
    		$slide = new banner(0, $_REQUEST['titulo'], $_REQUEST['link'], $_FILES['imagen']['name'], $_FILES['imagen']['tmp_name'], $_REQUEST['tituloEn'], $_REQUEST['descripcion'], $_REQUEST['descripcionEn'], $_REQUEST['textoBoton'], $_REQUEST['textoBotonEn'], $_REQUEST['linkVideo'], $_REQUEST['tipo']);
    		$slide -> addSlide();
    		if($_FILES['imgMovil']['name'] != ''){
    			$slide -> updateImgMovil($_FILES['imgMovil']['name'], $_FILES['imgMovil']['tmp_name']);
    		}
    		header('location: listBanner.php?success=1&tipo='.$_REQUEST['tipo'].'');
    	break;
    	case 'modificarbanner':
    		if($_FILES['imagen']['name'] != ''){
    			$_name = $_FILES['imagen']['name'];
    			$_tmp = $_FILES['imagen']['tmp_name'];
    		}else{
    			$_name = '';
    			$_tmp = '';
    		}

    		$slide = new banner($_REQUEST['id'], $_REQUEST['titulo'], $_REQUEST['link'], $_name, $_tmp, $_REQUEST['tituloEn'], $_REQUEST['descripcion'], $_REQUEST['descripcionEn'], $_REQUEST['textoBoton'], $_REQUEST['textoBotonEn'], $_REQUEST['linkVideo']);
    		$slide -> updateSlide();
    		if($_FILES['imgMovil']['name'] != ''){
    			$slide -> updateImgMovil($_FILES['imgMovil']['name'], $_FILES['imgMovil']['tmp_name']);
    		}
    		header('location: listBanner.php?success=2&tipo='.$_REQUEST['tipo'].'');
    	break;
    	case 'operabanner':
    		if(isset($_REQUEST['idSlide'])){
    			$select=$_REQUEST['operador'];
    			if ($select == 'Eliminar'){
    				foreach ($_REQUEST['idSlide'] as $elemento) {
    					$slide = new banner($elemento);
    					$slide -> deleteSlide();
    				}
    				header('location: listBanner.php?success=3&tipo='.$_REQUEST['tipo'].'');
    			}
    			if ($select == 'Activar'){
    				foreach ($_REQUEST['idSlide'] as $elemento) {
    					$slide = new banner($elemento);
    					$slide -> updateStatusSlide(1);
    				}
    				header('location: listBanner.php?success=4&tipo='.$_REQUEST['tipo'].'');
    			}
    			if ($select == 'Desactivar'){
    				foreach ($_REQUEST['idSlide'] as $elemento) {
    					$slide = new banner($elemento);
    					$slide -> updateStatusSlide(0);
    				}
    				header('location: listBanner.php?success=5&tipo='.$_REQUEST['tipo'].'');
    			}
    		}else {
    			header('location: listBanner.php?success=0&tipo='.$_REQUEST['tipo'].'');
    		}
    	break;
    	case 'changeStatusBanner':
    		$slide = new banner($_REQUEST['id']);
    		$slide -> updateStatusSlide($_REQUEST['status']);
      break;
      ////////////////////////////////////
    	///		CONFIGURACIÓN GENERAL
    	///////////////////////////////////
      case 'setPassengersLimit':
        $general = new general();
        $general->setPassengersLimit($_REQUEST['passengers']);
        if ($general->successLimit == 1) {
          header('Location:general.php');
        }
      break;


}
?>
