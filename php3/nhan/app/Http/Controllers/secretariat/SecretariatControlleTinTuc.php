<?php

namespace App\Http\Controllers\secretariat;


use Illuminate\Http\Request;
use App\Models\tin;
use App\Models\ykien;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class SecretariatControlleTinTuc extends Controller
{ /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public $pages = [
       ['link' => '/secretariat', 'ten' => 'Trang Chủ'],
   ];

   public $data;
    public function index()
    {   
        $ds =  tin::where('role_tin', '=', 4)->orderBy('idTin','desc')->get();
        $page = ['link' => '/tin', 'ten' => 'Danh Sách Tin Tức'];

        $this->pages[] = $page;

        $this->data = [
            'ds' => $ds,
            'pages' => $this->pages,
        ];

        return view('secretariat.tintuc.index', $this->data);
    }
}
