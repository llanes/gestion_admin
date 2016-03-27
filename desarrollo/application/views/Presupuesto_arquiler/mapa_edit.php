{formulario1}
              <div class="col-md-12" >
              <input type='hidden'readonly style='form-control'  id='idGeo_posicion' name='idGeo_posicion'  value="{idGeo_posicion}">
                <input type='hidden'readonly style='form-control'  id='latit' name='Latitud'  value="">
                <input type='hidden' readonly style='form-control'  id='longit' name='Longitud' value="">
                <div  id="map" style="height: 300px"> </div>  
              </div>
              <script>
  
              var marker;

              function initMap() {
                 var myLatLng  = {lat: {Latitud}, lng: {Longitud}};
                var map = new google.maps.Map(document.getElementById('map'), {
                  zoom: 14,
                  center: myLatLng ,
                });

                marker = new google.maps.Marker({
                  map: map,
                  draggable: true,
                  animation: google.maps.Animation.DROP,
                  position: myLatLng
                });
                document.getElementById("lat").innerHTML = marker.position.lat().toFixed(5);
                document.getElementById("lng").innerHTML = marker.position.lng().toFixed(5);
                document.getElementById("latit").value = marker.position.lat().toFixed(5);
                document.getElementById("longit").value = marker.position.lng().toFixed(5);

                marker.addListener('click', toggleBounce);

                marker.addListener('click', function() {
                  map.setZoom(16);
                  map.setCenter(marker.getPosition());
                  document.getElementById("lat").innerHTML = marker.position.lat().toFixed(5);
                  document.getElementById("lng").innerHTML = marker.position.lng().toFixed(5);
                  document.getElementById("latit").value = marker.position.lat().toFixed(5);
                  document.getElementById("longit").value = marker.position.lng().toFixed(5);
                });
                map.addListener('center_changed', function() {
                  // 3 seconds after the center of the map has changed, pan back to the
                  window.setTimeout(function() {
                    map.panTo(marker.getPosition());
                  }, 3000);
                });
                marker.addListener("dragend", function() {
                  document.getElementById("lat").innerHTML = marker.position.lat().toFixed(5);
                  document.getElementById("lng").innerHTML = marker.position.lng().toFixed(5);
                  document.getElementById("latit").value = marker.position.lat().toFixed(5);
                  document.getElementById("longit").value = marker.position.lng().toFixed(5);
              });

              }

              function toggleBounce() {
                if (marker.getAnimation() !== null) {
                  marker.setAnimation(null);
                } else {
                  marker.setAnimation(google.maps.Animation.BOUNCE);
                }
              }
              </script>
                  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDkXp5JiVIF1oVhZzz5fIi5CXiWKE1XApA&callback=initMap" async defer></script>
              <div class="col-md-12" >
                <table   style="width:100px;margin: auto;">
                  <tr class="success" >
                    <td ><label for="" class="col-xs-2 " style="text-align:left"><b>Latitud</b></label></td><td    name="latitud"><label id="lat" class="col-xs-3 " ></label></td>
                    <td><label for="" class="col-xs-2 " style="text-align:left"><b>Longitud</b></label></td><td  name="longuitud"><label id="lng" class="col-xs-3 " ></label></td>
                  </tr>
                  
                </table>

              </div>
{/formulario1}