<?php

namespace App\Http\Controllers\Secretariat;
use App\Models\quangcaobaibao;
use App\Models\quangcao;

use App\Http\Controllers\Controller;
use App\Models\quangcaotong;
use App\Models\tongdichvu;
use Illuminate\Http\Request;
use DB;
class SecretariatQuangCaoController extends Controller
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
        $ds = quangcao::where('quangcao.loai_quangcao', '=', 'Quảng cáo ảnh')->where('role_quangcao','=',1)->orderby('id_quangcao', 'desc')->get();
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
        
        return view('secretariat.quangcao.dichvuImg.index', $this->data);
    }
    public function indexNews()
    {   
        $ds = quangcaobaibao::where('quangcaobaibao.loai_quangcao', '=', 'Báo quảng cáo')->where('quangcaobaibao.role_quangcao', '=',0)->get();
        $page = ['link' => '/quangcao', 'ten' => 'Danh Sách Yêu Cầu Quảng Cáo'];

        $this->pages[] = $page;

        $this->data = [
            'ds' => $ds,
            'pages' => $this->pages,
        ];

        return view('secretariat.quangcao.quangcaobaibao.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
            return view("secretariat.quangcao.dichvuImg.edit", $this->data);
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
        $t = quangcao::find($id);
        $check = DB::table('quangcaotong')->where('id_quangcao','=',$t->id_quangcao)->first();
        
        $tongquangcao =  quangcaotong::find($check->id);
        $tongquangcao->role_quangcao = 2;
        $tongquangcao->save();
        $t->role_quangcao = 2;
        $t->save();

        return redirect('/secretariat/listquangcaoDone')->with('mess', 'Cập nhật thành công!')->with('class', 'primary');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function indexListDone()
    {   
        $ds = quangcao::where('quangcao.loai_quangcao', '=', 'Quảng cáo ảnh')->where('role_quangcao','=',2)->get();
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
     
        return view('secretariat.quangcao.dichvuImg.index', $this->data);
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
      
        return view('secretariat.quangcao.quangcaobaibao.index', $this->data);
    }
    public function changeStatusImg($id, $anhien) {
        $ykien = quangcaobaibao::find($id);
        $ykien->AnHien = $anhien;
        $ykien->save();
        return redirect('/editor/listtimeshow')->with('mess', 'Đổi trạng thái ẩn hiện cho ý kiến id = ' .$id. ' thành công')->with('class', 'primary');
    }
    public function changeStatusNews($id, $anhien) {
        $ykien = quangcao::find($id);
        $ykien->AnHien = $anhien;
        $ykien->save();
        return redirect('/editor/listtimeshow')->with('mess', 'Đổi trạng thái ẩn hiện cho ý kiến id = ' .$id. ' thành công')->with('class', 'primary');
    }
}
