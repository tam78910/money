<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    protected $fillable = ['amount', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kind()
    {
        return $this->belongsTo(Kind::class);
    }
}
