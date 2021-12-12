<p>Уважаемый {{ $name }}</p>

<p>Ваш заказ на сумму {{ $fullSum }} $ создан</p>

<table>
    <tbody>
    @foreach($order->products as $product)
        <tr>
            <td>
                <a href="{{ route('showProduct', [$product->category['title'], $product->id]) }}">
                    <img height="56px" src="{{ $product->getImage() }}">
                    {{ $product->title }}
                </a>
            </td>
            <td><span class="badge">{{ $product->pivot->count }}</span></td>
            <td>{{ $product->price }} $.</td>
            <td>{{ $product->getPriceForCount() }} $.</td>
        </tr>
    @endforeach
    </tbody>
</table>
