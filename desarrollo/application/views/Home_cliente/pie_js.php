  <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?= base_url();?>clienteStilo/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?= base_url();?>clienteStilo/js/hover-dropdown.js"></script>
    <script defer src="<?= base_url();?>clienteStilo/js/jquery.flexslider.js"></script>
    <script type="text/javascript" src="<?= base_url();?>clienteStilo/assets/bxslider/jquery.bxslider.js"></script>
    <script type="text/javascript" src="<?= base_url();?>clienteStilo/assets/revolution_slider/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
    <script type="text/javascript" src="<?= base_url();?>clienteStilo/assets/revolution_slider/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script src="<?= base_url();?>clienteStilo/js/revulation-slide.js"></script>
    <script src="<?= base_url();?>clienteStilo/js/ajax.js"></script>
=

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
