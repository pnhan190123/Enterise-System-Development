<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ykien;
use App\Models\tin;
use App\Models\tongdichvu;
use App\Models\quangcaotong;
use App\Models\doanhthu;
use DB;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public $pages = [
        ['link' => '/admin', 'ten' => 'Trang Chủ'],
    ];

    public $data;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ds = User::where('idUSer','!=', Auth::id())->whereIN('idgroup',array(1,2,3,5))->get();
        $page = ['link' => '/user', 'ten' => 'Danh Sách Users'];
        $this->pages[] = $page;

        $this->data = [
            'ds' => $ds,
            'pages' => $this->pages,
        ];

        return view('admin.user.index', $this->data);
    }
    public function indexUser()
    {
        $ds = User::where('idUSer','!=', Auth::id())->where('idgroup','=',0)->get();
        $page = ['link' => '/user', 'ten' => 'Danh Sách Users'];
        $this->pages[] = $page;

        $this->data = [
            'ds' => $ds,
            'pages' => $this->pages,
        ];

        return view('admin.user.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = ['link' => '/user', 'ten' => 'User'];
        $page_2 = ['link' => false, 'ten' => 'Thêm Mới'];
        array_push($this->pages, $page, $page_2);

        $this->data = [
            'pages' => $this->pages,
        ];
        return view('admin.user.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lt = new User([
            'Ten' => $request->get('Ten'),
            'ThuTu' => $request->get('ThuTu'),
            'AnHien' => $request->get('AnHien'),
            'idTL' => $request->get('idTL'),
            'lang' => $request->get('lang'),
        ]);
        $lt->save();

        return redirect('/admin/user')->with('mess', 'Loại tin đã được lưu')->with('class', 'primary');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = User::find($id);

        $page = ['link' => '/user', 'ten' => 'User'];
        $page_2 = ['link' => false, 'ten' => 'Cập Nhật'];
        array_push($this->pages, $page, $page_2);

        $this->data = [
            'pages' => $this->pages,
            'row' => $row,
        ];

        if ($row == null) {
            return redirect('/admin/user')->with('mess', 'Không tồn tại user')->with('class', 'warning');
        } else {
            return view("admin.user.edit", $this->data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lt = User::find($id);
        $lt->Ten = $request->get('Ten');
        $lt->ThuTu = $request->get('ThuTu');
        $lt->AnHien = $request->get('AnHien');
        $lt->idTL = $request->get('idTL');
        $lt->lang = $request->get('lang');
        $lt->save();
        return redirect('/admin/loaitin')->with('mess', 'Cập nhật thành công!')->with('class', 'primary');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user == null) {
            return redirect('/admin/loaitin')->with('mess', 'User không tồn tại')
                ->with('class', 'danger');
        } else {
            $countTin = tin::where('idUser', $id)->count();
            $countYkien = ykien::where('idUser', $id)->count();

            if ($countTin == 0 && $countYkien == 0) {
                $user->delete();
                return redirect('/admin/user')->with('mess', 'Đã xóa user id = ' . $id)->with('class', 'primary');
            }
            if ($countTin == 0 && $countYkien > 0) {
                $mess = 'User ID ' . $id . ' còn '.$countYkien.' ý kiến nên không thể xóa';
            } else if ($countTin > 0 && $countYkien == 0) {
                $mess = 'User ID ' . $id . ' còn '.$countTin.' tin nên không thể xóa';
            } else {
                $mess = 'User ID ' . $id . ' còn '.$countTin.' tin, '.$countYkien.' ý kiến nên không thể xóa';
            }

            return redirect('/admin/user')->with('mess', $mess)->with('class', 'danger')->with('id', $id)->with('route', 'user');

        }
    }

    public function destroy_all($id) {
        $tin = tin::where('idUser', $id)->delete();
        $yKien = ykien::where('idUser', $id)->delete();
        $user = User::where('idUser', $id)->delete();
        return redirect('/admin/user')->with('mess', 'Đã xóa user id = ' . $id . ' Và tất cả tin, ý kiến của user này')->with('class', 'primary');
    }

    public function changeActive($id, $active, Request $request) {
        $user = User::find($id);
        if($user->idgroup ==  5){
            $user = User::find($id);
            $user->active = $active;
            $user->save();
        }else{
                $chucvu =  $request->get('chucvu');
                $user = User::find($id);
                $user->active = $active;
                $user->idgroup =  $chucvu;
                $user->save();
        }
   
           
            if($user->idgroup == 0){
                return redirect('/admin/listuser')->with('mess', 'Đổi trạng thái kích hoạt cho user id = ' .$id. ' thành công')->with('class', 'primary');

            }else{
                return redirect('/admin/user')->with('mess', 'Đổi trạng thái kích hoạt cho user id = ' .$id. ' thành công')->with('class', 'primary');

            }
    }
    public function reportTong(){

        $indexQuangCaoAnh=  quangcaotong::all()->where('id_quangcaobaibao', '=',0)->where('role_quangcao','=',1);
        $indexQuangCaoBao =  quangcaotong::all()->where('id_quangcao', '=',0)->where('role_quangcao','=',1);
    
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


            
        $getmoney12Anh =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcaobaibao','=',0)->where('thang', '=',12)->sum('giatien'); 
        $getmoney11Anh =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcaobaibao','=',0)->where('thang', '=',11)->sum('giatien');  
        $getmoney10Anh =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcaobaibao','=',0)->where('thang', '=',10)->sum('giatien');  
        $getmoney9Anh =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcaobaibao','=',0)->where('thang', '=',9)->sum('giatien');  
        $getmoney8Anh =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcaobaibao','=',0)->where('thang', '=',8)->sum('giatien');  
        $getmoney7Anh =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcaobaibao','=',0)->where('thang', '=',7)->sum('giatien');  
        $getmoney6Anh =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcaobaibao','=',0)->where('thang', '=',6)->sum('giatien');  
        $getmoney5Anh =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcaobaibao','=',0)->where('thang', '=',5)->sum('giatien');  
        $getmoney4Anh =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcaobaibao','=',0)->where('thang', '=',4)->sum('giatien');  
        $getmoney3Anh =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcaobaibao','=',0)->where('thang', '=',3)->sum('giatien');  
        $getmoney2Anh =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcaobaibao','=',0)->where('thang', '=',2)->sum('giatien');  
        $getmoney1Anh=  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcaobaibao','=',0)->where('thang', '=',1)->sum('giatien');   
            
        $getmoney12Bao =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcao','=',0)->where('thang', '=',12)->sum('giatien'); 
        $getmoney11Bao =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcao','=',0)->where('thang', '=',11)->sum('giatien');  
        $getmoney10Bao =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcao','=',0)->where('thang', '=',10)->sum('giatien'); 
        $getmoney9Bao =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcao','=',0)->where('thang', '=',9)->sum('giatien');   
        $getmoney8Bao =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcao','=',0)->where('thang', '=',8)->sum('giatien');  
        $getmoney7Bao =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcao','=',0)->where('thang', '=',7)->sum('giatien');  
        $getmoney6Bao =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcao','=',0)->where('thang', '=',6)->sum('giatien');  
        $getmoney5Bao =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcao','=',0)->where('thang', '=',5)->sum('giatien');  
        $getmoney4Bao =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcao','=',0)->where('thang', '=',4)->sum('giatien');  
        $getmoney3Bao =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcao','=',0)->where('thang', '=',3)->sum('giatien');  
        $getmoney2Bao =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcao','=',0)->where('thang', '=',2)->sum('giatien');  
        $getmoney1Bao =  DB::table('quangcaotong')->where('role_quangcao','=',1)->where('id_quangcao','=',0)->where('thang', '=',1)->sum('giatien'); 
                    
          $thang1 = $getmoney1+$getmoney1nap+$getmoney1Bao+$getmoney1Anh;
          $thang2 = $getmoney2+$getmoney2nap+$getmoney2Bao+$getmoney2Anh;
          $thang3 = $getmoney3+$getmoney3nap+$getmoney3Bao+$getmoney3Anh;
          $thang4 = $getmoney4+$getmoney4nap+$getmoney4Bao+$getmoney4Anh;
          $thang5 = $getmoney5+$getmoney5nap+$getmoney5Bao+$getmoney5Anh;
          $thang6 = $getmoney6+$getmoney6nap+$getmoney6Bao+$getmoney6Anh;
          $thang7 = $getmoney7+$getmoney7nap+$getmoney7Bao+$getmoney7Anh;
          $thang8 = $getmoney8+$getmoney8nap+$getmoney8Bao+$getmoney8Anh;
          $thang9 = $getmoney9+$getmoney9nap+$getmoney8Bao+$getmoney8Anh;
          $thang10 = $getmoney10+$getmoney10nap+$getmoney10Bao+$getmoney10Anh;
          $thang11 = $getmoney11+$getmoney11nap+$getmoney11Bao+$getmoney11Anh;
          $thang12 = $getmoney12+$getmoney12nap+$getmoney12Bao+$getmoney12Anh;
    
    
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
    
        return view('admin.doanhthutong.index', $this->data);
        
    }
 
 
}
