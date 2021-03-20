<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TaskType
 * @package App\Models
 */
class TaskType extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    protected $hidden = ["deleted_at"];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
