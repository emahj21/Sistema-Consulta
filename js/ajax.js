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


/*---------- ADMINISTRACION ----------*/
$('#adm1').click(function(){
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
$('#adm2').click(function(){
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
$('#adm3').click(function(){
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
$('#adm4').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/entregadosAdministracion.php',
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

/*---------- COMPRAS ----------*/
$('#comp1').click(function(){
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
$('#comp2').click(function(){
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
$('#comp3').click(function(){
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
$('#comp4').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/entregadosCompras.php',
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

/*---------- LOGISTICA ----------*/
$('#log1').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/entregadosLogistica.php',
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

/*---------- IMAGEN ----------*/
$('#img1').click(function(){
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
$('#img2').click(function(){
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
$('#img3').click(function(){
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
$('#img4').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/entregadosImagen.php',
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

/*---------- EMPAQUE ----------*/
$('#emp1').click(function(){
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
$('#emp2').click(function(){
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
$('#emp3').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/entregadosEmpaque.php',
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

/*---------- BACKOFFICE ----------*/
$('#bck1').click(function(){
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
$('#bck2').click(function(){
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
$('#bck3').click(function(){
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
$('#bck4').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/entregadosBCK.php',
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

/*---------- ALMACEN ----------*/
$('#alm1').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/entregadosBCK.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con7').html(res)
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
$('#alm2').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/entregadosBCK.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con7').html(res)
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
$('#alm3').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/entregadosBCK.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con7').html(res)
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
$('#alm4').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/entregadosBCK.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con7').html(res)
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
$('#alm5').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/entregadosAlmacen.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con7').html(res)
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

/*---------- CALIDAD ----------*/
$('#cal1').click(function(){
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
$('#cal2').click(function(){
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
$('#cal3').click(function(){
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
$('#cal4').click(function(){
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
$('#cal5').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/entregadosCalidad.php',
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
/*---------- PRODUCCION ----------*/
$('#prod1').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/genOCProduccion.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con9').html(res)
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
$('#prod2').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/recepOCProduccion.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con9').html(res)
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
$('#prod3').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/reclamacionesProduccion.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con9').html(res)
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
$('#prod4').click(function(){
  var Fechain=document.getElementById('f1').value;
  var Fechafin=document.getElementById('f2').value;

  var ruta="Fein="+Fechain+"&Fefin="+Fechafin;

  $.ajax({
    url: 'pag/entregadosProduccion.php',
    type: 'POST',
    data: ruta,
  })

  .done(function(res){
    $('#con9').html(res)
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