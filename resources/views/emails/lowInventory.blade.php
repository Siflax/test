@if($notifications)

The following products are low on inventory:

<table class="table">
    <thead>
    <tr>
        <th>Type</th>
        <th>Title</th>
        <th>Inventory</th>
        <th>Limit</th>
        <th>Product</th>
    </tr>
    </thead>
    <tbody>

        @foreach($notifications as $notification)
            <tr>
                <td>{{ $notification['type'] }}</td>
                <td>{{ $notification['title'] }}</td>
                <td>{{ $notification['inventory'] }}</td>
                <td>{{ $notification['limit'] }}</td>
                <td>{{ $notification['product'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@else
    <p>There is no products with low inventory</p>
@endif