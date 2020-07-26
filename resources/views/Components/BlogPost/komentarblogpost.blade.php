<h3>Komentar <span class="badge badge-primary">{{ $blogpost->jumlah_komentar }}</span></h3>
<div class="form-group">
    @auth
    <form action="{{ route('blogpost.comment.store', ['blogpost' => $blogpost->id]) }}" method="POST" id="formkomentar">
        @csrf
        <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content" rows="3"
            placeholder="Tulis Komentar..."></textarea>
        @if ($errors->has('content'))
        <div class="invalid-feedback">{{ $errors->first('content') }}</div>
        @endif
        <div class="text-right">
            <button class="btn btn-danger mt-3" type="reset"><i class="fa fa-undo mr-1"></i>
                Reset</button>
            <button class="btn btn-primary mt-3" type="submit"><i class="fa fa-paper-plane mr-1"></i>
                Kirim</button>
        </div>
    </form>
    @endauth
</div>
@forelse ($blogpost->comments as $komentar)
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