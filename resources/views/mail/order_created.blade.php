<p>@lang('mail.order_created.dear') {{ $name }}</p>

<p>@lang('mail.order_created.your_order') {{ $fullSum }} {{ $order->currency->symbol }}. @lang('mail.order_created.created')</p>

<table>
    <tbody>
    @foreach($order->products as $product)
        <tr>
            <td>
                <a href="{{ route('showProduct', [$product->category['title'], $product->id]) }}">
                    <img height="56px" src="{{ $product->getImage() }}">
                    {{ $product->__('title') }}
                </a>
            </td>
            <td><span class="badge">{{ $product->countInOrder }}</span></td>
            <td>{{ $product->price }} {{ $currencySymbol }}.</td>
            <td>{{ $product->getPriceForCount() }} {{ $currencySymbol }}.</td>
        </tr>
    @endforeach
    </tbody>
</table>
