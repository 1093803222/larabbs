<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * 设置支持修改的字段
     *
     * @var array
     */
    protected $fillable = [
        'name' => 'description'
    ];
}
