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

    public function getPlublicFlagDisplay() {
        return $this->publicFlagChoices[$this->public_flag] ?? '';
    }
}
