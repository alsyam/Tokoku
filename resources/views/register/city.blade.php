@foreach ($cities as $city)
    @if (old('city') == $city->city_id)
        <option value="{{ $city->city_id }}" selected>{{ $city->type }} {{ $city->city_name }}
        </option>
    @else
        <option value="{{ $city->city_id }}"> {{ $city->type }} {{ $city->city_name }}
        </option>
    @endif
@endforeach
