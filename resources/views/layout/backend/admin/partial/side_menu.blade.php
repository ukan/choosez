<ul class="nav nav-main">
@foreach ($menus as $menu)
    @if ($menu['is_parent'])
        @hasaccess((isset($menu['child_permissions']) ? $menu['child_permissions'] : []), true)
            <li class="{!! (Request::is($menu['pattern'].'/*')) ? 'nav-parent nav-expanded' : 'nav-parent' !!}">
                <a href="#" title="{{ $menu['display_name'] }}">
                    <i class="fa fa-{{ $menu['icon'] }}"></i> <span>{{ $menu['display_name'] }}</span>
                </a>
                @if (isset($menu['child']))
                    <ul class="nav nav-children">
                        @foreach($menu['child'] as $child)
                            @hasaccess($child['name'])
                                <li{!! (url($child['href']) == Request::url() OR Request::is($child['href'].'/*')) ? ' class="active"' : '' !!}>
                                    <a href="{!! url($child['href']) !!}" title="{{ $child['display_name'] }}">
                                        <i class="fa fa-{{ $child['icon'] }}"></i> {{ $child['display_name'] }}
                                    </a>
                                </li>
                            @endhasaccess
                        @endforeach
                    </ul>
                @endif
            </li>
        @endhasaccess
    @else
        @hasaccess($menu['name'])
            <li{!! (url($menu['href']) == Request::url() OR Request::is($menu['href'].'/*')) ? ' class="active"' : '' !!}>
                <a href="{!! url($menu['href']) !!}" title="{!! $menu['display_name'] !!}">
                    <i class="fa fa-{{ $menu['icon'] }}"></i> <span>{{ $menu['display_name'] }}</span>
                </a>
            </li>
        @endhasaccess
    @endif
@endforeach
</ul>