<?php
$db->select("vsede", "id_matrix,id_categoria", "ORDER BY id_matrix AND idioma={$idioma} DESC LIMIT 1");
$sedeCategoria = 0;
if ($db->num_rows() > 0) {
    $categoria = $db->fetch_object();
    $sedeCategoria = $categoria->id_categoria;
    $sedeid = $categoria->id_matrix;
}

if(isset($_GET['categoria'])&&$_GET['categoria']!=""&& is_numeric($_GET['categoria'])){
    $sedeCategoria=$_GET['categoria'];
    $sedeid=$_GET['id'];
}
?>
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript">
    var markers = [];
    $(document).ready(function () {

        $.get("<?php echo $dominio ?>task/server.php",
                {action: "locations", lang: "<?php echo $idioma ?>", id_categoria:<?php echo $sedeCategoria ?>,id:<?php echo $sedeid?>},
        function (res)
        {

            if (res.status == "ok") {
                clearMarkers();
                renderMap("map", res.data);
            }
        });

    });
    function renderMap(mapid, resposedata) {

        var collection = resposedata;
        var myCenter = new google.maps.LatLng(collection[0].codigo_matrix, collection[0].referencia_matrix);
        clearMarkers();
        initialize();
        
        function initialize()
        {
            var mapProp = {
                center: myCenter,
                zoom: 14,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            var map = new google.maps.Map(document.getElementById(mapid), mapProp);
            var infoWindow = new google.maps.InfoWindow();
           
            for (i = 0; i < collection.length; i++) {
                var data = collection[i];
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(data.codigo_matrix, data.referencia_matrix),
                    icon: '<?php echo $dominio ?>img/iconomondongos.png',
                    title: data.nombre_matrix
                });
//                (function (marker, data) {
//                    google.maps.event.addListener(marker, "click", function (e) {
//                        var innerHtml = "<p>" + data.nombre_matrix + "</p>\n\
//                                    <p>" + data.contenido_matrix + "</p>\n\
//                                    <img src='<?php echo $dominio ?>imagenes/sede/imagen1/" + data.img_matrix + "'/>"
//                        infoWindow.setContent(innerHtml);
//                        infoWindow.open(map, marker);
//                    });
//                     
//                })(marker, data);
                var innerHtml = "<p>" + data.nombre_matrix + "</p>\n\
                                <p>" + data.contenido_matrix + "</p>\n\
                                <img src='<?php echo $dominio ?>imagenes/sede/imagen1/" + data.img_matrix + "'/>"
                var infowindow = new google.maps.InfoWindow({
                    content: innerHtml,
                    maxWidth: 200
                  });
                  infowindow.open(map, marker);
               
                marker.setMap(map);
                markers.push(marker);
               
               
            }
          //infoWindow.open(map, marker);
        }
       
        google.maps.event.addDomListener(window, 'load', initialize);
    }/*end render map*/

    function clearMarkers() {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
        }
    }
</script>
<div id="map" style="height: 600px"></div>