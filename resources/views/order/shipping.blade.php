<h6>Choose Duration</h6>
<select class="form-select form-select mb-3" id="shipping" onchange="costCourier()">
    @foreach ($cost as $cost)
        <option value="">Shipping</option>
        <option
            value="{{ json_encode(['cost' => $cost->cost[0]->value, 'service' => $cost->service, 'etd' => $cost->cost[0]->etd]) }}">
            <div>Paket: {{ $cost->service }}</div>
            <div>Desc: {{ $cost->description }}</div>
            <div>Cost: {{ $cost->cost[0]->value }}</div>
            <div>Estimasi Hari: {{ $cost->cost[0]->etd }}</div>
        </option>
    @endforeach
</select>

{{-- <input type="hidden" id="shipping" value="{{ $cost }}"> --}}
