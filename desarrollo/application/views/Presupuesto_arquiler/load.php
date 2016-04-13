                     <table id="table" class="table table-striped" cellspacing="30" width="100%">
                                <thead>
                                  <tr>
										<th class ="text-danger">Cantidad</th>
										<th class ="text-danger">Nombre</th>
										<th style ="text-align:right" class ="text-danger">Precio</th>
										<th style ="text-align:right" class ="text-danger">Subtotal</th>
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
                                                                          <?php endforeach; ?>
                                                                  </p>

                                                          <?php endif; ?>

                                                  </td>
                                                  <td style="text-align:right;">₲. <?php echo number_format($items['price'],0,',','.'); ?></td>
                                                  <td style="text-align:right; ">₲. <?php echo number_format($items['subtotal'],0,',','.'); ?>
                                                  </td>

                                          </tr>

                                  <?php $i++; ?>

                                  <?php endforeach; ?>

<!--                                   <tr>
                                          <td width="130" colspan="6">
                                              <p id='Total' ></p>
                                          </td>

                                  </tr> -->
                     </table >
						<?php if ($this->cart->format_number($this->cart->total()) != '0') { ?>
						<?php } ?>