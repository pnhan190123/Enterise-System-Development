<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\site\homeController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\TintucController;
use App\Http\Controllers\admin\LoaiTinController;
use App\Http\Controllers\admin\TheloaiController;
use App\Http\Controllers\admin\YkienController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\ControllerAdmin  ;


use App\Http\Controllers\accountant\AccountantControllerCheck;
use App\Http\Controllers\accountant\AccountantSaleReportController;
use App\Http\Controllers\accountant\AccountantYkienController;
use App\Http\Controllers\accountant\AccountantServiceController;

use App\Http\Controllers\site\UserQuangcaoController;

use App\Http\Controllers\reporter\ReporterController;
use App\Http\Controllers\reporter\ReporterTintucController;
use App\Http\Controllers\reporter\ReporterYkienController;

use App\Http\Controllers\editor\EditorController;
use App\Http\Controllers\editor\EditorTintucController;
use App\Http\Controllers\editor\EditorLoaiTinController;
use App\Http\Controllers\editor\EditorTheloaiController;
use App\Http\Controllers\editor\EditorYkienController;
use App\Http\Controllers\editor\EditorUserController;
use App\Http\Controllers\editor\QuangcaoController;
use App\Http\Controllers\secretariat\SecretariatController;
use App\Http\Controllers\secretariat\SecretariatTintucController;
use App\Http\Controllers\secretariat\SecretariatLoaiTinController;
use App\Http\Controllers\secretariat\SecretariatTheloaiController;
use App\Http\Controllers\secretariat\SecretariatYkienController;
use App\Http\Controllers\secretariat\SecretariatUserController;
use App\Http\Controllers\secretariat\SecretariatQuangCaoController;

use App\Http\Controllers\secretariat\SecretariatControlleTinTuc;
use App\Http\Controllers\site\QuangcaoController as SiteQuangcaoController;

/*'


|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [homeController::class, 'index']);

Route::get('/bao-cao', function() {
    return view('site.baocao');
});

Route::get('/khongcoquyenquantri', function () {
    return 'Không có quyền quản trị';
});

Route::get('/money', [homeController::class, 'dichvu']);

Route::get('/confirm', [homeController::class, 'confirm']);

// Route::get('/checkGD/{loai}/{idUser}',[homeController::class, 'checkGD']);
Route::get('/checkout/{ten}/{idUser}', [homeController::class, 'checkout']);

Route::get('/checkoutDeposit', [homeController::class, 'checkoutDeposit']);

Auth::routes();

Route::get('/loading', [homeController::class, 'loading']);
Route::get('/deposit', [homeController::class, 'deposit']);


Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class,'logout']);

Route::prefix('site')->group(function () {
    Route::get('/', [homeController::class, 'index']);

    Route::prefix('tin')->group(function () {
        Route::get('/chitiet/{slug_tin}', [homeController::class, 'newsDetail']);
        Route::get('/theloai/{slug_theloai}', [homeController::class, 'theoTheLoai']);
        Route::get('/theloai/loaitin/{slug_loaitin}', [homeController::class, 'theoLoaiTin']);
        Route::get('/tags/{key}', [homeController::class, 'theoTags']);
        Route::get('/timkiem', [homeController::class, 'timkiemtin'])->name('tin.timkiem');
    });

    Route::post('/comment', [homeController::class, 'comment']);

    Route::prefix('profile')->group(function () {
        // Route::get('/chitiet/{slug_tin}', [homeController::class, 'newsDetail']);
        Route::get('/user/{idUser}', [homeController::class, 'profile'])->name('user.profile');
        Route::post('/user', [homeController::class, 'updateProfile']);
    });


    Route::prefix('/lienhe')->group(function () {
        Route::get('/', [homeController::class, 'lienhe']);
        Route::post('/', [homeController::class, 'guimaillienhe']);
    });
});

   Route::resource('/quangcao',UserQuangcaoController::class);
   Route::get('/quangcaoImg', [UserQuangcaoController::class, 'indexImg'])->name('quangcaoUser.indexImg');
   Route::get('/quangcaoNews', [UserQuangcaoController::class, 'indexNews'])->name('quangcaoUser.indexNews');

   Route::get('/createquangcaoNews', [UserQuangcaoController::class, 'createNewsPr'])->name('quangcaoUser.createNewsPr');
    Route::post('/quangcaoNews', [UserQuangcaoController::class, 'storelist'])->name('quangcaoUser.storelist');

   Route::get('/editlist/{id}', [UserQuangcaoController::class, 'editlist'])->name('quangcaoUser.editlist');
   Route::delete('/deletequangcao/{id}', [UserQuangcaoController::class, 'destroylist'])->name('quangcaoUser.destroylist');





   Route::post('/updatelistNews/{id}', [UserQuangcaoController::class, 'updatelistNews'])->name('quangcaoUser.updatelistNews');



Route::middleware(['auth', 'Quantri'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index']);
        Route::resource('/theloai', TheloaiController::class);
        Route::resource('/loaitin', LoaiTinController::class);
        Route::resource('/tintuc', TintucController::class);
        Route::resource('/ykien', YkienController::class);
        Route::resource('/user', UserController::class);
        Route::get('/listuser', [UserController::class, 'indexUser'])->name('user.indexUser');
        Route::get('/baocaotong', [UserController::class, 'reportTong'])->name('user.reportTong');
        Route::DELETE('/user/destroy_all/{id}', [UserController::class, 'destroy_all'])->name('user.destroy_all');
        Route::post('/user/active/{id}/{active}', [UserController::class, 'changeActive'])->name('user.active');

        Route::post('/ykien/anhien/{id}/{anhien}', [YkienController::class, 'changeStatusShow'])->name('ykien.statusShow');
        
        Route::get('/tintucDuyet', [ControllerAdmin::class,'index'])->name('ControllerAdmin.index');

    });
});


Route::middleware(['auth', 'Editor'])->group(function () {
    Route::prefix('editor')->group(function () {
        Route::get('/', [EditorController::class, 'index']);
        Route::resource('/tintucEditor', EditorTintucController::class);
        Route::get('/tintucEditorDone', [EditorTintucController::class,'indexDone'])->name("tintucEditor.indexDone");

        Route::resource('/userEditor', EditorUserController::class);
        Route::resource('/quangcaoEditor', QuangcaoController::class);
        Route::get('/editlistImg/{id}', [QuangcaoController::class, 'editImg'])->name('quangcaoEditor.editImg');
        Route::delete('/deleteImg/{id}', [QuangcaoController::class, 'destroyImg'])->name('quangcaoEditor.destroyImg');

        Route::get('/listquangcaoImg', [QuangcaoController::class, 'indexImg'])->name('quangcaoEditor.indexImg');
        Route::get('/listquangcaoDone', [QuangcaoController::class, 'indexListDone'])->name('quangcaoEditor.indexListDone');

        Route::get('/listquangcaoNews', [QuangcaoController::class, 'doneNews'])->name('quangcaoEditor.doneNews');
        Route::post('/updateNews/{id}', [QuangcaoController::class, 'updateNews'])->name('quangcaoEditor.updateNews');


        Route::get('/createComboNews', [QuangcaoController::class, 'createComboNews'])->name('quangcaoEditor.createComboNews');
        Route::get('/ListComboNews', [QuangcaoController::class, 'ListComboNews'])->name('quangcaoEditor.ListComboNews');
        Route::post('/getComboNews', [QuangcaoController::class, 'getComboNews'])->name('quangcaoEditor.getComboNews');
        Route::post('/showhideComboPrNews/{id}/{anhien}', [QuangcaoController::class, 'changeStatusShowNews'])->name('quangcaoEditor.changeStatusShowNews');
        Route::get('/editlistNews/{id}', [QuangcaoController::class, 'editlistNews'])->name('quangcaoEditor.editlistNews');
        Route::delete('/deletequangcaoNews/{id}', [QuangcaoController::class, 'destroylistNews'])->name('quangcaoEditor.destroylistNews');
        Route::post('/updatelistNews/{id}', [QuangcaoController::class, 'updatelistNews'])->name('quangcaoEditor.updatelistNews');


        Route::get('/timeshow', [QuangcaoController::class, 'createTimeshow'])->name('quangcaoEditor.createTimeshow');
        Route::post('/gettimeshow', [QuangcaoController::class, 'getTimeshow'])->name('quangcaoEditor.getTimeshow');
        Route::get('/listtimeshow', [QuangcaoController::class, 'listTimeshow'])->name('quangcaoEditor.listTimeshow');
        Route::post('/showhidequangcao/{id}/{anhien}', [QuangcaoController::class, 'changeStatusShowlist'])->name('quangcaoEditor.changeStatusShowlist');
        Route::get('/editlist/{id}', [QuangcaoController::class, 'editlist'])->name('quangcaoEditor.editlist');
        Route::post('/updatelist/{id}', [QuangcaoController::class, 'updatelist'])->name('quangcaoEditor.updatelist');
        Route::delete('/deletequangcao/{id}', [QuangcaoController::class, 'destroylist'])->name('quangcaoEditor.destroylist');




        // Route::get('/tintucEditor', [EditorTintucController::class, 'done'])->name('tintucEditor.done');
        Route::DELETE('/user/destroy_all/{id}', [EditorUserController::class, 'destroy_all'])->name('userEditor.destroy_all');
        Route::post('/user/active/{id}/{active}', [EditorUserController::class, 'changeActive'])->name('userEditor.active');
        });
});



Route::middleware(['auth', 'Accountant'])->group(function () {
    Route::prefix('accountant')->group(function () {
        Route::resource('/serviceAccountant', AccountantServiceController::class);
        Route::resource('/salereport',AccountantSaleReportController::class);

        Route::get('/salereportQuangCao',[AccountantSaleReportController::class,'indexSaleReportQuangcao'])->name('salereport.indexSaleReportQuangcao');
        Route::post('/serviceAccountant/anhien/{id}/{anhien}', [AccountantServiceController::class, 'changeStatusShow'])->name('serviceAccountant.statusShow');

        Route::get('/', [AccountantControllerCheck::class, 'index'])->name('Accountant.index');

        Route::get('/accountantCheckAdd/{id}', [AccountantControllerCheck::class, 'changeStatusShow'])->name('Accountant.statusShow');
        Route::delete('/accountantCheckDelete/{id}', [AccountantControllerCheck::class, 'destroy'])->name('Accountant.destroy');

      



        });
});


Route::middleware(['auth', 'Secretariat'])->group(function () {
    Route::prefix('secretariat')->group(function () {
        Route::get('/', [SecretariatController::class, 'index']);
        Route::resource('/tintucSecretariat', SecretariatTintucController::class);
        Route::resource('/ykienSecretariat', SecretariatYkienController::class);
        Route::resource('/userSecretariat', SecretariatUserController::class);
        Route::resource('/quangcaoSecretariat', SecretariatQuangCaoController::class);
        Route::get('/listquangcaoDone', [SecretariatQuangCaoController::class, 'indexListDone'])->name('quangcaoSecretariat.indexListDone');
        Route::get('/listquangcaoNews', [SecretariatQuangCaoController::class, 'doneNews'])->name('quangcaoSecretariat.doneNews');
        Route::get('/listNews', [SecretariatQuangCaoController::class, 'indexNews'])->name('quangcaoSecretariat.indexNews');

        Route::post('/showhidequangcaoImg/{id}/{anhien}', [QuangcaoController::class, 'changeStatusImg'])->name('quangcaoSecretariat.changeStatusImg');
        Route::post('/showhidequangcaoNews/{id}/{anhien}', [QuangcaoController::class, 'changeStatusNews'])->name('quangcaoSecretariat.changeStatusNews');

        Route::DELETE('/userSecretariat/destroy_all/{id}', [SecretariatUserController::class, 'destroy_all'])->name('userSecretariat.destroy_all');
        Route::post('/userSecretariat/active/{id}/{active}', [SecretariatUserController::class, 'changeActive'])->name('userSecretariat.active');
        Route::post('/ykienSecretariat/anhien/{id}/{anhien}', [SecretariatYkienController::class, 'changeStatusShow'])->name('ykienSecretariat.statusShow');
        Route::get('/tintucSecretariatRequest', [SecretariatControlleTinTuc::class,'index'])->name('tintucSecretariatRequest.index');
    });
});

Route::middleware(['auth', 'Reporter'])->group(function () {
    Route::prefix('reporter')->group(function () {
        Route::get('/', [ReporterController::class, 'index']);
        Route::resource('/tintucReporter', ReporterTintucController::class);
        Route::resource('/ykienReporter', ReporterYkienController::class);
        Route::post('/ykienReporter/anhien/{id}/{anhien}', [ReporterYkienController::class, 'changeStatusShow'])->name('ykienReporter.statusShow');
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/layloaitintrong1theloai/{idTL}', function ($idTL) {
    $kq = DB::select("SELECT idLT, Ten FROM loaitin WHERE idTL=$idTL");
    foreach ($kq as $row)
        echo "<option value={$row->idLT}>  $row->Ten  </option>";
});

Route::get('image/{filename}', [App\Http\Controllers\HomeController::class, 'displayImage'])->name('image.displayImage');

//Reset password
 
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


