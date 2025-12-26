<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'ticket_number',
        'user_id',
        'category_id',
        'image',        
        'description',
        'location',     
        'latitude',
        'longitude',
        'status',
        'admin_note',
        'completion_proof',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}