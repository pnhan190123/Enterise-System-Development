
  $(function() {
    if (typeof Storage != "undefined") {
      if (!localStorage.getItem("done")) {
        setTimeout(function() {
          $('#myModal').modal('show');
        }, 1000);
      }
      localStorage.setItem("done", true);
    }
  });