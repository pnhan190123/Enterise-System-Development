<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Arr;
use stdClass;
use Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\comment;
use App\Models\dichvu;
use App\Models\giaodich;
use App\Models\doanhthu;

use App\Models\tongdichvu;

use App\Models\naptien;
use Auth;
use App\Models\tin;
use App\Models\User;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Redirect;

class homeController extends Controller
{
    private $data;
    private $slug_tin = 'slug_tin';
    private $slug_theloai = 'slug_theloai';
    private $slug_loaitin = 'slug_loaitin';
    private $primaryKey_tin = 'idTin';
    private $primaryKey_theloai = 'idTL';
    private $primaryKey_loaitin = 'idLT';

    public function __construct()
    {
        $from            = 0;
        $limit           = 4;
        $dataMenu        = $this->dataMenu();
        $tinXemNhieu     = $this->getTinXemNhieu($from, $limit);
        $newsLastWeek    = $this->getNewsLastWeek($from, $limit);
        $hotNews         = $this->getHotNews($from, $limit);
        $topRatedNews    = $this->getTopRatedNews($from, $limit);
        $theloaiColumO   = $this->getCategoriesLimit(0, 6);
        $theloaiColumSc  = $this->getCategoriesLimit(6, 99999);
        $money           = $this->getMoney();
        $dichvu          = $this->dichvu();



        $this->data = array(
            'menuMain'        => $dataMenu[0],
            'menuHide'        => $dataMenu[1],
            'tinXemNhieu'     => $tinXemNhieu,
            'newsLastWeek'    => $newsLastWeek,
            'hotNews'         => $hotNews,
            'topRatedNews'    => $topRatedNews,
            'theloaiColumO'   => $theloaiColumO,
            'theloaiColumSc'  => $theloaiColumSc,
            'money'           => $money,
            'dichvu'          => $dichvu,
        );
    }

    public function index()
    {
        $hotSlide            = $this->getHotNews(0, 3);
        $newsFromCategories  = $this->getLatestFromCategories(0, 4);
        $newsFromCategories_ = $this->getLatestFromCategories_(0, 3);
        $lastNews            = $this->getNewsLatest(1, 5);
        $lastWeek            = $this->getNewsLastWeekHome(1, 5);
        $hotNewsHome         = $this->getHotNewsHome(1, 5);
        $topRatedNewsHome    = $this->getTopRatedNewsHome(1, 5);
        $newsTrend           = $this->getNewsTrend();
        $ramdom              = $this->getRamdomNews(0, 4);
        $lastNewsPage        = $this->getLatestNewsPage();
        $money               = $this->getMoney();
        $dichvu              = $this->dichvu();


        $this->data['hotSlide']             = $hotSlide;
        $this->data['isHome']               = 1;
        $this->data['newsFromCategories']   = $newsFromCategories;
        $this->data['newsFromCategories_']  = $newsFromCategories_;
        $this->data['lastNews']             = $lastNews;
        $this->data['lastWeekHome']         = $lastWeek;
        $this->data['hotNewsHome']          = $hotNewsHome;
        $this->data['topRatedNewsHome']     = $topRatedNewsHome;
        $this->data['newsTrend']            = $newsTrend;
        $this->data['ramdom']               = $ramdom;
        $this->data['lastNewsPage']         = $lastNewsPage;
        $this->data['money']                = $money;
        $this->data['dichvu']               = $dichvu;


        return view("site.home", $this->data);
    }

    public function lienhe()
    {
        $pages = [
            ['link' => false, 'ten' =>  'Liên Hệ']
        ];
        $this->data['TieuDe_']    = 'Liên Hệ Chúng Tôi';
        $this->data['pages']      = $pages;

        return view("site.contact", $this->data);
    }

    public function guimaillienhe(request $request)
    {
        $input   = $request->all();

        $hoten   = $input['hoten'];
        $tieude  = $input['tieude'];
        $sdt     = $input['sdt'];
        $email_  = $input['email'];
        $noidung = $input['noidung'];

        $data = array(
            'hoten' => $hoten,
            'tieude' => $tieude,
            'sdt' => $sdt,
            'email' => $email_,
            'noidung' => $noidung,
        );

        Mail::send(
            'site.mauthulienhe',
            $data,
            function ($message) use ($tieude) {
                $message->from('pnhan190124@gmail.com', 'Từ ứng dụng website');
                $message->to('pnhan190123@gmail.com', 'Ban quản trị')->subject($tieude);
            }
        );
        // 'longnguyen24101@gmail.com'
        session(['mess' => 'Gửi mail thành công !']);

        $pages = [
            ['link' => false, 'ten' =>  'Liên Hệ']
        ];
        $this->data['TieuDe_']    = 'Liên Hệ Chúng Tôi';
        $this->data['pages']      = $pages;

        return view("site.contact", $this->data);
    }

    public function dichvu()
    {
        $dichvu =  DB::table('dichvu')->where('AnHien', '=', 1)->get();
        return $dichvu;
    }

    public function confirm()
    {
        return view('site.confirm');
    }
    public function deposit()
    {
        return view('site.deposit');
    }
    public function checkoutDeposit(Request $request)
    {
        $sotien      =  $request->sodu;
        $idUser      =  Auth::id();
        $thoigiannap =  Carbon::now()->timestamp;
        $hethan =  Carbon::now()->timestamp;


        $check =  DB::table('naptien')->where('idUser', '=', Auth::id())->first();

        if ($check != null) {
            $checkthoigian =  $check->thoigiannap;
            $tmp = $hethan - $checkthoigian;
            $idUser =  $check->idUser;
            if ($tmp > 60 && $idUser == Auth::id()) {
                $t =  new naptien([
                    'idUser'     => $idUser,
                    'sotien'     => $sotien,
                    'role_nap'   => 0,
                    'thoigiannap' => $thoigiannap,
                    'loai'        => "Deposit",

                ]);
                $t->save();
               
                $tmp =  date("Y-m-d H:i:s ", substr("$thoigiannap", 0, 10));
                $month = date("m", strtotime($tmp));
                $tongdichvu = new tongdichvu([
                    'role_tongdv' => 0,
                    'idUser'      => Auth::id(),
                    'id_giaodich' => 0,
                    'id_nap'      => $check->id_nap,
                    'sotien'      => $sotien,
                    'loai'        => "Deposit",
                    'thoigianmua' => $thoigiannap,
                    'thoigianhethan' => 0,
                    'thang'       => $month,

                ]);
                $tongdichvu->save();
                $doanhthu = new doanhthu([
                    'role_doanhthu' => 0,
                    'id_giaodich'   => 0,
                    'id_nap'        => $check->id_nap,
                    'sotien'        => $sotien,
                ]);
                $doanhthu->save();
            } else {
                return back();
            }
        } elseif ($check == null) {
            $t =  new naptien([
                'idUser'     => $idUser,
                'sotien'     => $sotien,
                'role_nap'   => 0,
                'thoigiannap' => $thoigiannap,
                'loai'        => "Deposit",

            ]);
            $t->save();
            $checkDeposit =  DB::table('naptien')->where('idUser', '=', Auth::id())->where('sotien', '=', $sotien)->first();
            $tmp =  date("Y-m-d H:i:s ", substr("$thoigiannap", 0, 10));
            $month = date("m", strtotime($tmp));
            $tongdichvu = new tongdichvu([
                'role_tongdv' => 0,
                'id_giaodich' => 0,
                'id_nap'      => $checkDeposit->id_nap,
                'idUser'      => Auth::id(),
                'sotien'      => $sotien,
                'loai'        => "Deposit",
                'thoigianmua' => $thoigiannap,
                'thoigianhethan' => 0,
                'thang'       => $month,

            ]);
            $tongdichvu->save();
            $doanhthu = new doanhthu([
                'role_doanhthu' => 0,
                'id_giaodich'   => 0,
                'id_nap'        => $checkDeposit->id_nap,
                'sotien'      => $sotien,

            ]);
            $doanhthu->save();
        }


        return view('site.checkoutDeposit');
    }
    public function loading()
    {
        return view('site.loading');
    }
    public function checkout($ten, $idUser)
    {


        $data =  DB::table('dichvu')->where('ten_dv', '=', $ten)->first();

        $id_Dv = $data->id_DichVu;
        $gia_dv = $data->tien_dv;
        $thoihan =  $data->thoigian;
        $ngaymua = Carbon::now()->timestamp;
        $ngayhethan =  $ngaymua + $thoihan;
    
        $moneyDB = User::where('idUser', '=', $idUser)->first();
        $giaodich =  DB::table('giaodich')->where('idUser', '=', $idUser)->first();
        if (Auth::id() ?? null) {
            if ($giaodich != null) {
                if ($moneyDB->sodu >= $gia_dv) {
                    // $tmp =  $giaodich->thoigianmua;
                    $loai_giaodich = $giaodich->loai;
                    $role_giaodich =  $giaodich->role_giaodich;
                    $id_giaodich = $giaodich->id_giaodich;
                    // $ngaymuaDB =  $tmp - $ngaymua;
                    if ($role_giaodich == 1) {
                        $t =  giaodich::find($id_giaodich);
                        // print dd($loai);
                        $t->idUser          =  $idUser;
                        $t->id_DichVu       = $id_Dv;
                        $t->role_giaodich   = 0;
                        $t->thoigianmua    = $ngaymua;
                        $t->thoigianhethan  = $ngayhethan;
                        $t->loai        = $loai_giaodich;
                        $t->save();

                        if ($moneyDB->sodu > 0) {
                            $moneyDB->sodu =  $moneyDB->sodu - $gia_dv;
                            $moneyDB->save();
                            return view('site.loading');
                        }
                    } elseif ($role_giaodich == 0) {
                        return view('site.loading');
                    }
                } elseif ($ten == 'free') {
                    $t = new giaodich([
                        'idUser'        => $idUser,
                        'id_DichVu'     => $id_Dv,
                        'thoigianmua'   => Carbon::now()->timestamp,
                        'thoigianhethan' => $ngayhethan,
                        'loai'          => "Combo",

                    ]);
                    $t->role_giaodich = 1;
                    $t->save();
                    $tmp =  date("Y-m-d H:i:s ", substr("$ngaymua", 0, 10));
                    $month = date("m", strtotime($tmp));
                    $tongdichvu = new tongdichvu([
                        'role_tongdv'   => 0,
                        'id_giaodich' => $giaodich->id_giaodich,
                        'id_nap'      => 0,
                        'idUser'        => Auth::id(),
                        'sotien'        => $gia_dv,
                        'loai'          => "Combo",
                        'thoigianmua'   => $ngaymua,
                        'thoigianhethan' => $ngayhethan,
                        'thang'         => $month,
                    ]);
                    $tongdichvu->save();
                    $doanhthu = new doanhthu([
                        'role_doanhthu' => 0,
                        'id_giaodich'   => $giaodich->id_giaodich,
                        'id_nap'        => 0,
                        'sotien'        => $gia_dv,

                    ]);
                    $doanhthu->save();
                    return view('site.loading');
                } else {
                    return view('site.deposit');
                }
            } 
        
            else {
                if ($moneyDB->sodu >= $gia_dv) {
                    $t = new giaodich([
                        'idUser'        => $idUser,
                        'id_DichVu'     => $id_Dv,
                        'thoigianmua'   => $ngaymua,
                        'loai'          => "Combo",
                        'thoigianhethan' => $ngayhethan
                    ]);
                    $t->role_giaodich = 0;
                    $t->save();
                    $temp =  DB::table('giaodich')->join('dichvu', 'dichvu.id_DichVu','=', 'giaodich.id_DichVu')->where('dichvu.ten_dv', '=', $ten)->where('giaodich.idUser','=',$idUser)->first();
                    $tmp =  date("Y-m-d H:i:s ", substr("$ngaymua", 0, 10));
                    $month = date("m", strtotime($tmp));
                    $tongdichvu = new tongdichvu([
                        'role_tongdv'   => 0,
                        'id_giaodich'   => $temp->id_giaodich,
                        'id_nap'        => 0,
                        'idUser'        => Auth::id(),
                        'sotien'        => $gia_dv,
                        'loai'          => "Combo",
                        'thoigianmua'   => $ngaymua,
                        'thoigianhethan' => $ngayhethan,
                        'thang'          => $month,
                    ]);
                    $tongdichvu->save();
                    $doanhthu = new doanhthu([
                        'role_doanhthu' => 0,
                        'id_giaodich'   => $temp->id_giaodich,
                        'id_nap'        => 0,
                        'sotien'        => $gia_dv,

                    ]);
                    $doanhthu->save();
                    $moneyDB = User::where('idUser', '=', $idUser)->first();
                    $moneyDB->sodu =  $moneyDB->sodu - $gia_dv;
                    $moneyDB->save();
                    return view('site.loading');
                    
                } elseif ($ten == 'free') {
                    $t = new giaodich([
                        'idUser'        => $idUser,
                        'id_DichVu'     => $id_Dv,
                        'thoigianmua'   => Carbon::now()->timestamp,
                        'loai'          => "Combo",
                        'thoigianhethan' => $ngayhethan
                    ]);
                    $t->role_giaodich = 1;
                    $t->save();
                    $temp =  DB::table('giaodich')->join('dichvu', 'dichvu.id_DichVu','=', 'giaodich.id_DichVu')->where('dichvu.ten_dv', '=', $ten)->where('giaodich.idUser','=',$idUser)->first();
                    $tmp =  date("Y-m-d H:i:s ", substr("$ngaymua", 0, 10));
                    $month = date("m", strtotime($tmp));
                    $tongdichvu = new tongdichvu([
                        'role_tongdv'   => 0,
                        'id_giaodich'   => $temp->id_giaodich,
                        'id_nap'        => 0,
                        'idUser'        => Auth::id(),
                        'sotien'        => $gia_dv,
                        'loai'          => "Combo",
                        'thoigianmua'   => $ngaymua,
                        'thoigianhethan' => $ngayhethan,
                        'thang'          => $month,
                    ]);
                    $tongdichvu->save();
                    $doanhthu = new doanhthu([
                        'role_doanhthu' => 0,
                        'id_giaodich'   => $temp->id_giaodich,
                        'id_nap'        => 0,
                        'sotien'        => $gia_dv,

                    ]);
                    $doanhthu->save();
                    return view('site.loading');
                } else {

                    return view('site.deposit');
                }
            }
        }
    }

    public function getLatestNewsPage()
    {
        $news = DB::table('tin')
            ->select(
                'idTin',
                'TieuDe',
                'urlHinh',
                'Ngay',
                'Ten',
                'TomTat',
                'users.idUser',
                'Content',
                'SoLanXem',
                'tags',
                'tin.lang',
                'users.hoten',
                'loaitin.idLT',
                'loaitin.Ten',
                'theloai.idTL',
                'theloai.TenTL',
                'slug_tin',
                'theloai.slug_theloai',
                'loaitin.slug_loaitin'
            )
            ->join('loaitin', 'tin.idLT', '=', 'loaitin.idLT')
            ->join('users', 'tin.idUser', '=', 'users.idUser')
            ->join('theloai', 'tin.idTL', '=', 'theloai.idTL')
            ->where('tin.AnHien', '=', '1')
            ->orderby('Ngay', 'desc')
            ->paginate(5);


        foreach ($news as $n) {
            $comment           = $this->getCommentByIdTin($n->idTin);
            $n->commentNum  = count($comment);
        }

        $this->checkImageNews($news);

        return $news;
    }

    public function getRamdomNews($from, $limit)
    {
        $first = $this->getNewsRamdomFirst();

        $next  = $this->getNewsRamdomNext($first->idTin, $from, $limit);

        $ramdom = array(
            'first' => $first,
            'next'  => $next
        );

        return $ramdom;
    }

    public function getNewsRamdomNext($idFirst, $from, $limit)
    {
        $news = DB::table('tin')
            ->select(
                'idTin',
                'TieuDe',
                'urlHinh',
                'Ngay',
                'Ten',
                'TomTat',
                'users.idUser',
                'Content',
                'SoLanXem',
                'tags',
                'tin.lang',
                'users.hoten',
                'loaitin.idLT',
                'loaitin.Ten',
                'theloai.idTL',
                'theloai.TenTL',
                'slug_tin',
                'theloai.slug_theloai',
                'loaitin.slug_loaitin'
            )
            ->join('loaitin', 'tin.idLT', '=', 'loaitin.idLT')
            ->join('users', 'tin.idUser', '=', 'users.idUser')
            ->join('theloai', 'tin.idTL', '=', 'theloai.idTL')
            ->inRandomOrder()
            ->where('tin.AnHien', '=', '1')
            ->where('idTin', '<>', $idFirst)
            ->skip($from)->limit($limit)
            ->get();

        foreach ($news as $n) {
            $comment           = $this->getCommentByIdTin($n->idTin);
            $n->commentNum  = count($comment);
        }

        $this->checkImageNews($news);

        return $news;
    }

    public function getNewsRamdomFirst()
    {
        $news = DB::table('tin')
            ->select(
                'idTin',
                'TieuDe',
                'urlHinh',
                'Ngay',
                'Ten',
                'TomTat',
                'Content',
                'SoLanXem',
                'tags',
                'tin.lang',
                'users.hoten',
                'users.idUser',
                'loaitin.idLT',
                'loaitin.Ten',
                'theloai.idTL',
                'theloai.TenTL',
                'slug_tin',
                'theloai.slug_theloai',
                'loaitin.slug_loaitin'
            )
            ->join('loaitin', 'tin.idLT', '=', 'loaitin.idLT')
            ->join('users', 'tin.idUser', '=', 'users.idUser')
            ->join('theloai', 'tin.idTL', '=', 'theloai.idTL')
            ->inRandomOrder()
            ->where('tin.AnHien', '=', '1')
            ->first();

        $comment           = $this->getCommentByIdTin($news->idTin);
        $news->commentNum  = count($comment);

        if ($news->urlHinh == '') {
            $news->urlHinh = 'empty.jpg';
        }

        return $news;
    }

    public function getNewsTrend()
    {
        $topLTXemNhieu = DB::table('tin')
            ->select('idLT', DB::raw('sum(SoLanXem) as solanxem'))
            ->groupBy('idLT')
            ->orderby('solanxem', 'desc')
            ->where('tin.AnHien', '=', '1')
            ->limit(6)
            ->get();

        $stt = 0;
        $newsTrend = array();
        foreach ($topLTXemNhieu as $loaiTin) {
            // if ($stt == 0) {
            //     $newsTrend['left'] = $this->getNewsByKindId($loaiTin->idLT, 0, 4);
            // } else {
            $news = $this->getNewsByKindId($loaiTin->idLT, 0, 1);
            $newsTrend['right'][] = $news;
            // }

            $stt++;
        }

        return $newsTrend;
    }

    public function getTopRatedNewsHome($from, $limit)
    {
        $first = $this->getTopRatedNews(0, 1);
        $next  = $this->getTopRatedNews($from, $limit);

        $topRated = array(
            'firstNewsTopRated'  => $first,
            'nextNewsLastRated'  => $next
        );

        return $topRated;
    }

    public function getNewsLastWeekHome($from, $limit)
    {
        $first = $this->getNewsLastWeek(0, 1);
        $next  = $this->getNewsLastWeek($from, $limit);

        $lastWeek = array(
            'firstNewsLastWeek' => $first,
            'nextNewsLastWeek'  => $next
        );

        return $lastWeek;
    }

    public function getNewsLatest($from, $limit)
    {
        $firstNewsLates = $this->getLatestNews(0, 1);
        $nextNewsLates  = $this->getLatestNews($from, $limit);

        $latesNews = array(
            'firstNewsLates' => $firstNewsLates,
            'nextNewsLates'  => $nextNewsLates
        );

        return $latesNews;
    }

    public function getIdBySlug($slug_key, $slug, $table, $primaryKey)
    {
        $news = DB::table($table)
            ->select($primaryKey)
            ->where($slug_key, '=', $slug)
            ->first();
        if ($news !=  null) {
            return $news->$primaryKey;
        }
    }

    public function newsDetail($slug)
    {
        $id = $this->getIdBySlug($this->slug_tin, $slug, 'tin', $this->primaryKey_tin);

        $from  = 0;
        $limit = 6;

        $newsDetail = $this->getNewsDetail($id);

        $sumSLX = $newsDetail->SoLanXem + 1;
        $tin = Tin::find($id);
        $tin->SoLanXem = $sumSLX;
        $tin->save();

        $newsDetail->comment     = $this->getCommentByIdTin($id);
        $newsDetail->commentNum  = count($newsDetail->comment);
        $newsDetail->newsRelated = $this->getNewsRelated($newsDetail->idTL, $from, $limit);

        $tags = explode(',', $newsDetail->tags);
        $newsDetail->tags = $tags;

        $pages = [
            ['link' => 'site/tin/theloai/', 'ten' => $newsDetail->TenTL, 'id' => $newsDetail->slug_theloai],
            ['link' => 'site/tin/theloai/loaitin/', 'ten' => $newsDetail->Ten, 'id' => $newsDetail->slug_loaitin],
            ['link' => false, 'ten' => 'Chi tiết tin']
        ];


        $this->data['newsDetail'] = $newsDetail;
        $this->data['TieuDe_']    = $newsDetail->TieuDe;
        $this->data['pages']      = $pages;

        return view("site.newsdetail", $this->data);
    }

    public function getNewsDetail($idTin)
    {
        $news = DB::table('tin')
            ->select(
                'idTin',
                'TieuDe',
                'urlHinh',
                'Ngay',
                'Ten',
                'TomTat',
                'Content',
                'SoLanXem',
                'tags',
                'tin.lang',
                'users.hoten',
                'users.idUser',
                'loaitin.idLT',
                'loaitin.Ten',
                'theloai.idTL',
                'theloai.TenTL',
                'slug_tin',
                'theloai.slug_theloai',
                'loaitin.slug_loaitin'
            )
            ->join('loaitin', 'tin.idLT', '=', 'loaitin.idLT')
            ->join('users', 'tin.idUser', '=', 'users.idUser')
            ->join('theloai', 'tin.idTL', '=', 'theloai.idTL')
            ->where('tin.idTin', '=', $idTin)
            ->first();

        if ($news->urlHinh == '') {
            $news->urlHinh = 'empty.jpg';
        }

        return $news;
    }

    public function getLatestFromCategories_($from, $limit)
    {
        $categories = $this->getCategories_($from, $limit);

        $array = array();

        foreach ($categories as $cate) {
            $array['first'][] = $this->getNewsByCateId($cate->idTL, 0, 1);
            $array['kinds'][] = $this->getKindByCateId($cate->idTL, 0, 2);
            $array['next'][]  = $this->getNewsByCateId($cate->idTL, 1, 2);
        }

        return $array;
    }

    public function getKindByCateId($idCate, $from, $limit)
    {
        $kinds = DB::table('loaitin')
            ->select('idLT', 'Ten')
            ->orderby('ThuTu', 'ASC')
            ->where('idTL', '=', $idCate)
            ->skip($from)->limit($limit)
            ->get();
        return $kinds;
    }

    public function getNewsByCateId($idCate, $from, $limit)
    {
        $news = DB::table('tin')
            ->select('idTin', 'TieuDe', 'urlHinh', 'Ngay', 'Ten', 'SoLanXem', 'tags', 'tin.lang', 'TomTat', 'users.hoten', 'users.idUser', 'loaitin.Ten', 'theloai.TenTL', 'loaitin.idLT', 'theloai.idTL', 'slug_tin', 'theloai.slug_theloai', 'loaitin.slug_loaitin')
            ->join('loaitin', 'tin.idLT', '=', 'loaitin.idLT')
            ->join('users', 'tin.idUser', '=', 'users.idUser')
            ->join('theloai', 'tin.idTL', '=', 'theloai.idTL')
            ->orderby('Ngay', 'desc')
            ->where('tin.AnHien', '=', '1')
            ->where('theloai.idTL', '=', $idCate)
            ->skip($from)->take($limit)->get();

        foreach ($news as $n) {
            $comment           = $this->getCommentByIdTin($n->idTin);
            $n->commentNum  = count($comment);
        }

        $this->checkImageNews($news);

        return $news;
    }

    public function getCategories_($from, $limit)
    {
        $cate = DB::table('theloai')
            ->select('idTL', 'TenTL')
            ->orderby('ThuTu', 'ASC')
            ->where('AnHien', '=', '1')
            ->skip($from)->limit($limit)
            ->get();
        return $cate;
    }

    public function getLatestFromCategories($from, $limit)
    {
        $kinds = $this->getKind($from, $limit);

        $array = array();

        foreach ($kinds as $kind) {
            $news = $this->getNewsByKindIdFirst($kind->idLT);
            $array[] = $news;
        }

        return $array;
    }

    public function getHotNewsHome($from, $limit)
    {
        $firstNewsHot = $this->getHotNews(0, 1);
        $nextNewsHot  = $this->getHotNews($from, $limit);

        $newsHot = array(
            'firstNewsHot' => $firstNewsHot,
            'nextNewsHot'  => $nextNewsHot
        );

        return $newsHot;
    }

    public function getNewsByKindIdFirst($idLoaiTin)
    {
        $news = DB::table('tin')
            ->select('idTin', 'TieuDe', 'urlHinh', 'Ngay', 'Ten', 'SoLanXem', 'tags', 'tin.lang', 'users.hoten', 'users.idUser', 'loaitin.Ten', 'theloai.TenTL', 'loaitin.idLT', 'theloai.idTL', 'slug_tin', 'theloai.slug_theloai', 'loaitin.slug_loaitin')
            ->join('loaitin', 'tin.idLT', '=', 'loaitin.idLT')
            ->join('users', 'tin.idUser', '=', 'users.idUser')
            ->join('theloai', 'tin.idTL', '=', 'theloai.idTL')
            ->orderby('Ngay', 'desc')
            ->where('tin.AnHien', '=', '1')
            ->where('loaitin.idLT', '=', $idLoaiTin)
            ->first();
        if ($news != null) {
            $comment   = $this->getCommentByIdTin($news->idTin);

            $news->commentNum  = count($comment);

            if ($news->urlHinh == '') {
                $news->urlHinh = 'empty.jpg';
            }

            return $news;
        }
    }

    public function getLatestNews($from, $limit)
    {
        $news = DB::table('tin')
            ->select('idTin', 'TieuDe', 'urlHinh', 'Ngay', 'Ten', 'SoLanXem', 'TomTat', 'tags', 'tin.lang', 'users.hoten', 'users.idUser', 'loaitin.Ten', 'theloai.TenTL', 'loaitin.idLT', 'theloai.idTL', 'slug_tin', 'theloai.slug_theloai', 'loaitin.slug_loaitin')
            ->join('loaitin', 'tin.idLT', '=', 'loaitin.idLT')
            ->join('users', 'tin.idUser', '=', 'users.idUser')
            ->join('theloai', 'tin.idTL', '=', 'theloai.idTL')
            ->orderby('Ngay', 'desc')
            ->where('tin.AnHien', '=', '1')
            ->skip($from)->take($limit)->get();

        foreach ($news as $n) {
            $comment        = $this->getCommentByIdTin($n->idTin);
            $n->commentNum  = count($comment);
        }

        $this->checkImageNews($news);

        return $news;
    }

    public function getNewsRelated($idTheLoai, $from, $limit)
    {
        $news = DB::table('tin')
            ->select('idTin', 'TieuDe', 'urlHinh', 'Ngay', 'Ten', 'SoLanXem', 'tags', 'tin.lang', 'users.hoten', 'users.idUser', 'loaitin.Ten', 'theloai.TenTL', 'loaitin.idLT', 'theloai.idTL', 'slug_tin', 'theloai.slug_theloai', 'loaitin.slug_loaitin')
            ->join('loaitin', 'tin.idLT', '=', 'loaitin.idLT')
            ->join('users', 'tin.idUser', '=', 'users.idUser')
            ->join('theloai', 'tin.idTL', '=', 'theloai.idTL')
            ->orderby('Ngay', 'desc')
            ->where('tin.AnHien', '=', '1')
            ->where('theloai.idTL', '=', $idTheLoai)
            ->skip($from)->take($limit)->get();

        foreach ($news as $n) {
            $comment        = $this->getCommentByIdTin($n->idTin);
            $n->commentNum  = count($comment);
        }

        $this->checkImageNews($news);

        return $news;
    }

    public function getKind($from, $limit)
    {
        $kinds = DB::table('loaitin')
            ->select('idLT', 'Ten')
            ->orderby('ThuTu', 'ASC')
            ->where('AnHien', '=', '1')
            ->skip($from)->limit($limit)
            ->get();
        return $kinds;
    }

    public function getCommentByIdTin($idTin)
    {
        $comment = DB::table('ykien')
            ->select('idYKien', 'users.idUser', 'idTin', 'Ngay', 'NoiDung', 'users.hoten')
            ->join('users', 'users.idUser', '=', 'ykien.idUser')
            ->where('AnHien', '=', 1)->where('idTin', '=', $idTin)
            ->orderby('Ngay', 'desc')
            ->get();

        return $comment;
    }

    public function getNewsByKindId($kindId, $from, $limit)
    {
        $news = DB::table('tin')
            ->select('idTin', 'TieuDe', 'urlHinh', 'Ngay', 'Ten', 'SoLanXem', 'tags', 'tin.lang', 'TomTat', 'users.hoten', 'users.idUser', 'loaitin.idLT', 'loaitin.Ten', 'theloai.idTL', 'slug_tin', 'theloai.slug_theloai', 'loaitin.slug_loaitin')
            ->join('loaitin', 'tin.idLT', '=', 'loaitin.idLT')
            ->join('users', 'tin.idUser', '=', 'users.idUser')
            ->join('theloai', 'tin.idTL', '=', 'theloai.idTL')
            ->orderby('Ngay', 'desc')->where('tin.AnHien', '=', '1')
            ->where('tin.idLT', '=', $kindId)
            ->skip($from)->take($limit)->get();

        foreach ($news as $n) {
            $comment        = $this->getCommentByIdTin($n->idTin);
            $n->commentNum  = count($comment);
        }

        $this->checkImageNews($news);
        return $news;
    }

    public function getNews($categoriesId, $from, $limit)
    {
        $news = DB::table('tin')
            ->select('idTin', 'TieuDe', 'urlHinh', 'Ngay', 'Ten', 'SoLanXem', 'tags', 'tin.lang', 'users.hoten', 'users.idUser', 'loaitin.idLT', 'theloai.idTL', 'slug_tin', 'theloai.slug_theloai', 'loaitin.slug_loaitin')
            ->join('loaitin', 'tin.idLT', '=', 'loaitin.idLT')
            ->join('users', 'tin.idUser', '=', 'users.idUser')
            ->join('theloai', 'tin.idTL', '=', 'theloai.idTL')
            ->orderby('Ngay', 'desc')->where('tin.AnHien', '=', '1')
            ->where('tin.idTL', '=', $categoriesId)
            ->skip($from)->take($limit)->get();

        foreach ($news as $n) {
            $comment        = $this->getCommentByIdTin($n->idTin);
            $n->commentNum  = count($comment);
        }

        $this->checkImageNews($news);
        return $news;
    }

    public function checkImageNews($obj)
    {
        foreach ($obj as $newsItem) {
            if ($newsItem->urlHinh == '') {
                $newsItem->urlHinh = 'empty.jpg';
            }
        }

        return $obj;
    }

    public function getCategories()
    {
        $categories = DB::table('theloai')
            ->select('idTL', 'TenTL', 'slug_theloai')
            ->orderby('ThuTu', 'ASC')->where('AnHien', '=', '1')
            ->get();
        return $categories;
    }

    public function getKindOfNews($categories)
    {
        $array = array();
        foreach ($categories as $category) {
            $category->kinds = $this->getKindOfNewsByIdCategories($category->idTL);
        }
        // $array[] = $categories;

        return $categories;
    }

    public function getKindOfNewsByIdCategories($categoriesId)
    {
        $kinds = DB::table('loaitin')
            ->select('idLT', 'Ten', 'slug_loaitin')
            ->orderby('ThuTu', 'desc')
            ->where('AnHien', '=', '1')->where('idTL', $categoriesId)
            ->get();

        return $kinds;
    }

    public function dataMenu()
    {
        $cateMenu = $this->getCategories();
        $menuHide = $this->getKindOfNews($cateMenu);

        $menuMain = $menuHide;

        $filterFirstNews = new stdClass;
        $filterFirstNews->from  = 0;
        $filterFirstNews->limit = 1;

        $filterNextNews = new stdClass;
        $filterNextNews->from  = 1;
        $filterNextNews->limit = 3;

        foreach ($menuMain as $menuMainItem) {
            $menuMainItem->newsFirst = $this->getNews($menuMainItem->idTL, $filterFirstNews->from, $filterFirstNews->limit);
            $menuMainItem->newsNext  = $this->getNews($menuMainItem->idTL, $filterNextNews->from, $filterNextNews->limit);
        }

        return [$menuMain, $menuHide];
    }

    public function getTinXemNhieu($from, $limit)
    {
        $news = DB::table('tin')
            ->select('idTin', 'TieuDe', 'urlHinh', 'Ngay', 'Ten', 'SoLanXem', 'tags', 'tin.lang', 'users.hoten', 'users.idUser', 'loaitin.idLT', 'slug_tin', 'loaitin.slug_loaitin')
            ->join('loaitin', 'tin.idLT', '=', 'loaitin.idLT')
            ->join('users', 'tin.idUser', '=', 'users.idUser')
            ->orderby('SoLanXem', 'desc')->where('tin.AnHien', '=', '1')
            ->skip($from)->take($limit)->get();

        foreach ($news as $n) {
            $comment     = $this->getCommentByIdTin($n->idTin);
            $n->commentNum  = count($comment);
        }

        $this->checkImageNews($news);

        return $news;
    }

    public function getNewsLastWeek($from, $limit)
    {
        $date = \Carbon\Carbon::today()->subDays(7);

        $news = DB::table('tin')
            ->select('idTin', 'TieuDe', 'urlHinh', 'Ngay', 'Ten', 'SoLanXem', 'tags', 'TomTat', 'tin.lang', 'users.hoten', 'users.idUser', 'loaitin.idLT', 'slug_tin', 'loaitin.slug_loaitin')
            ->join('loaitin', 'tin.idLT', '=', 'loaitin.idLT')
            ->join('users', 'tin.idUser', '=', 'users.idUser')
            ->where('tin.AnHien', '=', '1')
            ->orderby('Ngay', 'desc')
            ->where('Ngay', '<=', $date)
            ->skip($from)->take($limit)->get();

        foreach ($news as $n) {
            $comment     = $this->getCommentByIdTin($n->idTin);
            $n->commentNum  = count($comment);
        }

        $this->checkImageNews($news);

        return $news;
    }

    public function getHotNews($from, $limit)
    {
        $news = DB::table('tin')
            ->select('idTin', 'TieuDe', 'urlHinh', 'Ngay', 'Ten', 'SoLanXem', 'tags', 'TomTat', 'tin.lang', 'users.hoten', 'users.idUser', 'loaitin.idLT', 'theloai.TenTL', 'slug_tin', 'theloai.slug_theloai', 'loaitin.slug_loaitin')
            ->join('loaitin', 'tin.idLT', '=', 'loaitin.idLT')
            ->join('users', 'tin.idUser', '=', 'users.idUser')
            ->join('theloai', 'tin.idTL', '=', 'theloai.idTL')
            ->where('tin.AnHien', '=', '1')
            ->where('tin.NoiBat', '=', '1')
            ->orderby('Ngay', 'desc')
            ->skip($from)->take($limit)->get();

        foreach ($news as $n) {
            $comment     = $this->getCommentByIdTin($n->idTin);
            $n->commentNum  = count($comment);
        }

        $this->checkImageNews($news);

        return $news;
    }

    public function getTopRatedNews($from, $limit)
    {
        $news = DB::table('tin')
            ->select('idTin', 'TieuDe', 'urlHinh', 'Ngay', 'Ten', 'SoLanXem', 'tags', 'TomTat', 'tin.lang', 'users.hoten', 'users.idUser', 'DanhGia', 'loaitin.idLT', 'slug_tin', 'loaitin.slug_loaitin')
            ->join('loaitin', 'tin.idLT', '=', 'loaitin.idLT')
            ->join('users', 'tin.idUser', '=', 'users.idUser')
            ->where('tin.AnHien', '=', '1')
            ->orderby('DanhGia', 'desc')
            ->skip($from)->take($limit)->get();

        foreach ($news as $n) {
            $comment        = $this->getCommentByIdTin($n->idTin);
            $n->commentNum  = count($comment);
        }

        $this->checkImageNews($news);

        return $news;
    }

    public function theoTheLoai($slug)
    {
        $id = $this->getIdBySlug($this->slug_theloai, $slug, 'theloai', $this->primaryKey_theloai);

        $newsFirst = $this->getNewsTheLoaiFirst($id);
        if ($newsFirst != null) {

            $newsNext  = $this->getNewsTheLoaiPage($id, $newsFirst->idTin);
            $news      = $this->setCommentNumAndCateName($newsFirst, $newsNext);
            $newsFirst = $news[0];
            $newsNext  = $news[1];

            $pages = [
                ['link' => false, 'ten' =>  $newsFirst->TenTL]
            ];

            $this->data['pages']      = $pages;
            $this->data['TieuDe_']    = 'Tin ' . $newsFirst->TenTL;
            $this->data['newsFirst']    = $newsFirst;
            $this->data['newsNext']    = $newsNext;

            return view('site.category', $this->data);
        }
    }

    public function theoLoaiTin($slug)
    {
        $id = $this->getIdBySlug($this->slug_loaitin, $slug, 'loaitin', $this->primaryKey_loaitin);

        $newsFirst = $this->getNewsLoaiTinFirst($id);
        if ($newsFirst !=  null) {
            $newsNext  = $this->getNewsLoaiTinPage($id, $newsFirst->idTin);

            $news      = $this->setCommentNumAndCateName($newsFirst, $newsNext);
            $newsFirst = $news[0];
            $newsNext  = $news[1];

            $pages = [
                ['link' => 'site/tin/theloai/', 'ten' => $newsFirst->TenTL, 'id' => $newsFirst->slug_theloai],
                ['link' => false, 'ten' =>  $newsFirst->Ten]
            ];

            $this->data['pages']      = $pages;
            $this->data['TieuDe_']    = 'Tin ' . $newsFirst->Ten;
            $this->data['newsFirst']  = $newsFirst;
            $this->data['newsNext']   = $newsNext;

            return view('site.category', $this->data);
        }
    }

    public function getNewsLoaiTinPage($id, $idFirst)
    {
        $news = DB::table('tin')
            ->select('idTin', 'TieuDe', 'urlHinh', 'Ngay', 'Ten', 'SoLanXem', 'TomTat', 'tags', 'tin.lang', 'users.hoten', 'users.idUser', 'loaitin.idLT', 'theloai.idTL', 'theloai.TenTL', 'slug_tin', 'theloai.slug_theloai', 'loaitin.slug_loaitin')
            ->join('loaitin', 'tin.idLT', '=', 'loaitin.idLT')
            ->join('users', 'tin.idUser', '=', 'users.idUser')
            ->join('theloai', 'tin.idTL', '=', 'theloai.idTL')
            ->orderby('Ngay', 'desc')->where('tin.AnHien', '=', '1')
            ->where('idTin', '<>', $idFirst)
            ->where('tin.idLT', '=', $id)
            ->skip(2)
            ->paginate(9);

        $this->checkImageNews($news);

        return $news;
    }

    public function getNewsLoaiTinFirst($id)
    {
        $news = DB::table('tin')
            ->select('idTin', 'TieuDe', 'urlHinh', 'Ngay', 'Ten', 'SoLanXem', 'TomTat', 'tags', 'tin.lang', 'users.hoten', 'users.idUser', 'loaitin.idLT', 'theloai.idTL', 'theloai.TenTL', 'slug_tin', 'theloai.slug_theloai', 'loaitin.slug_loaitin')
            ->join('loaitin', 'tin.idLT', '=', 'loaitin.idLT')
            ->join('users', 'tin.idUser', '=', 'users.idUser')
            ->join('theloai', 'tin.idTL', '=', 'theloai.idTL')
            ->orderby('Ngay', 'desc')->where('tin.AnHien', '=', '1')
            ->where('tin.idLT', '=', $id)
            ->first();
        if ($news !=  null) {
            if ($news->urlHinh == '') {
                $news->urlHinh = 'empty.jpg';
            }

            return $news;
        }
    }

    public function getNewsTheLoaiFirst($id)
    {
        $news = DB::table('tin')
            ->select('idTin', 'TieuDe', 'urlHinh', 'Ngay', 'Ten', 'SoLanXem', 'TomTat', 'tags', 'tin.lang', 'users.hoten', 'users.idUser', 'loaitin.idLT', 'theloai.idTL', 'theloai.TenTL', 'slug_tin', 'theloai.slug_theloai', 'loaitin.slug_loaitin')
            ->join('loaitin', 'tin.idLT', '=', 'loaitin.idLT')
            ->join('users', 'tin.idUser', '=', 'users.idUser')
            ->join('theloai', 'tin.idTL', '=', 'theloai.idTL')
            ->orderby('Ngay', 'desc')->where('tin.AnHien', '=', '1')
            ->where('tin.idTL', '=', $id)
            ->first();
        if ($news !=  null) {
            if ($news->urlHinh == '') {
                $news->urlHinh = 'empty.jpg';
            }

            return $news;
        }
    }

    public function getNewsTheLoaiPage($id, $idFirst)
    {
        $news = DB::table('tin')
            ->select('idTin', 'TieuDe', 'urlHinh', 'Ngay', 'Ten', 'SoLanXem', 'TomTat', 'tags', 'tin.lang', 'users.hoten', 'users.idUser', 'loaitin.idLT', 'theloai.idTL', 'theloai.TenTL', 'slug_tin', 'theloai.slug_theloai', 'loaitin.slug_loaitin')
            ->join('loaitin', 'tin.idLT', '=', 'loaitin.idLT')
            ->join('users', 'tin.idUser', '=', 'users.idUser')
            ->join('theloai', 'tin.idTL', '=', 'theloai.idTL')
            ->orderby('Ngay', 'desc')->where('tin.AnHien', '=', '1')
            ->where('idTin', '<>', $idFirst)
            ->where('tin.idTL', '=', $id)
            ->skip(2)
            ->paginate(9);

        $this->checkImageNews($news);

        return $news;
    }

    public function getCategoriesLimit($from, $limit)
    {
        $categories = DB::table('theloai')
            ->select('idTL', 'TenTL', 'slug_theloai')
            ->orderby('ThuTu', 'desc')->where('AnHien', '=', '1')
            ->skip($from)->limit($limit)
            ->get();
        return $categories;
    }

    public function setCommentNumAndCateName($newsFirst, $newsNext)
    {

        $newsFirst->CatetegoryName = $newsFirst->Ten;
        $newsFirst->comment     = $this->getCommentByIdTin($newsFirst->idTin);
        $newsFirst->commentNum  = count($newsFirst->comment);

        foreach ($newsNext as $next) {
            $next->CatetegoryName = $next->Ten;
            $next->comment     = $this->getCommentByIdTin($next->idTin);
            $next->commentNum  = count($next->comment);
        }

        return [$newsFirst, $newsNext];
    }

    public function theoTags($key)
    {
        $newsFirst = $this->getNewsByTagsFirst($key);
        $newsNext = $this->getNewsByTagsNext($key, $newsFirst->idTin);

        $pages = [
            ['link' => false, 'ten' =>  'Tags'],
            ['link' => false, 'ten' =>  $key]
        ];

        $news = $this->setCommentNumAndCateName($newsFirst, $newsNext);

        $this->data['pages']      = $pages;
        $this->data['TieuDe_']    = 'Tags ' . $key;
        $this->data['newsFirst']  = $news[0];
        $this->data['newsNext']   = $news[1];

        return view('site.category', $this->data);
    }

    public function getNewsByTagsNext($tags, $idFirst)
    {
        $news = DB::table('tin')
            ->select('idTin', 'TieuDe', 'urlHinh', 'Ngay', 'Ten', 'SoLanXem', 'TomTat', 'tags', 'tin.lang', 'users.hoten', 'users.idUser', 'loaitin.idLT', 'theloai.idTL', 'theloai.TenTL', 'slug_tin', 'theloai.slug_theloai', 'loaitin.slug_loaitin')
            ->join('loaitin', 'tin.idLT', '=', 'loaitin.idLT')
            ->join('users', 'tin.idUser', '=', 'users.idUser')
            ->join('theloai', 'tin.idTL', '=', 'theloai.idTL')
            ->orderby('Ngay', 'desc')->where('tin.AnHien', '=', '1')
            ->where('idTin', '<>', $idFirst)
            ->where('tags', 'LIKE', '%' . $tags . '%')
            ->paginate(9);

        $this->checkImageNews($news);

        return $news;
    }

    public function getNewsByTagsFirst($tags)
    {
        $news = DB::table('tin')
            ->select('idTin', 'TieuDe', 'urlHinh', 'Ngay', 'Ten', 'SoLanXem', 'TomTat', 'tags', 'tin.lang', 'users.hoten', 'users.idUser', 'loaitin.idLT', 'theloai.idTL', 'theloai.TenTL', 'slug_tin', 'theloai.slug_theloai', 'loaitin.slug_loaitin')
            ->join('loaitin', 'tin.idLT', '=', 'loaitin.idLT')
            ->join('users', 'tin.idUser', '=', 'users.idUser')
            ->join('theloai', 'tin.idTL', '=', 'theloai.idTL')
            ->orderby('Ngay', 'desc')->where('tin.AnHien', '=', '1')
            ->where('tags', 'LIKE', '%' . $tags . '%')
            ->first();

        if ($news->urlHinh == '') {
            $news->urlHinh = 'empty.jpg';
        }

        return $news;
    }

    public function timkiemtin(Request $request)
    {
        $keyword = $request->keyword;
        $numberTin = $this->countProByKeyWord($keyword);

        $newsFirst = $this->searchByKeyWordFirst($keyword);

        $pages = [
            ['link' => false, 'ten' =>  'Tìm kiếm'],
        ];

        $this->data['keyword']    = $keyword;
        $this->data['pages']      = $pages;
        $this->data['TieuDe_']    = 'Tìm Kiếm Tin ';

        if ($newsFirst == null) {
            $this->data['newsFirst']  = [];
            $this->data['sotin']      = 0;
            $this->data['newsNext']   = [];
        } else {
            $newsNext = $this->searchByKeyWordNext($keyword, $newsFirst->idTin);

            if ($newsFirst != null && count($newsNext) > 0) {
                $news = $this->setCommentNumAndCateName($newsFirst, $newsNext);
                $this->data['newsFirst']  = $news[0];
                $this->data['sotin']      = $numberTin;
                $this->data['newsNext']   = $news[1];
            } else if ($newsFirst != null && count($newsNext) == 0) {
                $newsFirst->CatetegoryName = $newsFirst->Ten;
                $newsFirst->comment     = $this->getCommentByIdTin($newsFirst->idTin);
                $newsFirst->commentNum  = count($newsFirst->comment);
                $this->data['newsFirst']  = $newsFirst;
                $this->data['sotin']      = 1;
                $this->data['newsNext']   = [];
            }
        }

        return view('site.category', $this->data);
    }

    public function searchByKeyWordFirst($keyword)
    {
        $news = DB::table('tin')
            ->select('idTin', 'TieuDe', 'urlHinh', 'Ngay', 'Ten', 'SoLanXem', 'TomTat', 'tags', 'tin.lang', 'users.hoten', 'users.idUser', 'loaitin.idLT', 'theloai.idTL', 'theloai.TenTL', 'slug_tin', 'theloai.slug_theloai', 'loaitin.slug_loaitin')
            ->join('loaitin', 'tin.idLT', '=', 'loaitin.idLT')
            ->join('users', 'tin.idUser', '=', 'users.idUser')
            ->join('theloai', 'tin.idTL', '=', 'theloai.idTL')
            ->orderby('Ngay', 'desc')->where('tin.AnHien', '=', '1')
            ->where('TieuDe', 'LIKE', '%' . $keyword . '%')
            ->first();

        if ($news != null && $news->urlHinh == '') {
            $news->urlHinh = 'empty.jpg';
        }

        return $news;
    }

    public function searchByKeyWordNext($keyword, $idFirst)
    {
        $news = DB::table('tin')
            ->select('idTin', 'TieuDe', 'urlHinh', 'Ngay', 'Ten', 'SoLanXem', 'TomTat', 'tags', 'tin.lang', 'users.hoten', 'users.idUser', 'loaitin.idLT', 'theloai.idTL', 'theloai.TenTL', 'slug_tin', 'theloai.slug_theloai', 'loaitin.slug_loaitin')
            ->join('loaitin', 'tin.idLT', '=', 'loaitin.idLT')
            ->join('users', 'tin.idUser', '=', 'users.idUser')
            ->join('theloai', 'tin.idTL', '=', 'theloai.idTL')
            ->orderby('Ngay', 'desc')->where('tin.AnHien', '=', '1')
            ->where('TieuDe', 'LIKE', '%' . $keyword . '%')
            ->where('idTin', '<>', $idFirst)
            ->paginate(9);

        if ($news != null) {
            $this->checkImageNews($news);
        }
        return $news;
    }
    public function getMoney()
    {
        $money =  DB::table('users')->where('users.idUser', '=', Auth::id())->get();
        return $money;
    }
    public function countProByKeyWord($keyword)
    {
        $news = DB::table('tin')
            ->select('idTin')
            ->where('tin.AnHien', '=', '1')
            ->where('TieuDe', 'LIKE', '%' . $keyword . '%')
            ->count();

        return $news;
    }

    public function comment(comment $request)
    {
        $validated = $request->validated();

        if ($validated) {
            $noidung = $request->post('noidung');
            $idTin = $request->post('idTin');
            $user = Auth::user();

            $dateTime = date('Y-m-d H:i:s');
            DB::table('ykien')->insert([
                'noidung' => $noidung,
                'idTin' => $idTin,
                'idUser' => $user->idUser,
                'Ngay' => $dateTime
            ]);
        }

        return redirect()->back();
    }

    public function profile($id)
    {
        $user = DB::table('users')
            ->select('idUser', 'hoten', 'vaitro', 'email', 'diachi', 'sdt', 'created_at')
            ->where('users.active', '=', '1')
            ->where('idUser', '=', $id)
            ->first();

        if ($user->idUser == Auth::id()) {
            $this->data['checkAuth']    = true;
        } else {
            $this->data['checkAuth']    = false;
        }

        $pages = [
            ['link' => false, 'ten' =>  'Thông tin cá nhân'],
        ];
        $this->data['TieuDe_']    = 'Trang cá nhân';
        $this->data['pages']      = $pages;
        $this->data['user']      = $user;

        return view("site.profile", $this->data);
    }

    public function updateProfile(Request $request)
    {
        $this->data['checkAuth']    = true;

        $update = DB::table('users')
            ->where('idUser', $request->post('idUser'))
            ->update([
                'hoten' => $request->post('hoten'),
                'diachi' => $request->post('diachi'),
                'sdt' => $request->post('sdt'),
            ]);
        if ($update == 1) {
            $user = DB::table('users')
                ->select('idUser', 'hoten', 'vaitro', 'email', 'diachi', 'sdt', 'created_at')
                ->where('users.active', '=', '1')
                ->where('idUser', '=', $request->post('idUser'))
                ->first();

            $pages = [
                ['link' => false, 'ten' =>  'Thông tin cá nhân'],
            ];

            $this->data['TieuDe_']    = 'Trang cá nhân';
            $this->data['pages']      = $pages;
            $this->data['user']      = $user;

            return view("site.profile", $this->data)->with('mess', 'Sửa thông tin thành công');
        }
    }
}
