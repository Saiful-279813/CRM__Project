<ul class="search-item-design">
    @forelse ($products as $product)
    <a href="{{ route('product-details',[$product->id,$product->product_slug]) }}">
        <li class="design-li">
            <img src="{{ asset($product->product_thambnail) }}" alt="" height="100px;" width="100px;">
            <strong >{{ $product->product_name }}</strong> <hr>
        </li>
    </a>
    @empty
        <li style="color: red; padding:0 20px;">Not Found</li>
    @endforelse
</ul>
