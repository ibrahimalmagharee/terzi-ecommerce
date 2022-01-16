<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialMediaLink extends Model
{
    use SoftDeletes;
    protected $table = 'social_media_links';
    protected $fillable = ['link', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];
}
