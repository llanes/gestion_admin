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
         // alert(iva);
         if (iva == '') {

         } else {
                if (iva == 5) {
                 inpuesto_cinco += parseFloat($(this).attr('data-subtotal').replace(',', ','));
                 num1 = inpuesto_cinco/21;
                 total_cinco = num1.toFixed(3);
                 $("#iva_cinco").val(total_cinco);
               }
               if (iva == 10) {
                 inpuesto_diez += parseFloat($(this).attr('data-subtotal').replace(',', ','));
                 // alert(inpuesto_diez);
                 num2 = inpuesto_diez/11;
                 total_diez = num2.toFixed(3);
                 $("#iva_diez").val(total_diez);
               }
                var num3 = num1 + num2;
                total_iva = num3.toFixed(3);
                $("#lesiva").val(total_iva);
                $(".sub_to").html(total_iva);

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
     
