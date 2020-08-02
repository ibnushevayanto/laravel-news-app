@forelse ($comments as $komentar)
<div class="bg-white p-3" style="border-bottom: 1px solid #eee;">
    <div class="text-primary">
        <b>{{ $komentar->user->name }}</b>
    </div>
    <x-date-upload date="{{ $komentar->created_at->diffForHumans() }}"></x-date-upload>
    <p>{{ $komentar->content }}</p>
</div>
@empty
<div class="bg-white p-3">
    <p class="text-muted">Tidak ada komentar</p>
</div>
@endforelse