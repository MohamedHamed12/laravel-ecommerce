<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'photo', 'description', 'status'];

    // Accessor to get the full image URL
    public function getPhotoUrlAttribute()
    {
        return $this->photo ? asset("storage/{$this->photo}") : null;
    }

    // Include photo_url in the JSON response
    protected $appends = ['photo_url'];
}
