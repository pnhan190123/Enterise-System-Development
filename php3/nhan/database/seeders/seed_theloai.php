<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Str;

class seed_theloai extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listTL = DB::table('theloai')->select('idTL', 'TenTL')->get();
        for ($i = 0; $i < count($listTL); $i++) {
            $idTL = $listTL[$i]->idTL;
            $TenTL = $listTL[$i]->TenTL;
            $kd = Str::slug($TenTL, '-');
            DB::table('theloai')->where('idTL', $idTL)->update(['slug_theloai' => $kd]);
        }
    }
}
