<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortURL extends Model
{
    use HasFactory;
    protected $table = 'short_url';
    protected $fillable = ['code','url'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
