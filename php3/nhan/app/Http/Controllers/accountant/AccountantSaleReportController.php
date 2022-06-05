<?php

namespace App\Http\Controllers\accountant;

use App\Http\Controllers\Controller;
use App\Models\dichvu;
use App\Models\doanhthu;
use App\Models\giaodich;
use App\Models\quangcaotong;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ykien;
use App\Models\tin;
use App\Models\tongdichvu;
use DateTime;
use DB;

use Illuminate\Support\Facades\Auth;

class AccountantSaleReportController extends Controller
{
    public $pages = [
        ['link' => '/accountant', 'ten' => 'Trang Chủ'],
    ];

    public $data;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        $indexGoi = tongdichvu::all()->where('role_tongdv','=',1)->where('id_nap','=',0);
        $indexNap= tongdichvu::all()->where('role_tongdv','=',1)->where('id_giaodich','=',0);
        $getmoney12nap =  DB::table('tongdichvu')->where('role_tongdv','=',1)->where('id_giaodich','=',0)->where('thang', '=',12)->sum('sotien'); 
        $getmoney11nap =  DB::table('tongdichvu')->where('role_tongdv','=',1)->where('id_giaodich','=',0)->where('thang', '=',11)->sum('sotien');  
        $getmoney10nap =  DB::table('tongdichvu')->where('role_tongdv','=',1)->where('id_giaodich','=',0)->where('thang', '=',10)->sum('sotien');  
        $getmoney9nap =  DB::table('tongdichvu')->where('role_tongdv','=',1)->where('id_giaodich','=',0)->where('thang', '=',9)->sum('sotien');  
        $getmoney8nap =  DB::table('tongdichvu')->where('role_tongdv','=',1)->where('id_giaodich','=',0)->where('thang', '=',8)->sum('sotien');  
        $getmoney7nap =  DB::table('tongdichvu')->where('role_tongdv','=',1)->where('id_giaodich','=',0)->where('thang', '=',7)->sum('sotien');  
        $getmoney6nap =  DB::table('tongdichvu')->where('role_tongdv','=',1)->where('id_giaodich','=',0)->where('thang', '=',6)->sum('sotien');  
        $getmoney5nap =  DB::table('tongdichvu')->where('role_tongdv','=',1)->where('id_giaodich','=',0)->where('thang', '=',5)->sum('sotien');  
        $getmoney4nap =  DB::table('tongdichvu')->where('role_tongdv','=',1)->where('id_giaodich','=',0)->where('thang', '=',4)->sum('sotien');  
        $getmoney3nap =  DB::table('tongdichvu')->where('role_tongdv','=',1)->where('id_giaodich','=',0)->where('thang', '=',3)->sum('sotien');  
        $getmoney2nap =  DB::table('tongdichvu')->where('role_tongdv','=',1)->where('id_giaodich','=',0)->where('thang', '=',2)->sum('sotien');  
        $getmoney1nap =  DB::table('tongdichvu')->where('role_tongdv','=',1)->where('id_giaodich','=',0)->where('thang', '=',1)->sum('sotien');   
            
        $getmoney12 =  DB::table('tongdichvu')->where('role_tongdv','=',1)->where('id_nap','=',0)->where('thang', '=',12)->sum('sotien'); 
        $getmoney11 =  DB::table('tongdichvu')->where('role_tongdv','=',1)->where('id_nap','=',0)->where('thang', '=',11)->sum('sotien');  
        $getmoney10 =  DB::table('tongdichvu')->where('role_tongdv','=',1)->where('id_nap','=',0)->where('thang', '=',10)->sum('sotien');  
        $getmoney9 =  DB::table('tongdichvu')->where('role_tongdv','=',1)->where('id_nap','=',0)->where('thang', '=',9)->sum('sotien');  
        $getmoney8 =  DB::table('tongdichvu')->where('role_tongdv','=',1)->where('id_nap','=',0)->where('thang', '=',8)->sum('sotien');  
        $getmoney7 =  DB::table('tongdichvu')->where('role_tongdv','=',1)->where('id_nap','=',0)->where('thang', '=',7)->sum('sotien');  
        $getmoney6 =  DB::table('tongdichvu')->where('role_tongdv','=',1)->where('id_nap','=',0)->where('thang', '=',6)->sum('sotien');  
        $getmoney5 =  DB::table('tongdichvu')->where('role_tongdv','=',1)->where('id_nap','=',0)->where('thang', '=',5)->sum('sotien');  
        $getmoney4 =  DB::table('tongdichvu')->where('role_tongdv','=',1)->where('id_nap','=',0)->where('thang', '=',4)->sum('sotien');  
        $getmoney3 =  DB::table('tongdichvu')->where('role_tongdv','=',1)->where('id_nap','=',0)->where('thang', '=',3)->sum('sotien');  
        $getmoney2 =  DB::table('tongdichvu')->where('role_tongdv','=',1)->where('id_nap','=',0)->where('thang', '=',2)->sum('sotien');  
        $getmoney1 =  DB::table('tongdichvu')->where('role_tongdv','=',1)->where('id_nap','=',0)->where('thang', '=',1)->sum('sotien'); 
                
      $thang1 = $getmoney1+$getmoney1nap;
      $thang2 = $getmoney2+$getmoney2nap;
      $thang3 = $getmoney3+$getmoney3nap;
      $thang4 = $getmoney4+$getmoney4nap;
      $thang5 = $getmoney5+$getmoney5nap;
      $thang6 = $getmoney6+$getmoney6nap;
      $thang7 = $getmoney7+$getmoney7nap;
      $thang8 = $getmoney8+$getmoney8nap;
      $thang9 = $getmoney9+$getmoney9nap;
      $thang10 = $getmoney10+$getmoney10nap;
      $thang11 = $getmoney11+$getmoney11nap;
      $thang12 = $getmoney12+$getmoney12nap;


        $doanhthuquy1 = $thang1+$thang2+$thang3;
        $doanhthuquy2 = $thang4+$thang5+$thang6;
        $doanhthuquy3 = $thang7+$thang8+$thang9;
        $doanhthuquy4 = $thang10+$thang11+$thang12;

        $doanhthunam = $thang1+$thang2+$thang3+$thang4+$thang5+$thang6+$thang7+$thang8+$thang9+$thang11+$thang12;
         $page = ['link' => '/user', 'ten' => 'Danh Sách Users'];
        $this->pages[] = $page;
        $this->data = [
            'indexGoi' => $indexGoi,
            'indexNap' => $indexNap,
            'thang1' =>  $thang1,
            'thang2' =>  $thang2,
            'thang3' =>  $thang3,
            'thang4' =>  $thang4,
            'thang5' =>  $thang5,
            'thang6' =>  $thang6,
            'thang7' =>  $thang7,
            'thang8' =>  $thang8,
            'thang9' =>  $thang9,
            'thang10' =>  $thang10,
            'thang11' =>  $thang11,
            'thang12' =>  $thang12,
            'doanhthuquy1' =>  $doanhthuquy1,
            'doanhthuquy2' =>  $doanhthuquy2,
            'doanhthuquy3' =>  $doanhthuquy3,
            'doanhthuquy4' =>  $doanhthuquy4,
            'doanhthunam' =>  $doanhthunam,

            'pages' => $this->pages,
        ];

        return view('accountant.SaleReport.doanhthu.index', $this->data);
        

        
 
}
public function indexSaleReportQuangcao()
{
    $indexQuangCaoAnh=  quangcaotong::all()->where('id_quangcaobaibao', '=',0)->where('role_quangcao','=',0);
    $indexQuangCaoBao =  quangcaotong::all()->where('id_quangcao', '=',0)->where('role_quangcao','=',0);

        $getmoney12nap =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcaobaibao','=',0)->where('thang', '=',12)->sum('giatien'); 
        $getmoney11nap =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcaobaibao','=',0)->where('thang', '=',11)->sum('giatien');  
        $getmoney10nap =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcaobaibao','=',0)->where('thang', '=',10)->sum('giatien');  
        $getmoney9nap =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcaobaibao','=',0)->where('thang', '=',9)->sum('giatien');  
        $getmoney8nap =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcaobaibao','=',0)->where('thang', '=',8)->sum('giatien');  
        $getmoney7nap =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcaobaibao','=',0)->where('thang', '=',7)->sum('giatien');  
        $getmoney6nap =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcaobaibao','=',0)->where('thang', '=',6)->sum('giatien');  
        $getmoney5nap =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcaobaibao','=',0)->where('thang', '=',5)->sum('giatien');  
        $getmoney4nap =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcaobaibao','=',0)->where('thang', '=',4)->sum('giatien');  
        $getmoney3nap =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcaobaibao','=',0)->where('thang', '=',3)->sum('giatien');  
        $getmoney2nap =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcaobaibao','=',0)->where('thang', '=',2)->sum('giatien');  
        $getmoney1nap =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcaobaibao','=',0)->where('thang', '=',1)->sum('giatien');   
            
        $getmoney12 =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcao','=',0)->where('thang', '=',12)->sum('giatien'); 
        $getmoney11 =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcao','=',0)->where('thang', '=',11)->sum('giatien');  
        $getmoney10 =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcao','=',0)->where('thang', '=',10)->sum('giatien'); 
        $getmoney9 =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcao','=',0)->where('thang', '=',9)->sum('giatien');   
        $getmoney8 =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcao','=',0)->where('thang', '=',8)->sum('giatien');  
        $getmoney7 =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcao','=',0)->where('thang', '=',7)->sum('giatien');  
        $getmoney6 =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcao','=',0)->where('thang', '=',6)->sum('giatien');  
        $getmoney5 =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcao','=',0)->where('thang', '=',5)->sum('giatien');  
        $getmoney4 =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcao','=',0)->where('thang', '=',4)->sum('giatien');  
        $getmoney3 =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcao','=',0)->where('thang', '=',3)->sum('giatien');  
        $getmoney2 =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcao','=',0)->where('thang', '=',2)->sum('giatien');  
        $getmoney1 =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcao','=',0)->where('thang', '=',1)->sum('giatien'); 
                
      $thang1 = $getmoney1+$getmoney1nap;
      $thang2 = $getmoney2+$getmoney2nap;
      $thang3 = $getmoney3+$getmoney3nap;
      $thang4 = $getmoney4+$getmoney4nap;
      $thang5 = $getmoney5+$getmoney5nap;
      $thang6 = $getmoney6+$getmoney6nap;
      $thang7 = $getmoney7+$getmoney7nap;
      $thang8 = $getmoney8+$getmoney8nap;
      $thang9 = $getmoney9+$getmoney9nap;
      $thang10 = $getmoney10+$getmoney10nap;
      $thang11 = $getmoney11+$getmoney11nap;
      $thang12 = $getmoney12+$getmoney12nap;


        $doanhthuquy1 = $thang1+$thang2+$thang3;
        $doanhthuquy2 = $thang4+$thang5+$thang6;
        $doanhthuquy3 = $thang7+$thang8+$thang9;
        $doanhthuquy4 = $thang10+$thang11+$thang12;
        $doanhthunam = $thang1+$thang2+$thang3+$thang4+$thang5+$thang6+$thang7+$thang8+$thang9+$thang11+$thang12;

     $page = ['link' => '/user', 'ten' => 'Danh Sách Users'];
    $this->pages[] = $page;
    $this->data = [
       'indexQuangCaoAnh' => $indexQuangCaoAnh,
       'indexQuangCaoBao' => $indexQuangCaoBao,
       'thang1' =>  $thang1,
       'thang2' =>  $thang2,
       'thang3' =>  $thang3,
       'thang4' =>  $thang4,
       'thang5' =>  $thang5,
       'thang6' =>  $thang6,
       'thang7' =>  $thang7,
       'thang8' =>  $thang8,
       'thang9' =>  $thang9,
       'thang10' =>  $thang10,
       'thang11' =>  $thang11,
       'thang12' =>  $thang12,
       'doanhthuquy1' =>  $doanhthuquy1,
       'doanhthuquy2' =>  $doanhthuquy2,
       'doanhthuquy3' =>  $doanhthuquy3,
       'doanhthuquy4' =>  $doanhthuquy4,
       'doanhthunam' =>  $doanhthunam,
        'pages' => $this->pages,
    ];

    return view('accountant.SaleReport.SaleReportQuangcao.index', $this->data);
    

    

}
public function store()
{
  $year = doanhthu::join('giaodich','giaodich.id_giaodich','=','doanhthu.id_giaodich')
  ->join('dichvu', 'dichvu.id_DichVu','=','giaodich.id_DichVu')
  ->where('giaodich.loai', '=',"Combo")
  ->where("dichvu.ten_dv",'=','Year')
  ->sum('doanhthu.sotien');

  $precious = doanhthu::join('giaodich','giaodich.id_giaodich','=','doanhthu.id_giaodich')
  ->join('dichvu', 'dichvu.id_DichVu','=','giaodich.id_DichVu')
  ->where('giaodich.loai', '=',"Combo")
  ->where("dichvu.ten_dv",'=','precious')
  ->sum('doanhthu.sotien');


  $month = doanhthu::join('giaodich','giaodich.id_giaodich','=','doanhthu.id_giaodich')
  ->join('dichvu', 'dichvu.id_DichVu','=','giaodich.id_DichVu')
  ->where('giaodich.loai', '=',"Combo")
  ->where("dichvu.ten_dv",'=','month')
  ->sum('doanhthu.sotien');

  $doanhthu = $year + $month + $precious;
  $checktime = doanhthu::join('giaodich','giaodich.id_giaodich','=','doanhthu.id_giaodich')->get();
  foreach($checktime as $value){
        $time =  $value->thoigianmua;
            $t = date('m', $time);
            $monthNum  = $t;
            $dateObj   = DateTime::createFromFormat('!m', $monthNum);
            $monthName = $dateObj->format('F');
  }
 

  $naptien = doanhthu::join('naptien', 'doanhthu.id_nap','=', 'naptien.id_nap')->join('users','users.idUser','=','naptien.idUser')->get();
  $doanhthunap = doanhthu::join('naptien', 'doanhthu.id_nap','=', 'naptien.id_nap')->join('users','users.idUser','=','naptien.idUser')->sum('doanhthu.sotien');

    $page = ['link' => '/user', 'ten' => 'Danh Sách Users'];
    $this->pages[] = $page;

    $this->data = [
        'year' => $year,
        'precious' => $precious,
        'month'  => $month,
        'doanhthu'=> $doanhthu,
        'monthName' => $monthName,
        'naptien'  => $naptien,
        'doanhthunap' => $doanhthunap,
        'pages' => $this->pages,
    ];

    return view('accountant.SaleReport.index', $this->data);
}

}