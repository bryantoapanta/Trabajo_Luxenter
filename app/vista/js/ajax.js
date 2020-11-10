
//FUNCION AJAX BUSCAR

$(document).on('keyup', '#busqueda', function () { //al pulsar una tecla en el buscador ejecutamos la funcion 
    
    var CampoValor = $(this).val(); //almacenamos el valor que se encuentra en #busqueda en una nueva variable

    if (CampoValor != "") { //si contiene alguna letra
        
        $.ajax({
            url: '?orden=Buscar&id=0', //llamamos a la funcion
            type: 'POST', //se lo pasamos por POST
            dataType: 'html', //tipo HTML
            data: { palabra: CampoValor }, //le pasamos el parametro tienda 
        })

            .done(function (resultado) {
                // alert(resultado);
                $(".contenedor_verVideos").html("");
                $(".contenedor_verVideos").html(resultado); //en el div #resultado le metemos lo que nos devuelva el php
            })

    } else {
        $.ajax({
            url: '?', //llamamos a la funcion
            type: 'POST', //se lo pasamos por POST
            dataType: 'html', //tipo HTML
        })

            .done(function (resultado) {
                $("body").html("");
                $("body").html(resultado); //en el div #resultado le metemos lo que nos devuelva el php
            })
    }
});



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
            $(".container").addClass('disabledbutton');//le añado una clase donde inhabilito las funciones del div
            $(".container").fadeTo('slow', .1);//oscurecemos el div 
            $("#div_modificar").html(resultado); //en el div #resultado le metemos lo que nos devuelva el php
            $("#div_modificar").css("top", "15vh");;
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
            $(".container").addClass('disabledbutton');//le añado una clase donde inhabilito las funciones del div
            $(".container").fadeTo('slow', .1);//oscurecemos el div 
            $("#div_modificar").html(resultado); //en el div #resultado le metemos lo que nos devuelva el php
            $("#div_modificar").css("top", "15vh");;
        });

}
)
);


//FUNCION BORRAR

$(document).on("click", ".borrador", (function () {
    if (confirm("¿Quieres eliminar el producto:  " + $(this).attr("value") + "?")) {
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



/* FUNCION VOLVER ------------- */

$(document).on("click", ".volver", (function () {

    $("#div_modificar").html(""); // dejamos en blanco el div_ajax
    $(".container").fadeTo('slow', 1);//oscurecemos el div 
    $(".container").removeClass('disabledbutton');

}));
