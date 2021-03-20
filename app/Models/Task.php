<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Task
 *
 * @package App\Models
 * @method static Builder|Task query()
 */
class Task extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'description',
        'due',
        'finished_at',
        'task_types_id',
    ];

    protected $appends = [
        'readable_date',
    ];

    protected $hidden = ["deleted_at"];

    public function taskType(): BelongsTo
    {
        return $this->belongsTo(TaskType::class);
    }

    public function getReadableDateAttribute()
    {
        return Carbon::create($this->due)->addHours(3);
    }
}
