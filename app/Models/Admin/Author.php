<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Author
 * @package App\Models
 * @property string $name
 */
class Author extends Model
{
    /**
     * @var array $fillable
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Книги, принадлежащие автору.
     */
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }
}
