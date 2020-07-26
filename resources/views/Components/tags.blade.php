<div class="{{ (isset($menu)) ? 'd-flex justify-content-center' : '' }}">
    @foreach ($tags as $tag)
    <a href="{{ route('blogpost.tags.index', ['tag_id' => $tag->id]) }}">
        <span
            class="badge {{ isset($menu) ? ($namatag == $tag->name) ? 'badge-primary' : '' : 'badge-primary' }} {{ (isset($menu)) ? ' large-text mr-2' : ''}}">
            {{$tag->name}}
        </span>
    </a>
    @endforeach
</div>