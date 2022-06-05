@php

use App\Models\quangcao;
use App\Models\loaiquangcao;
use App\Models\loaibaibao;

use App\Models\User;
use App\Models\quangcaobaibao;




@endphp
<style>
  .styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
  }

  .styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
  }

  .styled-table th,
  .styled-table td {
    padding: 12px 15px;
  }

  .styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
  }

  .styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
  }

  .styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
  }

  .styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
  }

  table#quy {
    margin-left: 417px;
    margin-top: -631px;
  }

  table#nam {
    margin-left: 856px;
    margin-top: -214px;
  }
  
</style>

<center>
  <h2>
    <b>
      <i>
        Doanh Thu Tổng (Dịch Vụ && Nạp Tiền && Quảng Cáo )
      </i>
    </b>
  </h2>
</center>
<table class="styled-table">
  <thead>
    <tr>
      <th>Doanh thu Tháng</th>
      <th>Tiền</th>
    </tr>
  </thead>
  <tbody>
    
   
      <tr class="active-row">
       <td>Tháng 1
        </td>
        <td>{{$thang1}}$</td>

      </td>
      </tr>
      <tr class="active-row">
       <td>Tháng 2
        </td>
        <td>{{$thang2}}$</td>

      </td>
      </tr>
      <tr class="active-row">
       <td>Tháng 3
        </td>
        <td>{{$thang3}}$</td>

      </td>
      </tr>
      <tr class="active-row">
       <td>Tháng 4
        </td>
        <td>{{$thang4}}$</td>

      </td>
      </tr>
      <tr class="active-row">
       <td>Tháng 5
        </td>
        <td>{{$thang5}}$</td>

      </td>
      </tr>
      <tr class="active-row">
       <td>Tháng 6
        </td>
        <td>{{$thang6}}$</td>

      </td>
      </tr>
      <tr class="active-row">
       <td>Tháng 7
        </td>
        <td>{{$thang7}}$</td>

      </td>
      </tr>
      <tr class="active-row">
       <td>Tháng 8
        </td>
        <td>{{$thang8}}$</td>

      </td>
      </tr>
      <tr class="active-row">
       <td>Tháng 9
        </td>
        <td>{{$thang9}}$</td>

      </td>
      </tr>
      <tr class="active-row">
       <td>Tháng 10
        </td>
        <td>{{$thang10}}$</td>

      </td>
      </tr>
      <tr class="active-row">
       <td>Tháng 11
        </td>
        <td>{{$thang11}}$</td>

      </td>
      </tr>
      <tr class="active-row">
       <td>Tháng 12
        </td>
        <td>{{$thang12}}$</td>

      </td>
      </tr>
   
  </tbody>
</table>

<table class="styled-table" id="quy">
  <thead>
    <tr>
      <th>Doanh Thu Quý</th>
      <th>$</th>
    </tr>
  </thead>
  <tbody>
   
      <tr class="active-row">
        <td>Quý 1</td>
        <td>{{$doanhthuquy1}}$</td>
      </tr>
      <tr class="active-row">
        <td>Quý 2</td>
        <td>{{$doanhthuquy2}}$</td>
      </tr>
      <tr class="active-row">
        <td>Quý 3</td>
        <td>{{$doanhthuquy3}}$</td>
      </tr>
      <tr class="active-row">
        <td>Quý 4</td>
        <td>{{$doanhthuquy4}}$</td>
      </tr>


    <!-- and so on... -->
  </tbody>
</table>


<table class="styled-table" id="nam">
  <thead>
    <tr>
      <th>Doanh thu Năm</th>
      <th>Tiền</th>
    </tr>
  </thead>
  <tbody>
      <tr class="active-row">
        <td>Năm 2021</td>
        <td>{{$doanhthunam}}$</td>
      </tr>
 


    <!-- and so on... -->
  </tbody>
</table>


<br><br><br><br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br><br>
<br>
<br>
<br>
<br>
<br>
<hr>
<br>
<br>


</table>