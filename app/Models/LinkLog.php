<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class LinkLog extends Model
{

    use HasFactory, HasUlids;

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

