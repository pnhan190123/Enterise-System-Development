
<link rel="stylesheet" type="text/css" href="{{asset('css/checkoutDeposit.css')}}">

<h1>Choose Payment</h1>
<p id="choosen-paymenttype">Credit Card</p>
<ul class="payment-types">
  <li class="paymenttype pp unselected-left">
    <div class="box">
      <header>
        <div class="card" id="pp-card">
          <div class="flipper">
            <div class="front">
              <div class="shine"></div>
              <div class="shadow"></div>
              <div class="card-bg">
                <img src="https://play-lh.googleusercontent.com/dQbjuW6Jrwzavx7UCwvGzA_sleZe3-Km1KISpMLGVf1Be5N6hN6-tdKxE5RDQvOiGRg" style="width: 300px; height: 220px;" />
              </div>
            </div>
          </div>
        </div>
      </header>
      <form action="/loading">
        <div class="form-content">
          <p><strong>Thông tin thanh toán</strong></p>
          <p>Hướng dẫn thanh toán</p>
          <ul>
            <li>Quý khách vui lòng chuyển khoản trước và đợi trong vài phút</li>
            <ul><b>Thông tin chuyển khoản</b>
              <hr>
              <li>
                <h1><i>Công ty truyền thông báo ngày mới</i></h1>
              </li>
              <li>
                <h1><i>06868686868</i></h1>
              </li>
              <li>
                <h1><i>Nội dung: Email+ số tiền </i></h1>
              </li>
            </ul>
          </ul>
          <br>  
          <button><span>Xác nhận đã thanh toán</span></button>

        </div>
      </form>
    </div>
  </li>
  <li class="paymenttype selected cc">
    <div class="box">
      <header>
        <div class="card" id="cc-card">
          <div class="flipper">
            <div class="front">
              <div class="shine"></div>
              <div class="shadow"></div>
              <div class="card-bg">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/513985/cc-front-bg.png" />
              </div>
              <div class="card-content">
                <div class="credit-card-type"></div>
                <div class="card-number">
                  <span>1234 1234 1234 1234</span>
                  <span>1234 1234 1234 1234</span>
                </div>
                <div class="card-holder">
                  <em>Card holder</em>
                  <span>Your Name</span>
                  <span>Your Name</span>
                </div>
                <div class="validuntil">
                  <em>Expire</em>
                  <div class="e-month">
                    <span>
                      MM
                    </span>
                    <span>
                      MM
                    </span>
                  </div>
                  <div class="e-divider">
                    <span>
                      /
                    </span>
                    <span>
                      /
                    </span>
                  </div>
                  <div class="e-year">
                    <span>
                      YY
                    </span>
                    <span>
                      YY
                    </span>
                  </div>

                </div>
              </div>
            </div>

            <div class="back">
              <div class="shine"></div>
              <div class="shadow"></div>
              <div class="card-bg">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/513985/cc-back-bg-new.png" />
              </div>
            
              <div class="card-content">
                <div class="card-number">
                  <span>4111 1111 1111 1111</span>
                  <span>4111 1111 1111 1111</span>
                </div>
                <div class="card-holder">
                  <span>Your Name</span>
                  <span>Your Name</span>
                </div>
                <div class="validuntil">
                  <span>
                    <strong class="e-month">MM</strong> / <strong class="e-year">YY</strong>
                  </span>
                  <span>
                    <strong class="e-month">MM</strong> /
                    <strong class="e-year">YY</strong>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>

      <form action="/loading">
      <div class="form-content">
          <p><strong>Thông tin thanh toán</strong></p>
          <p>Hướng dẫn thanh toán</p>
          <ul>
            <li>Quý khách vui lòng chuyển khoản trước và đợi trong vài phút</li>
            <ul><b>Thông tin chuyển khoản</b>
              <hr>
              <li>
                <h1><i>Công ty truyền thông báo ngày mới</i></h1>
              </li>
              <li>
                <h1><i>Số tài khoản: 14694238713</i></h1>
              </li>
              <li>
                <h1><i>Ngân hàng VPBANK (Chi nhánh Bến Thành)</i></h1>
              </li>
              <li>
                <h1><i>Nội dung: Email+ số tiền </i></h1>
              </li>


            </ul>
          </ul>
          <br>
          <button><span>Xác nhận đã thanh toán</span></button>

        </div>
      </form>
    </div>
  </li>
 
</ul>
<script type="text/javascript" src="{{asset('js/checkoutDeposit.js')}}"></script>