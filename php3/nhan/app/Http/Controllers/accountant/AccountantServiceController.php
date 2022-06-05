<?php

namespace App\Http\Controllers\accountant;

use App\Http\Controllers\Controller;
use App\Models\giaodich;
use Illuminate\Http\Request;
use App\Models\dichvu;
use App\Models\loaitin;

class AccountantServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $pages = [
        ['link' => '/accountant', 'ten' => 'Trang Chủ'],
    ];

    public $data;

    public function index()
    {
        $ds = dichvu::all();

        $page = ['link' => '/loaitin', 'ten' => 'Danh Sách Thể Loại'];
        $this->pages[] = $page;

        $this->data = [
            'ds' => $ds,
            'pages' => $this->pages,
        ];

        return view('accountant.SaleReport.dichvu.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = ['link' => '/dichvu', 'ten' => 'Thể Loại'];
        $page_2 = ['link' => false, 'ten' => 'Thêm Mới'];
        array_push($this->pages, $page, $page_2);

        $this->data = [
            'pages' => $this->pages,
        ];
        return view('accountant.SaleReport.dichvu.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   $time =  $request->get('thoigian');
        $thoigian =  86400 *$time;
        $tl = new dichvu([
            'ten_dv' => $request->get('ten_dv'),
            'tien_dv' => $request->get('tien_dv'),
            'AnHien' => $request->get('AnHien'),
            'noidung' => $request->get('noidung'),
            'thoigian' => $thoigian,

        ]);
        $tl->save();
        return redirect('/accountant/serviceAccountant')->with('mess','Thể loại đã được lưu')->with('class', 'primary');
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
        $row = dichvu::find($id);

        $page = ['link' => '/loaitin', 'ten' => 'Loại Tin'];
        $page_2 = ['link' => false, 'ten' => 'Cập Nhật'];
        array_push($this->pages, $page, $page_2);

        $this->data = [
            'pages' => $this->pages,
            'row' => $row,
        ];

        if ($row == null) {
            echo "Không tồn tại loại tin này";return;
        } else {
            return view("accountant.SaleReport.dichvu.edit", $this->data);
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
        $tl = dichvu::find($id);
        $tl->ten_dv     = $request->get('ten_dv');
        $tl->tien_dv     = $request->get('tien_dv');
        $tl->AnHien    = $request->get('AnHien');
        $tl->noidung      = $request->get('noidung');
        $tl->thoigian      = $request->get('thoigian') * 86400;

        $tl->save();

        return redirect('/accountant/serviceAccountant')->with('mess', 'Cập nhật thành công!')->with('class', 'primary');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ykien = dichvu::find($id);
        if ($ykien == null) {
          return redirect('/accountant/serviceAccountant')->with('mess', 'Dịch vụ không tồn tại')->with('class', 'danger');
        } else {
					$ykien->delete();
					return redirect('/accountant/serviceAccountant')->with('mess', 'Đã xóa ý kiến id = ' . $id)->with('class', 'primary');
        }
    }

    public function changeStatusShow($id, $anhien) {
        $ykien = dichvu::find($id);
        $ykien->AnHien = $anhien;
        $ykien->save();
        return redirect('/accountant/serviceAccountant')->with('mess', 'Đổi trạng thái ẩn hiện cho ý kiến id = ' .$id. ' thành công')->with('class', 'primary');
    }
}
