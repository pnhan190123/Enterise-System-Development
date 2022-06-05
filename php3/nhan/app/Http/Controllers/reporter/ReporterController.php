<?php

namespace App\Http\Controllers\reporter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tin;
use App\Models\ykien;
use App\Models\loaitin;
use App\Models\theloai;
use App\Models\User;
class ReporterController extends Controller
{
    public $pages = [
        ['link' => '/reporter', 'ten' => 'Quảng Trị'],
    ];

    public $data;

    public function index()
    {
        $ds = tin::orderBy('idTin','desc')->get();
        
        $page = ['link' => '/reporter', 'ten' => 'Trang Chủ'];
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

        return view('reporter.home', $this->data);
    }
}
