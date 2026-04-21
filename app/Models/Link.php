<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{



    use \Illuminate\Database\Eloquent\Concerns\HasUlids;
    use HasFactory;

    protected $fillable = [
        'user_id',
        'original_url',
        'short_code',
        'clicks',
        'password',
        'expires_at',
        'click_limit',
        'title',
        'description',
        'thumbnail',
        'is_active',
        'workspace_id'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'short_code';
    }

    /**
     * Get the workspace that owns the link.
     */
    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }

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

