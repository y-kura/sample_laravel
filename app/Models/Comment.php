<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'article_id',
        'text',
    ];

    protected $dates = [
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }    
}
