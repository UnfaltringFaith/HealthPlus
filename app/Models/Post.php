<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'user_id', 'category', 'image', 'status', 'tags', 'created_at', 'updated_at', 'rating', 'view_count'];

    protected $appends = ['image_url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->image ? asset('storage/' . $this->image) : null,
        );
    }
}
