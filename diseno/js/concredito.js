
$('#btn_login').on('click', function(){
    $("#btn_login").attr("disabled", "disabled");
    $('#fa_login').addClass('fa-cog fa-spin');
    var Accion2 = $('#Accion').val();
    var usuario = $('#usuario').val();
    $.ajax({
        url:'Controllers/logear.php',
        type:'POST',
        data:'usuario='+usuario+"&boton=ingresar"
    }).done(function(resp){
    switch (resp) { 
            case '0': 
                    $('#error').show();
                    $("#btn_login").removeAttr("disabled");
                    $('#fa_login').removeClass('fa-cog fa-spin');
                break;
            case '1': 
                break;
            case '2': 
                    location.href='dashboardusuario.php';

                break;
            default:
                alert(resp);
            }
    });
});

$('#form_edit').on('submit', function (e) {
          e.preventDefault();
          $.ajax({
            type: 'post',
            url: 'calculo.php',
             data: $('#form_edit').serialize(),
            success: function (response) {
              //alert(response);
              $('#Total').html(response);
            }
          });
       });
        function registrar(){
            var opcion = "registrar";
          $.ajax({
            type: 'post',
            url: 'registrarsolicitud.php',
             data: $('#form_edit').serialize()+"&opcion="+opcion,
            success: function (response) {
                location.reload();
              //alert(response);
              
            }
          });
        };
        function aceptar(){
            var paginaActual = "dashboardusuarios.php";
            var idusuario = $("#usuario").val();
            var id = $("#solicitud").val();
            var opcion = "aceptada";
            //console.log(id);
          $.ajax({
            type: 'post',
            url: 'registrarsolicitud.php',
             data: "idsolicitud="+id+"&opcion="+opcion+"&idCliente="+idusuario,
            success: function (response) {
            //alert(response);
            if (response == 'true') {
            
            alert("La solicitud se acepto correctamente");
              location.reload();

            }
              
            }
          });
        };
        function rechazar(){
            var idusuario = $("#usuario").val();
            var id = $("#solicitud").val();
            var opcion = "rechazada";
          $.ajax({
            type: 'post',
            url: 'registrarsolicitud.php',
             data: "idsolicitud="+id+"&opcion="+opcion+"&idCliente="+idusuario,
            success: function (response) {
               if (response == 'true') {
                    alert("La solicitud se rechazo correctamente");
                      location.reload();
                }
            }
          });
        };

$('[data-toggle="popover"]').popover();

function LogOut(){
    $.ajax({
        url:'Controllers/logear.php',
        type:'POST',
        data:"boton=cerrar"
    }).done(function(resp){
        if(resp=='0'){
            $('#error').show();
        }
        else{
            location.href='index.php';
        }
    });

}

function checarnotificaciones() {
  var paginaActual = 0;
  //Actualizacion automatica
  window.ajaxUpdate = true;
  setInterval(function(){
    console.log("entro2");
    location.reload();
  },30000);
}

function longPoll(){
console.log('entre longpoll');
var opcion = "notificaciones";
$.ajax({
        type: 'post',
        url: 'registrarsolicitud.php',
        data: "&opcion="+opcion,
      success: function (response) {
         //console.log(response);
         if (response == 1) {
          checarnotificaciones();
          console.log("entro if");
           swal('Tienes nuevas Solicitudes por votar');
         }else{
          checarnotificaciones();
          console.log("entro else");
          
         }
         

      }
    });
}