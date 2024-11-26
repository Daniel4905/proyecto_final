$(document).ready(function () {

  $(document).on("click", ".toggle-btn", function () {

    $("#sidebar").toggleClass("expand");

    if ($("#sidebar").hasClass("expand")) {
      $("#sol").removeClass("d-none");
      $("#rep").removeClass("d-none");
      $("#usu").removeClass("d-none");
      $("#logonav").addClass("d-none");
      $("#sidebar").addClass("sideScroll");
    } else {
      $("#sol").addClass("d-none");
      $("#rep").addClass("d-none");
      $("#usu").addClass("d-none");
      $("#logonav").removeClass("d-none");
      $("#sidebar").removeClass("sideScroll");

    }
  });

  $(document).on('change', "#cambiarDir", function () {

    var direccion = $("#direccionDiv");

    if ($(this).is(":checked")) {
      direccion.removeClass("d-none");
    } else {
      direccion.addClass("d-none");
    }
  });

  const patronTexto = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
  const patronNumero = /^[0-9]+$/;
  const patronCorreo = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  const patronClave = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&])[A-Za-z\d@$!%?&]{8,}$/;

  function agregarError(campo, mensaje) {
    campo.addClass('input-error').after(`<p class='text-danger'>${mensaje}</p>`);
  }

  function validarCampo(campo, patron, campoNombre, mensajeError) {
    const valor = campo.val().trim();
    if (valor === '') {
      agregarError(campo, `Por favor, ingrese ${campoNombre}.`);
      return false;
    }
    if (!patron.test(valor)) {
      agregarError(campo, mensajeError);
      return false;
    }
    return true;
  }

  $('#formRegistrolog').submit(function (event) {
    event.preventDefault();

    $('.text-danger').remove();
    $('input, select').removeClass('input-error');

    let valido = true;


    if (!validarCampo($('#nombre1'), patronTexto, 'el primer nombre', 'El primer nombre solo debe contener letras y espacios.')){
      valido = false;
    } 
    if ($('#nombre2').val().trim() !== '' && !validarCampo($('#nombre2'), patronTexto, 'el segundo nombre (opcional)', 'El segundo nombre solo debe contener letras y espacios.')){
      valido = false;
    } 
    if (!validarCampo($('#apellido1'), patronTexto, 'el primer apellido', 'El primer apellido solo debe contener letras y espacios.')){
      valido = false;
    } 
    if ($('#apellido2').val().trim() !== '' && !validarCampo($('#apellido2'), patronTexto, 'el segundo apellido (opcional)', 'El segundo apellido solo debe contener letras y espacios.')){
      valido = false;
    } 

    const tipoDoc = $('#doc').val().trim();
    if (tipoDoc === '') {
      agregarError($('#doc'), 'Por favor, seleccione un tipo de documento.');
      valido = false;
    }

    if (!validarCampo($('#documento'), patronNumero, 'el número de documento', 'El número de documento solo debe contener dígitos.')) valido = false;

   
    const sexo = $('#sexo').val().trim();
    if (sexo === '') {
      agregarError($('#sexo'), 'Por favor, seleccione su sexo biológico.');
      valido = false;
    }

    
    if (!validarCampo($('#telefono'), patronNumero, 'el número de teléfono', 'El número de teléfono solo debe contener dígitos.')) valido = false;


    const tipoVia = $('#tipoVia').val().trim();
    if (tipoVia === '') {
      agregarError($('#tipoVia'), 'Por favor, seleccione un tipo de vía.');
      valido = false;
    }


    if (!validarCampo($('#numeroPrincipal'), patronNumero, 'el número principal', 'El número principal solo debe contener dígitos.')){
      valido = false;
    } 
    if (!validarCampo($('#numeroSecundario'), patronNumero, 'el número secundario', 'El número secundario solo debe contener dígitos.')){
      valido = false;
    } 
    if (!validarCampo($('#numeroTerciario'), patronNumero, 'el número terciario', 'El número terciario solo debe contener dígitos.')) {
      valido = false;
    }

 
    const complemento1 = $('#complemento1').val().trim();
    if (complemento1 !== '' && !patronTexto.test(complemento1)) {
      agregarError($('#complemento1'), 'El complemento solo debe contener letras y espacios.');
      valido = false;
    }

    const complemento2 = $('#complemento2').val().trim();
    if (complemento2 !== '' && !patronTexto.test(complemento2)) {
      agregarError($('#complemento2'), 'El complemento solo debe contener letras y espacios.');
      valido = false;
    }


    if (!validarCampo($('#correo'), patronCorreo, 'el correo electrónico', 'El correo electrónico debe seguir el formato "usuario@dominio.com".')){
      valido = false;
    } 


    if (!validarCampo($('#clave'), patronClave, 'la contraseña', 'La contraseña debe tener al menos 8 caracteres, incluir una mayúscula, una minúscula, un número y un carácter especial.')){
      valido = false;
    }

    const clavenew = $('#clavenew').val().trim();
    if (clavenew === '' || clavenew !== $('#clave').val().trim()) {
      agregarError($('#clavenew'), 'La confirmación de la contraseña no coincide con la contraseña ingresada.');
      valido = false;
    }

  
    if (valido) {
      this.submit();
    }
  });






});

