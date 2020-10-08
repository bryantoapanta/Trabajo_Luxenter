function confirmarBorrarProducto(codigo) {
    if (confirm("¿Quieres eliminar el producto:  " + codigo + "?")) {
        document.location.href = "?orden=Borrar&id=" + codigo; //llamamos al index y le pasamos un codigo como parametro.
    }
}

function confirmarRenombrarProducto(codigo) {
    if (confirm("¿Quieres renombrar el producto:  " + codigo + "?")) {
        document.location.href = "?orden=Modificar&id=" + codigo; //llamamos al index y le pasamos un codigo como parametro.
    }
}

function volver() {
    if (confirm("¿Quieres volver atrás?")) {
        document.location.href = "?orden=Inicio";
    }
}