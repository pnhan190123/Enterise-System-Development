<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="{{asset('css/confirm.css')}}">


<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>

  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <!--         <h4 class="modal-title">Modal Header</h4> -->
        </div>
        <div class="modal-body text-center">
          <h1>Thanh toán thành công</h1><br>
          <p></p>
          <a class="pre-order-btn" href="" data-dismiss="modal">Đồng ý</a>
        </div>
        <div class="modal-footer">
          <!--         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        </div>
      </div>

    </div>
  </div>
</body>

</html>

<script type="text/javascript" src="{{asset('js/confirm.js')}}">

</script>