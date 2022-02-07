@lang('mail.subscription.dear_client') {{ $sku->__('name') }} @lang('mail.subscription.appeared_in_stock').

<a href="{{ route('sku', [$sku->product->category->slug, $sku->product->id, $sku->id]) }}">@lang('mail.subscription.more_info')</a>
