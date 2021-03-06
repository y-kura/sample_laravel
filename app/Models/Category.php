<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * カテゴリー名のリストの取得
     *
     * @return array
     */
    public static function getNames() {
        return self::all()->pluck('name', 'id')->toArray();
    }
}
