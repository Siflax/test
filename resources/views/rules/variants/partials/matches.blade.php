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
        @foreach($matches as $match)
            <tr>
                <td><strong>{{$match->title}}</strong></td>
                <td>                </td>
                <td>                </td>
                <td>                </td>
            </tr>
            @foreach($match->variants as $variant)

                    @include('rules.variants.partials.variant')

            @endforeach
        @endforeach
        </tbody>

    </table>

@endif
