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

  function validarCampo(campo, patron, mensaje) {
    if (campo.val().trim() === '') {
      agregarError(campo, `Por favor, ingrese ${mensaje}`);
      return false;
    }
    if (campo.val().trim() !== '' && !patron.test(campo.val().trim())) {
      agregarError(campo, `El campo ${mensaje} solo admite letras`);
      return false;
    }
    return true;
  }

  $('#formRegistrolog').submit(function (event) {
    event.preventDefault();

    $('.text-danger').remove();
    $('input, select').removeClass('input-error');

    let valido = true;

    if (!validarCampo($('#nombre1'), patronTexto, 'el primer nombre')) {
      valido = false;
    }
    if ($('#nombre2').val().trim() !== '' && !validarCampo($('#nombre2'), patronTexto, 'el segundo nombre (opcional)')) {
      valido = false;
    }
    if (!validarCampo($('#apellido1'), patronTexto, 'el primer apellido')) {
      valido = false;
    }
    if ($('#apellido2').val().trim() !== '' && !validarCampo($('#apellido2'), patronTexto, 'el segundo apellido (opcional)')) {
      valido = false;
    }

    // Validación del tipo de documento
    const documento = $('#doc').val().trim();
    if (documento === '') {
      agregarError($('#doc'), 'Por favor, seleccione un tipo de documento');
      valido = false;
    }

    if (!validarCampo($('#documento'), patronNumero, 'un número de documento válido')) {
      valido = false;
    }

    // Validación del sexo
    const sexo = $('#sexo').val().trim();
    if (sexo === '') {
      agregarError($('#sexo'), 'Por favor, seleccione su sexo biológico');
      valido = false;
    }

    // Validación del teléfono
    if (!validarCampo($('#telefono'), patronNumero, 'un número de teléfono válido')) {
      valido = false;
    }

    // Validación del tipo de vía
    const tipoVia = $('#tipoVia').val().trim();
    if (tipoVia === '') {
      agregarError($('#tipoVia'), 'Por favor, seleccione un tipo de vía');
      valido = false;
    }

    // Validación de números principales, secundarios y terciarios
    if (!validarCampo($('#numeroPrincipal'), patronNumero, 'el número principal')) {
      valido = false;
    }
    if (!validarCampo($('#numeroSecundario'), patronNumero, 'el número secundario')) {
      valido = false;
    }
    if (!validarCampo($('#numeroTerciario'), patronNumero, 'el número terciario')) {
      valido = false;
    }

    const complemento = $('#complemento1').val().trim();
    if (complemento !== '' && !patronTexto.test(complemento)) {
      agregarError($('#complemento1'), 'El campo complemento solo admite letras');
      valido = false;
    }
    const complemento2 = $('#complemento2').val().trim();
    if (complemento2 !== '' && !patronTexto.test(complemento2)) {
      agregarError($('#complemento2'), 'El campo complemento solo admite letras');
      valido = false;
    }

    // Validación del correo
    if (!validarCampo($('#correo'), patronCorreo, 'un correo válido')) {
      valido = false;
  }
  
  if (!validarCampo($('#clave'), patronClave, 'una contraseña válida')) {
      valido = false;
  }
    const clavenew = $('#clavenew').val().trim();
  if (clavenew === '' || clavenew !== $('#clave').val().trim()) {
      console.log('Las contraseñas no coinciden');
      agregarError($('#clavenew'), 'Las contraseñas no coinciden');
      valido = false;
  }

    // Si todas las validaciones son correctas, se envía el formulario
    if (valido) {
      this.submit();
    }
  });




});

