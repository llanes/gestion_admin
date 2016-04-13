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
                    <ul class="nav navbar-nav nav-tabs">
                      <li ><a href="<?php echo site_url('index.php/1') ?>">Inicio</a></li>
                      <li class="active"><a href="<?php echo site_url('index.php/2') ?>">Servicios</a></li>
                      <li class="dropdown ">
                      </li>
                      <li class=""><a href="<?php echo site_url('index.php/3') ?>">Presupuesto</a></li>
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
                    <h1><i class="fa fa-globe"></i> Servicios Disponoble</h1>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <ol class="breadcrumb pull-right">
                         <li ><a href="<?php echo site_url('index.php/1') ?>">Inicio</a></li>
                        <li class="active">Services</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
     <div >
        <div class="container">
            <div class="row">
                <div class="row">

                    <div class="services">
                    {formulario}
                        <div class="col-lg-6 col-sm-6">
                        <br>
                            <div class="icon-wrap ico-bg round">
                                <i class="fa fa-desktop"></i>
                            </div>
                            <div class="content">
                                <h3 class="title"><a href="#" onclick="listar({idCategoria})">{Categoria}</a></h3>
                                <p>{Descrip}.</p>
                            </div>
                        <br>
                        </div>
                     {/formulario}

                    </div>

                </div>
            </div>
                                {pagination} 
        </div>
        <div class="modal fade" id="modal-id">
            <div class="modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Articulos</h4>
                    </div>
                    <div class="modal-body">
                       <div class="services" id="list_pro">

                        </div>
                    </div>
                    <br>
                    <div class="modal-footer">
                       
                    </div>
                </div>
            </div>
        </div>
     </div>
<script type="text/javascript" charset="utf-8" async defer>
    function listar (valor) {
        $("#list_pro").html("").css({"display":"none"});
        $.ajax({
            type: 'POST',
            url: "<?php echo site_url('index.php/Home_cliente/listar_articulo/'); ?>/"+valor,
        })
        .done(function(data) {
            var result = JSON.parse(data);
             $.each(result, function(i, val){
                 $("#list_pro").append('<div class="col-lg-6 col-sm-6"><br><div class="icon-wrap ico-bg round"><i class="fa fa-desktop"></i></div><div class="content"><h3 class="title">'+val.Nombre+'</h3><p>'+val.Descripcion+'</p></div><br></div>').css({"display":"block"});
            });
           
            $('#modal-id').modal('show'); // show bootstrap modal
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
        
    }
</script>