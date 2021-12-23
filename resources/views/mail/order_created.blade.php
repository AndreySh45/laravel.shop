<p>@lang('mail.order_created.dear') {{ $name }}</p>

<p>@lang('mail.order_created.your_order') {{ $fullSum }} @lang('main.rub'). @lang('mail.order_created.created')</p>

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
            <td><span class="badge">{{ $product->pivot->count }}</span></td>
            <td>{{ $product->price }} {{ App\Services\CurrencyConversion::getCurrencySymbol() }}.</td>
            <td>{{ $product->getPriceForCount() }} {{ App\Services\CurrencyConversion::getCurrencySymbol() }}.</td>
        </tr>
    @endforeach
    </tbody>
</table>
