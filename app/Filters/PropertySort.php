<?php


namespace App\Filters;

use Illuminate\Http\Request;

class PropertySort extends QueryFilters
{
    /**
     * PropertyFilter constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function sortByLowPrice()
    {
        $this->builder->orderBy('monthly_rent', 'asc');
    }

    public function sortByHighPrice()
    {
        $this->builder->orderBy('monthly_rent', 'desc');
    }

    public function sortByNewest()
    {
        $this->builder->orderBy('created_at', 'desc');
    }

    public function sortByOldest()
    {
        $this->builder->orderBy('created_at', 'asc');
    }
}
