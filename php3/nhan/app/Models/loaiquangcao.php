<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loaiquangcao extends Model
{
    use HasFactory;
    protected $table='loaiquangcao';
    protected $primaryKey='id';
    protected $fillable=[
        'ten_loai',
        'gialoai',
        'AnHien',
        'thoigian',
    ];
}
