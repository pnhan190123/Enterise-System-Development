<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class naptien extends Model
{
    use HasFactory;
    protected $table='naptien';
    protected $primaryKey='id_nap';
    protected $fillable=[
        'id_nap',
        'idUser',
        'sotien',
        'role_nap',
        'thoigiannap',
        'loai',
       
    ];
}
