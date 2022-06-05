<?php

namespace App\Http\Controllers\editor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ykien;
use App\Models\tin;

class EditorUserController extends Controller
{
    public $pages = [
        ['link' => '/editor', 'ten' => 'Trang Chủ'],
    ];

    public $data;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ds = User::where('vaitro', '=',1)->get();
        $page = ['link' => '/user', 'ten' => 'Danh Sách Phóng Viên'];
        $this->pages[] = $page;

        $this->data = [
            'ds' => $ds,
            'pages' => $this->pages,
        ];

        return view('editor.user.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = ['link' => '/user', 'ten' => 'User'];
        $page_2 = ['link' => false, 'ten' => 'Thêm Mới'];
        array_push($this->pages, $page, $page_2);

        $this->data = [
            'pages' => $this->pages,
        ];
        return view('editor.user.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lt = new User([
            'Ten' => $request->get('Ten'),
            'ThuTu' => $request->get('ThuTu'),
            'AnHien' => $request->get('AnHien'),
            'idTL' => $request->get('idTL'),
            'lang' => $request->get('lang'),
        ]);
        $lt->save();

        return redirect('/editor/userEditor')->with('mess', 'Loại tin đã được lưu')->with('class', 'primary');
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
        $row = User::find($id);

        $page = ['link' => '/user', 'ten' => 'User'];
        $page_2 = ['link' => false, 'ten' => 'Cập Nhật'];
        array_push($this->pages, $page, $page_2);

        $this->data = [
            'pages' => $this->pages,
            'row' => $row,
        ];

        if ($row == null) {
            return redirect('/editor/user')->with('mess', 'Không tồn tại user')->with('class', 'warning');
        } else {
            return view("editor.user.edit", $this->data);
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
        $lt = User::find($id);
        $lt->Ten = $request->get('Ten');
        $lt->ThuTu = $request->get('ThuTu');
        $lt->AnHien = $request->get('AnHien');
        $lt->idTL = $request->get('idTL');
        $lt->lang = $request->get('lang');
        $lt->save();
        return redirect('/editor/loaitin')->with('mess', 'Cập nhật thành công!')->with('class', 'primary');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user == null) {
            return redirect('/editor/loaitin')->with('mess', 'User không tồn tại')
                ->with('class', 'danger');
        } else {
            $countTin = tin::where('idUser', $id)->count();
            $countYkien = ykien::where('idUser', $id)->count();

            if ($countTin == 0 && $countYkien == 0) {
                $user->delete();
                return redirect('/editor/userEditor')->with('mess', 'Đã xóa user id = ' . $id)->with('class', 'primary');
            }
            if ($countTin == 0 && $countYkien > 0) {
                $mess = 'User ID ' . $id . ' còn '.$countYkien.' ý kiến nên không thể xóa';
            } else if ($countTin > 0 && $countYkien == 0) {
                $mess = 'User ID ' . $id . ' còn '.$countTin.' tin nên không thể xóa';
            } else {
                $mess = 'User ID ' . $id . ' còn '.$countTin.' tin, '.$countYkien.' ý kiến nên không thể xóa';
            }

            return redirect('/editor/userEditor')->with('mess', $mess)->with('class', 'danger')->with('id', $id)->with('route', 'user');

        }
    }

    public function destroy_all($id) {
        $tin = tin::where('idUser', $id)->delete();
        $yKien = ykien::where('idUser', $id)->delete();
        $user = User::where('idUser', $id)->delete();
        return redirect('/editor/userEditor')->with('mess', 'Đã xóa user id = ' . $id . ' Và tất cả tin, ý kiến của user này')->with('class', 'primary');
    }

    public function changeActive($id, $active) {
        $user = User::find($id);
        $user->active = $active;
        $user->idgroup = $active;
        $user->save();
        return redirect('/editor/userEditor')->with('mess', 'Đổi trạng thái kích hoạt cho user id = ' .$id. ' thành công')->with('class', 'primary');
    }
}
