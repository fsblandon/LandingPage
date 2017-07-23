$(function () {    
  $("#contact_form").submit(function (e) {
    //alert("its ok");
    e.preventDefault();

    //variables a enviar tipo json
    var nombre = $("#nombre").val();
    var correo = $("#correo").val();
    var mensaje = $("#mensaje").val();

    if (nombre == ''){
      alert("Por favor ingresar nombre");
      document.getElementById("nombre").focus();
    }else if(correo == ''){
      alert("Por favor ingresar correo");
      document.getElementById("correo").focus();
    }else if(mensaje == '') {
      alert("Por favor ingresar mensaje");
      document.getElementById("mensaje").focus();
    }
    else{

      //formar la data
      var form_data = $("#contact_form").serializeArray();
      //console.log(form_data);

      /*var data = {
        nombre : $("#nombre").val(),
        correo : $("#correo").val(),
        mensaje : $("#mensaje").val()
      };*/

      var Url = "php/process.php";

      $.ajax({
        //cache: false,
        //async: false,
        url: Url,
        data: form_data,
        type: 'POST' // Add datatype
        //datatype : 'json',
      }).done(function (data) {
        console.log("Enviado"+form_data);
        alert("listo");
        
        $("#nombre").val('');
        $("#correo").val('');
        $("#mensaje").val('');

      }).fail(function (jqXHR, textStatus, errorThrown) {
        //alert("Error al enviar mensaje, compruebar conexión");
        alert("error");
        console.log(jqXHR, textStatus, errorThrown);
        //document.getElementById("contact_form").reset();

        $("#nombre").val('');
        $("#correo").val('');
        $("#mensaje").val('');

      });
    }
  }); 
});