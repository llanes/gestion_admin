    <link href="<?= base_url();?>admin_stilo/dist/css/Admin.css" rel="stylesheet" type"text/css" />
    <!--header start-->
    <header class="header-frontend">
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="fa fa-bars"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo site_url('index.php/1') ?>">Gestion<span> Eventos </span></a>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav ">
                      <li class="active"><a href="<?php echo site_url('index.php/1') ?>">Inicio</a></li>
                      <li><a href="<?php echo site_url('index.php/2') ?>">Servicios</a></li>
                      <li class="dropdown ">
                      </li>
                      <li id="presupuesto" class=""><a href="<?php echo site_url('index.php/3') ?>">Presupuesto</a></li>
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
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-4">
                    <h1><i class="fa fa-globe"></i> Mis Eventos</h1>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <ol class="breadcrumb pull-right">
                         <li ><a href="<?php echo site_url('index.php/1') ?>">Inicio</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumbs end -->
    <!--calendar inicio -->
    <section class="content col-md-6" style="min-height: 400px;" >
          <div class="row">
                  <div class="panel-body">
                      <div class="">
                          <div class="btn-group">
                        <button class="btn bg-maroon" id="titulos"></button>
                        <button class="btn btn-primary" data-calendar-nav="prev"><i class="fa fa-backward"></i> Anterior</button>
                          <button class="btn" data-calendar-nav="today">Hoy</button>
                          <button class="btn btn-primary" data-calendar-nav="next">Siguiente <i class="fa fa-forward"></i></button>
                        </div>
                        <div class="btn-group">
                          <button class="btn btn-warning" data-calendar-view="year">Año</button>
                          <button class="btn btn-warning active" data-calendar-view="month">Mes</button>
                          <button class="btn btn-warning" data-calendar-view="week">Semana</button>
                          <button class="btn btn-warning" data-calendar-view="day">Día</button>
                        </div>
                      </div>
                  </div>

                        <div id="calendar"  class="panel"></div>

                     <!--ventana modal para el calendario-->
                        <div class="modal fade" id="events-modal">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Detalles del evento</h4>
                                  </div>
                                <div class="modal-cabecera" style="height: 50px">

                                </div>
                                <div class="modal-body" style="height: 200px">

                                </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
                                 </div>
                              </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
          </div><!-- /.row -->
    </section>
    <!-- calendar fin -->
        <section class="content col-md-6" style="min-height: 400px;" >
        <br> 
          <div class="row">
                <div class="col-sm-11 col-md-1 col-md-offset-1 col-lg-11 ">
                    <table id="listado_alquiler_ajax" class="table table-striped table-advance table-hover" >
                      <thead>
                        <tr>
                          <th class ="text-danger" style="width:120px;"><i class="fa fa-list"></i>   Servicio</th>
                          <th class ="text-danger" style="width:120px;">₲.  Monto Servicio</th>
                          <th class ="text-danger" style="width:50px; text-align:center"><i class="fa fa-bookmark"></i> Detalles</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                </div>
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
            
          </div><!-- /.row -->
    </section>

