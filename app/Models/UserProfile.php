<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id',
        'address',
        'contact_number'
    ];

    // Relationships

    public function user(){
        return $this->belongsTO(User::class);
    }
}
