<?php


namespace App\Filters;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PropertyFilter extends QueryFilters
{

    private const LONG_TERM = ">=";
    private const SHORT_TERM = "<=";
    private const MID_TERM = 18;

    /**
     * PropertyFilter constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    /**
     * @return array|mixed
     */
    public function filters()
    {
        return $this->request->filters;
    }


    /**
     * @param int $minValue
     * @param int $maxValue
     */
    public function PriceFilter($price)
    {
        $this->builder->whereBetween('monthly_rent', [$price[0], $price[1]]);
    }


    /**
     * @param int|string $count
     */
        public function bathroomsFilter($count)
    {
        if (Str::contains($count, '+')) {
            $bathroomCounts = substr($count, -2,1);
            $this->builder->where('bathrooms', '>=',$bathroomCounts);
            return;
        }
        $this->builder->where('bathrooms', $count);
    }


    /**
     * @param int|string $count
     */
    public function bedroomsFilter($count)
    {
        if (Str::contains($count, '+')) {
            $bedroomCounts = substr($count, -2,1);
            $this->builder->where('bedrooms', '>=', $bedroomCounts);
            return;
        }
        $this->builder->where('bedrooms', $count);
    }

    /**
     * @param array $pets
     */
    public function petsFilter($pets)
    {
        $this->builder
            ->where('pets_allowed', true)
            ->whereHas('pets', function (Builder $query) use ($pets) {
                return $query->whereIn('type', $pets);
            });
    }

    /**
     * @param array $buildingTypes
     */
    public function BuildingTypeFilter($buildingTypes)
    {
        $this->builder->whereIn('type', $buildingTypes);
    }

    public function leaseLengthFilter($leaseLengthType)
    {
        $leaseLengthType = Str::upper($leaseLengthType);
        try {
            $cmpSign = constant('self::' . $leaseLengthType);

            $this->builder->where(
                'rental_period_in_months'
                , $cmpSign
                , self::MID_TERM
            );
        }
        catch (\Exception $e){}

    }

    public function postedAtFilter($date)
    {
        $parsedDate = Carbon::parse($date);

        $this->builder->where('created_at', $date);
    }

    public function spaceFilter($space)
    {
        $this->builder->whereBetween('space', [$space - 20, $space + 20]);
    }

    public function amenitiesFilter($amenities)
    {
        $this->builder->whereHas('features', function (Builder $query) use ($amenities) {
            return $query->whereIn('name', $amenities);
        }, '=', count($amenities));
    }
}
