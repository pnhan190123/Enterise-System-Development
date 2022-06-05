<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ykien;
use App\Models\tin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class YkienController extends Controller
{
    public $pages = [
        ['link' => '/admin', 'ten' => 'Trang Chủ'],
    ];

    public $data;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ds = ykien::orderby('idYKien')->get();
        $bien=0;
        foreach ($ds as $ykien) {
            $bien++;
            $idTin = $ykien->idTin;
            $idUser = $ykien->idUser;
            $tin = tin::find($idTin);
            $tenphongvien = tin::find($idTin)->select('users.hoten')->join('users', 'tin.idUser', '=', 'users.idUser')->first() ?? null;

            $user = User::find($idUser);
            $ykien->tin = $tin->TieuDe;
            $ykien->tenphongvien =  $tenphongvien->hoten;
            if($user != null){
                $ykien->tenuser = $user->hoten;

            }
        }
        $page = ['link' => '/ykien', 'ten' => 'Danh Sách Ý Kiến'];
        $this->pages[] = $page;

        $this->data = [
            'ds' => $ds,
            'pages' => $this->pages,
        ];

        return view('admin.ykien.index', $this->data);
        // return dd(Auth::id())
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = ['link' => '/loaitin', 'ten' => 'Loại Tin'];
        $page_2 = ['link' => false, 'ten' => 'Thêm Mới'];
        array_push($this->pages, $page, $page_2);

        $this->data = [
            'pages' => $this->pages,
        ];
        return view('admin.loaitin.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lt = new ykien([
            'Ten' => $request->get('Ten'),
            'ThuTu' => $request->get('ThuTu'),
            'AnHien' => $request->get('AnHien'),
            'idTL' => $request->get('idTL'),
            'lang' => $request->get('lang'),
        ]);
        $lt->save();

        return redirect('/admin/loaitin')->with('mess', 'Loại tin đã được lưu')->with('class', 'primary');
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
        $row = ykien::find($id);

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
            return view("admin.loaitin.edit", $this->data);
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
        $lt = ykien::find($id);
        $lt->Ten = $request->get('Ten');
        $lt->ThuTu = $request->get('ThuTu');
        $lt->AnHien = $request->get('AnHien');
        $lt->idTL = $request->get('idTL');
        $lt->lang = $request->get('lang');
        $lt->save();
        return redirect('/admin/loaitin')->with('mess', 'Cập nhật thành công!')->with('class', 'primary');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ykien = ykien::find($id);
        if ($ykien == null) {
          return redirect('/admin/ykien')->with('mess', 'Ý kiến không tồn tại')->with('class', 'danger');
        } else {
					$ykien->delete();
					return redirect('/admin/ykien')->with('mess', 'Đã xóa ý kiến id = ' . $id)->with('class', 'primary');
        }
    }

    public function changeStatusShow($id, $anhien) {
        $ykien = ykien::find($id);
        $ykien->AnHien = $anhien;
        $ykien->save();
        return redirect('/admin/ykien')->with('mess', 'Đổi trạng thái ẩn hiện cho ý kiến id = ' .$id. ' thành công')->with('class', 'primary');
    }
}
