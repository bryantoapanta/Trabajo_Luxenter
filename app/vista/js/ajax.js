/** AL INICIAR LA PAGINA */
$(document).ready(function () {
    $("#busqueda").focus();

});


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
        $(location).attr('href', "?");
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

    $.ajax({
        url: '?orden=DeleteAlert', //llamamos a la funcion
        type: 'POST', //se lo pasamos por POST
        dataType: 'html', //tipo HTML
        data: {
            id: $(this).attr("value"),

        },
    })

        .done(function (resultado) {
            $(".container").addClass('disabledbutton');//le añado una clase donde inhabilito las funciones del div
            $(".container").fadeTo('slow', .1);//oscurecemos el div 
            $("#div_borrar").html(resultado); //en el div le metemos lo que nos devuelva el php
            $("#div_borrar").css("top", "30vh");
        });
}
)
);



/* FUNCION VOLVER ------------- */

$(document).on("click", ".volver", (function () {

    $("#div_modificar").html(""); // dejamos en blanco el div_ajax
    $("#div_borrar").html(""); // dejamos en blanco el div_ajax
    $(".container").fadeTo('slow', 1);//oscurecemos el div 
    $(".container").removeClass('disabledbutton');

}));



//FUNCION COMPROBAR URL

$(document).on('keyup', '.url', (function () { //al pulsar una tecla en el buscador ejecutamos la funcion 

    $url = $(this).val();
    if ($url != "") {
        $.ajax({
            url: '?orden=UserCheck', //llamamos a la funcion
            type: 'POST', //se lo pasamos por POST
            dataType: 'html', //tipo HTML
            data: {
                id: $url,
                tipo: "url",
            }, //le pasamos el parametro id 
        })
            .done(function (resultado) {
                $(".msg").html(resultado);
            });
    } else {
        $(".msg").html("");
    }


}));

//FUNCION COMPROBAR ORDEN

$(document).on('keyup', '.orden', (function () { //al pulsar una tecla en el buscador ejecutamos la funcion 

    $orden = $(this).val();
    $codigo = $(".codigo").val();
    $ordenActual = $(".ordenActual").attr("value");
    if ($orden != "") {
        $.ajax({
            url: '?orden=UserCheck', //llamamos a la funcion
            type: 'POST', //se lo pasamos por POST
            dataType: 'html', //tipo HTML
            data: {
                id: $orden,
                codigo: $codigo,
                tipo: "orden",
                orden: $ordenActual,
            }, //le pasamos el parametro id 
        })
            .done(function (resultado) {
                $(".msg1").html(resultado);
            });
    } else {
        $(".msg1").html("");

    }


}));
