$('#Enviar').click(function(){
    var Fechain=document.getElementById('f1').value;
    var Fechafin=document.getElementById('f2').value;

    var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

    $.ajax({
      url: 'pag/graf.php',
      type: 'POST',
      data: ruta,
    })

    .done(function(res){
      $('#respuesta').html(res)
      //$('#f1').val('');
      //$('#f2').val('');
    })

    .fail(function(){
      console.log("error");
    })
    .always(function(){
      console.log("complete");
    })
});  



$('#Ver').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/administracion.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con').html(res)
    //$('#f1').val('');
    //$('#f2').val('');
  })

  .fail(function(){
    console.log("error");
  })
  .always(function(){
    console.log("complete");
  })
});  

$('#Ver2').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/liberacion.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con').html(res)
    //$('#f1').val('');
    //$('#f2').val('');
  })

  .fail(function(){
    console.log("error");
  })
  .always(function(){
    console.log("complete");
  })
});  

$('#Ver3').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/reclamaciones.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con').html(res)
    //$('#f1').val('');
    //$('#f2').val('');
  })

  .fail(function(){
    console.log("error");
  })
  .always(function(){
    console.log("complete");
  })
});  


$('#Ver4').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/entregados.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con').html(res)
    //$('#f1').val('');
    //$('#f2').val('');
  })

  .fail(function(){
    console.log("error");
  })
  .always(function(){
    console.log("complete");
  })
});  


$('#Ver5').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/oc1.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con2').html(res)
    //$('#f1').val('');
    //$('#f2').val('');
  })

  .fail(function(){
    console.log("error");
  })
  .always(function(){
    console.log("complete");
  })
});  

$('#Ver6').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/oc.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con2').html(res)
    //$('#f1').val('');
    //$('#f2').val('');
  })

  .fail(function(){
    console.log("error");
  })
  .always(function(){
    console.log("complete");
  })
}); 

$('#Ver7').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/reclamaciones.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con2').html(res)
    //$('#f1').val('');
    //$('#f2').val('');
  })

  .fail(function(){
    console.log("error");
  })
  .always(function(){
    console.log("complete");
  })
}); 

$('#Ver8').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/entregados.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con2').html(res)
    //$('#f1').val('');
    //$('#f2').val('');
  })

  .fail(function(){
    console.log("error");
  })
  .always(function(){
    console.log("complete");
  })
}); 

$('#logistica').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/entregados.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#logis').html(res)
    //$('#f1').val('');
    //$('#f2').val('');
  })

  .fail(function(){
    console.log("error");
  })
  .always(function(){
    console.log("complete");
  })
}); 

$('#entregadosim').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/entregados.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con4').html(res)
    //$('#f1').val('');
    //$('#f2').val('');
  })

  .fail(function(){
    console.log("error");
  })
  .always(function(){
    console.log("complete");
  })
}); 

$('#reclamosim').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/reclamaciones.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con4').html(res)
    //$('#f1').val('');
    //$('#f2').val('');
  })

  .fail(function(){
    console.log("error");
  })
  .always(function(){
    console.log("complete");
  })
}); 

$('#personalizacionim').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/personalizacion.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con4').html(res)
    //$('#f1').val('');
    //$('#f2').val('');
  })

  .fail(function(){
    console.log("error");
  })
  .always(function(){
    console.log("complete");
  })
});

$('#generacion').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/generacion.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con4').html(res)
    //$('#f1').val('');
    //$('#f2').val('');
  })

  .fail(function(){
    console.log("error");
  })
  .always(function(){
    console.log("complete");
  })
});

$('#empaque').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/empaque.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con5').html(res)
    //$('#f1').val('');
    //$('#f2').val('');
  })

  .fail(function(){
    console.log("error");
  })
  .always(function(){
    console.log("complete");
  })
});

$('#reclamoemp').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/reclamaciones.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con5').html(res)
    //$('#f1').val('');
    //$('#f2').val('');
  })

  .fail(function(){
    console.log("error");
  })
  .always(function(){
    console.log("complete");
  })
});

$('#pedidosemp').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/entregados.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con5').html(res)
    //$('#f1').val('');
    //$('#f2').val('');
  })

  .fail(function(){
    console.log("error");
  })
  .always(function(){
    console.log("complete");
  })
});

$('#pedreg').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/registrados.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con6').html(res)
    //$('#f1').val('');
    //$('#f2').val('');
  })

  .fail(function(){
    console.log("error");
  })
  .always(function(){
    console.log("complete");
  })
});

$('#regas').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/asesores.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con6').html(res)
    //$('#f1').val('');
    //$('#f2').val('');
  })

  .fail(function(){
    console.log("error");
  })
  .always(function(){
    console.log("complete");
  })
});

$('#reclamacionadm').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/reclamaciones.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con6').html(res)
    //$('#f1').val('');
    //$('#f2').val('');
  })

  .fail(function(){
    console.log("error");
  })
  .always(function(){
    console.log("complete");
  })
});

$('#pedidosadm').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/entregados.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con6').html(res)
    //$('#f1').val('');
    //$('#f2').val('');
  })

  .fail(function(){
    console.log("error");
  })
  .always(function(){
    console.log("complete");
  })
});

$('#maquila1').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/maquila1.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con8').html(res)
    //$('#f1').val('');
    //$('#f2').val('');
  })

  .fail(function(){
    console.log("error");
  })
  .always(function(){
    console.log("complete");
  })
});

$('#maquila2').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/maquila2.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con8').html(res)
    //$('#f1').val('');
    //$('#f2').val('');
  })

  .fail(function(){
    console.log("error");
  })
  .always(function(){
    console.log("complete");
  })
});

$('#defectos').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/defectos.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con8').html(res)
    //$('#f1').val('');
    //$('#f2').val('');
  })

  .fail(function(){
    console.log("error");
  })
  .always(function(){
    console.log("complete");
  })
});

$('#reclamacioncal').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/reclamaciones.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con').html(res)
    //$('#f1').val('');
    //$('#f2').val('');
  })

  .fail(function(){
    console.log("error");
  })
  .always(function(){
    console.log("complete");
  })
});

$('#pedidoscal').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/entregados.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con8').html(res)
    //$('#f1').val('');
    //$('#f2').val('');
  })

  .fail(function(){
    console.log("error");
  })
  .always(function(){
    console.log("complete");
  })
});