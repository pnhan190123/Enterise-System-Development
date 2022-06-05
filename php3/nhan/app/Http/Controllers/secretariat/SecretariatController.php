<?php

namespace App\Http\Controllers\secretariat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tin;
use App\Models\ykien;
use App\Models\loaitin;
use App\Models\theloai;
use App\Models\User;

class SecretariatController extends Controller
{
    public $pages = [
        ['link' => '/secretariat', 'ten' => 'Quảng Trị'],
    ];

    public $data;

    public function index()
    {
        $ds = tin::where('role_tin', '=', 3)->orderBy('idTin','desc')->get();
        
        $page = ['link' => '/secretariat', 'ten' => 'Trang Chủ'];
        $this->pages[] = $page;

        $this->data = [
            'ds' => $ds,
            'pages' => $this->pages,
            'countTin' => tin::count(),
            'countUser' => User::count(),
            'countLoaitin' => loaitin::count(),
            'countTheloai' => theloai::count(),
            'namePage' => 'Tin Tức'
        ];

        return view('secretariat.home', $this->data);
    }
}
