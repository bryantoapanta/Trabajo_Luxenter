

function obtener_registro(tienda) {

    $.ajax({
        url: '?accion=Buscar&id=0', //llamamos a la funcion
        type: 'POST', //se lo pasamos por POST
        dataType: 'html', //tipo HTML
        data: { tienda: tienda }, //le pasamos el parametro tienda 
    })

        .done(function (resultado) {
            // alert(resultado);
            $("#resultado").html(resultado); //en el div #resultado le metemos lo que nos devuelva el php
        })
}

$(document).on('keyup', '#busqueda', function () { //al pulsar una tecla en el buscador ejecutamos la funcion 

    var CampoValor = $(this).val(); //almacenamos el valor que se encuentra en #busqueda en una nueva variable

    if (CampoValor != "") { //si contiene alguna letra

        obtener_registro(CampoValor); // llamamos a la funcion obtener registro, le pasamos la variable

    } else {
        $("#resultado").html(""); // si no, se imprime un campo vacio
    }
}
);



/* CAMBIAR PUNTERO AL PASAR POR LOS DIVS */


$(document).on("mouseover", ".puntero", (function () {
    $(".puntero").css("cursor", "pointer");
}
)
);

/*------------------------------------------------------------------------------------------------------------*/


/* FUNCION AÑADIR ------------- */

$(document).on("click", ".añadir", (function () {

    $.ajax({
        url: '?orden=Añadir', //llamamos a la funcion
        type: 'POST', //se lo pasamos por POST
        dataType: 'html', //tipo HTML
        data: {
            id: 0,

        },
    })

        .done(function (resultado) {

            $("#div_modificar").html(resultado); //en el div #resultado le metemos lo que nos devuelva el php
            ;
        });

}
)
);


/* FUNCION EXPORTAR EXEL ------------- */

$(document).on("click", ".exportar", (function () {

    if (confirm("¿Quieres exportar a Exel")) {
        document.location.href = "?orden=Exportar&id=0"; //llamamos al index y le pasamos un codigo como parametro.
    }

}));



//FUNCION MODIFICAR

$(document).on("click", ".modificacion", (function () {

    $.ajax({
        url: '?orden=Modificar', //llamamos a la funcion
        type: 'POST', //se lo pasamos por POST
        dataType: 'html', //tipo HTML
        data: {
            id: $(this).attr("value"),

        },
    })

        .done(function (resultado) {

            $("#div_modificar").html(resultado); //en el div #resultado le metemos lo que nos devuelva el php
            ;
        });

}
)
);


//FUNCION BORRAR

$(document).on("click", ".borrador", (function () {
    if (confirm("¿Quieres eliminar el producto:  " +  $(this).attr("value") + "?")) {
        $.ajax({
            url: '?orden=Borrar', //llamamos a la funcion
            type: 'POST', //se lo pasamos por POST
            dataType: 'html', //tipo HTML
            data: {
                id: $(this).attr("value"),

            },
        })

            .done(function (resultado) {

                $("body").html(resultado); //
                ;
            });

    }
}
)
);



