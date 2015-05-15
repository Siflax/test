@if (isset($matches))
    @foreach($matches as $product)
        @include('partials.product')
    @endforeach
@endif