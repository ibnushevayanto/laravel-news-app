<h3>Komentar <span class="badge badge-secondary">{{ $blogpost->jumlah_komentar }}</span></h3>
@forelse ($blogpost->comments as $komentar)
<div class="bg-white p-3" style="border-bottom: 1px solid #eee;">
    <x-date-upload date="{{ $komentar->created_at->diffForHumans() }}"></x-date-upload>
    <p>{{ $komentar->content }}</p>
</div>
@empty
<div class="bg-white p-3">
    <p class="text-muted">Tidak ada komentar</p>
</div>
@endforelse