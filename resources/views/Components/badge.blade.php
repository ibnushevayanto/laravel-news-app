{{-- Isi  dari sebuah element akan memberikan parameter $slot  --}}
@if (!isset($show) || $show)
<div>
    <span class="badge badge-{{ isset($type) ? $type : 'success' }}">
        <strong>{{$slot}}</strong>
    </span>
</div>
@endif