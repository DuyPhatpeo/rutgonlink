<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'owner_id',
        'logo',
        'is_personal',
    ];

    protected $casts = [
        'is_personal' => 'boolean',
    ];

    /**
     * Get the owner of the workspace.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Get the users that belong to the workspace.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'workspace_user')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    /**
     * Get the links for the workspace.
     */
    public function links()
    {
        return $this->hasMany(Link::class);
    }

    /**
     * Get the bio pages for the workspace.
     */
    public function bioPages()
    {
        return $this->hasMany(BioPage::class);
    }
}
