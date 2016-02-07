
                            <table id="table" class="idRecorrer table" cellspacing="0" width="100%" >
                                        <thead>
                                          <tr>
                                                      <th class  ="text-danger">Cantidad</th>
                                                      <th class  ="text-danger">Nombre</th>
                                                      <th style  ="text-align:right" class ="text-danger">Inpuesto</th>
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
                                                  <td style="text-align:right" id="td_id" >
                                                          <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

                                                                  <p>
                                                                          <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

                                                                                  <?php echo $option_value; ?>%

                                                                          <?php endforeach; ?>
                                                                  </p>

                                                          <?php endif; ?>

                                                  </td>
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
                                          <td width="130" colspan="6">
                                              <strong>Total IVA 5 %&nbsp;&nbsp;</strong>₲. <span class='total_iva_cinco'></span>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                              <strong>Total IVA 10 %&nbsp;&nbsp;</strong>₲. <span class='total_iva_diez'></span>
                                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                              <strong>Total IVA &nbsp;&nbsp;</strong>₲. <span class='totalesiva'></span>
                                             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                              <strong>Monto Total &nbsp;</strong>₲. <?php echo $this->cart->format_number($this->cart->total()); ?>
                                          </td>
                                   </tr>
                                        </tbody>

                            </table >
                          <table class="" cellspacing="30" width="100%">
                            <thead>
                            <?php if ($this->cart->format_number($this->cart->total()) != '0') { ?>
                                 <tr id="generar">
                                          <td colspan="4"> </td>
                                          <td class="right"  style="text-align:right">
                                                       <button type="submit" formtarget="_blank" id="target" class="btn btn-sm btn-primary btn-fla " style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
                                                       <button type="submit" id="Presupuesto" onclick="add_presupuesto(0)" class="btn btn-sm btn-success">
                                                                <i class="fa fa-archive" ></i> Guarda Presupuesto
                                                        </button>
                                                        <button type="submit" id="Alquiler" onclick="modal_view(0)" class="btn btn-sm btn-success">
                                                                <span class="glyphicon glyphicon-floppy-disk"></span> Generar Alquiler
                                                        </button>
                                          </td>
                                  </tr>

                          <?php } ?>

                            </thead>
                             <input type="hidden" name="iva_cinco" id="iva_cinco" value='' class="form-control" value="">
                            <input type="hidden" name="iva_diez" id="iva_diez"    value='' class="form-control" value="">
                            <input type="hidden" name="lesiva" id="lesiva"      value=''class="form-control" value=""> 
                          </table>
                           <!-- cierre de carrito -->
                    </div>
              </div>
          </div>
          <!-- ///////////////////////////////////////////// -->
      </section>
      <div class="modal fade" id="modal_form_alquiler">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 style="text-align: center" class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
              <div <div class="roww"> 
               <div class="col-md-12 col-md-offset-0 table-responsive">
                <table class="table" >
                  <tbody>
                     <tr id="transparente">
                        <td >
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Tipo de Pago</label>
                                <div class="col-lg-5">
                                        <select name="credi_cont" id="credi_cont" class="form-control">
                                          <option value="1">Contado</option>
                                          <option value="2">Credito</option>
                                        </select>
                                </div>
                            </div>
                        </td>
                    </tr> 
                    <tr id="transparente">
                        <td>
                            <div class="form-group cuotas">
                                <label class="col-lg-4 control-label">Cantidad Cuotas</label>
                                <div class="col-lg-5">
                                    <select name="cuota" id="cuota" class="form-control">
                                          <option value="2">2</option>
                                          <option value="4">4</option>
                                          <option value="6">6</option>
                                          <option value="8">8</option>
                                          <option value="12">12</option>
                                    </select>
                                </div>
                            </div>
                        </td>
                      </tr>
                  </tbody>
                </table>
              </div>
              </div>
            </div>
         <div class="modal-footer">

            <button type="submit" id="btnSave" onclick="add_alquiler()" class="btn btn-sm btn-success">
                     <span class="glyphicon glyphicon-floppy-disk"></span> Alquilar
            </button>&nbsp;&nbsp;&nbsp;
             <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" >
                     <span class="glyphicon glyphicon-floppy-remove"></span> Cancelar
             </button>
          </div>
          </div>
        </div>
      </div>
</div>
      </form>

<script type="text/javascript" charset="utf-8" async defer>
  $(function() {
        var inpuesto_cinco = 0;
        var iva = 0;
        var inpuesto_diez = 0;
        var total_cinco = 0;
        var total_diez = 0;
        var total_iva = 0;
        var num1 = 0;
         var num2 =0;
        // alert(iva);
        $('.idRecorrer td.inpuesto').each(function(){ //filas con clase 'contenido_caja', especifica una clase, asi no tomas el nombre de las columnas
         iva = $(this).attr('data-id');
         if (iva == '') {

         } else {
                if (iva == 5) {
                 inpuesto_cinco += parseFloat($(this).attr('data-subtotal').replace(',', ','));
                 num1 = inpuesto_cinco/21;
                 total_cinco = num1.toFixed(3);
                 $(".total_iva_cinco").html(total_cinco);
                 $("#iva_cinco").val(total_cinco);
               }
               if (iva == 10) {
                 inpuesto_diez += parseFloat($(this).attr('data-subtotal').replace(',', ','));
                 // alert(inpuesto_diez);
                 num2 = inpuesto_diez/11;
                 total_diez = num2.toFixed(3);
                 $(".total_iva_diez").html(total_diez);
                 $("#iva_diez").val(total_diez);
               }
                var num3 = num1 + num2;
                total_iva = num3.toFixed(3);
                $(".totalesiva").html(total_iva);
                $("#lesiva").val(total_iva);

         }
        });
});
    $(function() {
            $("#credi_cont").change(function(){
              var id      = $( "select[name=credi_cont]").val();
            if (id == 1) {
               $('.cuotas').hide();
                // $('.Vencimiento').hide();
            } if (id == 2) {
                $('.cuotas').show();
                // $('.Vencimiento').show();
            }
                          });
    });

</script>