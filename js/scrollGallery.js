let ultimaPaginaCaricata = 2;
let loading = false;
let EOF = false;

$(window).scroll(function () {
  // Calcola la posizione di scroll
  if (!loading) {
    var scrollTop = $(window).scrollTop();
    var documentHeight = $(document).height();
    var windowHeight = $(window).height();

    // Se la posizione di scroll è vicina al fondo della pagina
    if (scrollTop + windowHeight >= documentHeight - 100) {
      // Carica la pagina successiva
      loading = true;

      if (EOF){
        // Non ci sono più prodotti da caricare
        $("#galleria").append("<p style='text-align: center; margin-top: 20px;'>Non ci sono più prodotti da caricare</p>");
      }
      else
        caricaProdotti(ultimaPaginaCaricata++);
    }
  }


});

function caricaProdotti(pagina) {
  // Esegui una chiamata AJAX per caricare i prodotti
  $.ajax({
    url: "entity/getProducts.php",
    type: "GET",
    data: {
      pagina: pagina
    },
    success: function (data) {
      // Aggiungi i nuovi prodotti alla galleria
      if(data == "") EOF = true;
        $("#galleria").append(data); // document.getElementById("galleria").innerHTML += data;
        loading = false;
    }});
}

//Al termine del caricamento:
if ($("body").css("overflow-y") !== "scroll") {
  // La barra di scroll non è presente
  caricaProdotti(ultimaPaginaCaricata++);
}