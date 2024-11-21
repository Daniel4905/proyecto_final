
$(document).ready(function () {


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

    $('#formRegistro').submit(function (event) {
        event.preventDefault();

        $('.text-danger').remove();
        $('input, select').removeClass('input-error');

        let valido = true;

        // Validación para los nombres y apellidos
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

        // Validación del complemento (si se proporciona)
        const complemento = $('#complemento').val().trim();
        if (complemento !== '' && !patronTexto.test(complemento)) {
            agregarError($('#complemento'), 'El campo complemento solo admite letras');
            valido = false;
        }

        // Validación del correo
        if (!validarCampo($('#correo'), patronCorreo, 'un correo válido')) {
            valido = false;
        }

        // Validación del rol
        const rol = $('#rol').val().trim();
        if (rol === '') {
            agregarError($('#rol'), 'Por favor, seleccione un rol');
            valido = false;
        }

        // Validación de la contraseña
        if (!validarCampo($('#clave'), patronClave, 'una contraseña válida')) {
            valido = false;
        }

        // Validación de la confirmación de contraseña
        const clavenew = $('#clavenew').val().trim();
        if (clavenew === '' || clavenew !== $('#clave').val().trim()) {
            agregarError($('#clavenew'), 'Las contraseñas no coinciden');
            valido = false;
        }

        // Si todas las validaciones son correctas, se envía el formulario
        if (valido) {
            this.submit();
        }
    });



    $('#formRegistrolog').submit(function (event) {
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
        let patron = /^[a-zA-Z\s]+$/;
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
        if (clave == '') {
            $('#clave').after("<p class='text-danger'>Por favor, ingrese su clave</p>");
            valido = false;
        }
        if (clave !== '' && !patronClave.test(clave)) {
            $('#clave').after("<p class='text-danger'>La contraseña debe contener al menos un caractér especial, una mayuscula y una minuscula</p>");
            valido = false;
        }

        const clavenew = $('#clavenew').val().trim();
        if (clavenew == '') {
            $('#clavenew').after("<p class='text-danger'>Por favor, confirme su clave</p>");
            valido = false;
        }
        if (clavenew !== '' && !patronClave.test(clave)) {
            $('#clavenew').after("<p class='text-danger'>La contraseña debe contener al menos un caractér especial, una mayuscula y una minuscula</p>");
            valido = false;
        }

        if (clave != clavenew) {
            $('#clavenew').after("<p class='text-danger'>Las contraseñas no coinciden</p>");
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



