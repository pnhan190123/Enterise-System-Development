<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dichvu extends Model
{
    use HasFactory;
    protected $table='dichvu';
    protected $primaryKey='id_DichVu';
    protected $fillable=[
        'id_DichVu',
        'ten_dv',
        'AnHien',
        'tien_dv',
        'noidung',
        'thoigian',
        
    ];
}
