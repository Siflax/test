@if (isset($matches))

    @foreach($matches as $product)
        @include('partials.product', array('display'=> 'search'))
    @endforeach

    <?php echo $products->render(); ?>

@endif


