<?php

namespace Tests\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class PostWithStringCascade extends Model
{
    use SoftDeletes, CascadeSoftDeletes;

    public $dates = ['deleted_at'];

    protected $table = 'posts';

    protected $cascadeDeletes = 'comments';

    protected $fillable = ['title', 'body'];

    public function comments()
    {
        return $this->hasMany('Tests\Entities\Comment', 'post_id');
    }
}
