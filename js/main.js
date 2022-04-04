$(document).ready(function() {

    //REGISTER
    var register = $("#register");
    register.bind("submit", function() {

        var formData = new FormData($("#register")[0]);

        $.ajax({
            url: register.attr("action"),
            type: register.attr("method"),
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $("#success-register").html("Creando usuario...");
            },
            success: function(result) {
                if (result == '1') {
                    setTimeout("location.href = 'login.php'", 2000);
                } else {
                    $("#success-register").html(result);
                    $("#success-register").fadeIn("slow");
                    $("#success-register").delay(2000).fadeOut("slow");
                }
            }
        });

        return false;
    });

    //LOGIN
    /* var login = $("#login");
    login.bind("submit", function(){
        
        var formData = new FormData($("#login")[0]);

            $.ajax({
                url: login.attr("action"),
                type: login.attr("method"),
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function() {
                $("#success-login").html("Iniciando Sesión...");
                },
                success: function(result){
                    if(result == '1'){
                        location.href ='index.php';
                    } else {
                        $("#success-login").html(result);
                        $("#success-login").fadeIn("slow");
                        $("#success-login").delay(2000).fadeOut("slow");
                    }
                }
            });

        return false;
    }); */

    //INSERT USER
    var addUser = $("#add-user");
    addUser.bind("submit", function() {

        var formData = new FormData($("#add-user")[0]);

        $.ajax({
            url: addUser.attr("action"),
            type: addUser.attr("method"),
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $("#success-add-user").html("Guardando usuario...");
            },
            success: function(result) {
                $("#success-add-user").html(result);
                $("#success-add-user").fadeIn("slow");
                $("#success-add-user").delay(2000).fadeOut("slow");
                setTimeout("location.href = 'all-users.php'", 2000);
            }
        });

        return false;
    });

    //UPDATE USER
    var updateUser = $("#update-user");
    updateUser.bind("submit", function() {

        var formData = new FormData($("#update-user")[0]);

        $.ajax({
            url: updateUser.attr("action"),
            type: updateUser.attr("method"),
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $("#success-update-user").html("Actualizando usuario...");
            },
            success: function(result) {
                $("#success-update-user").html(result);
                $("#success-update-user").fadeIn("slow");
                $("#success-update-user").delay(2000).fadeOut("slow");
                setTimeout("location.href = 'all-users.php'", 2000);
            }
        });

        return false;
    });

    //DELETE USER
    $(document).on("click", "#delete-user", function(e) {
        //Con esto detenemos la función nativa del selector
        e.preventDefault();
        e.stopPropagation();

        //Recuperamos el ID del atributo data-id
        let id = $(this).data('id');

        //Enviamos el AJAX
        $.ajax({
            type: "GET",
            url: "inc/delete-user.php",
            data: { id },
            beforeSend: function() {
                $("#success-delete-user").html("Eliminando usuario...");
            },
            success: function(result) {
                $("#success-delete-user").html(result);
                $("#success-delete-user").fadeIn("slow");
                $("#success-delete-user").delay(2000).fadeOut("slow");
            },
            complete: function() {
                setTimeout("location.reload()", 2000);
            }
        });
    });

    //INSERT PROCESS
    var addProcess = $("#add-process");
    addProcess.bind("submit", function() {

        var formData = new FormData($("#add-process")[0]);

        $.ajax({
            url: addProcess.attr("action"),
            type: addProcess.attr("method"),
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $("#success-add-process").html("Guardando proceso...");
            },
            success: function(result) {
                $("#success-add-process").html(result);
                $("#success-add-process").fadeIn("slow");
                $("#success-add-process").delay(2000).fadeOut("slow");
                setTimeout("location.href = 'all-process.php'", 2000);
            }
        });

        return false;
    });

    //UPDATE PROCESS
    var updateProcess = $("#update-process");
    updateProcess.bind("submit", function() {

        var formData = new FormData($("#update-process")[0]);

        $.ajax({
            url: updateProcess.attr("action"),
            type: updateProcess.attr("method"),
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $("#success-update-process").html("Actualizando proceso...");
            },
            success: function(result) {
                $("#success-update-process").html(result);
                $("#success-update-process").fadeIn("slow");
                $("#success-update-process").delay(2000).fadeOut("slow");
                setTimeout("location.href = 'all-process.php'", 2000);
            }
        });

        return false;
    });

    //CHANGE PROCESS
    var changeProcess = $("#change-process");
    changeProcess.bind("submit", function() {

        var formData = new FormData($("#change-process")[0]);

        $.ajax({
            url: changeProcess.attr("action"),
            type: changeProcess.attr("method"),
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $("#success-change-process").html("Guardando proceso...");
            },
            success: function(result) {
                $("#success-change-process").html(result);
                $("#success-change-process").fadeIn("slow");
                $("#success-change-process").delay(2000).fadeOut("slow");
                setTimeout("location.href = 'all-orders.php'", 2000);
            }
        });
        return false;
    });    

    //DELETE PROCESS
    $(document).on("click", "#delete-process", function(e) {
        //Con esto detenemos la función nativa del selector
        e.preventDefault();
        e.stopPropagation();

        //Recuperamos el ID del atributo data-id
        let id = $(this).data('id');

        //Enviamos el AJAX
        $.ajax({
            type: "GET",
            url: "inc/delete-process.php",
            data: { id },
            beforeSend: function() {
                $("#success-delete-process").html("Eliminando proceso...");
            },
            success: function(result) {
                $("#success-delete-process").html(result);
                $("#success-delete-process").fadeIn("slow");
                $("#success-delete-process").delay(2000).fadeOut("slow");
            },
            complete: function() {
                setTimeout("location.reload()", 2000);
            }
        });
    });

    //INSERT PRODUCT
    var addProduct = $("#add-product");
    addProduct.bind("submit", function() {

        var formData = new FormData($("#add-product")[0]);

        $.ajax({
            url: addProduct.attr("action"),
            type: addProduct.attr("method"),
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $("#success-add-product").html("Guardando producto...");
            },
            success: function(result) {
                $("#success-add-product").html(result);
                $("#success-add-product").fadeIn("slow");
                $("#success-add-product").delay(2000).fadeOut("slow");
                setTimeout("location.href = 'all-products.php'", 2000);
            }
        });

        return false;
    });

    //UPDATE PRODUCT
    var updateProduct = $("#update-product");
    updateProduct.bind("submit", function() {

        var formData = new FormData($("#update-product")[0]);

        $.ajax({
            url: updateProduct.attr("action"),
            type: updateProduct.attr("method"),
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $("#success-update-product").html("Actualizando producto...");
            },
            success: function(result) {
                $("#success-update-product").html(result);
                $("#success-update-product").fadeIn("slow");
                $("#success-update-product").delay(2000).fadeOut("slow");
                setTimeout("location.href = 'all-products.php'", 2000);
            }
        });

        return false;
    });

    //DELETE PRODUCT
    $(document).on("click", "#delete-product", function(e) {
        //Con esto detenemos la función nativa del selector
        e.preventDefault();
        e.stopPropagation();

        //Recuperamos el ID del atributo data-id
        let id = $(this).data('id');

        //Enviamos el AJAX
        $.ajax({
            type: "GET",
            url: "inc/delete-product.php",
            data: { id },
            beforeSend: function() {
                $("#success-delete-product").html("Eliminando producto...");
            },
            success: function(result) {
                $("#success-delete-product").html(result);
                $("#success-delete-product").fadeIn("slow");
                $("#success-delete-product").delay(2000).fadeOut("slow");
            },
            complete: function() {
                setTimeout("location.reload()", 2000);
            }
        });
    });


    //INSERT CATEGORY
    var addCategory = $("#add-category");
    addCategory.bind("submit", function() {

        var formData = new FormData($("#add-category")[0]);

        $.ajax({
            url: addCategory.attr("action"),
            type: addCategory.attr("method"),
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $("#success-add-category").html("Guardando categoría...");
            },
            success: function(result) {
                $("#success-add-category").html(result);
                $("#success-add-category").fadeIn("slow");
                $("#success-add-category").delay(2000).fadeOut("slow");
                setTimeout("location.href = 'all-categories.php'", 2000);
            }
        });

        return false;
    });

    //UPDATE CATEGORY
    var updateCategory = $("#update-category");
    updateCategory.bind("submit", function() {

        var formData = new FormData($("#update-category")[0]);

        $.ajax({
            url: updateCategory.attr("action"),
            type: updateCategory.attr("method"),
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $("#success-update-category").html("Actualizando categoría...");
            },
            success: function(result) {
                $("#success-update-category").html(result);
                $("#success-update-category").fadeIn("slow");
                $("#success-update-category").delay(2000).fadeOut("slow");
                setTimeout("location.href = 'all-categories.php'", 2000);
            }
        });

        return false;
    });

    //DELETE CATEGORY
    $(document).on("click", "#delete-category", function(e) {
        //Con esto detenemos la función nativa del selector
        e.preventDefault();
        e.stopPropagation();

        //Recuperamos el ID del atributo data-id
        let id = $(this).data('id');

        //Enviamos el AJAX
        $.ajax({
            type: "GET",
            url: "inc/delete-category.php",
            data: { id },
            beforeSend: function() {
                $("#success-delete-category").html("Eliminando producto...");
            },
            success: function(result) {
                $("#success-delete-category").html(result);
                $("#success-delete-category").fadeIn("slow");
                $("#success-delete-category").delay(2000).fadeOut("slow");
            },
            complete: function() {
                setTimeout("location.reload()", 2000);
            }
        });
    });

    //INSERT CLIENT
    var addClient = $("#add-client");
    addClient.bind("submit", function() {

        var formData = new FormData($("#add-client")[0]);

        $.ajax({
            url: addClient.attr("action"),
            type: addClient.attr("method"),
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $("#success-add-client").html("Guardando cliente...");
            },
            success: function(result) {
                $("#success-add-client").html(result);
                $("#success-add-client").fadeIn("slow");
                $("#success-add-client").delay(2000).fadeOut("slow");
                setTimeout("location.href = 'all-clients.php'", 2000);
            }
        });

        return false;
    });

    //UPDATE CLIENT
    var updateClient = $("#update-client");
    updateClient.bind("submit", function() {

        var formData = new FormData($("#update-client")[0]);

        $.ajax({
            url: updateClient.attr("action"),
            type: updateClient.attr("method"),
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $("#success-update-client").html("Actualizando cliente...");
            },
            success: function(result) {
                $("#success-update-client").html(result);
                $("#success-update-client").fadeIn("slow");
                $("#success-update-client").delay(2000).fadeOut("slow");
                setTimeout("location.href = 'all-clients.php'", 2000);
            }
        });

        return false;
    });

    //DELETE CLIENT
    $(document).on("click", "#delete-client", function(e) {
        //Con esto detenemos la función nativa del selector
        e.preventDefault();
        e.stopPropagation();

        //Recuperamos el ID del atributo data-id
        let id = $(this).data('id');

        //Enviamos el AJAX
        $.ajax({
            type: "GET",
            url: "inc/delete-client.php",
            data: { id },
            beforeSend: function() {
                $("#success-delete-client").html("Eliminando cliente...");
            },
            success: function(result) {
                $("#success-delete-client").html(result);
                $("#success-delete-client").fadeIn("slow");
                $("#success-delete-client").delay(2000).fadeOut("slow");
            },
            complete: function() {
                setTimeout("location.reload()", 2000);
            }
        });
    });

    //INSERT EMPLOYEE
    var addEmployee = $("#add-employee");
    addEmployee.bind("submit", function() {

        var formData = new FormData($("#add-employee")[0]);

        $.ajax({
            url: addEmployee.attr("action"),
            type: addEmployee.attr("method"),
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $("#success-add-employee").html("Guardando empleado...");
            },
            success: function(result) {
                $("#success-add-employee").html(result);
                $("#success-add-employee").fadeIn("slow");
                $("#success-add-employee").delay(2000).fadeOut("slow");
                setTimeout("location.href = 'all-employee.php'", 2000);
            }
        });

        return false;
    });

    //UPDATE EMPLOYEE
    var updateEmployee = $("#update-employee");
    updateEmployee.bind("submit", function() {

        var formData = new FormData($("#update-employee")[0]);

        $.ajax({
            url: updateEmployee.attr("action"),
            type: updateEmployee.attr("method"),
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $("#success-add-employee").html("Actualizando empleado...");
            },
            success: function(result) {
                $("#success-update-employee").html(result);
                $("#success-update-employee").fadeIn("slow");
                $("#success-update-employee").delay(2000).fadeOut("slow");
                setTimeout("location.href = 'all-employee.php'", 2000);
            }
        });

        return false;
    });

    //DELETE EMPLOYEE
    $(document).on("click", "#delete-employee", function(e) {
        //Con esto detenemos la función nativa del selector
        e.preventDefault();
        e.stopPropagation();

        //Recuperamos el ID del atributo data-id
        let id = $(this).data('id');

        //Enviamos el AJAX
        $.ajax({
            type: "GET",
            url: "inc/delete-employee.php",
            data: { id },
            beforeSend: function() {
                $("#success-delete-employee").html("Eliminando empleado...");
            },
            success: function(result) {
                $("#success-delete-employee").html(result);
                $("#success-delete-employee").fadeIn("slow");
                $("#success-delete-employee").delay(2000).fadeOut("slow");
            },
            complete: function() {
                setTimeout("location.reload()", 2000);
            }
        });
    });

    //INSERT ORDER
    var addOrder = $("#add-order");
    addOrder.bind("submit", function() {

        var formData = new FormData($("#add-order")[0]);

        $.ajax({
            url: addOrder.attr("action"),
            type: addOrder.attr("method"),
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $("#success-add-order").html("Generando orden...");
            },
            success: function(result) {
                $("#success-add-order").html(result);
                $("#success-add-order").fadeIn("slow");
                $("#success-add-order").delay(2000).fadeOut("slow");
                setTimeout("location.href = 'all-orders.php'", 2000);
            }
        });

        return false;
    });

    //UPDATE ORDER
    var updateOrder = $("#update-order");
    updateOrder.bind("submit", function() {

        var formData = new FormData($("#update-order")[0]);

        $.ajax({
            url: updateOrder.attr("action"),
            type: updateOrder.attr("method"),
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $("#success-update-order").html("Actualizando orden...");
            },
            success: function(result) {
                $("#success-update-order").html(result);
                $("#success-update-order").fadeIn("slow");
                $("#success-update-order").delay(2000).fadeOut("slow");
                setTimeout("location.href = 'all-orders.php'", 2000);
            }
        });

        return false;
    });

    //DELETE ORDER
    $(document).on("click", "#delete-order", function(e) {
        //Con esto detenemos la función nativa del selector
        e.preventDefault();
        e.stopPropagation();

        //Recuperamos el ID del atributo data-id
        let id = $(this).data('id');

        //Enviamos el AJAX
        $.ajax({
            type: "GET",
            url: "inc/delete-order.php",
            data: { id },
            beforeSend: function() {
                $("#success-delete-order").html("Eliminando orden...");
            },
            success: function(result) {
                $("#success-delete-order").html(result);
                $("#success-delete-order").fadeIn("slow");
                $("#success-delete-order").delay(2000).fadeOut("slow");
            },
            complete: function() {
                setTimeout("location.reload()", 2000);
            }
        });
    });

});