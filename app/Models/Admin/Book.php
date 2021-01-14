<?php

namespace App\Models\Admin;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Book
 * @package App\Models
 * @property string $name
 * @property float $price
 */
class Book extends Model
{
    use SoftDeletes, CrudTrait;
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
