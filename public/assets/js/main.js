if(document.querySelector("#table")) {
    let table = new DataTable("#table")
}


function previewImagem() {
    var imagem = document.querySelector('input[name=imagem').files[0];
    var preview = document.querySelector('#preview-user');

    var reader = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
    }

    if (imagem) {
        reader.readAsDataURL(imagem);
    } else {
        preview.src = "";
    }
}


$(function() {
    $('#meuDiv').hide();
    $('#meuDiv2').hide();

    $('#service_id').change(function() {
        if ($(this).val() >= 5) {
            $('#meuDiv').show();
            $('#meuDiv2').show();
        }
    });
});

$(function () { 
    $('input[name=cpf]').mask('999.999.999-99');
    $('input[id=searchCpf]').mask('999.999.999-99');
    $('input[name=zip_code]').mask('99999-999');
    $('input[name=phone]').mask('(99)9-9999-9999');

    $('.img-pro').fancybox();
 });



(function () {
    'use strict'
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
      new bootstrap.Tooltip(tooltipTriggerEl)
    })
  })()

  


