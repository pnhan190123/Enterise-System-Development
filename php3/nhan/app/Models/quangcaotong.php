<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quangcaotong extends Model
{
    use HasFactory;
    protected $table='quangcaotong';
    protected $primaryKey='id';
    protected $fillable=[
        'id',
        'id_quangcao',
        'id_quangcaobaibao',
        'giatien',
        'thang',
        'role_quangcao',
    ];
}
