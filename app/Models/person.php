<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class person extends Model
{
    use HasFactory;
    
    protected $fillable = [
        
        'comment',
        'person_id',
        'name',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    

}
