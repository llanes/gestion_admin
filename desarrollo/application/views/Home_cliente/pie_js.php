  <!-- js placed at the end of the document so the pages load faster -->

   <script src="<?= base_url();?>admin_stilo/alert/sweetalert.min.js" type="text/javascript"></script>
       <!-- datetimepicker-->
        <script src="<?php echo base_url();?>admin_stilo/pikear/js/moment.js"></script>
        <script src="<?php echo base_url();?>admin_stilo/pikear/es.js"></script>
        <script src="<?php echo base_url();?>admin_stilo/pikear/js/bootstrap-datetimepicker.js"></script>
        <!-- autocomplete -->
        <script src="<?php echo base_url();?>clienteStilo/js/jquery.autocomplete.js"></script>
        <script type="text/javascript" src="<?= base_url();?>clienteStilo/js/bootstrap.min.js"></script>
        
        <script src="<?php echo base_url('admin_stilo/datatables/js/jquery.dataTables.min.js')?>"></script>
        <script src="<?php echo base_url('admin_stilo/datatables/js/dataTables.bootstrap.js')?>"></script>

        <script src="<?php echo base_url('bower_components/underscore/underscore-min.js')?>"></script>
        <script src="<?php echo base_url('bower_components/bootstrap-calendar/js/calendar.js')?>"></script>

        <script type="text/javascript" src="<?= base_url();?>clienteStilo/js/hover-dropdown.js"></script>
        <script defer src="<?= base_url();?>clienteStilo/js/jquery.flexslider.js"></script>
        <script type="text/javascript" src="<?= base_url();?>clienteStilo/assets/bxslider/jquery.bxslider.js"></script>
        <script type="text/javascript" src="<?= base_url();?>clienteStilo/assets/revolution_slider/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
        <script type="text/javascript" src="<?= base_url();?>clienteStilo/assets/revolution_slider/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
        <script src="<?= base_url();?>clienteStilo/js/revulation-slide.js"></script>



  <script>

      RevSlide.initRevolutionSlider();

      $(window).load(function() {
          $('.flexslider').flexslider({
              animation: "slide",
              start: function(slider) {
                  $('body').removeClass('loading');
              }
          });
      });


  </script>

  </body>
</html>
