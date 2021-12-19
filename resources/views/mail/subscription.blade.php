@lang('mail.subscription.dear_client') {{ $product->title }} @lang('mail.subscription.appeared_in_stock').

<a href="{{ route('showProduct', [$product->category['title'], $product->id]) }}">@lang('mail.subscription.more_info')</a>
