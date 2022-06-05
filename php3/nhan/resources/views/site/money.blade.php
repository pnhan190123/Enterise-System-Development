<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Example of Auto Loading Bootstrap Modal on Page Load</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/money.css')}}">
    

    
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{asset('js/money.js')}}"></script>
</head>
<body>
    <center>
        <div id="myModal" class="modal fade" style="padding-top: 180px;">
            <div class="modal-dialog" style="min-width: 105%; height: 500px;">
                <div class="modal-content" style="height: 120%;">
                    <div class="modal-header">
                        <h5 class="modal-title">Thanh toán</h5>
                        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <section>
                                <div class="container py-5">
                                    <h1 class="text-center pricing">Bootstrap pricing table</h1> <br>
                                    <div class="row text-center align-items-end">
                                    @foreach($dichvu as $value)

                                        <div class="col-lg-4 mb-5 mb-lg-0">
                                            <div class="bg-white p-5 rounded-lg shadow" id="rouded-lg">
                                                <h1 class="h6 text-uppercase font-weight-bold mb-4">{{$value->ten_dv}}</h1>
                                                <h2 class="h1 font-weight-bold"name ="tien_dv">${{$value->tien_dv}}<span class="text-small font-weight-normal ml-2"name="ten_dv">{{$value->ten_dv}}</span></h2>
                                                <div class="custom-separator my-4 mx-auto bg-warning"></div>
                                                <ul class="list-unstyled my-5 text-small text-left">
                                                    <li class="mb-3"> <i class="fa fa-check mr-2 text-primary"></i>{{$value->noidung}}</li>
                                                </ul>
                                              
                                                <a href="/checkout/{{$value->ten_dv}}/{{Auth::id()}}" class="btn btn-warning btn-block p-2 shadow rounded-pill">Đăng kí</a>

                                            
                                            </div>
                                        </div>
                                    @endforeach
                                      
                                    </div>
                                </div>
                            </section>
                        </form>
                    </div>
                </div>
            </div>
    </center>

    </div>
</body>

</html>