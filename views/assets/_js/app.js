$( document ).ready(function() {
  setTimeout(function(){
   $('.messages').fadeOut();
  },2500);
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

// $('body').bind('keypress', function(e) {
//   if(e.keyCode==11){
//      setTimeout(function() {
//     $( '.panel-header' ).trigger( "click" );
//   }, 100);
//   }
// });
  
// $(document).keydown(function(e) {
//   if (e.which == 75 && e.shiftKey && !e.ctrlKey) {
//          setTimeout(function() {
//     $( '.panel-header' ).trigger( "click" );
//   }, 100);
//   };
//       // console.log('key code is: ' + e.which + ' ' + (e.ctrlKey ? 'Ctrl' : '') + ' ' +
//       //       (e.shiftKey ? 'Shift' : '') + ' ' + (e.altKey ? 'Alt' : ''));
// });


$("input[type='text']").click(function () {
   $(this).select();
});