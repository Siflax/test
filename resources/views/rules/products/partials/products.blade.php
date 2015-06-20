<table class="table">
    <thead>
    <tr>
        <th>Title</th>
        <th>Limit</th>
        <th>Track</th>
        <th></th>
    </tr>
    </thead>

    @if (isset($products))


        <tbody>

        @foreach($products as $product)
            @include('rules.products.partials.product')
        @endforeach

        </tbody>



        <?php echo $products->render(); ?>

    @endif

</table>
