<!-- <a class="btn btn-lg btn-success" href="#">
   <i class="fa fa-arrow-left ">Atras</i>
</a> -->
<style type="text/css" media="screen">
.User,.Pass{display: none;}
</style>
   <div class="container">
      <form class="form-signin" id="for_login" action="<?= site_url('index.php/Login/logeo')?> ">
        <h2 class="form-signin-heading">Inicio de Sesion</h2>
        <div class="login-wrap">
              <input type="text" required  class="form-control" placeholder="Usuario"  id="usuario" name="usuario" onfocus="autofocus" autocomplete="off" pattern="[A-Za-z ]{3,100}"  >
                <span class="User text-danger">
                <!-- error usuario -->
                </span>
              <input type="password" required  class="form-control" placeholder="Contraseña " id="password" name="password"   onfocus="autofocus" autocomplete="off" pattern="(?=.*[a-z]).{6,}"   >
                <span class="Pass text-danger">
                    <!-- error password -->
                </span>
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Recordarme
                <span class="pull-right">
                    <a data-toggle="modal" rel="tooltip" title="Recuperar" href="#myModal"> ¿Se te olvidó tu contraseña?</a>

                </span>
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit">Iniciar </button>
            <p>Inicioar con redes Sociales</p>
            <div class="login-social-link">
                <a href="index.html" class="facebook">
                    <i class="fa fa-facebook"></i>
                    Facebook
                </a>
                <a href="index.html" class="twitter">
                    <i class="fa fa-twitter"></i>
                    Twitter
                </a>
            </div>
            <div class="registration">
                ¿No tienes una cuenta?  
                <a class="" href="<?= base_url();?>index.php/Login/registro">
                    Crea una cuenta
                </a>
            </div>

        </div>
     </form>
          <!-- Modal -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Se te olvidó tu contraseña ?</h4>
                      </div>
                      <div class="modal-body">
                          <p>Introduzca su dirección de correo para restablecer la contraseña.</p>
                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                          <button class="btn btn-success" type="button">Enviar</button>
                      </div>
                  </div>
              </div>
          </div>
          <!-- modal -->

    </div>
    <script src="<?= base_url();?>clienteStilo/js/jquery.js"></script>
    <script src="<?= base_url();?>clienteStilo/js/bootstrap.min.js"></script>
    <script src="<?= base_url();?>clienteStilo/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("<?= base_url();?>clienteStilo/img/login.jpg", {speed: 0});
    </script>
    <script type="text/javascript" charset="utf-8" async defer>
    $(function () {
        //////////////////////cobrar = add cobra un credito//////////////////////////
         $('#for_login').submit(function(e){
         $.ajax({
              type : 'POST',
              url : $(this).attr("action"), // octengo la url del formulario
              data: $(this).serialize(), // serilizo el formulario
              success : function(data) {
                 var json = JSON.parse(data);// parseo la dada devuelta por json
                  $(".User,.Pass").html("").css({"display":"none"});
                  if (json.res == "error") {
                    if (json.usuario) {
                       $(".User").append(json.usuario).css({"display":"block"}); // mostrar validation de iten usuario
                    }
                    if (json.password) {
                       $(".Pass").append(json.password).css({"display":"block"}); /// mostar validation  de iten pass
                    }
                  }else{ // si pasa la validation redireccionar al ligin del control de acceso
                      var url = "<?= site_url('index.php/Login')?>";
                      // $(location).attr('href',url);
                      // setTimeout($(location).attr('href',url), 10000); 
                      $("#for_login").hide();
                     setTimeout('document.location.reload()',500);
                   }
             },
              // código a ejecutar si la petición falla;
              error : function(xhr, status) {
                  alert('Disculpe, existió un problema');
                  console.log('error(jqXHR, textStatus, errorThrown)');
              },
          });
         e.preventDefault();
        });
        /////////////////////////////////////////////////////////
        });
    </script>