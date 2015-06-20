@if (isset($matches))

    <table class="table">
    <thead>
    <tr>
        <th>Title</th>
        <th>Limit</th>
        <th>Track</th>
        <th></th>
    </tr>
    </thead>



        <tbody>

        @foreach($matches as $product)
            @include('rules.products.partials.product')
        @endforeach

        </tbody>

    </table>

@endif
