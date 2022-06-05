<?php

namespace App\Http\Controllers\accountant;

use App\Http\Controllers\Controller;
use App\Models\giaodich;
use Illuminate\Http\Request;
use App\Models\tin;
use App\Models\ykien;
use App\Models\loaitin;
use App\Models\theloai;
use App\Models\tongdichvu;
use App\Models\naptien;

use App\Models\User;
use DB;

class AccountantControllerCheck extends Controller
{
    public $pages = [
        ['link' => '/accountant', 'ten' => 'Kế toán'],
    ];

    public $data;

    public function index()
    {
        $ds = tongdichvu::join('users', 'tongdichvu.idUser', '=', 'users.idUser')->where('role_tongdv', '=', 0)->get();
        $page = ['link' => '/accountant', 'ten' => 'Trang Chủ'];
        $this->pages[] = $page;
        $this->data = [
            'ds' => $ds,
            'pages' => $this->pages,
            'namePage' => 'Danh Sách khách hàng dùng dịch vụ'
        ];

        return view('accountant.home', $this->data);
    }
    public function destroy($id)
    {
        $ykien = tongdichvu::find($id);
        if ($ykien == null) {
            return redirect('/accountant')->with('mess', 'Ý kiến không tồn tại')->with('class', 'danger');
        } else {
            $ykien->delete();
            return redirect('/accountant')->with('mess', 'Đã xóa ý kiến id = ' . $id)->with('class', 'primary');
        }
    }

    public function changeStatusShow($id)
    {
        $tonggiaodich = tongdichvu::find($id);
        
        // $naptien = naptien::find($id);
        $tmp =  User::join('tongdichvu', 'users.idUser', '=', 'tongdichvu.idUser')->where('tongdichvu.role_tongdv', '=', 0)->first();
        // print dd($tonggiaodich);
        if ($tmp != null) {
            $sodu =  $tmp->sodu;
            $tien =  $tonggiaodich->sotien;
            $loai = $tonggiaodich->loai;
            if ($loai == "Deposit") {
                $t = User::find($tmp->idUser);
                // print dd($t);
                $t->sodu = $sodu + $tien;
                $t->save();
            }
            $checkservice = DB::table('tongdichvu')->join('giaodich', 'giaodich.id_giaodich', '=', 'tongdichvu.id_giaodich')->where('giaodich.role_giaodich', '=', 0)->first();

            // print dd($checkdeposit->role_nap);
            // print dd($t->role_giaodich);
            if($checkservice != null){
                $t = giaodich::find($checkservice->id_giaodich);
                $t->role_giaodich = 1;
                $t->save();
               
              
            }
            $checkdeposit = DB::table('tongdichvu')->join('naptien', 'naptien.id_nap', '=', 'tongdichvu.id_nap')->where('naptien.role_nap', '=', 0)->first();
            if($checkdeposit != null){
                $t = naptien::find($checkdeposit->id_nap);
                $t->role_nap = 1;
                $t->save();
            }
            $tonggiaodich->role_tongdv = 1;
            $tonggiaodich->save();
          
            return redirect('/accountant')->with('mess', 'Duyệt Thành Công id = ' . $id . ' thành công')->with('class', 'primary');
        }
    }
}
