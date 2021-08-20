<?php

namespace App\Traits;

trait Sortable
{
    public function scopeSortBy($query, QuerySort $sort)
    {
        return $sort->apply($query);
    }
}
