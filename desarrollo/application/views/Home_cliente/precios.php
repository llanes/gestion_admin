     <!--header start-->
     <style type="text/css" media="screen">
    /*  a {
      background: transparent;
      }*/
      li {
      display: list-item;
      text-align: -webkit-match-parent;
      }
      ul li {
      list-style: none;
      }
      a, a:hover, a:focus {
      text-decoration: none;
      outline: none;
      }
      .prod-cat li a {
      border-bottom: 1px dashed #d9d9d9;
      }
 /*     .prod-cat li a {
      color: #3b3b3b;
      }*/
      .nav>li>a {
      position: relative;
      display: block;
      padding: 10px 15px;
      }
body {

    background: #f1f2f7;
}


     </style>
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
                      <li ><a href="<?php echo site_url('index.php/2') ?>">Servicios</a></li>
                      <li class="dropdown ">
                      </li>
                      <li class=""><a href="<?php echo site_url('index.php/3') ?>">Presupuesto</a></li>
                      <li class="active"><a href="<?php echo site_url('index.php/4') ?>">Precios</a></li>
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
                    <h1>Precios&nbsp;&nbsp;&nbsp;<button type="button" id="refres" class="btn btn-info">Listar Todos</button></h1>

                </div>
                <div class="col-lg-8 col-sm-8">
                    <ol class="breadcrumb pull-right">
                         <li ><a href="<?php echo site_url('index.php/4') ?>">Inicio</a></li>
                        <li class="active">Precios</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
     <div >


        <div class="row">
                  <div class="col-md-3">
                      <section class="panel">
                          <div class="panel-body">
                              <input type="text" placeholder="Buscar articulos" id="fillter" class="form-control">
                          </div>
                      </section>
                      <section class="panel">
                          <header class="panel-heading">
                              Categoria

                          </header>
                          <div class="panel-body">
                              <ul class="nav prod-cat">
                              {form}
                                  <li><a href="<?php echo site_url('index.php/Home_cliente/lista_pr_categ'); ?>/{idCategoria}" ><i class=" fa fa-angle-right"></i> {Categoria}</a></li>
                              {/form}
                              </ul>
                          </div>

                  </div>

                  <div class="col-md-9" id="contenedor">

                  </div>
              </div>
<script type="text/javascript" charset="utf-8" async defer>
var table_precio;
$(function() {
      table_precio = $('#table_precio').DataTable({ 
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('index.php/Home_cliente/ajax_list'); ?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ -1 ], //last column
          "orderable": false, //set not orderable
        },
        ],

      });
    });

    function reload_table()
    {
      table_precio.ajax.reload(null,false); //reload datatable ajax 
    }
    $(function() {
       $("#contenedor").load("<?php echo site_url('index.php/Home_cliente/lista_precio'); ?>");
       $(document).on('click', '.pagination_class li a', function(event) {
         event.preventDefault();
         /* Act on the event */
          var href = $(this).attr("href");
          $("#contenedor").load(href);
       });
       $(document).on('click', '.prod-cat li a', function(event) {
         event.preventDefault();
         /* Act on the event */
          var href = $(this).attr("href");
          // alert(href);
          $("#contenedor").load(href);
       });

       $(document).on('click','#refres',function(event) {
          event.preventDefault();
          $("#contenedor").load("<?php echo site_url('index.php/Home_cliente/lista_precio'); ?>");
       });

       try{
            $(document).on('keyup','#fillter', function(){
              var value = $(this).val();
              if (value != '') {
                 $("#contenedor").load("<?php echo site_url('index.php/Home_cliente/precio_fillter'); ?>/"+value);
              }else{
                 $("#contenedor").load("<?php echo site_url('index.php/Home_cliente/lista_precio'); ?>");
              }
              }).keyup();
          }catch(e){};

    });

</script>