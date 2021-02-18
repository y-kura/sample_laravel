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

    /**
     * 公開フラグの表示名の取得
     *
     * @return string
     */
    public function getPlublicFlagDisplay() {
        return $this->publicFlagChoices[$this->public_flag] ?? '';
    }

    /**
     * ユーザーの取得
     *
     * @return App\Models\User
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * コメントのリストの取得
     *
     * @return array
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
