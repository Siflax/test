@if (isset($matches))

    @if (empty($matches))
        <p>No products matched your search query</p>
    @else

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
        @foreach($matches as $match)
            <tr>
                <td><strong>{{$match->title}}</strong></td>
                <td>                </td>
                <td>                </td>
                <td>                </td>
            </tr>

            @if ( empty($match->variants) )
                <tr><td><p>This product has no variants</p></td></tr>
            @else
                @foreach($match->variants as $variant)

                        @include('rules.variants.partials.variant')

                @endforeach
            @endif
        @endforeach
        </tbody>

    </table>

    @endif

@endif

