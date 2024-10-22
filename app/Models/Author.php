<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'authors';

    /**
     * Get the posts for the author.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'author_id');
    }
}
