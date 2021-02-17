<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'category_id',
        'posted_at',
        'public_flag',
    ];

    private $publicFlagChoices = [
        0 => '非公開',
        1 => '公開',
    ];

    protected $dates = [
        'posted_at',
        'created_at',
        'updated_at',
    ];

    public function getPlublicFlagDisplay() {
        return $this->publicFlagChoices[$this->public_flag] ?? '';
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
