$(document).ready(function(){
})
  var imagenes = imgsurl.split(","),
      total = imagenes.length,
      contador = 0,
      atras = document.getElementById("atras"),
      adelante = document.getElementById("adelante");
      var nombres = nomimg.split(",");
       
      atras.addEventListener("click", function(){
          contador = contador === 0 ? total - 1 : --contador;
          document.body.style.opacity = 0;
          document.body.style.background = "url(" + imagenes[contador] + ") no-repeat fixed center";
          document.body.style.backgroundSize = "cover";
          document.body.style.opacity = 1;
          $(".titulo-imagen").find('p').html(nombres[contador]);
      }, false);
       
      adelante.addEventListener("click", function(){
          contador = contador == total - 1 ? 0 : ++contador;
          document.body.style.opacity = 0;
          document.body.style.background = "url(" + imagenes[contador] + ") no-repeat fixed center";
          document.body.style.backgroundSize = "cover";
          document.body.style.opacity = 1;
          $(".titulo-imagen").find('p').html(nombres[contador]);
      }, false);
       
      document.body.style.background = "url(" + imagenes[contador] + ") no-repeat fixed center";
      document.body.style.backgroundSize = "cover";
      $(".titulo-imagen").find('p').html(nombres[contador]);

  