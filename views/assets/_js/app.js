$( document ).ready(function() {

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
  