@push('styles')
    <style>
        section.range-slider {
            position: relative;
        }

        section.range-slider input {
            pointer-events: none;
            position: absolute;
        }

        section.range-slider input::-webkit-slider-thumb {
            pointer-events: all;
            position: relative;
            z-index: 1;
        }

        section.range-slider input::-moz-range-thumb {
            pointer-events: all;
            position: relative;
            z-index: 10;
        }

        section.range-slider input::-moz-range-track {
            position: relative;
            z-index: -1;
            background-color: rgba(0, 0, 0, 1);
            border: 0;
        }

        section.range-slider input:last-of-type::-moz-range-track {
            -moz-appearance: none;
            background: none transparent;
            border: 0;
        }

        section.range-slider input[type=range]::-moz-focus-outer {
            border: 0;
        }

    </style>
@endpush

<div>
    <form onsubmit="event.preventDefault()" action="">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Property Filters
                </div>
            </div>
            <div class="card-body" style="max-height: 80vh;overflow: auto">
                <h6>
                    price
                </h6>
                <div>
                    $<span id="minSalary">1,500</span>
                    --
                    $<span id="maxSalary">3,000</span>
                </div>
                <section class="range-slider" id="salaryRange">
                    <span class="rangeValues"></span>

                    <input id="minRange" type="range" class="form-range" min="200" max="7000" value="1500">
                    <input id="maxRange" type="range" class="form-range" min="200" max="7000" value="3000">
                </section>
                <br>

                <div
                    class="<d-flex flex-wrap> justify-content-between border-start-0 border-end-0 border border-bottom-0">

                    <div class="my-4">
                        <div class="text-muted">
                            Bedrooms
                        </div>
                        <div class="btn-group" aria-label="Basic radio toggle button group">

                            @foreach($bedroomOptions as $option)
                                <input
                                    type="radio"
                                    class="btn-check"
                                    name="bedrooms"
                                    value="{{$option['value']}}"
                                    id="bedroom_radio_{{$option['value']}}"
                                >

                                <label
                                    for="bedroom_radio_{{$option['value']}}"
                                    class="btn mx-1 btn-outline-primary"
                                >
                                    {{$option['title']}}
                                </label>

                            @endforeach

                        </div>
                    </div>

                    <div class="my-4">
                        <div class="text-muted">
                            Bathrooms
                        </div>
                        <div class="btn-group d-flex btn-group-toggle">
                            @foreach($bathroomOptions as $option)
                                <input
                                    type="radio"
                                    class="btn-check flex-wrap"
                                    name="bathrooms"
                                    value="{{$option['value']}}"
                                    id="bathroom_radio_{{$option['value']}}"
                                >

                                <label
                                    for="bathroom_radio_{{$option['value']}}"
                                    class="btn mx-1 btn-outline-primary"
                                >
                                    {{$option['title']}}
                                </label>
                            @endforeach
                        </div>
                    </div>

                </div>

                <div
                    class="d-flex flex-wrap justify-content-around border-start-0 border-end-0 border border-bottom-0">
                    <div class="my-4 flex-grow-1">
                        <x-pets-checkboxes></x-pets-checkboxes>
                    </div>
                    <div class="my-4 flex-grow-1">
                        <x-config-list listHeader="Sort">
                            <select name="sort" class="form-select">
                                @foreach($sortOptions as $option)
                                    <option value="{{$option['value']}}">{{$option['title']}}</option>
                                @endforeach
                            </select>
                        </x-config-list>
                    </div>

                </div>

                <div class="border-start-0 border-end-0 border border-bottom-0 row row-cols-2">
                    @foreach($additionalFilters as $filter)
                        <div class="col my-3">
                            <x-config-list list-header="{{$filter['sectionName']}}">
                                @foreach($filter['values'] as $filterValue)
                                    <x-app-checkbox
                                        name="{{$filter['name']}}"
                                        type="{{$filter['inputType']}}"
                                        value="{{$filterValue}}"
                                        label="{{$filterValue}}"
                                    ></x-app-checkbox>
                                @endforeach
                            </x-config-list>
                        </div>
                    @endforeach

                    <div class="col">
                        <x-config-list listHeader="Others">
                            <x-app-checkbox
                                name="posted_at"
                                value="today"
                                label="posted today"
                            >
                            </x-app-checkbox>

                            <div class="input-group flex-nowrap align-items-center">
                                <span style="padding-right: 20px">Space :</span>
                                <input
                                    type="number"
                                    class="form-control form-floating"
                                    name="space"
                                    placeholder="space"
                                >
                                <span class="input-group-text  position-relative">
                                    m2
                                </span>
                            </div>
                        </x-config-list>

                    </div>

                    <div class="col-12 my-4">
                        <x-config-list list-header="amenities">
                            <div style="padding-left: 10px" class="row row-cols-md-3 row-cols-2">
                                @foreach($features as $feature)
                                    <div class="col">
                                        <x-app-checkbox
                                            value="{{$feature->name}}"
                                            name="features"
                                            label="{{$feature->name}}"
                                        >
                                        </x-app-checkbox>
                                    </div>
                                @endforeach
                            </div>
                        </x-config-list>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <div>
                    <button class="btn btn-outline-primary">
                        Cancel
                    </button>
                    <button class="btn btn-primary">
                        Search
                    </button>
                </div>
                <div>
                    <button class="btn btn-link">
                        reset all filters
                    </button>
                </div>

            </div>
        </div>
    </form>
</div>

@push('scripts')
    <script>
        var minRange = document.getElementById('minRange')
        var maxRange = document.getElementById('maxRange')
        var maxSalary = document.getElementById('maxSalary')
        var minSalary = document.getElementById('minSalary')
        var salaryRange = document.getElementById('salaryRange')


        salaryRange.addEventListener('input', (event) => {
            let maxValue = parseInt(maxRange.value)
            let minvalue = parseInt(minRange.value)

            if (minvalue > maxValue) {
                let tmp = minvalue
                minvalue = maxValue
                maxValue = tmp
            }

            minSalary.innerText = minvalue
            maxSalary.innerText = maxValue
        })


    </script>
@endpush
