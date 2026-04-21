<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BioPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'workspace_id',
        'slug',
        'title',
        'bio',
        'profile_image',
        'theme_data',
        'is_active',
    ];

    protected $casts = [
        'theme_data' => 'json',
        'is_active' => 'boolean',
    ];

    /**
     * Get the workspace that owns the bio page.
     */
    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }

    /**
     * Get the links for the bio page.
     */
    public function links()
    {
        return $this->hasMany(BioLink::class)->orderBy('sort_order', 'asc');
    }
}
