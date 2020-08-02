<p class="text-muted">
    {{ empty(trim($slot)) ? 'Added' : $slot }} {{ $date }}
    @if (isset($user))
    by <a href="{{ route('user.show', ['user' => $user->id]) }}"><b>{{ $user->name }}</b></a>
    @endif
</p>