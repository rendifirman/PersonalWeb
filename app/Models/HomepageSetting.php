<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'hero_description',
        'cta_text',
        'hero_photo',
        'email',
        'phone',
        'location',
        'about_title',
        'about_text',
        'skills',
        'linkedin',
        'instagram',
        'github',
        'twitter',
        'name',
        'title',
        'bio',
        'photo',
    ];

    public function selectedSkills()
    {
        return $this->belongsToMany(Skill::class);
    }

    public function softSkills()
    {
        return $this->selectedSkills()->where('type', 'soft');
    }

    public function hardSkills()
    {
        return $this->belongsToMany(Skill::class)->where('type', 'hard');
    }
}
