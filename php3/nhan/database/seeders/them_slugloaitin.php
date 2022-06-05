<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Str;

class them_slugloaitin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listTL = DB::table('loaitin')->select('idLT', 'Ten')->get();
        for ($i = 0; $i < count($listTL); $i++) {
            $idLT = $listTL[$i]->idLT;
            $Ten = $listTL[$i]->Ten;
            $kd = Str::slug($Ten, '-');
            DB::table('loaitin')->where('idLT', $idLT)->update(['slug_loaitin' => $kd]);
        }
    }
}
