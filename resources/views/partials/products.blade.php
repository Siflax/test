@if (isset($products))

    @foreach($products as $product)
        @include('partials.product', array('display'=> 'rules'))
    @endforeach

    <?php echo $products->render(); ?>

@endif


