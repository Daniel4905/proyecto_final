
$(document).ready(function () {

    $('#formRegistro').submit(function (event) {
        // Pausa el envío
        event.preventDefault();

        $('.text-danger').remove();
        $('input').removeClass('input-error');



        // Verifica si hay errores
        let valido = true;

        // Validar campo nombre
        const nombre = $('#nombre1').val().trim();
        if (nombre == '') {
            $('#nombre1').addClass('input-error').after("<p class='text-danger'>Por favor, ingrese el primer nombre</p>");
            valido = false;
        }
        const nombre2 = $('#nombre2').val().trim();


        const apellido = $('#apellido1').val().trim();
        if (apellido == '') {
            $('#apellido1').addClass('input-error').after("<p class='text-danger'>Por favor, ingrese el primer apellido</p>");
            valido = false;
        }
        const apellido2 = $('#apellido2').val().trim();
        let patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
        if (nombre !== '' && !patron.test(nombre)) {
            $('#nombre1').addClass('input-error').after("<p class='text-danger'>El campo primer nombre solo admite letras</p>");
            valido = false;
        }
        if (nombre2 !== '' && !patron.test(nombre2)) {
            $('#nombre2').addClass('input-error').after("<p class='text-danger'>El campo segundo nombre solo admite letras</p>");
            valido = false;
        }
        if (apellido !== '' && !patron.test(apellido)) {
            $('#apellido1').addClass('input-error').after("<p class='text-danger'>El campo primer apellido solo admite letras</p>");
            valido = false;
        }
        if (apellido2 !== '' && !patron.test(apellido2)) {
            $('#apellido2').addClass('input-error').after("<p class='text-danger'>El campo segundo apellido solo admite letras</p>");
            valido = false;
        }
        

        const documento = $('#doc').val().trim();
        if (documento == '') {
            $('#doc').addClass('input-error').after("<p class='text-danger'>Por favor, seleccione un tipo de documento</p>");
            valido = false;
        }
        
        const numDoc = $('#documento').val().trim();
        if (numDoc == '') {
            $('#documento').addClass('input-error').after("<p class='text-danger'>Por favor, ingrese su numero de documento</p>");
            valido = false;
        }

        const sexo = $('#sexo').val().trim();
        if(sexo==''){
            $('#sexo').addClass('input-error').after("<p class='text-danger'>Por favor, seleccione su sexo biologico</p>");
            valido = false;
        }

        
        let patronNum = /^[0-9]+$/;
        if (numDoc !== '' && !patronNum.test(numDoc)) {
            $('#documento').addClass('input-error').after("<p class='text-danger'>El campo documento solo admite numeros</p>");
            valido = false;
        }

        const telefono = $('#telefono').val().trim();
        if (telefono == '') {
            $('#telefono').addClass('input-error').after("<p class='text-danger'>Por favor, ingrese su numero de telefono</p>");
            valido = false;
        }
        if (telefono !== '' && !patronNum.test(telefono)) {
            $('#documento').after("<p class='text-danger'>El campo telefono solo admite numeros</p>");
            valido = false;
        }

        const tipoVia = $('#tipoVia').val().trim();
        if(tipoVia == ''){
            $('#tipoVia').addClass('input-error').after("<p class='text-danger'>Por favor, seleccione un tipo de via</p>");
            valido = false;
        }

        const numeroPrincipal = $('#numeroPrincipal').val().trim();
        if(numeroPrincipal == '' ){
            $('#numeroPrincipal').addClass('input-error').after("<p class='text-danger'>Por favor, digite el numero principal</p>");
            valido = false;
        }

        const numeroSecundario = $('#numeroSecundario').val().trim();
        if(numeroSecundario == '' ){
            $('#numeroSecundario').addClass('input-error').after("<p class='text-danger'>Por favor, digite el numero 1</p>");
            valido = false;
        }

        const numeroTerciario= $('#numeroTerciario').val().trim();
        if(numeroTerciario == '' ){
            $('#numeroTerciario').addClass('input-error').after("<p class='text-danger'>Por favor, digite el numero 2</p>");
            valido = false;
        }
        const complemento = $('#complemento').val().trim();
        if (complemento  !== '' && !patron.test(complemento )) {
            $('#complemento').addClass('input-error').after("<p class='text-danger'>El campo complemento solo admite letras</p>");
            valido = false;
        }
        


        let patronCorreo = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        const correo = $('#correo').val().trim();
        if (correo == '') {
            $('#correo').addClass('input-error').after("<p class='text-danger'>Por favor, ingrese su correo</p>");
            valido = false;
        }

        if (correo !== '' && !patronCorreo.test(correo)) {
            $('#correo').addClass('input-error').after("<p class='text-danger'>El campo correo debe contener la estructura usuario@dominio.com</p>");
            valido = false;
        }

        const rol = $('#rol').val().trim();
        if (rol == '') {
            $('#rol').addClass('input-error').after("<p class='text-danger'>Por favor, seleccione un rol</p>");
            valido = false;
        }
        let patronClave = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&])[A-Za-z\d@$!%?&]{8,}$/;
        const clave = $('#clave').val().trim();
        if (clave == '') {
            $('#clave').addClass('input-error').after("<p class='text-danger'>Por favor, ingrese su clave</p>");
            valido = false;
        }
        if (clave !== '' && !patronClave.test(clave)) {
            $('#clave').addClass('input-error').after("<p class='text-danger'>La contraseña debe contener al menos un caractér especial, una mayuscula y una minuscula</p>");
            valido = false;
        }

        const clavenew = $('#clavenew').val().trim();
        if (clavenew == '') {
            $('#clavenew').addClass('input-error').after("<p class='text-danger'>Por favor, confirme su clave</p>");
            valido = false;
        }
        if (clavenew !== '' && !patronClave.test(clave)) {
            $('#clavenew').addClass('input-error').after("<p class='text-danger'>La contraseña debe contener al menos un caractér especial, una mayuscula y una minuscula</p>");
            valido = false;
        }

        if(clave != clavenew){
            $('#clavenew').addClass('input-error').after("<p class='text-danger'>Las contraseñas no coinciden</p>");
            valido = false;
        }

        // Si no hay errores, enviar el formulario
        if (valido) {
            $('#error').fadeOut(500);
            this.submit();
        } else {
            $('#error').fadeIn();
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

        if(clave != clavenew){
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
        } else if(valor !== '' && valor.length > 10){
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
        if(valor !== '' && valor.length != 10){
            $campo.after("<p class='text-danger'>Este campo debe contener 10 digitos</p>");
            $campo.addClass('input-error');
            valido = false;
        }else{
            valido = true;
        }
    });

    

});



