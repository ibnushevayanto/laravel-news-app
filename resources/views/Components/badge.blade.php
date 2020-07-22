{{-- Isi  dari sebuah element akan memberikan parameter $slot  --}}
@if (!isset($show) || $show)

<span class="badge badge-{{ isset($type) ? $type : 'success' }}">
    <strong>{{$slot}}</strong>
</span>

@endif