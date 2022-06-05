<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\loaibaibao;
use App\Models\loaiquangcao;
use App\Models\quangcao;
use Illuminate\Http\Request;
use App\Models\tin;
use App\Models\ykien;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DB;
use App\Models\quangcaobaibao;
use App\Models\quangcaotong;
use Carbon\Carbon;

class UserQuangCaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $pages = [
        ['link' => '/quangcao', 'ten' => 'Trang Chủ'],
    ];

    public $data;

    public function index()
    {
        
        $img = quangcaotong::all()->where('id_quangcaobaibao','=',0);
        $baibao = quangcaotong::all()->where('id_quangcao','=',0);
            // print dd($ds->loai_quangcao);
            $page = ['link' => '/quangcao', 'ten' => 'Danh Sách Yêu Cầu Quảng Cáo'];

            $this->pages[] = $page;

            $this->data = [
                'img' => $img,
                'baibao' => $baibao,
                'pages' => $this->pages,
            ];
        
        
       

            return view('site.quangcao.quangcao', $this->data);

    }

    public function indexImg()
    {
        $ds = quangcao::where('quangcao.loai_quangcao', '=', 'Quảng cáo ảnh')->orderby('id_quangcao', 'desc')->get();
        
        $id_editor = quangcao::join('users','quangcao.id_editor', '=', 'users.idUser')->first();
        if($id_editor != null){
        $hoten =  $id_editor->hoten;
        $page = ['link' => '/quangcao', 'ten' => 'Danh Sách Yêu Cầu Quảng Cáo'];
        $this->pages[] = $page;
        $this->data = [
            'ds' => $ds,
            'hoten' => $hoten,
            'pages' => $this->pages,
        ];
        }else{
            $page = ['link' => '/quangcao', 'ten' => 'Danh Sách Yêu Cầu Quảng Cáo'];
            $this->pages[] = $page;
    
            $this->data = [
                'ds' => $ds,
                'hoten' => "null",

                'pages' => $this->pages,
            ];
        }
      

        return view('site.quangcao.hinhanh.quangcaoimg', $this->data);
    }


    public function indexNews()
    {
        $ds = quangcaobaibao::where('quangcaobaibao.loai_quangcao', '=', 'Báo quảng cáo')->get();
        $page = ['link' => '/quangcao', 'ten' => 'Danh Sách Yêu Cầu Quảng Cáo'];

        $this->pages[] = $page;

        $this->data = [
            'ds' => $ds,
            'pages' => $this->pages,
        ];

        return view('site.quangcao.baopr.quangcao', $this->data);
    }
    public function editlist($id)
    {
        $row = quangcaobaibao::find($id);

        $page = ['link' => '/quangcaobaibao', 'ten' => 'Loại Tin'];
        $page_2 = ['link' => false, 'ten' => 'Cập Nhật'];
        array_push($this->pages, $page, $page_2);

        $this->data = [
            'pages' => $this->pages,
            'row' => $row,
        ];

        if ($row == null) {
            echo "Không tồn tại loại tin này";
            return;
        } else {
            return view("site.quangcao.baopr.edit", $this->data);
        }
    }

    public function destroylist($id)
    {
        $ykien = quangcaobaibao::find($id);
        if ($ykien == null) {
            return redirect('/quangcaoNews')->with('mess', 'Dịch vụ không tồn tại')->with('class', 'danger');
        } else {
            $ykien->delete();
            return redirect('/quangcaoNews')->with('mess', 'Đã xóa ý kiến id = ' . $id)->with('class', 'primary');
        }
    }

    public function updatelistNews(Request $request, $id)
    {
        // $time = DB::table('loaiquangcao')->where('loaiquangcao.id', '=', $tmp)->first();
        // print dd($tmp);
        $arrUrlHinh = explode("/", $request->get('urlHinh'));
        $thoigianyeucau =  DB::table('quangcaobaibao')->where('quangcaobaibao.id', '=', $id)->first();

        // $thoigianhethan =  $thoigianyeucau + $timequangcao;
        $lengArr = count($arrUrlHinh);
        $lengArr = (int)$lengArr;
        $localOfUrlHinh = $lengArr - 1;
        $endurl = $arrUrlHinh[$localOfUrlHinh];
        $urlHinh =  $endurl;

        $tl = quangcaobaibao::find($id);
        $tl->yeucau =   $request->get('yeucau');
        $tl->noidung =  $request->get('noidung');
        $tl->urlHinh = $urlHinh;
        $tl->ngayyeucau = $thoigianyeucau->ngayyeucau;
        $tl->ngayduocduyet = 0;

        $tl->save();

        return redirect('/quangcaoNews')->with('mess', 'Cập nhật thành công!')->with('class', 'primary');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = ['link' => '/quangcao', 'ten' => 'Tin Tức'];
        $page_2 = ['link' => false, 'ten' => 'Thêm Mới'];
        array_push($this->pages, $page, $page_2);

        $this->data = [
            'pages' => $this->pages,
        ];
        return view('site.quangcao.hinhanh.create', $this->data);
    }

    public function createNewsPr()
    {
        $page = ['link' => '/quangcao', 'ten' => 'Tin Tức'];
        $page_2 = ['link' => false, 'ten' => 'Thêm Mới'];
        array_push($this->pages, $page, $page_2);

        $this->data = [
            'pages' => $this->pages,
        ];
        return view('site.quangcao.baopr.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $arrUrlHinh = explode("/", $request->get('urlHinh'));
        $lengArr = count($arrUrlHinh);
        $lengArr = (int)$lengArr;
        $localOfUrlHinh = $lengArr - 1;
        $endurl = $arrUrlHinh[$localOfUrlHinh];
        $urlHinh =  $endurl;

        $tmp =  $request->get('id_loaiquangcao');        
        $lqc =  loaiquangcao::find($tmp);
        $time = DB::table('loaiquangcao')->where('loaiquangcao.id', '=', $tmp)->first();
        $timequangcao =  $time->thoigian;
        $thoigianyeucau = Carbon::now()->timestamp;
        $thoigianhethan =  $thoigianyeucau + $timequangcao;
        // print dd($timequangcao);

        // print dd($thoigianyeucau);

        // foreach($time as $value){
        //     $thoigianhethan =  $thoigianyeucau + $value;
        // }
        $t = new quangcao([
            'urlHinh' => $urlHinh,
            'loai_quangcao' => 'Quảng cáo ảnh',
            'id_loaiquangcao' =>  $tmp,
            'role_quangcao' => 0,
            'yeucau'        => $request->get('yeucau'),
            'id_editor'    => 0,
            'idUser' => Auth::id(),
            'thoigianyeucau' => $thoigianyeucau,
            'thoigianhethan' => $thoigianhethan,

        ]);

        $t->save();
        $tmp =  date("Y-m-d H:i:s ", substr("$thoigianyeucau", 0, 10));
        $month = date("m", strtotime($tmp));
        $tqc = new quangcaotong([
            'id_quangcao' => $t->id_quangcao,
            'role_quangcao' => 0,
            'id_quangcaobaibao' => 0,
            'giatien'    => $lqc->gialoai,
            'thang'        => $month,
        ]);
        $tqc->save();
        return redirect('/quangcao')->with('mess', 'Tin mới đã được lưu')->with('class', 'primary');
    }

    public function storelist(Request $request)
    {
        
        $arrUrlHinh = explode("/", $request->get('urlHinh'));
        $lengArr = count($arrUrlHinh);
        $lengArr = (int)$lengArr;
        $localOfUrlHinh = $lengArr - 1;
        $endurl = $arrUrlHinh[$localOfUrlHinh];
        $urlHinh =  $endurl;
        $id_loaibaibao =  $request->get('id_loaibaibao');

        $lbb =  loaibaibao::find($id_loaibaibao);
        $thoigianyeucau = Carbon::now()->timestamp;
        // print dd($timequangcao);

        // print dd($thoigianyeucau);

        // foreach($time as $value){
        //     $thoigianhethan =  $thoigianyeucau + $value;
        // }
        $t = new quangcaobaibao([
            'id_loaibaibao' =>$id_loaibaibao,
            'urlHinh' => $urlHinh,
            'yeucau' => $request->get('yeucau'),
            'loai_quangcao' => 'Báo quảng cáo',
            'noidung'       => $request->get('noidung'),
            'id_editor'     => 0,
            'role_quangcao' => 0,
            'idUser' => Auth::id(),
            'ngayyeucau' => $thoigianyeucau,
            'ngayduocduyet' => 0,

        ]);
        $t->save();
        $tmp =  date("Y-m-d H:i:s ", substr("$thoigianyeucau", 0, 10));
        $month = date("m", strtotime($tmp));
        $tqc = new quangcaotong([
            'id_quangcao' => 0,
            'role_quangcao' => 0,
            'id_quangcaobaibao' => $t->id,
            'giatien' => $lbb->gialoai,
            'thang'   => $month,
        ]);
        $tqc->save();
        return redirect('/quangcaoNews')->with('mess', 'Tin mới đã được lưu')->with('class', 'primary');
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
        $row = quangcao::find($id);

        $page = ['link' => '/tintuc', 'ten' => 'Tin Tức'];
        $page_2 = ['link' => false, 'ten' => 'Cập Nhật'];
        array_push($this->pages, $page, $page_2);

        $this->data = [
            'pages' => $this->pages,
            'row' => $row,
        ];

        if ($row == null) {
            echo "Không tồn tại loại tin này";
            return;
        } else {
            return view("site.quangcao.hinhanh.edit", $this->data);
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
        $tmp =  $request->get('id_loaiquangcao');
        $time = DB::table('loaiquangcao')->where('loaiquangcao.id', '=', $tmp)->first();
        // print dd($tmp);
        $timequangcao =  $time->thoigian;
        $arrUrlHinh = explode("/", $request->get('urlHinh'));
        $thoigianyeucau = Carbon::now()->timestamp;
        $thoigianhethan =  $thoigianyeucau + $timequangcao;
        $lengArr = count($arrUrlHinh);
        $lengArr = (int)$lengArr;
        $localOfUrlHinh = $lengArr - 1;
        $endurl = $arrUrlHinh[$localOfUrlHinh];
        $urlHinh =  $endurl;



        $tl = quangcao::find($id);
        $tl->urlHinh = $urlHinh;

        $tl->id_quangcao = $tmp;
        $tl->thoigianyeucau = $thoigianyeucau;
        $tl->thoigianhethan = $thoigianhethan;

        $tl->save();

        return redirect('/quangcao')->with('mess', 'Cập nhật thành công!')->with('class', 'primary');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ykien = quangcao::find($id);
        
        if ($ykien == null) {
            return redirect('/quangcaoImg')->with('mess', 'Dịch vụ không tồn tại')->with('class', 'danger');
        } else {
            $ykien->delete();
            return redirect('/quangcaoImg')->with('mess', 'Đã xóa ý kiến id = ' . $id)->with('class', 'primary');
        }
    }
}
