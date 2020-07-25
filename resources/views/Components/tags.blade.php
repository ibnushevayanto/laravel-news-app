<div>
    @foreach ($tags as $tag)
    <a href="{{ route('blogpost.tag', ['tag_id' => $tag->id]) }}"><span
            class="badge badge-{{ isset($color) ? $color : 'primary' }} {{ (isset($large)) ? ' large-text' : ''}}">{{$tag->name}}</span></a>
    @endforeach
</div>