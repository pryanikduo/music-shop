@foreach($categories as $category)
    @php
        $hasChildren = $category->categories->count() > 0;
    @endphp
    <li class="{{ $hasChildren ? 'dropdown-submenu' : '' }}">
        <a href="{{ route('catalog', ['locale' => app()->getLocale(), 'category' => $category->category_id]) }}">
            {{ $category->name }}
        </a>
        @if($hasChildren)
            <ul class="dropdown-menu">
                @include('layouts.partials.menu_recursive', ['categories' => $category->categories])
            </ul>
        @endif
    </li>
@endforeach