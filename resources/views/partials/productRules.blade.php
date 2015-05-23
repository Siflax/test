@if (isset($products))

<table class="table table-condensed" style="border-collapse:collapse;">

    <thead>
    <tr>
        <th></th>
        <th>Name</th>
        <th>Limit</th>
        <th>Track</th>
        <th></th>
    </tr>
    </thead>

    <tbody>


    @foreach($products as $product)
        @include('partials.product')
    @endforeach


    </tbody>
</table>










    <?php echo $products->render(); ?>
@endif