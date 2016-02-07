    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          <i class="fa fa-globe"></i>
            {titulo1}
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> {titulo3}</a></li>
            <li class="active">{titulo4}</li>
          </ol>
        </section>
<section class="content" >
          <div class="row">
            <!-- left column -->
            <div class="col-md-12 box box-info" style="height: 500px;">
               <div class="col-md-2">
               </div>
               <div class="col-md-8">
                 <div class="box ">
                    <div class="box-header" style="text-align:center">
                      <h3 class="box-title">Entrada de Reportes</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

 <form role="form" id="al_pre" name="al_pre"  method="POST" target="myIframe" action="<?= site_url('index.php/Reportes/generar_empleado'); ?>">
  <table class="table table-condensed" >
    <tbody>
    <tr>
    <td colspan="">
               <label for="" class="col-xs-2 ">Rango</label>
                 <div class="col-xs-4   ">
                          <select name="rango_empleado" id="rango_empleado" class="form-control input-sm" >
                            <option class="natural" value="5">Todos</option>
                            <option class="juridica" value="10">10</option>
                              <option class="natural" value="50">50</option>
                                <option class="natural" value="100">100</option>
                                <option class="natural" value="500">500</option>

                          </select>
                </div>

                 <label for="" class="col-xs-2 "></label>
                 <div class="col-xs-4   ">
<button type="submit" formtarget="_blank" id="target" class="btn btn-block btn-primary btn-fla pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>

                </div>

    </td>

    </tr> 

    </tbody>
  </table>

                    </form>
                    <!-- <iframe name="myIframe" id="iframe" src="" height="500" width="970"></iframe> -->

                </div><!-- /.box -->
               </div>
              <div class="col-md-1">



            </div><!--/.col (left) -->
          </div>   <!-- /.row -->
        </section>

<div class="modal fade" id="reportes">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body modal-lg" >
       
      </div>
    </div>
  </div>
</div>

