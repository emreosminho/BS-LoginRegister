<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $table = 'warehouse';

    protected $fillable = [
        'name',
        'province',
        'district',
        'm2',
    ];

    public  function shelf()
    {
        return $this->hasMany(Warehouse::class,'warehouse_id');
    }
}
