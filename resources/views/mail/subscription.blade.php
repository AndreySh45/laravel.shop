Уважаемый клиент, товар {{ $product->title }} появился в наличии.

<a href="{{ route('showProduct', [$product->category['title'], $product->id]) }}">Узнать подробности</a>
