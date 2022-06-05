<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loaibaibao extends Model
{
    use HasFactory;
    protected $table='loaibaibao';
    protected $primaryKey='id';
    protected $fillable=[
        'id',
        'ten_loai',
        'gialoai',
        'AnHien',
    ];
}
