                                  <table id="table" class="table table-striped" cellspacing="30" width="100%">
                                                                          <thead>
                                          <tr>
                                                      <th class  ="text-danger">Cantidad</th>
                                                      <th class  ="text-danger">Nombre</th>
                                                       <th style  ="text-align:right" class ="text-danger">Precio</th>
                                                      <th style  ="text-align:right" class ="text-danger">Subtotal</th>
                                                      <th  style ="text-align:right"  class ="text-danger"style="width:125px;">Acciones</th>
                                          </tr>
                                        </thead>
                               <?php $i = 1; ?>

                                  <?php foreach ($this->cart->contents() as $items): ?>

                                          <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

                                          <tr >

                                                  <?php echo form_hidden(array('style'=> 'border: none;','class' => 'row_id', 'name' => $i.'[qty]', 'value' => $items['qty'], 'data-id'=> $items['rowid'], 'maxlength' => '3', 'size' => '5')); ?>

                                                  <td colspan="1">
                                                  <?php echo  $items['qty']; ?>
                                                  </td>
                                                   <td colspan="1">
                                                 <?php echo $items['name']; ?>

                                                          <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

                                                                  <p>
                                                                          <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

                                                                                  <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />

                                                                          <?php endforeach; ?>
                                                                  </p>

                                                          <?php endif; ?>

                                                  </td>
                                                  <td style="text-align:right;">₲. <?php echo number_format($items['price'],0,',','.'); ?></td>
                                                  <td style="text-align:right; ">₲. <?php echo number_format($items['subtotal'],0,',','.'); ?>
                                                  </td>
                                                  <td style="text-align:right">
                                                    <div class="btn-group">
                                                       <a class="btn btn-sm btn-danger" href="#" title="Hapus" onclick="delete_rowid_servi('<?php echo $items['rowid']?>')">
                                                       <i class="fa fa-trash-o"></i></a>
                                                    </div>
                                                  </td>
                                          </tr>

                                  <?php $i++; ?>

                                  <?php endforeach; ?>

                                  <tr>
                                          <td width="130" colspan="6">
                                              <!-- <strong>Total IVA 5 %&nbsp;&nbsp;</strong>₲. <span class='total_iva_cinco'></span> -->
                                                <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
                                              <!-- <strong>Total IVA 10 %&nbsp;&nbsp;</strong>₲. <span class='total_iva_diez'></span> -->
                                              <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
                                              <!-- <strong>Total IVA &nbsp;&nbsp;</strong>₲. <span class='totalesiva'></span> -->
                                              <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
                                              <strong class='text-danger'> Monto Total &nbsp;</strong>₲. <?php echo $this->cart->format_number($this->cart->total()); ?>
                                          </td>

                                  </tr>
                     </table >
              <?php if ($this->cart->format_number($this->cart->total()) != '0') { ?>
                      <div class="modal-footer">
                        <button type="submit" id="btnSave"  class="btn btn-sm btn-success">
                                 <span class="glyphicon glyphicon-floppy-disk"></span> Guardar
                        </button>&nbsp;&nbsp;&nbsp;     
                        <button type="reset"  class="btn btn-sm btn-info" onclick="reser(0);">
                                <i class="fa fa-refresh "></i> Limpiar
                        </button>
                         <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" >
                                 <span class="glyphicon glyphicon-floppy-remove"></span> Cancelar
                         </button>     
                      </div>
             <?php } ?>