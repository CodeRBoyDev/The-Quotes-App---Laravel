<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;
    
    protected $table = 'quotes';

    public function author()
    {
     return $this->belongsTo(Author::class);
    }
}
