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
    <form class="form-horizontal" method="post" name="Cerrar_caja" id="Cerrar_caja" role="form" target="myIframe"  action="<?= site_url('index.php/Reportes/generar_caja_principal'); ?>">
            <div class="roww featurette">
                <div class="datatime"  >
                    <button  id="datatima" type="button" class="btn btn-block btn-info btn-xs" >
                     <h4>
                        Fecha Inicio&nbsp;
                        <?php echo date("m/d/Y");?> &nbsp;
                        Hora &nbsp;
                        <?php $stime=date("H").":".date("i").date("A");
                        echo " $stime";
                        ?>
                     </h4> 
                    </button>
                </div>
                <div class="col-md-8 col-md-offset-0" >
                        <div class="box box-success " style="height: 500px;  overflow : auto;  ">
                                    <table id="contenido_caja_ajax" class="table table-striped" >

                                      <thead>
                                        <tr class="success">
                                           <th class ="text-danger" style="text-align:center">   Descripcion</th>
                                           <th class ="text-danger" style="text-align:center height: auto; width: 70px;">   Fecha</th>
                                           <th class ="text-danger" style="text-align:center; height: auto; width: 70px;">   Ingresos</th>
                                           <th class ="text-danger" style="text-align:center; height: auto; width: 70px;"> Egresos</th>
                                           <th class="success"  style="text-align:center; height: auto; width: 80px;">Total</th>
                                         </tr>
                                      </thead>
                                    </table>
                        </div>
                </div>
                <!-- ////////////////////////////////// -->
               <div class="col-md-4 col-md-offset-0" >
                    <table class="table" >
                        <tbody>
                            <tr id="transparente">
                                <td>
                                    <div class="btn bg-navy btn-flat  margin " id="caja_abierta">
                                        <input id="caja_abierta" type="button" class="btn bg-navy  btn-lg disabled" value="Caja Abierta">
                                    </div>
                                </td> 
                                <td>
                                    <div class="btn bg-orange btn-flat  margin " id="1">
                                       <input type="submit" id="1" class="btn bg-orange btn-lg" onclick="return cerrarCaja()" name="1" value="Cerrar">
                                    </div>
                                </td>
                            </tr>
                            <tr id="transparente">
                                <td colspan="2">
                                        <h3>
                                           <p class="text-center text-primary">Informacion del Usuario<!-- <hr class="soften" /> --></p>
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
                                        <p id="final" class="text-primary">Monto Final</p>
                                    </h3>
                                </td>
                                    <td>
                                    <h3 id="monto_final1">
                                        
                                    </h3>
                                        <!-- <input type="text" name="monto_final1" id="monto_final1" class="" value=""  pattern="" title="" disabled> -->
                                         <input type="hidden" name="Importe" id="Importe" class="form-control" value=""  pattern="" title="" >
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table">
                        <tbody class="table_occiones">
                            <tr id="transparente">
                                <td>
                                    <h3>
                                        &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                    </h3>
                                </td>

                                <td>
                                    <h3>
                                         &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                    </h3>
                                </td>
                                <td>
                                    <h3 class="occiones">
                                        <button type="button" class="btn btn-primary  btn-sm"  data-toggle="modal" href='#modal-id' >
                                             <i class="fa fa-external-link"></i> Occiones
                                        </button>
                                    </h3>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        <div class="modal fade" id="modal-id">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Ociones</h4>
                    </div>
                    <div class="modal-body">
                 <label for="" class="col-xs-2 ">Configuracion</label>
                 <div class="col-xs-5   ">
                          <select name="rango_caja" id="rango_caja" class="form-control input-sm" >
                            <option class="" value="1">Normal</option>
                            <option class="" value="2">Detallado</option>
                           </select>
                </div>
                 <div class="col-xs-5   ">
                 
                    <button type="submit" formtarget="_blank" id="target" class="btn btn-block btn-primary btn-fla pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>

                </div>

                    </div>
                    <div class="modal-footer ">
                    <div class="col-xs-12"></div>
                 <!--        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> -->
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
        </div>
    </form>
