<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestEquipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_type',
        'manufacturer',
        'model',
        'dsn_name',
        'serial_no',
        'label',
        'purchase_date',
        'warranty_remain',
        'user',
    ];
}