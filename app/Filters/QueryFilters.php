<?php


namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QueryFilters
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
        foreach ($this->filters() as $name => $value) {
            $name = Str::camel($name).'Filter';

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

    public function filters()
    {
        return $this->request->all();
    }
}
