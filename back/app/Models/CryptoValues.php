<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CryptoValues extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function Crypto(): BelongsTo
    {
        return $this->belongsTo(Crypto::class);
    }

}
