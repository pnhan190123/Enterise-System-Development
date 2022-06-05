localStorage.removeItem("done");

$(function() {
    if (typeof Storage != "undefined") {
        if (!localStorage.getItem("done")) {
            setTimeout(function() {
                $('#myModal').modal('show');
            }, 1400);
        }
        localStorage.setItem("done", true);

    }
});

$('#button').click(function() {
    $('#myModal').modal('hide');

});
document.onkeydown = function(){
    switch (event.keyCode){
          case 116 : //F5 button
              event.returnValue = false;
              event.keyCode = 0;
              return false;
          case 82 : //R button
              if (event.ctrlKey){ 
                  event.returnValue = false;
                  event.keyCode = 0;
                  return false;
              }
      }
      // location.reload(true);
  }