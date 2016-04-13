    <!--header start-->
    <style type="text/css" media="screen">
.tttttt{
    background-color: rgba(255, 150, 255, 0.1) !important;
}
    </style>

    <div class="modal fade bs-example-modal-lg" id="snnip">
          <div style="text-align: center">
            <br><br><br><br><br><br><br><br><br><br><br><br>
             <h1 class="text-danger">Procesando....</h1>
            <p class="text-danger"><i class="fa fa-spinner fa-spin fa-5x"></i></p>
          </div>
    </div>
    <header class="header-frontend">
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="fa fa-bars"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo site_url('index.php/Inicio') ?>">Gestion<span> Eventos </span></a>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav ">
                      <li ><a href="<?php echo site_url('index.php/1') ?>">Inicio</a></li>
                      <li><a href="<?php echo site_url('index.php/2') ?>">Servicios</a></li>
                      <li class="dropdown ">
                      </li>
                      <li class="active"><a href="<?php echo site_url('index.php/3') ?>">Presupuesto</a></li>
                      <li><a href="<?php echo site_url('index.php/4') ?>">Precios</a></li>
                      <!-- <li><a href="#">Blog</a></li> -->
                      <!-- <li><a href="<?php echo site_url('index.php/5') ?>">Contacto</a></li> -->
                      <li class="user user-menu">
                      <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> -->
                      <a href="#" class="dropdown-toggle " data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">
                      <img src="http://localhost/gestion_admin/desarrollo/admin_stilo/dist/img/avatar.png" class="user-image" alt="User Image">
                      <span class="hidden-xs"><?php echo $this->session->userdata('Usuario')?></span>
                      <b class=" fa fa-angle-down"></b>
                      </a>
                      <ul class="dropdown-menu">
                      <!-- User image -->
                      <li class="user-header">
                        <img src="http://localhost/gestion_admin/desarrollo/admin_stilo/dist/img/avatar.png" class="img-circle" alt="User Image">
                        <p>
                         Usuario
                          <small>Inicio de seccion</small>
                        </p>
                      </li>
                      <!-- Menu Footer-->
                      <li class="user-footer">
                        <div class="pull-right">
                          <a href="http://localhost/gestion_admin/desarrollo/index.php/Login/logout" class="btn btn-default btn-flat">Cerrar Seccion</a>
                        </div>
                      </li>
                      </ul>
                      </li>
                    </ul>

                </div>
            </div>
        </div>
    </header>
    <!--header end-->
      <!--breadcrumbs start-->
    <div class="breadcrumbs " >
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-4">
                    <h1><i class="fa fa-globe"></i> Presupuesto&nbsp;&nbsp;&nbsp;
                    <button class="btn  btn-success " onclick="generar_pre(0)"><i class="fa fa-calculator"></i>    Crear Presupuesto</button>
                     </h1>

                </div>
                <div class="col-lg-8 col-sm-8">
                    <ol class="breadcrumb pull-right">
                         <li ><a href="<?php echo site_url('index.php/1') ?>">Inicio</a></li>
                        <li class="active">Presupuesto</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs end-->

<section class="content" style="min-height: 400px;" >
          <div class="row">
              <div class="col-sm-10 col-md-1 col-md-offset-2 col-lg-10 col-lg-offset-1">
                    <table id="listado_presupuesto_ajax" class="table table-striped table-advance table-hover" >
                      <thead>
                        <tr>
                          <th class ="text-danger" style="width:120px;"><i class="fa fa-list"></i>   Servicio</th>
                          <th class ="text-danger" style="width:120px;">₲.  Monto Servicio</th>
                          <th class ="text-danger" style="width:120px;"><i class="fa fa-calendar"></i>  Fecha Expedición</th>
                          <th class ="text-danger" style="width:50px; text-align:center"><i class="fa fa-bookmark"></i> Detalles</th>
                          <th  class ="text-danger"style="width:60px; text-align:center"><i class="fa fa-cogs"></i> Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                    <div class="modal fade" id="details_al" >
                        <div class="modal-dialog">
                          <div class="modal-content">
                          <div class="modal-body form" id="reset">
                          <fieldset title="Step 3" class="" id="default-step-2" style="display: block;">
                            <table id="table" class="table table-striped" cellspacing="30" width="100%">
                              <caption><h4 style="text-align:center;" class ="text-success">Detalles Pedidos </h4></caption>
                              <thead>
                                <tr style="background-color:#DFF0D8">
                                  <td  style="text-align:left ">
                                    <div id="1"></div>
                                  </td>
                                  <td  style="text-align:left ">
                                    <div id="2"></div>
                                  </td>
                                  <td  style="text-align:left  ">
                                    <div id="3"></div>
                                  </td>
                                </tr>
                                <tr style="background-color:#DFF0D8">
                                  <td  style="text-align:left ">
                                    <div id="4"></div>
                                  </td>
                                  <td  style="text-align:left ">
                                    <div id="5"></div>
                                  </td>
                                  <td  style="text-align:left  ">
                                    <div id="6"></div>
                                  </td>
                                </tr>
                              </thead>
                            </table>
                          </fieldset>
                          <fieldset title="Step 3" class="step" id="default-step-2" style="display: block;">

                          </fieldset>
                          <p id='Total' ></p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-success" onclick="impri()"><i class="fa fa-print"></i> Imprimir</button>
                            <button type="button" class="btn btn-sm btn-info" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>
                    </div>
            </div>
          </div>
</section>



<div class="modal fade bs-example-modal-lg" id="modal-id">
    <div class="modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <H5 class='text-primary'>Generar Presupuesto</H5>
            </div>
            <div class="modal-body">
            <form class="form-horizontal" method="post" name="formulario" id="formulario" target="myIframe"  action="<?= site_url('index.php/Reportes/reporte_presipuesro'); ?>">
            <input type="hidden" name="fecha_expedicion" id="fecha_expedicion" value="<?php echo date("Y-m-d");?>">
                <div class="col-md-12 ">
                                            <div class="x_panel">
                                                <div class="x_content">

                                                    <section class="content invoice">
                                                        <!-- Table row -->
                                                        <div class="row">
                                                            <div class="table-responsive col-xs-12" id="table_">  
                                                                <table class="table tttttt" border="0">  
                                                                             <input type ="hidden" id="idArquiler" name="idArquiler" value="" class="form-control input-sm" placeholder="" >
                                                                              <input type ="hidden" id="Precio_Unitario" name="Precio_Unitario" value="" class="form-control input-sm" placeholder="" >
                                                                    <tr class="table-active">
                                                                      <td border="0" cellspacing="0" cellpadding="0">
                                                                        <label >Entrega</label>
                                                                      </td> 
                                                                      <td  style="width: 220px; ">
                                                                           <div class='input-group date' id='datetimepicker6'>
                                                                              <!-- <input required type="text" id="Fecha_Pre_Arqui" name="Fecha_Pre_Arqui" class="form-control input-sm " readonly="" size="16" value=""> -->
                                                                              <input required type='text' class="form-control input-sm" id="Fecha_Pre_Arqui" name="Fecha_Pre_Arqui"  size="16" value=""/>
                                                                              <div class="input-group-btn">
                                                                                  <button type="button" class="btn btn-sm btn-info date-set"><i class="fa fa-calendar"></i></button>
                                                                              </div>
                                                                          </div>
                                                                      </td id="trasparente" > 
                                                                      <td colspan="" colspan="" headers="" hheight="" width="">
                                                                        <label >Devolucion</label>
                                                                      </td> 
                                                                      <td  style="width: 220px; " id="trasparente" >
                                                                          <div class='input-group date' id='datetimepicker7'>
                                                                              <!-- <input required type="text" id="Fecha_Devolucion" name="Fecha_Devolucion" class="form-control input-sm " readonly="" size="16"> -->
                                                                              <input required type='text' class="form-control input-sm" id="Fecha_Devolucion" name="Fecha_Devolucion" size="16" value=""/>
                                                                              <div class="input-group-btn">
                                                                                  <button type="button" class="btn btn-sm btn-info date-set"><i class="fa fa-calendar"></i></button>
                                                                              </div>
                                                                          </div>
                                                                      </td> 
                                                                      <td  id="trasparente" colspan="" colspan="" headers="" hheight="" width="">
                                                                      <label >Servicio</label>
                                                                      </td> 
                                                                      <td  id="trasparente" colspan="2" colspan="" headers="" hheight="" width="">
                                                                      <input
                                                                      maxlength="35"
                                                                      required
                                                                      type='text' 
                                                                      id='autocomplete busqueda_servicio' 
                                                                      data-id=''
                                                                      name="Nombres_servicios" 
                                                                      class="autocomplete form-control input-sm busqueda_servicio" 
                                                                      value="" 
                                                                      placeholder=""  
                                                                      title="Seleciona Categoriaa"/>
                                                                      <input  id="idServicio" name="idServicio" class="form-control" placeholder="idServicio" value="" type="hidden"  />
                                                                      </td>
                                                                      <td colspan="2" rowspan="" headers=""></td>
                                                                    </tr>
                                                                    <tr border="0" cellspacing="0" cellpadding="0">
                                                                    <td   id="trasparente" >
                                                                       <label for="" class="control-label text-danger">Categoria</label>
                                                                    </td>
                                                                    <td  id="trasparente" >
                                                                            <select class="categoria" id="categoria" name="categoria" lang="">
                                                                            </select>
                                                                               <!-- <select class="categoria" name="categoria"></select> -->
                                                                    </td>
                                                                    <td  id="trasparente" >
                                                                       <label for="" class="control-label text-danger">Articulos</label>
                                                                    </td>
                                                                    <td id="trasparente" >
                                                                            <select class="Articulos" id="Articulos" name="Articulos" lang="">
                                                                            </select>
                                                                            <input maxlength="35" type="hidden" name="idProducto_Servicio" id='idProducto_Servicio' value="">
                                                                            <input maxlength="35" type="hidden" name="checkbox"  id="checkbox" value="">
                                                                            <input maxlength="35" type="hidden" id="Nombre" name="Nombre" value="">
                                                                    </td>
                                                                    <td colspan="" rowspan="" headers="" id="trasparente" >
                                                                      <label for  ="" class="control-label text-danger">Precio</label> : 
                                                                    </td>
                                                                      <td  id="trasparente" >
                                                                          <label id="Precio_Unitario1" name="Precio_Unitario1" class="control-label text-info"></label>
                                                                          <input maxlength="35" type="hidden" name="Precio_Unitario"  id="Precio_Unitario" value="">
                                                                      </td>
                                                                      <td style="text-align:right" id="trasparente" >
                                                                        <label for  ="" class="control-label text-danger">Cantidad</label>
                                                                      </td>
                                                                      <td style="width: 100px; " id="trasparente" >
                                                                          <div class="" id="max">
                                                                            <input type ="text" maxlength="5" class="form-control input-sm" id="Cantidad" name="Cantidad" maxlength="" pattern="{10,15}" placeholder="" value="">
                                                                          </div>
                                                                               <div class  ="" style="display: none">
                                                                                  <select name="opciones[inpuesto]" id="opciones_input" class="form-control input-sm di " >
                                                                                         <option value="10">10 %</option>
                                                                                      <option value="5">5 %</option>
                                                                                  </select>
                                                                              </div>
                                                                      </td>
                                                                      <!-- <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                      </td> -->
                                                                     <td colspan="" rowspan="" headers="" style="text-align:right" id="trasparente" >
                                                                              <button type="button" id="agregar_carrito"  class="btn btn-sm btn-info">
                                                                                    <i class="fa fa-cart-plus"></i> Agregar
                                                                            </button>
                                                                     </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div id="detalle">
                                                            </div>
                                                         </div>

                                                    </section>
                                                </div> 
                                            </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
<!--                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>
