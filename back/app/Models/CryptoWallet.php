<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CryptoWallet extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;
    const DELETED_AT = "sell_at";
}
