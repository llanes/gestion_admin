    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            {titulo1}
            <small>{titulo2}</small>     
            &nbsp;&nbsp;&nbsp;&nbsp;
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> {titulo3} <i class="fa fa-angle-double-right"></i> {titulo4}</a></li>
          </ol>
        </section>
     <section class="content">
          <div class="row">
            <div class="col-md-12">
                <div class="">
                  <div class="panel-body">
                      <div class="pull-right form-inline">
                          <div class="btn-group">
                          <button class="btn bg-maroon" id=""><i class="fa fa-calendar-o"></i></button>
                         <button class="btn bg-maroon" id="titulos"></button>
                         <button class="btn bg-maroon" id="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-calendar"></i></button>
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

                </div>
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
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
