<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactQueue extends Model
{
    use HasFactory;
    protected $fillable = ["contact_id", "sender_id", "receiver_id", "status"];
    public function contact()
    {
        return $this->belongsTo(Contact::class, json_decode("contact_id"));
    }
    public function sender()
    {
        return $this->belongsTo(User::class, "sender_id");
    }
}
