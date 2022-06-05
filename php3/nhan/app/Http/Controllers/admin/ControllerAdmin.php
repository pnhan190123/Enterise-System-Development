<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\tin;
use App\Models\ykien;
use App\Models\loaitin;
use App\Models\theloai;
use App\Models\User;

class ControllerAdmin extends Controller
{
    public $pages = [
        ['link' => '/admin', 'ten' => 'Quản Trị'],
    ];

    public $data;

    public function index()
    {
        $ds = tin::where('role_tin','=',0)->orderBy('idTin','desc')->get();
        
        $page = ['link' => '/admin', 'ten' => 'Trang Chủ'];
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

        return view('admin.home', $this->data);
    }}
