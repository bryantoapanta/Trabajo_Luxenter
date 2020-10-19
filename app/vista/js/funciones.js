function confirmarBorrarProducto(url, codigo) {
    if (confirm("¿Quieres eliminar el producto:  " + codigo + "?")) {
        document.location.href = "?orden=Borrar&id=" + url; //llamamos al index y le pasamos un codigo como parametro.
    }
}

function confirmarRenombrarProducto(url, codigo) {
    if (confirm("¿Quieres renombrar el producto:  " + codigo + "?")) {
        document.location.href = "?orden=Modificar&id=" + url; //llamamos al index y le pasamos un codigo como parametro.
    }
}

function volver() {
    if (confirm("¿Quieres volver atrás?")) {
        document.location.href = "?orden=Inicio";
    }
}


//-------------BUSCADOR--------------

document.addEventListener("DOMContentLoaded", buscador, false);

function buscador() {

    document.getElementById('search').addEventListener('click', buscar);


}
function buscar(e) {

    var palabra = document.getElementById("palabra").value.toUpperCase();
    //alert(palabra);
    document.location.href = "?orden=Buscar&palabra="+palabra+"&id="+1+"&pagina="+1;// le pasamos la ordena ejecutar y la palabra a buscar

}