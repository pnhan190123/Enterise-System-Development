<?php

namespace App\Http\Controllers\editor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tin;
use App\Models\ykien;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DB;
class EditorTintucController extends Controller
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
        $ds = tin::where('tin.role_tin', '=', 2)->orderby('idTin', 'desc')->get();
        $page = ['link' => '/tin', 'ten' => 'Danh Sách Tin Tức'];

        $this->pages[] = $page;

        $this->data = [
            'ds' => $ds,
            'pages' => $this->pages,
        ];

        return view('editor.tintuc.index', $this->data);
    }
    public function indexDone()
    {   
        $ds = tin::where('tin.role_tin', '=', 3)->orderby('idTin', 'desc')->get();
        $page = ['link' => '/tin', 'ten' => 'Danh Sách Tin Tức'];

        $this->pages[] = $page;

        $this->data = [
            'ds' => $ds,
            'pages' => $this->pages,
        ];

        return view('editor.tintuc.tintucdone.index', $this->data);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = ['link' => '/tintuc', 'ten' => 'Tin Tức'];
        $page_2 = ['link' => false, 'ten' => 'Thêm Mới'];
        array_push($this->pages, $page, $page_2);

        $this->data = [
            'pages' => $this->pages,
        ];
        return view('editor.tintuc.create', $this->data);
    }

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
           
        ]);
        $t->slug_tin= $slug;
        $t->save();
    return redirect('/editor/tintucEditor')->with('mess', 'Tin mới đã được lưu')->with('class', 'primary');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = tin::find($id);

        $page = ['link' => '/tintuc', 'ten' => 'Tin Tức'];
        $page_2 = ['link' => false, 'ten' => 'Cập Nhật'];
        array_push($this->pages, $page, $page_2);

        $this->data = [
            'pages' => $this->pages,
            'row' => $row,
        ];

        if ($row == null) {
            echo "Không tồn tại loại tin này";return;
        } else {
            return view("editor.tintuc.edit", $this->data);
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
        // $tmp = DB::table('tin')->select('tin.idUser')->join('users', 'users.idUser', '=','tin.idUser')->get();
        // return dd($tmp);
        $arr = explode("/", $request->get('Ngay'));

        $arrUrlHinh = explode("/", $request->get('urlHinh'));

        $lengArr = count($arrUrlHinh);
        $lengArr = (int)$lengArr;
        $localOfUrlHinh = $lengArr - 1;
        $endurl = $arrUrlHinh[$localOfUrlHinh];
        $urlHinh =  $endurl;
        $slug = Str::slug($request->get('TieuDe'));


        if (count($arr) == 3) {
            $n = $arr[2] . "-" . $arr[1] . "-" . $arr[0];
        } else $n = date('Y-m-d');

        $t = tin::find($id);
        $t->TieuDe=$request->get('TieuDe');
        $t->TomTat=$request->get('TomTat');
        $t->Ngay=$n;
        $t->idTL=$request->get('idTL');
        $t->idLT=$request->get('idLT');
        $t->lang=$request->get('lang');
        $t->AnHien=$request->get('AnHien');
        $t->NoiBat=$request->get('NoiBat');
        $t->urlHinh=$urlHinh;
        $t->tags=$request->get('tags');
        $t->Content=$request->get('Content');
        $t->slug_tin= $slug;
        $t->role_tin= 3;
        //  DB::table('tin')->update('tin.role_tin','=',3);
        $t->save();

        return redirect('/editor')->with('mess', 'Tin ID '. $id .' đã được cập nhật')->with('class', 'primary');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tin = tin::find($id);
        if ($tin == null) {
            return redirect('/tintuc')->with('mess', 'Tin không tồn tại')->with('class', 'warning');
        } else {
            $countYkien = ykien::where('idTin', $id)->count();

            if ($countYkien == 0) {
                $tin->delete();
                return redirect('/editor/tintucEditor')->with('mess', 'Đã xóa tin id = ' . $id)->with('class', 'primary');
            } else {
                return redirect('/editor/tintucEditor')->with('mess', 'Tin ID ' . $id . ' Còn ý kiến của tin nên không thể xóa !')
                    ->with('class', 'danger');
            }
        }
    }
}
