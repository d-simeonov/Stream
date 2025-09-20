<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Stream extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'title', 'description', 'tokens_price', 'type', 'date_expiration', 'user_id'
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string)Str::uuid();
        });
    }

    public function streamType(): BelongsTo
    {
        return $this->belongsTo(StreamType::class, 'type');
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
