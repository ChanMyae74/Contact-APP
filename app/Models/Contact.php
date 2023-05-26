<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;
    protected $cascadeDeletes = ['contact_queues'];
    protected $dates = ["deleted_at"];
    protected $fillable = ["name", "phone", "photo", "user_id"];
    protected $casts = ["phones" => "array"];

    public function contact_queues()
    {
        return $this->hasMany(ContactQueue::class, "contact_ids");
    }
}
