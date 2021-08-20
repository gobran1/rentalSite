<div>
    <x-config-list listHeader="Pets">
        <div class="d-flex">
            @foreach($availablePets as $pet)
                <x-app-checkbox-btn
                    :name="$pet['type']"
                    :value="$pet['value']"
                    :label="$pet['type']"
                    type="checkbox"
                ></x-app-checkbox-btn>
            @endforeach
        </div>
    </x-config-list>
</div>
