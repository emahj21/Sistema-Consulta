function inicio_sesion() {
    Swal.fire({
        icon: 'success',
        title: 'Bienvenido',
        text: 'Has iniciado sesión',
        color: '#fff',
        background: '#545454',
        position: 'top-end',
        showConfirmButton: false,

        timer: '3000',
        toast: true,
        hideClass: {
            popup: 'animate__animated  animate__backOutUp'
        }
    });
}
function detalleProc() {
    Swal.fire({
        title: 'Gráfica completa!',
        confirmButtomText: 'Aceptar',
        confirmButtomColor: '#EF172F',
        icon: 'success',

        grow: 'column',
        //html: ,
    });
}

function mensaje() {
    Swal.fire({
        title: 'Gráfica completa!',
        confirmButtomText: 'Aceptar',
        confirmButtomColor: '#EF172F',
        icon: 'success',
        iconColor: 'red',
        //position
        //grow: 'row',
        grow: 'column',
        //grow: 'fullscreen',

    });
}