
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            {titulo1}
            <small>{titulo2}</small>     
            <button class="btn btn-sm btn-success" onclick="add_Productos()"><i class="glyphicon glyphicon-plus"></i> Productos</button>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> {titulo3}</a></li>
            <li class="active">{titulo4}</li>
          </ol>
        </section>
              <section class="content">
                    <table id="table_producto" class="table table-striped table-bordered" cellspacing="30" width="100%">
                      <thead>
                        <tr>
                        <th class ="text-danger"><i class="fa fa-list"></i> </th>
                        <th class ="text-danger"><i class="fa fa-codepen"></i>  Codigo</th>
                          <th class ="text-danger"><i class="fa fa-user"></i>  Nombre</th>
                          <th class ="text-danger"><i class="fa fa-usd"></i>  Precio</th>
                          <th class ="text-danger"><i class="fa fa-cc"></i> Cantidad</th>
                          <th class ="text-danger"><i class="fa fa-building-o"></i> Categoria</th>
                          <th  class ="text-danger"style="width:125px;"><i class="fa fa-cogs"></i> Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
              </section><!-- /.content -->
        </div>
  <div class="modal fade" id="modal_form_productos" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title_productos">Formulario Productos</h3>
        </div>
       <div class="alert alert-info" id="producto_aler" >
        <strong class="title" ></strong>
      </div>
        <div class="modal-body form">
          <form action="#" name="formulario" id="form_productos" class="form-signin" enctype="multipart/form-data">
            <input type="hidden" value="" name="idProducto_Servicio"/>
            <input type="hidden" value="" name="Codigo_Barra"/>  
                <div class="table-responsive">
                  <table class="table table-striped">
                    <tbody>
                       <tr id="transparente">
                          <td >
                            <a> Codigo </a>
                          </td>
                          <td>
                            <span class ="N text-danger"></span>
                            <div class="form-group has-feedback">
                              <input required  type ="text" id="Codigo" name="Codigo" class="form-control " placeholder="Codigo" size='45' title="ingrese Codigo" pattern="[0-9]{3,10}" min="3" maxlength="10"  autofocus   >
                              <!-- <span class="fa fa-codepen form-control-feedback"></span> -->
                            </div>
                          </td>
                          <td >
                            <a> Nombre </a>
                          </td>
                          <td>
                            <span class ="A text-danger"></span>
                            <div class="form-group has-feedback">
                              <input required  type ="text" id="Nombre" name="Nombre" class="form-control " placeholder="Nombre" size='45' title="ingrese Nombre"pattern="[A-Za-z ]{4,50}" maxlength="50" maxlength="30"  autofocus   >
                              <!-- <span class="glyphicon glyphicon-user form-control-feedback"></span> -->
                            </div>
                          </td>
                        </tr>
                        <tr id="transparente"> 
                          <td >
                            <a> Categoria </a>
                          </td>
                          <td>
                            <span class ="cate text-danger"></span>
                            <div class="form-group has-feedback">
                                        <input required type='text' id='autocomplete cliente_bus' name="Categoria" class="form-control autocomplete cliente_bus" value="<?php echo set_value('Categoriaa');?>" placeholder="escribe una letra"  title="Seleciona Categoriaa"/>
                                        <input required id="idCategoria" name="idCategoria" class="form-control" placeholder="idCategoria" value="<?php echo set_value('idCategoria');?>" type="hidden"  />
                                        <?php echo form_error('idCategoria'); ?>
                            </div>
                          </td>
                          <td >
                            <a> Precio </a>
                          </td>
                          <td>
                              <span class ="T text-danger"></span>
                              <div class="form-group has-feedback">
                                  <input  required  type ="text" id="Precio_Unitario" name="Precio_Unitario" class="form-control" placeholder="Precio" size='45'   title="ingrese Precio" pattern="[0-9]{3,10}" min="3" maxlength="10"  autofocus  >
                                <!-- <span class="glyphicon glyphicon-phone form-control-feedback"></span> -->
                              </div>
                          </td>
                        </tr> 
                        <tr id="transparente"> 
                          <td >
                            <a> Cantidad </a>
                          </td>
                          <td>
                                <span class ="E text-danger"></span>
                              <div class="form-group has-feedback">
                                <input  required  type ="text" id="Cantidad" name="Cantidad" class="form-control" placeholder="Cantidad" title="Cantidad" onfocus="autofocus" pattern="[0-9]{1,10}" min="3" maxlength="10" autofocus  >
                                <!-- <span class="glyphicon glyphicon-envelope form-control-feedback"></span> -->
                              </div>
                          </td>
                          <td >
                            <a> Descuento </a>
                          </td>
                          <td>
                          <span class ="U text-danger"></span>
                          <div class="form-group has-feedback">
                            <input  required type ="text" id="Descuento" name="Descuento" class="form-control" onfocus="autofocus" autocomplete="off"  placeholder="descuento" pattern="[0-9]{0,10}" min="3" maxlength="10"  autofocus >
                            <!-- <span class="glyphicon glyphicon-magnet form-control-feedback"></span> -->
                          </div>
                          </td>
                        </tr>
                        <tr id="transparente">
                          <td >
                            <a> Iva </a>
                          </td>
                          <td>
                          <span class ="P text-danger"></span>
                          <div class="form-group has-feedback">
                                  <select required class="form-control has-feedback" name="Iva" id="Iva"  title="Seleciona Iva">
                                          <option  value=""></option>
                                          <option  value="10">10%</option>
                                          <option   value="5">5%</option>
                                        </select> 
                          <!-- <span class="glyphicon glyphicon-lock form-control-feedback"></span> -->
                          </div>
                          </td>
                         <td >
                            <a> Descripcion </a>
                         </td>
                          <td>
                           <span class ="PF text-danger"></span>
                          <div class="form-group has-feedback" id="PF">
                             <textarea required  rows="2" class="form-control has-feedback"  autofocus="autofocus"   placeholder=""  id='Descripcion' name='Descripcion'  title="Ingrese una Descripcion" type="textarea" pattern="[A-Za-z ]{5,50}" maxlength="50" ></textarea>
                          </div>
                          </td>
                       </tr>
                    </tbody>
                  </table>
                </div>
           <div class="modal-footer">
              <button type="submit" id="btnSave"  class="btn btn-sm btn-success">
                       <span class="glyphicon glyphicon-floppy-disk"></span> Guardar
              </button>&nbsp;&nbsp;&nbsp;     
              <button type="reset"  class="btn btn-sm btn-info">
                      <i class="fa fa-refresh "></i> Limpiar
              </button>
               <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" >
                       <span class="glyphicon glyphicon-floppy-remove"></span> Cancelar
               </button>     
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
 <div class="modal fade" id="ver_mas" >
    <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
        <button type="button " class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title_productos_ver"></h3>

      </div>
      <div class="modal-body form" id="reset">
      <fieldset title="Step 3" class="step" id="default-step-2" style="display: block;">
                                      <div class="form-group">
                                          <label class="col-lg-3 control-label">Codigo Barra</label>
                                          <div class="col-lg-8">
                                              <p class="form-control-static Codigo_Barra" id="Codigo_Barra"> </p>
                                          </div>
                                      </div><br>
                                      <div class="form-group">
                                          <label class="col-lg-3 control-label">Descripcion</label>
                                          <div class="col-lg-8">
                                              <p class="form-control-static Descripcion" id="Descripcion"></p>
                                          </div>
                                      </div><br>
                                      <div class="form-group">
                                          <label class="col-lg-3 control-label">Descuento</label>
                                          <div class="col-lg-8">
                                              <p class="form-control-static Descuento" id="Descuento"></p>
                                          </div>
                                      </div><br>
                                      <div class="form-group">
                                          <label class="col-lg-3 control-label">Iva</label>
                                          <div class="col-lg-8">
                                              <p class="form-control-static Iva" id="Iva"></p>
                                          </div>
                                      </div>
     </fieldset>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
<script type="text/javascript" charset="utf-8" async defer>
// $(":file").filestyle('input', false); 
// $(":file").filestyle('buttonName', 'btn-primary');
// $(":file").filestyle('buttonText', '&nbsp;&nbsp;Cargar Imagen');
// $(":file").filestyle('placeholder', 'Crga una imagen no mayor a 4 megas');
// $(function() {
//   $('#ss').click(function() {
//   $(":file").filestyle('clear');
// });
// });
 </script> 