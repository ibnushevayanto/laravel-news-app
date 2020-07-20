<div class="card border-0 {{ (isset($addMarginTop) && $addMarginTop)  ? 'mt-3' : '' }}">
    <div class="card-body">
        <h5 class="card-title">{{ $title }}</h5>
        <h6 class="card-subtitle mb-2 text-muted">{{ $subtitle }}</h6>
    </div>
    <ul class="list-group">

        @if (isset($flag) && $flag == 'blogposts')
        @foreach ($items as $item)
        <li class="list-group-item border-right-0 border-left-0">
            <a href="{{ route('blogpost.show', $item->id) }}">{{ $item->title }}</a>
        </li>
        @endforeach

        @else

        @foreach ( $items as $item)
        <li class="list-group-item border-right-0 border-left-0">
            {{ $item }}
        </li>
        @endforeach

        @endif


    </ul>
</div>