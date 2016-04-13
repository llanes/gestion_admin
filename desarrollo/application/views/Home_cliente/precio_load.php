<section class="panel">
               <?php echo $pagination;?>
</section>
                      <?php if (count($lista_precio) != 0) { ?>
                                     <div class="row product-list">
                                        <?php foreach ($lista_precio as $key) {?>
                                          <div class="col-md-4">
                                              <section class="panel">
                                                  <div class="pro-img-box">
                                                      <!-- <img src="" alt=""> -->
<!--                                                       <a href="#" class="adtocart">
                                                          <i class="fa fa-shopping-cart"></i>
                                                      </a> -->
                                                  </div>

                                                  <div class="panel-body text-center">
                                                      <h4>
                                                          <a href="#" class="pro-title">
                                         <?php echo $key->Nombre ?>
                                                          </a>
                                                      </h4>
                                                      <p class="price"> ₲.&nbsp; <?php echo $key->Precio_Unitario ?></p>
                                                  </div>
                                              </section>
                                          </div>
                                        <?php } ?>
                                      </div>
                      <?php } else {?>
<div class="alert alert-success">
  <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
  <h4><strong>No se han encontrado resultados para tu búsqueda!</strong></h4>
</div>
                      <?php } ?>

       
