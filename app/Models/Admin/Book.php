<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Book
 * @package App\Models
 * @property string $name
 * @property float $price
 */
class Book extends Model
{
    /**
     * @var array $fillable
     */
    protected $fillable = [
        'name',
        'price',
    ];
    /**
     * @var array $casts
     */
    protected $casts = [
        'price' => 'float',
    ];

    /**
     * Авторы, принадлежащие этой книги.
     */
    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }
}
