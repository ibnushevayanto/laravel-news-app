<h3>Komentar <span class="badge badge-primary">{{ $blogpost->jumlah_komentar }}</span></h3>
<div class="form-group">
    @auth
    <form action="{{ route('blogpost.comment.store', ['blogpost' => $blogpost->id]) }}" method="POST" id="formkomentar">
        @csrf
        @include('Components.Komentar._form_komentar')
    </form>
    @endauth
</div>

<x-list-komentar-blogpost :comments="$blogpost->comments"></x-list-komentar-blogpost>