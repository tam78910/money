<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    protected $fillable = ['kind_id', 'amount', 'description'];

    protected $appends = ['date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kind()
    {
        return $this->belongsTo(Kind::class);
    }

    public function getDateAttribute()
    {
        return $this->created_at->format('d.m.Y');            
    }
}
