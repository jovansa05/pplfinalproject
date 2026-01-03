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
        'kecamatan_id',
        'kelurahan_id',
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

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }

    /**
     * Get full URL for image
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }
        
        return asset('storage/' . $this->image);
    }

    /**
     * Check if image file exists
     */
    public function imageExists()
    {
        if (!$this->image) {
            return false;
        }
        
        return \Storage::disk('public')->exists($this->image);
    }

    /**
     * Get full URL for completion proof
     */
    public function getCompletionProofUrlAttribute()
    {
        if (!$this->completion_proof) {
            return null;
        }
        
        return asset('storage/' . $this->completion_proof);
    }

    /**
     * Check if completion proof file exists
     */
    public function completionProofExists()
    {
        if (!$this->completion_proof) {
            return false;
        }
        
        return \Storage::disk('public')->exists($this->completion_proof);
    }
}