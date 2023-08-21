<div class="breadcrumbs mt-3">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumb">
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumb-item">
            @if(Request::is('/'))
                <span class="nav-link" itemprop="item" href="/">
                    <span itemprop="name">{{ __('page.home') }}</span>
                </span>
            @else
                <a class="nav-link" itemprop="item" href="/">
                    <span itemprop="name">{{ __('page.home') }}</span>
                </a>
            @endif
            <meta itemprop="position" content="1"/>
        </li>
        @foreach ($links as $link)
            <span class="prefix_breadcrumbs me-2 ms-2">/</span>
            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumb-item">
                <a class="nav-link" itemprop="item"
                   href="@isset($link['link']) {{ $link['link'] }}@else{{ '#' }} @endif">
                    <span itemprop="name">{!! $link['title'] !!}</span>
                </a>
                <meta itemprop="position" content={{$loop->index + 2}} />
            </li>
        @endforeach
    </ol>
</div>
