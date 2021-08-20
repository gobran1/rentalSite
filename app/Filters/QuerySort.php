<?php


namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class QuerySort
{
    protected $request;

    /**
     * @var Builder
     */
    protected $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;
        foreach ($this->sortTerms() as $name => $value) {
            $name = 'sortBy' . $name;
            if (!method_exists($this, $name)) {
                continue;
            }
            if (isset($value)) {
                $this->$name($value);
            } else {
                $this->$name();
            }
        }

        return $this->builder;
    }

    public function sortTerms()
    {
        return $this->request->sortBy;
    }
}
