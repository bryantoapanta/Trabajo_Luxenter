function confirmarBorrarProducto(url,codigo) {
    if (confirm("¿Quieres eliminar el producto:  " + codigo + "?")) {
        document.location.href = "?orden=Borrar&id=" + url; //llamamos al index y le pasamos un codigo como parametro.
    }
}

function confirmarRenombrarProducto(url,codigo) {
    if (confirm("¿Quieres renombrar el producto:  " + codigo + "?")) {
        document.location.href = "?orden=Modificar&id=" + url; //llamamos al index y le pasamos un codigo como parametro.
    }
}

function volver() {
    if (confirm("¿Quieres volver atrás?")) {
        document.location.href = "?orden=Inicio";
    }
}