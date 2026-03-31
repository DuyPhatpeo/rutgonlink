<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkLog extends Model
{

    use HasFactory;

    protected $fillable = [
        'link_id',
        'ip_address',
        'user_agent'
    ];

    /**
     * Lấy link tương ứng với log này.
     */
    public function link()
    {
        return $this->belongsTo(Link::class);
    }
}

