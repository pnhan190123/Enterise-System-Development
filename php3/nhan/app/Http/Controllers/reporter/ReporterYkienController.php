<?php

namespace App\Http\Controllers\reporter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ykien;
use App\Models\tin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class ReporterYkienController extends Controller
{
    public $pages = [
        ['link' => '/reporter', 'ten' => 'Trang Chủ'],
    ];

    public $data;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ds = ykien::select('*', 'ykien.AnHien')->join('tin','ykien.idTin', '=', 'tin.idTin')->where('tin.idUser', '=',Auth::id())->get();
        $ykien = ykien::all();
      
        $bien=0;
        foreach ($ds as $ykien) {
            $bien++;
            $idTin = $ykien->idTin;
            $idUser = $ykien->idUser;
            $tin = tin::find($idTin);
            $user = User::find($idUser);
            $ykien->tin = $tin->TieuDe;
            if($user !=  null){
                $ykien->tenuser = $user->hoten;

            }
        }

        $page = ['link' => '/ykien', 'ten' => 'Danh Sách Ý Kiến'];
        $this->pages[] = $page;

        $this->data = [
            'ds' => $ds,
            'pages' => $this->pages,
        ];

        return view('reporter.ykien.index', $this->data);
        // return dd($ykien->AnHien);
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
        return view('reporter.loaitin.create', $this->data);
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

        return redirect('/reporter/loaitin')->with('mess', 'Loại tin đã được lưu')->with('class', 'primary');
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
            return view("reporter.loaitin.edit", $this->data);
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
        return redirect('/reporter/loaitin')->with('mess', 'Cập nhật thành công!')->with('class', 'primary');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
    }

    public function changeStatusShow($id, $anhien) {
        $ykien = ykien::find($id);
        $ykien->AnHien = $anhien;
        $ykien->save();
        return redirect('/reporter/ykienReporter')->with('mess', 'Đổi trạng thái ẩn hiện cho ý kiến id = ' .$id. ' thành công')->with('class', 'primary');
    }
}
