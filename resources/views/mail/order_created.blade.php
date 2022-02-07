<p>@lang('mail.order_created.dear') {{ $name }}</p>

<p>@lang('mail.order_created.your_order') {{ $fullSum }} {{ $currencySymbol }}. @lang('mail.order_created.created')</p>

<table>
    <tbody>
    @foreach($order->skus as $sku)
        <tr>
            <td>
                <a href="{{ route('sku', [$sku->product->category->slug, $sku->product->id, $sku]) }}">
                    <img height="56px" src="{{ $sku->product->getImage() }}">
                    {{ $sku->product->__('title') }}
                </a>
            </td>
            <td><span class="badge">{{ $sku->countInOrder }}</span></td>
            <td>{{ $sku->price }} {{ $currencySymbol }}.</td>
            <td>{{ $sku->getPriceForCount() }} {{ $currencySymbol }}.</td>
        </tr>
    @endforeach
    </tbody>
</table>
