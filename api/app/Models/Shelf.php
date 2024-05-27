<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelf extends Model
{
    use HasFactory;

    protected $table = 'shelf';

    protected $fillable = [
        'warehouse_id',
        'block',
        'shelf_name',
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
