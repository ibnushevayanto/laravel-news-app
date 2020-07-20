<p class="text-muted">
    {{ empty(trim($slot)) ? 'Added' : $slot }} {{ $date }}
    @if (isset($name))
    by <b>{{ $name }}</b>
    @endif
</p>