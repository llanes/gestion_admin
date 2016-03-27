<script >
    $(function() {
        $("#input").keyup(function () {
        var value = $(this).val();
        $("#Importe").val(value);
        $("#Importe1").val(value);
        });
    });



</script>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            {titulo1}
            <small>{titulo2}</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> {titulo3}</a></li>
            <li class="active">{titulo4}</li>
          </ol>
        </section>
    <form class="form-horizontal" method="post" name="Abrir_caja" id="Abrir_caja" role="form" action="#">
    <input type="hidden" name="Fecha" id="Fecha" value="<?php echo date("Y-m-d");?>">
            <div class="roww featurette">
                <div class="abrir_caja" >
                    <button id="datatima" type="button" class="btn btn-block btn-info btn-xs" > 
                    <h4>Abri Caja</h4>  </button>
                </div>
                <div class="col-md-8 col-md-offset-0" >
                    <div id="Cabecera" class="col-md-8 col-md-offset-2">
                    <table class="table" id="cabecera">
                        <tbody>
                            <tr id="transparente">
                             <div class="col-xs-4">
                                <td>
                                        <h3>
                                            <span id="" class="text-primary">Monto Apertura</span>
                                        </h3>
                                </td>
                             </div>
                             <div class="col-xs-3">
                                <td>
                                    <h5>
                                        <input required type="text" name="" id="input" class="form-control input-lg" value="{monto_inicio}" placeholder="Introducir" pattern="[0-9]{0,11}" min="0" maxlength="11"  title="insertar" >
                                    </h5>
                                </td>
                             </div>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                    <div class="col-md-12 col-md-offset-0" >
                        <div class="" style="height: 417px;  overflow : auto;  ">
                            <h4>
                                <p class="text-info text-center" id="info">Listado registro de caja.</p>
                            </h4>
                                    <table id="registro_caja_ajax" class="table table-striped" >

                                      <thead>
                                        <tr class="success">
                                           <th class ="text-danger" style="text-align:center;">Apertura</th>
                                           <th class ="text-danger" style="text-align:center;">Cierre</th>
                                             <th class ="text-danger" style="text-align:center;">Monto final</th>
                                                   <th class ="text-danger" style="width:70px; text-align:center">Usuario</th>
                                            <th  class ="text-danger"style="width:30px; text-align:center"> Acciones</th>
                                         </tr>
                                      </thead>
                                    </table>
                        </div>
                    </div>
                </div>
                <!-- ////////////////////////////////// -->
               <div class="col-md-4 col-md-offset-0" >
                    <table class="table" >
                        <tbody>
                            <tr id="transparente">
                                <td>
                                    <div class="btn bg-orange btn-flat  margin disabled" id="caja_cerrada">
                                        <input id="caja_cerrada" type="button" class="btn bg-orange btn-lg " value="Caja Cerrada">
                                    </div>
                                </td> 
                                <td>
                                    <div class="btn bg-navy btn-flat  margin " >
                                        <input type="submit"  class="btn bg-navy btn-lg" onclick="Abrircaja();" value="&nbsp;Abrir&nbsp;">
                                    </div>
                                </td>
                            </tr>
                            <tr id="transparente">
                                <td colspan="2">
                                        <h3>
                                           <p class="text-center text-primary">Informacion del Uduario<!-- <hr class="soften" /> --></p>
                                        </h3>
                                        <div class="box box-success">
                                        </div>
                                            <strong class="profile-ava">
                                                <i class="fa fa-user fa-fw"></i>Nombre:&nbsp;&nbsp;
                                                <abbr class="username">
                                                    <span class="text-danger">
                                                        <?php 
                                                        echo ucfirst($this->session->userdata('Usuario'));
                                                         ?>
                                                    </span>
                                                </abbr>
                                            </strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table" >
                        <tbody>
                            <tr id="transparente">
                                <td>
                                    <h3>
                                        <p id="inicial" class="text-primary">Monto Inicio</p>
                                    </h3>
                                </td>
                                    <td>
                                    <h5>
                                        <input type="number" name="Importe1" id="Importe1" class="form-control" value="{monto_inicio}"  pattern="" title="" disabled>
                                         <input type="hidden" name="Importe" id="Importe" class="form-control" value="{monto_inicio}"  pattern="" title="" >
                                    </h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
   </form>
