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
  $(document).on('click', '.dropdown-item', function () {

    var id = $(this).data('bs-id'); 

    $('#pqrsId').val(id);
  });

  $(document).on('change', "#cambiarDir", function () {

    var direccion = $("#direccionDiv");

    if ($(this).is(":checked")) {
      direccion.removeClass("d-none");
    } else {
      direccion.addClass("d-none");
    }
  });

  $(document).on('change', "#cambiarCont", function () {

    var contra = $("#divContra");

    if ($(this).is(":checked")) {
      contra.removeClass("d-none");
    } else {
      contra.addClass("d-none");
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


    if (!validarCampo($('#nombre1'), patronTexto, 'el primer nombre', 'El primer nombre solo debe contener letras y espacios.')) {
      valido = false;
    }
    if ($('#nombre2').val().trim() !== '' && !validarCampo($('#nombre2'), patronTexto, 'el segundo nombre (opcional)', 'El segundo nombre solo debe contener letras y espacios.')) {
      valido = false;
    }
    if (!validarCampo($('#apellido1'), patronTexto, 'el primer apellido', 'El primer apellido solo debe contener letras y espacios.')) {
      valido = false;
    }
    if ($('#apellido2').val().trim() !== '' && !validarCampo($('#apellido2'), patronTexto, 'el segundo apellido (opcional)', 'El segundo apellido solo debe contener letras y espacios.')) {
      valido = false;
    }

    const tipoDoc = $('#doc').val().trim();
    if (tipoDoc === '') {
      agregarError($('#doc'), 'Por favor, seleccione un tipo de documento.');
      valido = false;
    }

    if (!validarCampo($('#documento'), patronNumero, 'el número de documento', 'El número de documento solo debe contener dígitos mín(8) y máx(10).')) {
      valido = false;
    }
    const documento = $('#documento').val().trim();

    if (documento !== '' && documento.length < 8) {
      agregarError($('#documento'), 'El campo documento debe contener mín(8) y máx(10) dígitos');
    }

    if (documento !== '' && documento.length > 10) {
      agregarError($('#documento'), 'El campo documento debe contener mín(8) y máx(10) dígitos');
    }


    const telefono = $('#telefono').val().trim();
    if (telefono !== '' && telefono.length != 10) {
      agregarError($('#telefono'), 'El campo telefono debe contener (10) digitos');
    }





    const sexo = $('#sexo').val().trim();
    if (sexo === '') {
      agregarError($('#sexo'), 'Por favor, seleccione su sexo biológico.');
      valido = false;
    }


    if (!validarCampo($('#telefono'), patronNumero, 'el número de teléfono', 'El número de teléfono solo debe contener dígitos.')) {
      valido = false;
    }


    const tipoVia = $('#tipoVia').val().trim();
    if (tipoVia === '') {
      agregarError($('#tipoVia'), 'Por favor, seleccione un tipo de vía.');
      valido = false;
    }


    if (!validarCampo($('#numeroPrincipal'), patronNumero, 'el número principal', 'El número principal solo debe contener dígitos.')) {
      valido = false;
    }
    if (!validarCampo($('#numeroSecundario'), patronNumero, 'el número secundario', 'El número secundario solo debe contener dígitos.')) {
      valido = false;
    }
    if (!validarCampo($('#numeroTerciario'), patronNumero, 'el número terciario', 'El número terciario solo debe contener dígitos.')) {
      valido = false;
    }


    const complemento1 = $('#complemento1').val().trim();
    if (complemento1 !== '' && !patronTexto.test(complemento1)) {
      agregarError($('#complemento'), 'El complemento solo debe contener letras y espacios.');
      valido = false;
    }

    const complemento2 = $('#complemento2').val().trim();
    if (complemento2 !== '' && !patronTexto.test(complemento2)) {
      agregarError($('#complemento2'), 'El complemento solo debe contener letras y espacios.');
      valido = false;
    }


    if (!validarCampo($('#correo'), patronCorreo, 'el correo electrónico', 'El correo electrónico debe seguir el formato "usuario@dominio.com".')) {
      valido = false;
    }


    if (!validarCampo($('#clave'), patronClave, 'la contraseña', 'La contraseña debe tener al menos 8 caracteres, incluir una mayúscula, una minúscula, un número y un carácter especial.')) {
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

  $(document).on('keyup', ".validar-nombre", function () {
    const $campo = $(this);
    const valor = $campo.val().trim();
    const patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;

    $campo.next('.text-danger').remove();
    $campo.removeClass('input-error');

    if (valor !== '' && !patron.test(valor)) {
      $campo.after("<p class='text-danger'>Este campo solo admite letras</p>");
      $campo.addClass('input-error');
      valido = false;
    } else {
      valido = true;
    }
  });

  $(document).on('keyup', ".validar-num", function () {
    const $campo = $(this);
    const valor = $campo.val().trim();
    const patronNum = /^[0-9]+$/;

    $campo.next('.text-danger').remove();
    $campo.removeClass('input-error');

    if (valor !== '' && !patronNum.test(valor)) {
      $campo.after("<p class='text-danger'>Este campo solo admite numeros</p>");
      $campo.addClass('input-error');
      valido = false;
    } else {
      valido = true;
    }
  });

  $(document).on('keyup', "#correo", function () {
    const $campo = $(this);
    const valor = $campo.val().trim();
    const patronCorreo = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    $campo.next('.text-danger').remove();
    $campo.removeClass('input-error');

    if (valor !== '' && !patronCorreo.test(valor)) {
      $campo.after("<p class='text-danger fw-bold'>El campo correo debe contener la estructura usuario@dominio.com</p>");
      $campo.addClass('input-error');
      valido = false;
    } else {
      valido = true;
    }

  });


  $(document).on('keyup', ".claves", function () {
    const $campo = $(this);
    const patronClave = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&])[A-Za-z\d@$!%?&]{8,}$/;

    $campo.next('.text-danger').remove();
    $campo.removeClass('input-error');


    const clave = $('#clave').val().trim();
    if ($campo.is('#clave') && clave !== '' && !patronClave.test(clave)) {
      $campo.after("<p class='text-danger'>La contraseña debe contener al menos un carácter especial, una mayúscula y una minúscula, y ser de al menos 8 caracteres</p>");
      $campo.addClass('input-error');
      return;
    }

    const clavenew = $('#clavenew').val().trim();
    // if ($campo.is('#clavenew') && clavenew !== '' && !patronClave.test(clavenew)) {
    //     $campo.after("<p class='text-danger'>La contraseña debe contener al menos un carácter especial, una mayúscula y una minúscula, y ser de al menos 8 caracteres</p>");
    //     return;
    // }
    if (clave !== '' && clavenew !== '' && clave != clavenew) {
      $('#clavenew').next('.text-danger').remove();
      $('#clavenew').after("<p class='text-danger'>Las contraseñas no coinciden</p>");
      $campo.addClass('input-error');
    }
  });
  $(document).on('keyup', "#documento", function () {
    const $campo = $(this);
    const valor = $campo.val().trim();
    $campo.next('.text-danger').remove();
    $campo.removeClass('input-error');
    if (valor !== '' && valor.length < 8) {
      $campo.after("<p class='text-danger'>Este campo debe contener solo números (mín.8)</p>");
      $campo.addClass('input-error');
      valido = false;
    } else if (valor !== '' && valor.length > 10) {
      $campo.after("<p class='text-danger'>Este campo debe contener solo números (máx.10)</p>");
      $campo.addClass('input-error');
      valido = false;
    }
  });

  $(document).on('keyup', "#telefono", function () {
    const $campo = $(this);
    const valor = $campo.val().trim();
    $campo.next('.text-danger').remove();
    $campo.removeClass('input-error');
    if (valor !== '' && valor.length != 10) {
      $campo.after("<p class='text-danger'>Este campo debe contener solo números (10)</p>");
      $campo.addClass('input-error');
      valido = false;
    } else {
      valido = true;
    }
  });







});

