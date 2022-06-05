<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Str;

class slug_tin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listTinL = DB::table('tin')->select('idTin', 'TieuDe')->get();
        for ($i = 0; $i < count($listTinL); $i++) {
            $idTin = $listTinL[$i]->idTin;
            $TieuDe = $listTinL[$i]->TieuDe;
            $kd = Str::slug($TieuDe, '-');
            DB::table('tin')->where('idTin', $idTin)->update(['slug_tin' => $kd]);
        }
    }
}
