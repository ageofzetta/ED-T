$( document ).ready(function() {
  setTimeout(function(){
   $('.messages').fadeOut();
  },2500);

1
$.post( "soap.php", { query: "consultarDetalleGuia", time: "2pm" }).done(function( data ) {
    console.log(data);
  });
});


$(document).on('click','.getBLzs', function (event) {
    event.preventDefault ? event.preventDefault() : event.returnValue = false;
    
    $.post( "includes/process.php", { num_refe: 'LAR08-02734-I01' }, function( data ) {
        if (! /^[\[|\{](\s|.*|\w)*[\]|\}]$/.test(data)) {
            console.log('Error de Conexión');
        }else{
            
        }
        var obj = JSON.parse(data);
        if (obj.ok) {
            console.log(obj.data.adu_desp);
        };
  // alert( "Data Loaded: " + data );
  console.log(obj);
    });
   });


$("input[type='text']").click(function () {
   $(this).select();
});