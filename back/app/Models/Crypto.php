<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Crypto extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function CryptoValues(): HasMany
    {
        return $this->hasMany(CryptoValues::class);
    }
}
