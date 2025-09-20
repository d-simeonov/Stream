<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StreamType extends Model
{
    protected $fillable = ['name'];

    public function streams(): HasMany|StreamType
    {
        return $this->hasMany(Stream::class, 'type');
    }
}
