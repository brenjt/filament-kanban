<?php

namespace Mokhosh\FilamentKanban\Tests\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mokhosh\FilamentKanban\Tests\Enums\TaskStatus;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Task extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;

    protected $guarded = [];

    protected $casts = [
        'status' => TaskStatus::class,
    ];
}
