 <div>
        @foreach($properties as $property)
            <x-property-item :property="$property"></x-property-item>
        @endforeach
    </div>

