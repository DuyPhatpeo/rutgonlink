<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BioLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'bio_page_id',
        'label',
        'url',
        'type',
        'icon',
        'sort_order',
        'clicks',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the bio page that owns the link.
     */
    public function bioPage()
    {
        return $this->belongsTo(BioPage::class);
    }
}
