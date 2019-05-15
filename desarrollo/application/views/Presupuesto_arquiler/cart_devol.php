
<table id="principal" class="table table-striped" cellspacing="30" width="100%" >
    <thead>
      <tr>
            <th class ="text-danger">Cantidad</th>
            <th class ="text-danger">Nombre</th>
            <th style ="text-align:center" class ="text-danger">Precio Perdida</th>
            <th style ="text-align:center" class ="text-danger">Nº Perdida   <input type="checkbox" name="micheckbox" class="micheckbox" value=""></th>
            <th style ="text-align:center" class ="text-danger"> Sub-Total</th>
       </tr>
    </thead>
    <tbody>
                           <?php $i = 1; ?>

                                  <?php foreach ($this->cart->contents() as $items): ?>

                                          <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

                                          <tr >


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
                                                  <td style="text-align:center;">₲. <?php echo number_format($items['price'],0,',','.'); ?></td>
                                                  <td style="text-align:center; ">
                                                   <?php echo form_input(array(
                                                    'disabled' => 'disabled',
                                                   'name' => $i.'[qty]',
                                                   'class' => $i.'[qty]',
                                                    'type' => 'number',
                                                    'value' => '',
                                                     'id' => $items['rowid'],
                                                     'placeholder' => 'Cantidad',
                                                    'data-monto' => $items['price']
                                                   )); ?>
                                                  </td>
                                                  <td id="recorerr" style="text-align:center; " class="<?php echo $items['rowid']?>">
                                                  </td>

                                          </tr>

                                  <?php $i++; ?>

                                  <?php endforeach; ?>

<!--                                   <tr>
                                          <td width="130" colspan="6">
                                              <p id='Total' ></p>
                                          </td>

                                  </tr> -->
    </tbody>

</table >
						<?php if ($this->cart->format_number($this->cart->total()) != '0') { ?>
                             <table id="table" class="table" cellspacing="0" width="100%" >
                              <tbody>
                                  <tr class="success" role="row">
                                          <td colspan="6" >
                                            <label for="" class="col-xs-3 " style="text-align:left">

                                            </label>
                                            <label for="" class="col-xs-3 " style="text-align:center">

                                            </label>
                                            <label for="" class="col-xs-3 " style="text-align:center">

                                            </label>
                                            <label for="" class="col-xs-3 " style="text-align:right">
                                                  <strong>Monto Perdida &nbsp;</strong>₲. <span class='totalesiva'></span>
                                                  <input type="hidden" name="total" id="total" value="">
                                            </label>
                                          </td>
                                   </tr>
                                        </tbody>

                            </table >
						<?php } ?>
<script type="text/javascript" charset="utf-8" async defer>
  $(function() {
                  $('#total').val();
              $('.totalesiva').html();
    $(".micheckbox").on( 'change', function() {
        if( $(this).is(':checked') ) {
            // Hacer algo si el checkbox ha sido seleccionado
            // alert("El checkbox con valor " + $(this).val() + " ha sido seleccionado");
             $("input").prop('disabled', false);
        } else {
            // Hacer algo si el checkbox ha sido deseleccionado
            // alert("El checkbox con valor " + $(this).val() + " ha sido deseleccionado");
            $("input").prop('disabled', true);
        }
    });
  });   

    $(function() {
        $("input").keyup(function () {

        });

      $('input').focusout(function(event) {
                      var id      = $(this).attr('id');
                      var val      = $(this).val();
                      var perdida      = $(this).attr('data-monto');
                      var resultado = parseFloat(perdida) * parseFloat(val);
                      $('.'+id).html(resultado);


                var resultVal = 0.0;
                $("#principal tbody tr").each(function (index) 
                {
                    var campo1; 

                    $(this).children("#recorerr").each(function (index2) 
                    {
                        switch (index2) 
                        {
                            case 0: 
                            campo1 = $(this).text();
                                    break;
                        }
                    })
                        if (campo1 == 0 ) {
                       }else{
                         resultVal += parseFloat(campo1);
                       }

                })
                 if (resultVal == '' || resultVal == 0) {
                        $('#Recibir_cobrar').prop('disabled', true);

                      }else{
                        $('#Recibir_cobrar').prop('disabled', false);
                      }
              $('#total').val(resultVal);
              $('.totalesiva').html(resultVal);
      });

    });
</script>