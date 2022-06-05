<?php

namespace App\Http\Controllers\editor;

use App\Http\Controllers\Controller;
use App\Models\loaibaibao;
use App\Models\quangcao;
use Illuminate\Http\Request;
use App\Models\tin;
use App\Models\loaiquangcao;
use App\Models\quangcaobaibao;
use App\Models\quangcaotong;
use App\Models\User;
use App\Models\ykien;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;
class QuangcaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $pages = [
        ['link' => '/editor', 'ten' => 'Trang Chủ'],
    ];

    public $data;

    public function index()
    {   
        $ds = quangcaobaibao::where('quangcaobaibao.loai_quangcao', '=', 'Báo quảng cáo')->where('quangcaobaibao.role_quangcao', '=',0)->get();
        $page = ['link' => '/quangcao', 'ten' => 'Danh Sách Yêu Cầu Quảng Cáo'];

        $this->pages[] = $page;

        $this->data = [
            'ds' => $ds,
            'pages' => $this->pages,
        ];

        return view('editor.quangcao.index', $this->data);
    }

    public function indexImg()
    {   
        $ds = quangcao::where('quangcao.loai_quangcao', '=', 'Quảng cáo ảnh')->where('role_quangcao','=',0)->orderby('id_quangcao', 'desc')->get();
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
        

        return view('editor.quangcao.indexImg', $this->data);
    }
    public function indexListDone()
    {   
        $ds = quangcao::where('quangcao.loai_quangcao', '=', 'Quảng cáo ảnh')->where('role_quangcao','=',1)->get();
        $id_editor = quangcao::join('users','quangcao.id_editor', '=', 'users.idUser')->first();
        if($id_editor !=  null){
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
    
                'pages' => $this->pages,
            ];
    
        }
     
        return view('editor.quangcao.indexImg', $this->data);
    }
    
    public function doneNews()
    {   
        $ds = quangcaobaibao::where('quangcaobaibao.loai_quangcao', '=', 'Báo quảng cáo')->where('role_quangcao','=',1)->get();
        $id_editor = quangcaobaibao::join('users','quangcaobaibao.id_editor', '=', 'users.idUser')->first();
       
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
                'pages' => $this->pages,
            ];
        }
      
        return view('editor.quangcao.indexbaibao', $this->data);
    }


    public function listTimeshow()
    {   
        $ds = loaiquangcao::all();
        $page = ['link' => '/tin', 'ten' => 'Danh Sách Tin Tức'];

        $this->pages[] = $page;

        $this->data = [
            'ds' => $ds,
            'pages' => $this->pages,
        ];

        return view('editor.quangcao.dichvuImg.index', $this->data);
    }
    
    public function ListComboNews()
    {   
        $ds = loaibaibao::all();
        $page = ['link' => '/tin', 'ten' => 'Danh Sách Tin Tức'];

        $this->pages[] = $page;

        $this->data = [
            'ds' => $ds,
            'pages' => $this->pages,
        ];

        return view('editor.quangcao.quangcaobaibao.indexCombo', $this->data);
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
        return view('editor.quangcao.create', $this->data);
    }
    public function createTimeshow()
    {
        $page = ['link' => '/dichvu', 'ten' => 'Thể Loại'];
        $page_2 = ['link' => false, 'ten' => 'Thêm Mới'];
        array_push($this->pages, $page, $page_2);

        $this->data = [
            'pages' => $this->pages,
        ];
        return view('editor.quangcao.dichvuImg.create', $this->data);
    }


    public function createComboNews()
    {
        $page = ['link' => '/dichvu', 'ten' => 'Thể Loại'];
        $page_2 = ['link' => false, 'ten' => 'Thêm Mới'];
        array_push($this->pages, $page, $page_2);

        $this->data = [
            'pages' => $this->pages,
        ];
        return view('editor.quangcao.quangcaobaibao.createcombo', $this->data);
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function insert()
    // {
    //     $page = ['link' => '/quangcao', 'ten' => 'Tin Tức'];
    //     $page_2 = ['link' => false, 'ten' => 'Thêm Mới'];
    //     array_push($this->pages, $page, $page_2);

    //     $this->data = [
    //         'pages' => $this->pages,
    //     ];
    //     return view('editor.quangcao.insert', $this->data);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arr = explode('/', $request->get('Ngay'));
        if (count($arr)==3) {
            $n = $arr[2] . "-" . $arr[1] . "-" . $arr[0];
        } else {
            $n = date("Y-m-d");
        }

        $arrUrlHinh = explode("/", $request->get('urlHinh'));
        $lengArr = count($arrUrlHinh);
        $lengArr = (int)$lengArr;
        $localOfUrlHinh = $lengArr - 1;
        $endurl = $arrUrlHinh[$localOfUrlHinh];
        $urlHinh =  $endurl;

        $slug = Str::slug($request->get('TieuDe'));

        $t = new tin([
            'TieuDe' => $request->get('TieuDe'),
            'TomTat' => $request->get('TomTat'),
            'Ngay' => $n,
            'idTL' => $request->get('idTL'),
            'idLT' => $request->get('idLT'),
            'lang' => $request->get('lang'),
            'AnHien' => $request->get('AnHien'),
            'NoiBat' => $request->get('NoiBat'),
            'urlHinh' => $urlHinh,
            'tags' => $request->get('tags'),
            'Content' => $request->get('Content'),
            'idUser' => $request->get('idUser'),
            'role_tin' => 3,
        ]);
        
        $t->slug_tin= $slug;
        $t->save();
    return redirect('/editor/quangcaoEditor')->with('mess', 'Tin mới đã được lưu')->with('class', 'primary');
    }
    public function getTimeshow(Request $request)
    {   
        $time =  ($request->get('thoigian')*86400);
        $tl = new loaiquangcao([
            'ten_loai' => $request->get('ten_loai'),
            'gialoai' => $request->get('gialoai'),
            'AnHien' => $request->get('AnHien'),
            'thoigian' => $time,
        ]);

        $tl->save();
        return redirect('/editor/listtimeshow')->with('mess','Thể loại đã được lưu')->with('class', 'primary');
    }
    public function getComboNews(Request $request)
    {   
        $tl = new loaibaibao([
            'ten_loai' => $request->get('ten_loai'),
            'gialoai' => $request->get('gialoai'),
            'AnHien' => $request->get('AnHien'),
        ]);
        $tl->save();
        return redirect('/editor/ListComboNews')->with('mess','Thể loại đã được lưu')->with('class', 'primary');
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
            return view("editor.quangcao.quangcaobaibao.edit", $this->data);
        }
    }
    
    public function editImg($id)
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
            return view("editor.quangcao.edit", $this->data);
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
        
        $tl = quangcao::find($id);
        $loaiquangcao =  loaiquangcao::find($tl->id_loaiquangcao);

        $tl->id_editor = Auth::id();
        $user =  User::find($tl->idUser);
        if($user !=  null){
            $sotien =  $user->sodu - $loaiquangcao->gialoai;
            $user->sodu =  $sotien;
        }
        $user->save();
        $tl->role_quangcao = 1;
        $sql =  DB::TABLE('quangcaotong')->where('id_quangcao', '=', $tl->id_quangcao)->first();
        $tongquangcao =  quangcaotong::find($sql->id);

        $tongquangcao->role_quangcao =1;
        $tongquangcao->save();
        
        // $check->role_quangcao =1;
        // $check->save();
        $tl->save();
        return redirect('/editor/listquangcaoDone')->with('mess', 'Cập nhật thành công!')->with('class', 'primary');
    }
    public function updateNews(Request $request, $id)
    {
        
        $tl = quangcaobaibao::find($id);
        $getidbaibao =  DB::table('quangcaotong')->where('id_quangcaobaibao', '=',$tl->id)->first();
        $id_loaibaibao = loaibaibao::find($tl->id_loaibaibao);
        $idUser =  User::find($tl->idUser);
        $tmp=  $idUser->sodu - $id_loaibaibao->gialoai;
        $idUser->sodu =  $tmp;
        $tl->id_editor = Auth::id();
        $baibao =  quangcaotong::find($getidbaibao->id);
        $baibao->role_quangcao =1;
        $baibao->save();
        $tl->role_quangcao = 1;
        $idUser->save();
        $tl->save();
        return redirect('/editor/listquangcaoNews')->with('mess', 'Cập nhật thành công!')->with('class', 'primary');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ykien = quangcaobaibao::find($id);
        if ($ykien == null) {
            return redirect('/editor/listquangcaoImg')->with('mess', 'Dịch vụ không tồn tại')->with('class', 'danger');
        } else {
            $ykien->delete();
            return redirect('/editor/listquangcaoImg')->with('mess', 'Đã xóa ý kiến id = ' . $id)->with('class', 'primary');
        }
    }
    public function destroyImg($id)
    {
        $ykien = quangcao::find($id);
        
        if ($ykien == null) {
            return redirect('/editor/listquangcaoImg')->with('mess', 'Dịch vụ không tồn tại')->with('class', 'danger');
        } else {
            $ykien->delete();
            return redirect('/editor/listquangcaoImg')->with('mess', 'Đã xóa ý kiến id = ' . $id)->with('class', 'primary');
        }
    }

    public function destroylist($id)
    {
        $ykien = loaiquangcao::find($id);
        if ($ykien == null) {
          return redirect('/editor/listtimeshow')->with('mess', 'Dịch vụ không tồn tại')->with('class', 'danger');
        } else {
					$ykien->delete();
					return redirect('/editor/listtimeshow')->with('mess', 'Đã xóa ý kiến id = ' . $id)->with('class', 'primary');
        }
    }
    public function destroylistNews($id)
    {
        $ykien = loaibaibao::find($id);
        if ($ykien == null) {
          return redirect('/editor/listtimeshow')->with('mess', 'Dịch vụ không tồn tại')->with('class', 'danger');
        } else {
					$ykien->delete();
					return redirect('/editor/ListComboNews')->with('mess', 'Đã xóa ý kiến id = ' . $id)->with('class', 'primary');
        }
    }

    public function changeStatusShowlist($id, $anhien) {
        $ykien = loaiquangcao::find($id);
        $ykien->AnHien = $anhien;
        $ykien->save();
        return redirect('/editor/listtimeshow')->with('mess', 'Đổi trạng thái ẩn hiện cho ý kiến id = ' .$id. ' thành công')->with('class', 'primary');
    }
    public function changeStatusShowNews($id, $anhien) {
        $ykien = loaibaibao::find($id);
        $ykien->AnHien = $anhien;
        $ykien->save();
        return redirect('/editor/ListComboNews')->with('mess', 'Đổi trạng thái ẩn hiện cho ý kiến id = ' .$id. ' thành công')->with('class', 'primary');
    }
    public function editlist($id)
    {
        $row = loaiquangcao::find($id);

        $page = ['link' => '/quangcao', 'ten' => 'Loại Tin'];
        $page_2 = ['link' => false, 'ten' => 'Cập Nhật'];
        array_push($this->pages, $page, $page_2);

        $this->data = [
            'pages' => $this->pages,
            'row' => $row,
        ];

        if ($row == null) {
            echo "Không tồn tại loại tin này";return;
        } else {
            return view("editor.quangcao.dichvuImg.edit", $this->data);
        }
    }

    public function editlistNews($id)
    {
        $row = loaibaibao::find($id);

        $page = ['link' => '/quangcao', 'ten' => 'Loại Tin'];
        $page_2 = ['link' => false, 'ten' => 'Cập Nhật'];
        array_push($this->pages, $page, $page_2);

        $this->data = [
            'pages' => $this->pages,
            'row' => $row,
        ];

        if ($row == null) {
            echo "Không tồn tại loại tin này";return;
        } else {
            return view("editor.quangcao.quangcaobaibao.editCombo", $this->data);
        }
    }

    public function updatelist(Request $request, $id)
    {
        $tl = loaiquangcao::find($id);
        $tl->ten_loai     = $request->get('ten_loai');
        $tl->gialoai     = $request->get('gialoai');
        $tl->AnHien    = $request->get('AnHien');
        $tl->thoigian  = $request->get('thoigian');
        $tl->save();

        return redirect('/editor/listtimeshow')->with('mess', 'Cập nhật thành công!')->with('class', 'primary');
    }
    public function updatelistNews(Request $request, $id)
    {
        $tl = loaibaibao::find($id);
        $tl->ten_loai     = $request->get('ten_loai');
        $tl->gialoai     = $request->get('gialoai');
        $tl->AnHien    = $request->get('AnHien');
        $tl->save();

        return redirect('/editor/ListComboNews')->with('mess', 'Cập nhật thành công!')->with('class', 'primary');
    }
}
