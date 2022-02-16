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