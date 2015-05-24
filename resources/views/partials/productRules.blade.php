@if (isset($products))





    @foreach($products as $product)
        @include('partials.product')
    @endforeach











    <?php echo $products->render(); ?>
@endif