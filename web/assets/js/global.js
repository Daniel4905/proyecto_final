
$(document).ready(function () {

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

    $('#formRegistro').submit(function (event) {
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


        if (!validarCampo($('#numeroPrincipal'), patronNumero, 'el número principal', 'El número principal solo debe contener dígitos.')) {
            valido = false;
        }
        if (!validarCampo($('#numeroSecundario'), patronNumero, 'el número secundario', 'El número secundario solo debe contener dígitos.')) {
            valido = false;
        }
        if (!validarCampo($('#numeroTerciario'), patronNumero, 'el número terciario', 'El número terciario solo debe contener dígitos.')) {
            valido = false;
        }


        const complemento1 = $('#complemento').val().trim();
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
        const rol = $('#rol').val().trim();
        if (rol == '') {
            agregarError($('#rol'), 'Debe seleccionar al menos un rol.');
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

    $('#formUpdate').submit(function (event) {
        // Pausa el envío
        event.preventDefault();

        $('.text-danger').remove();


        // Verifica si hay errores
        let valido = true;

        // Validar campo nombre
        const nombre = $('#nombre1').val().trim();
        if (nombre == '') {
            $('#nombre1').after("<p class='text-danger'>Por favor, ingrese el primer nombre</p>");
            valido = false;
        }
        const nombre2 = $('#nombre2').val().trim();


        const apellido = $('#apellido1').val().trim();
        if (apellido == '') {
            $('#apellido1').after("<p class='text-danger'>Por favor, ingrese el primer apellido</p>");
            valido = false;
        }
        const apellido2 = $('#apellido2').val().trim();
        let patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
        if (nombre !== '' && !patron.test(nombre)) {
            $('#nombre1').after("<p class='text-danger'>El campo primer nombre solo admite letras</p>");
            valido = false;
        }
        if (nombre2 !== '' && !patron.test(nombre2)) {
            $('#nombre2').after("<p class='text-danger'>El campo segundo nombre solo admite letras</p>");
            valido = false;
        }
        if (apellido !== '' && !patron.test(apellido)) {
            $('#apellido1').after("<p class='text-danger'>El campo primer apellido solo admite letras</p>");
            valido = false;
        }
        if (apellido2 !== '' && !patron.test(apellido2)) {
            $('#apellido2').after("<p class='text-danger'>El campo segundo apellido solo admite letras</p>");
            valido = false;
        }


        const documento = $('#doc').val().trim();
        if (documento == '') {
            $('#doc').after("<p class='text-danger'>Por favor, seleccione un tipo de documento</p>");
            valido = false;
        }

        const numDoc = $('#documento').val().trim();
        if (numDoc == '') {
            $('#documento').after("<p class='text-danger'>Por favor, ingrese su numero de documento</p>");
            valido = false;
        }
        let patronNum = /^[0-9]+$/;
        if (numDoc !== '' && !patronNum.test(numDoc)) {
            $('#documento').after("<p class='text-danger'>El campo documento solo admite numeros</p>");
            valido = false;
        }

        const telefono = $('#telefono').val().trim();
        if (telefono == '') {
            $('#telefono').after("<p class='text-danger'>Por favor, ingrese su numero de telefono</p>");
            valido = false;
        }
        if (telefono !== '' && !patronNum.test(telefono)) {
            $('#documento').after("<p class='text-danger'>El campo telefono solo admite numeros</p>");
            valido = false;
        }
        let patronCorreo = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        const correo = $('#correo').val().trim();
        if (correo == '') {
            $('#correo').after("<p class='text-danger'>Por favor, ingrese su correo</p>");
            valido = false;
        }

        if (correo !== '' && !patronCorreo.test(correo)) {
            $('#correo').after("<p class='text-danger'>El campo correo debe contener la estructura usuario@dominio.com</p>");
            valido = false;
        }

        const rol = $('#rol').val().trim();
        if (rol == '') {
            $('#rol').after("<p class='text-danger'>Por favor, seleccione un rol</p>");
            valido = false;
        }
        let patronClave = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&])[A-Za-z\d@$!%?&]{8,}$/;
        const clave = $('#clave').val().trim();

        if (clave !== '' && !patronClave.test(clave)) {
            $('#clave').after("<p class='text-danger'>La contraseña debe contener al menos un caractér especial, una mayuscula y una minuscula</p>");
            valido = false;
        }

        const clavenew = $('#clavenew').val().trim();

        if (clavenew !== '' && !patronClave.test(clavenew)) {
            $('#clavenew').after("<p class='text-danger'>La contraseña debe contener al menos un caractér especial, una mayuscula y una minuscula</p>");
            valido = false;
        }



        // Si no hay errores, enviar el formulario
        if (valido) {
            $('#error').fadeOut(500);
            this.submit();
        } else {
            $('#error').fadeIn();
            $('#error').html(mensajes.map(msg => `${msg}<br>`).join(''));
            $('#error').removeClass('d-none');
        }
    });

    $(document).on('keyup', "#buscar", function () {

        let buscar = $(this).val();
        let url = $(this).attr('data-url');

        $.ajax({
            url: url,
            type: 'POST',
            data: { 'buscar': buscar },
            success: function (data) {
                $('tbody').html(data);
                if (data.trim() === '') {
                    $('#datError').removeClass('d-none');
                } else {
                    $('#datError').addClass('d-none');

                }
            }

        });

    });
    $(document).on('change', "#tipo-solicitud", function () { 
        let tipoSolicitud = $(this).val();
        let url = $(this).attr('data-url');
    
        if (tipoSolicitud) {
            $.ajax({
                url: url,
                type: 'POST',
                data: { tipoSolicitud: tipoSolicitud },
                success: function (data) {
                    $('#form-dinamico').html(data);
                },
                error: function () {
                    $('#form-dinamico').html('<div class="alert alert-danger">Error al cargar el formulario.</div>');
                }
            });
        } else {
            $('#form-dinamico').empty(); 
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

    $(document).on("click", "#cambiar_estado", function () {
        let id = $(this).attr('data-id');
        let url = $(this).attr('data-url');
        let user = $(this).attr('data-user');


        $.ajax({
            url: url,
            data: { id, user },
            type: "POST",
            success: function (data) {
                $("tbody").html(data);
            }

        });
    });
    $(document).on('keyup', "#documento", function () {
        const $campo = $(this);
        const valor = $campo.val().trim();
        $campo.next('.text-danger').remove();
        $campo.removeClass('input-error');
        if (valor !== '' && valor.length < 8) {
            $campo.after("<p class='text-danger'>Este campo minimo 8 digitos</p>");
            $campo.addClass('input-error');
            valido = false;
        } else if (valor !== '' && valor.length > 10) {
            $campo.after("<p class='text-danger'>Este campo maximo 10 digitos</p>");
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
            $campo.after("<p class='text-danger'>Este campo debe contener 10 digitos</p>");
            $campo.addClass('input-error');
            valido = false;
        } else {
            valido = true;
        }
    });



});



