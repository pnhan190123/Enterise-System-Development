<?php

namespace App\Http\Controllers\editor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tin;
use App\Models\ykien;
use App\Models\loaitin;
use App\Models\theloai;
use App\Models\User;

class EditorController extends Controller
{
    public $pages = [
        ['link' => '/editor', 'ten' => 'Quản Trị'],
    ];

    public $data;

    public function index()
    {
        $ds = tin::where('tin.role_tin', '=', 2)->orderby('idTin', 'desc')->get();
        
        $page = ['link' => '/editor', 'ten' => 'Trang Chủ'];
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

        return view('editor.home', $this->data);
    }
}
