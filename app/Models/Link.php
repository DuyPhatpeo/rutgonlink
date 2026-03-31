<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{



    use HasFactory;

    protected $fillable = [
        'user_id',
        'original_url',
        'short_code',
        'clicks'
    ];

    /**
     * Lấy lịch sử truy cập của link này.
     */
    public function logs()
    {
        return $this->hasMany(LinkLog::class);
    }

    /**
     * Lấy người sở hữu link này.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

