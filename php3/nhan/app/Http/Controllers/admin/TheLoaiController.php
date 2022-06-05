<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\theloai;
use App\Models\loaitin;

class TheLoaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $pages = [
        ['link' => '/admin', 'ten' => 'Trang Chủ'],
    ];

    public $data;

    public function index()
    {
        $ds = Theloai::all();

        $page = ['link' => '/loaitin', 'ten' => 'Danh Sách Thể Loại'];
        $this->pages[] = $page;

        $this->data = [
            'ds' => $ds,
            'pages' => $this->pages,
        ];

        return view('admin.theloai.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = ['link' => '/theloai', 'ten' => 'Thể Loại'];
        $page_2 = ['link' => false, 'ten' => 'Thêm Mới'];
        array_push($this->pages, $page, $page_2);

        $this->data = [
            'pages' => $this->pages,
        ];
        return view('admin.theloai.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tl = new theloai([
            'TenTL' => $request->get('TenTL'),
            'ThuTu' => $request->get('ThuTu'),
            'AnHien' => $request->get('AnHien'),
            'HienMenu' => $request->get('HienMenu'),
            'lang' => $request->get('lang'),
        ]);
        $tl->save();
        return redirect('/admin/theloai')->with('mess','Thể loại đã được lưu')->with('class', 'primary');
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
        $row = theloai::find($id);

        $page = ['link' => '/theloai', 'ten' => 'Thể Loại'];
        $page_2 = ['link' => false, 'ten' => 'Cập Nhật'];
        array_push($this->pages, $page, $page_2);

        $this->data = [
            'pages' => $this->pages,
            'row' => $row,
        ];

        if ($row==null) {
            echo "Không có thể loại này"; return;
        }
        return view("admin.theloai.edit", $this->data);
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
        $tl = theloai::find($id);
        $tl->TenTL     = $request->get('TenTL');
        $tl->ThuTu     = $request->get('ThuTu');
        $tl->AnHien    = $request->get('AnHien');
        $tl->lang      = $request->get('lang');
        $tl->HienMenu  = $request->get('HienMenu');
        $tl->save();

        return redirect('/admin/theloai')->with('mess', 'Cập nhật thành công!')->with('class', 'primary');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tl = theloai::find($id);
        if ($tl == null) {
            return redirect('/theloai')->with('mess', 'Thể loại không tồn tại')->with('class', 'danger');
        } else {
            $countLoaiTin = loaitin::where('idTL', $id)->count();

            if ($countLoaiTin == 0) {
                $tl->delete();
                return redirect('/admin/theloai')->with('mess', 'Đã xóa thể loại id = ' . $id)->with('class', 'primary');
            } else {
                return redirect('/admin/theloai')->with('mess', 'Thể loại ID ' . $id . ' Còn loại tin nên không thể xóa')
                    ->with('class', 'danger');
            }

        }
    }
}
