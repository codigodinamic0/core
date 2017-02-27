(function($){
  $(function(){
    $(".button-collapse").sideNav();
  	$('.dropdown-button').dropdown();
    $(".modal-trigger").click(function(){
      var idmo = $(this).attr("href");
      $(idmo).openModal();
    })

        $("#form-suscribir").submit(function(){
          if (!vacios("#form-suscribir")) {return false;}
          $.ajax({
            type: 'POST',
            url: dominio+"lib/task/server.php",
            data: $("#form-suscribir").serialize(),
            success: function(data){
              var respuesta = data['msg'];
              if (respuesta == '1' || respuesta == '3') {
                swal({
                  title: "proceso Exitoso",
                  text: "mensaje enviado correctamente",
                  type: "success" 
                },function(){
                  location.reload();
                });
              }else{
                swal('Error','Ocurrio un problema, intente mas tarde','error');
              }
            }
          });
          return false;
        });



    // BAnner slider
  	 $('#bannerslider').owlCarousel({
          loop:true,
          margin:0,
          dots:false,
          nav:true,
          items:1,
          navText:["<img src='images/izq.png' alt='Anterior' title='Anterior'>","<img src='images/der.png' alt='Siguiente' title='Siguiente'>"]
      })

     $("#sliderproyecto").owlCarousel({
          loop:true,
          margin:20,
          nav:true,
          dots:false,
          responsive:{
              0:{
                  items:1
              },
              600:{
                  items:3
              },
              1000:{
                  items:4
              }
          },
          navText:["<img src='images/izq.png' alt='Anterior' title='Anterior'>","<img src='images/der.png' alt='Siguiente' title='Siguiente'>"]
      })

      $("#slidercalificados").owlCarousel({
          loop:true,
          margin:20,
          nav:true,
          dots:false,
          responsive:{
              0:{
                  items:1
              },
              600:{
                  items:3
              },
              1000:{
                  items:4
              }
          },
          navText:["<img src='images/izq.png' alt='Anterior' title='Anterior'>","<img src='images/der.png' alt='Siguiente' title='Siguiente'>"]
      })

      $("#sliderpatrocina").owlCarousel({
          loop:true,
          autoplay:true,
          autoplayTimeout:2000,
          margin:20,
          nav:false,
          dots:false,
          responsive:{
              0:{
                  items:3
              },
              600:{
                  items:5
              },
              1000:{
                  items:7
              }
          },
      })

      $(".clvistas").click(function(){
        $(".clvistas").removeClass("active");
        $(this).addClass("active");
        var datr = $(this).attr("rel");
        if (datr=="cua"){
          $(".listeventos").addClass("row");
          $(".listeventos").addClass("cuaevento");
        }
        if (datr=="list"){
          $(".listeventos").removeClass("row");
          $(".listeventos").removeClass("cuaevento");
        }
      })
      $(".listquienes .cont").hover(function(){
        $(".contquienes").addClass("menma");
      }, function(){
        $(".contquienes").removeClass("menma");
      })
  }); // end of document ready
})(jQuery); // end of jQuery name space

