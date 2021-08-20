@extends('layouts.app')

@section('content')
    <div class="row container-fluid">
        <div class="col-md-4">
                <x-property-filters :features="$features"></x-property-filters>
        </div>

        <div class="col-md-8">
            <x-property-items :properties="$properties"></x-property-items>
        </div>

    </div>

@endsection
