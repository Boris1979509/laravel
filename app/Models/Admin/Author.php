<?php

namespace App\Models\Admin;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Author
 * @package App\Models
 * @property string $name
 */
class Author extends Model
{
    use SoftDeletes, CrudTrait;
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
