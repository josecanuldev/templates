<?php
$menu_clave1 = "p_ver_home";
$menu_clave2 = "p_ver_talla";
$menu_clave5 = "p_ver_categoria";
$menu_clave6 = "p_ver_producto";
$menu_clave8 = "p_ver_categoria_j";
$menu_clave14 = 'p_ver_transportes';
$menu_clave15 = 'p_ver_newsletter';
$menu_clave17 = 'p_ver_ingrediente';
$menu_clave18 = 'p_ver_consideracion';
$menu_clave19 = 'p_ver_blog';

$menu_clave50 = 'p_ver_incentivo';
$menu_clave51 = 'p_ver_servicio';
$menu_clave52 = 'p_ver_yachting';
$menu_clave53 = 'p_ver_circuito';
$menu_clave54 = 'p_ver_destino';
$menu_clave55 = 'p_ver_cliente';
$menu_clave56 = 'p_ver_newsletter';
$menu_clave60 = 'p_ver_35';
$menu_clave61 = 'p_ver_premium';
$menu_clave62 = 'p_ver_estandar';
?>
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave56)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                    <li <?php if (strpos($page, "general.php")){ echo "class='active'";} ?>>
                        <a href="general.php">GENERAL</a>
                    </li>
                    <hr class="hrmenu">
                </div>

                <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave1) == 0 AND $seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave1) == 0){ echo 'style="display:none"'; }else{ echo '';}?> >
                    <li class="manita relative submenu-trigger" data-target-submenu="menu-sliders">SLIDE
                        <ul class="submenu" id="menu-sliders">
                            <!-- <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave1)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                              <li <?php if (strpos($page, "listSlide.php") AND $_REQUEST['tipo'] == 1){ echo "class='active'";} ?>><a href="listSlide.php?tipo=1">Transporte 35 USD</a>
                              </li>
                              <hr class="hrmenu">
                            </div>
                            <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave1)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                              <li <?php if (strpos($page, "listSlide.php") AND $_REQUEST['tipo'] == 2){ echo "class='active'";} ?>><a href="listSlide.php?tipo=2">Transporte privado</a>
                              </li>
                              <hr class="hrmenu">
                            </div> -->
                            <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave1)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                              <li <?php if (strpos($page, "listSlide.php") AND $_REQUEST['tipo'] == 3){ echo "class='active'";} ?>><a href="listSlide.php?tipo=3">Tours dentro Holbox</a>
                              </li>
                              <hr class="hrmenu">
                            </div>
                            <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave1)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                              <li <?php if (strpos($page, "listSlide.php") AND $_REQUEST['tipo'] == 4){ echo "class='active'";} ?>><a href="listSlide.php?tipo=4">Tours fuera Holbox</a>
                              </li>
                              <hr class="hrmenu">
                            </div>
                            <!-- <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave1)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                              <li <?php if (strpos($page, "listSlide.php") AND $_REQUEST['tipo'] == 5){ echo "class='active'";} ?>><a href="listSlide.php?tipo=5">Nosotros</a>
                              </li>
                              <hr class="hrmenu">
                            </div> -->

                        </ul>
                    </li>
                    <hr class="hrmenu">
                    <li <?php if (strpos($page, "otros-servicios.php")) { echo "class='active'";} ?>><a href="otros-servicios.php">Otros Servicios</a>
                    </li>
                    <hr class="hrmenu">
                </div>
                <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave52) == 0 AND $seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave53) == 0){ echo 'style="display:none"'; }else{ echo '';}?> >
                    <li class="manita relative submenu-trigger" data-target-submenu="menu-web">WEB
                        <ul class="submenu" id="menu-web">
                          <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave52)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                              <li <?php if (strpos($page, "listaPortadaForm.php") or strpos($page, "listaPortadaForm.php")){ echo "class='active'";} ?>><a href="listaPortadaForm.php">Portada</a>
                              </li>
                              <hr class="hrmenu">
                          </div>
                          <!-- <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave53)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                              <li <?php if (strpos($page, "listaToursFueraHolbox.php") or strpos($page, "formularioToursFueraHolbox.php")){ echo "class='active'";} ?>><a href="listaToursFueraHolbox.php">Ir a Tarifas (SAMMY)</a>
                              </li>
                              <hr class="hrmenu">
                          </div> -->
                        </ul>
                    </li>
                    <hr class="hrmenu">
                </div>
                <!--<div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave50)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                    <li <?php if (strpos($page, "listIncentivo.php") or strpos($page, "formIncentivo.php")){ echo "class='active'";} ?>><a href="listIncentivo.php">INCENTIVOS</a>
                    </li>
                    <hr class="hrmenu">
                </div>-->
                <!--<div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave51)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                    <li <?php if (strpos($page, "listaServicio.php") or strpos($page, "formularioServicio.php")){ echo "class='active'";} ?>><a href="listaServicio.php">SERVICIOS</a>
                    </li>
                    <hr class="hrmenu">
                </div>-->

                <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave52) == 0 AND $seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave53) == 0){ echo 'style="display:none"'; }else{ echo '';}?> >
                    <li class="manita relative submenu-trigger" data-target-submenu="menu-tours">TOURS
                        <ul class="submenu" id="menu-tours">
                          <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave52)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                              <li <?php if (strpos($page, "listaToursDentroHolbox.php") or strpos($page, "formularioToursDentroHolbox.php")){ echo "class='active'";} ?>><a href="listaToursDentroHolbox.php">Tours dentro Holbox</a>
                              </li>
                              <hr class="hrmenu">
                          </div>
                          <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave53)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                              <li <?php if (strpos($page, "listaToursFueraHolbox.php") or strpos($page, "formularioToursFueraHolbox.php")){ echo "class='active'";} ?>><a href="listaToursFueraHolbox.php">Tours fuera Holbox</a>
                              </li>
                              <hr class="hrmenu">
                          </div>
                        </ul>
                    </li>
                    <hr class="hrmenu">
                </div>
               <!--  <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave60)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                    <li <?php if (strpos($page, "lista35.php") or strpos($page, "formulario35.php")){ echo "class='active'";} ?>><a href="lista35.php">Transporte 35 USD</a>
                    </li>
                    <hr class="hrmenu">
                </div> -->
                <!-- <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave61) == 0 AND $seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave62) == 0){ echo 'style="display:none"'; }else{ echo '';}?> >
                    <li class="manita relative submenu-trigger" data-target-submenu="menu-privado">Transporte privado
                        <ul class="submenu" id="menu-privado">
                          <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave61)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                              <li <?php if (strpos($page, "listaServicioPremium.php") or strpos($page, "formularioServicioPremium.php")){ echo "class='active'";} ?>><a href="listaServicioPremium.php">Servicio Premium</a>
                              </li>
                              <hr class="hrmenu">
                          </div>
                          <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave62)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                              <li <?php if (strpos($page, "listaServicioEstandar.php") or strpos($page, "formularioServicioEstandar.php")){ echo "class='active'";} ?>><a href="listaServicioEstandar.php">Servicio Estandar</a>
                              </li>
                              <hr class="hrmenu">
                          </div>
                        </ul>
                    </li>
                    <hr class="hrmenu">
                </div> -->

                <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave54)==0){ echo 'style="display:none"'; }else{ echo '';}?> style="display:none">
                    <li <?php if (strpos($page, "listaDestino.php") or strpos($page, "formularioDestino.php") or strpos($page, "listaTestimonio.php") or strpos($page, "listaTestimonio2.php")){ echo "class='active'";} ?>><a href="listaDestino.php">DESTINOS</a>
                    </li>
                    <hr class="hrmenu">
                </div>
                <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave19) == 0 AND $seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave19) == 0){ echo 'style="display:none"'; }else{ echo '';}?> >
                    <li class="manita relative submenu-trigger" data-target-submenu="menu-recetas">BLOG
                        <ul class="submenu" id="menu-recetas">
                            <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave20)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                                <li <?php if (strpos($page, "listCategoria.php") AND $_REQUEST['t'] == 2){ echo "class='active'";} ?>><a href="listCategoria.php?t=2">Categorías</a>
                                </li>
                                <hr class="hrmenu">
                            </div>
                            <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave19)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                                <li style="list-style-type:none" <?php if ( ( strpos($page, "listSoluciones.php") or strpos($page, "formSoluciones.php") ) AND $_REQUEST['tipo'] == 2){ echo "class='active'";}  ?>><a href="listSoluciones.php?tipo=2">Blog</a></li>
                                <hr class="hrmenu">
                            </div>
                            <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave55)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                                <li <?php if (strpos($page, "listaTestimonio3.php")){ echo "class='active'";} ?>><a href="listaTestimonio3.php">Galería</a>
                                </li>
                                <hr class="hrmenu">
                            </div>
                            <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave64)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                                <li><a href="listBanner.php?tipo=1">Banner Nota</a>
                                </li>
                                <hr class="hrmenu">
                            </div>
                            <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave64)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                                <li><a href="listBanner.php?tipo=2">Banner Lateral</a>
                                </li>
                                <hr class="hrmenu">
                            </div>
                        </ul>
                    </li>
                    <hr class="hrmenu">
                </div>
                <!-- promo code -->

                <li class="relative <?php if (strpos($page, "listaCodigo.php") || strpos($page, "formularioCodigo.php")){ echo "active";} ?>">
                    <a href="listaCodigo.php">CÓDIGO PROMO</a>
                    <hr class="hrmenu">
                </li>
                <!-- /promo code -->


                <li class="relative <?php if (strpos($page, "listReservaTour.php") || strpos($page, "formReservaTour.php")){ echo "active";} ?>">
                    <a href="listReservaTour.php?page=1">VENTAS</a>
                    <hr class="hrmenu">
                </li>
                <!-- /ventas -->

                <!-- <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave56)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                    <li <?php if (strpos($page, "listNewsletter.php")){ echo "class='active'";} ?>><a href="listNewsletter.php">NEWSLETTER</a>
                    </li>
                    <hr class="hrmenu">
                </div> -->

                <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave56)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                    <li <?php if (strpos($page, "listNewsletterBlog.php")){ echo "class='active'";} ?>><a href="listNewsletterBlog.php">NEWSLETTER BLOG</a>
                    </li>
                    <hr class="hrmenu">
                </div>
            </ul>
            <!--<iframe height="375" width="100%" src="https://ssltools.forexprostools.com/currency-converter/index.php?from=14&to=12&force_lang=49"></iframe>-->
        </div>
