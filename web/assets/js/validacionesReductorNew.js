$(document).ready(function () {
    const patronTexto = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
     const patronNumero = /^[0-9]+$/;
 
     function agregarError(campo, mensaje) {
         const $campo = $(campo);
         if ($campo.length > 0) {
             $campo.addClass('input-error').after(`<p class='text-danger'>${mensaje}</p>`);
         } else {
             console.error('El campo no se encontró');
         }
     }
     $('#categoria').on('change', function () {
         const tipoId = $(this).val();
         const url = $(this).data('url');
 
         if (tipoId) {
             $.ajax({
                 url: url,
                 method: 'POST',
                 data: { 'id_cate_red': tipoId },
                 success: function (response) {
                     $('#tipoRedu').html(response);
                 }
             });
         } else {
             $('#tipoRedu').html('<option value="">Seleccione un tipo de choque primero...</option>');
         }
     });
 
 
     $('#formReductorNew').submit(function (event) {
 
             event.preventDefault();
             $('.text-danger').remove();
             $('input, select').removeClass('input-error');
         
             let valido = true;
         
             const tipo_red= $('#tipoRedu').val().trim();
         
             if (tipo_red === '' || tipo_red=== null ) {
                 agregarError($('#tipoRedu'), "Por favor seleccione un tipo de reductor");
                 valido = false;
             }
         
             const desc_red=$('#desc_red').val().trim();
             if (desc_red==='' || desc_red===null) {
                 agregarError($('#desc_red'),"Por favor ingrese una descripción");
                 valido = false;
             }else if ( !patronTexto.test(desc_red) || desc_red.length > 300) {
                 agregarError($('#desc_red'), "El campo observaciones solo admite letras (máx. 300)");
                 valido = false;
             }
             
             if (valido) {
                 this.submit();
             }
         
     });
 
 });
 
 