
                                                            <div class="col-xs-12 table" >
                                                                    <table id="table" class="idRecorrer table" cellspacing="0" width="100%" >
                                                                                <thead>
                                                                                  <tr>
                                                                                              <th class  ="text-danger">Cantidad</th>
                                                                                              <th class  ="text-danger">Nombre</th>
                                                                                                <!-- <th style  ="text-align:right" class ="text-danger">Inpuesto</th> -->
                                                                                              <th style  ="text-align:right" class ="text-danger">Precio</th>
                                                                                              <th style  ="text-align:right" class ="text-danger">Subtotal</th>
                                                                                              <th  style ="text-align:right"  class ="text-danger"style="width:125px;">Acciones</th>
                                                                                  </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                          <?php $i = 1; ?>
                                                                          <?php foreach ($this->cart->contents() as $items): ?>

                                                                                  <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
                                                                                  <tr>
                                                                                          <td><?php echo form_input(array('style'=> 'border: none;','class' => 'row_id', 'name' => $i.'[qty]', 'value' => $items['qty'], 'data-id'=> $items['rowid'], 'maxlength' => '3', 'size' => '5')); ?></td>
                                                                                          <td>
                                                                                                  <?php echo $items['name']; ?>
                                                                                          </td>
                                                                                          <!-- <td style="text-align:right" id="td_id" > -->
                                                                                                  <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

                                                                                                          <p>
                                                                                                                  <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
                                                                                                                  <!-- <?php  $option_value; ?>% -->
                                                                                                                 <?php endforeach; ?>
                                                                                                          </p>

                                                                                                  <?php endif; ?>
                                                                                          <!-- </td> -->
                                                                                           <td style="text-align:right" >₲. <?php echo $this->cart->format_number($items['price']); ?></td>
                                                                                          <td style="text-align:right" 
                                                                                              class='inpuesto' 
                                                                                              data-id="<?php echo $option_value;?>"
                                                                                              data-subtotal="<?php echo $this->cart->format_number($items['subtotal']); ?>">₲. 
                                                                                              <?php echo $this->cart->format_number($items['subtotal']); ?>
                                                                                          </td>
                                                                                          <td style="text-align:right" width="130">
                                                                                                <div class="pull-right hidden-phone">
                                                                                                      <a class="btn btn-danger btn-xs fa fa-trash-o"  
                                                                                                              onclick="delete_rowid('<?php echo $items['rowid']?>')">
                                                                                                      </a>
                                                                                                 </div>
                                                                                          </td>
                                                                                  </tr>
                                                                          <?php $i++; ?>
                                                                          <?php endforeach; ?>
                                                                           </tr>
                                                                       </tbody>

                                                                    </table >
                                                                 <!--     <input type="hidden" name="iva_cinco" id="iva_cinco" value='' class="form-control" value="">
                                                                    <input type="hidden" name="iva_diez" id="iva_diez"    value='' class="form-control" value="">
                                                                    <input type="hidden" name="lesiva" id="lesiva"      value=''class="form-control" value="">  -->
                                                            </div>
                                                            <!-- /.col -->
                                                        </div>
                                                        <!-- /.row -->
                                                        <div class="row">
                                                            <!-- accepted payments column -->
                                                                <div class="col-xs-6">
                                                                    <!-- info row -->
                                                                    {formulario}
                                                                    <div class="row invoice-info">
                                                                        <div class="col-sm-6 invoice-col">
                                                                            Empresa
                                                                            <address>
                                                                                <strong class='nombre_e'>{Nombre}</strong>
                                                                                <br><span class='e_1'>{em_direcc}</span>
                                                                                 <br>Telefono  :  <span class='e_3'>{Telefono}</span>
                                                                                <br>Correo  :   <span class='e_4'>{Email}</span>
                                                                             </address>
                                                                        </div>
                                                                        <!-- /.col -->
                                                                        <div class="col-sm-6 invoice-col">
                                                                            Cliente
                                                                            <address>
                                                                                <strong class='nombre_c'>{Nombres}  {Apellidos}</strong>
                                                                                <br><span class='c_1'>{Direccion}</span>
                                                                                <br>Telefono : <span class='c_3'>{cl_telefono}</span>
                                                                                <br>Correo :   <span class='c_4'>{cl_correo}</span>
                                                                            </address>
                                                                        </div>
                                                                        <input type="hidden" name="idCliente" id="idCliente" value="{idCliente}">
                                                                        </div>
                                                                    {/formulario}
                                                                    <!-- /.row -->  
                                                                </div>
                                                            <!-- /.col -->
                                                            <div class="col-xs-6">
                                                                <p class="lead">Generado 
                                                                &nbsp;<?php echo date("m/d/Y");?>
                                                                &nbsp;<?php $stime=date("H").":".date("i").date("A");
                                                                echo " $stime";
                                                                ?></p>
                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <tbody>
                                                                            <tr>
                                                                                <th>Iva:</th>
                                                                                <td>₲. <span class='sub_to'>0</span></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Monto Total:</th>
                                                                                <td>₲. <?php echo $this->cart->format_number($this->cart->total()); ?></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <!-- /.col -->
                                                        </div>
                                                        <!-- /.row -->

                                                        <!-- this row will not appear when printing -->
                                                        <div class="row no-print">
                                                            <div class="col-xs-12" id='refresh'>
                                                                 <table class="" cellspacing="30" width="100%">
                                                                <thead>
                                                                <?php if ($this->cart->format_number($this->cart->total()) != '0') { ?>
                                                                     <tr id="generar">
                                                                              <td colspan="" rowspan="" headers=""><button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">cerrar</button></td>
                                                                              <td colspan="3"> </td>
                                                                              <td class="right"  style="text-align:right">
                                                                                           <button type="submit" id="Guarda"  class="btn btn-sm btn-success">
                                                                                                    <i class="fa fa-archive text" >Guarda Presupuesto</i> 
                                                                                            </button>
                                                                              </td>
                                                                      </tr>

                                                              <?php } ?>
                                                                </thead>
                                                                 <input type="hidden" name="iva_cinco" id="iva_cinco" value='' class="form-control" value="">
                                                                <input type="hidden" name="iva_diez" id="iva_diez"    value='' class="form-control" value="">
                                                                <input type="hidden" name="lesiva" id="lesiva"      value=''class="form-control" value=""> 
                                                              </table>

                                                            </div>

