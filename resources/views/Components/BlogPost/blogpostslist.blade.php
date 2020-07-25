@forelse ($blogpost as $item)
<div class="col-md-6 px-2 py-2">
    <div style="background-color: white; position: relative; height: 100%;" class="px-3 py-3 mr-3 mb-3">
        {{-- Title --}}
        <a href="{{route('blogpost.show', ['blogpost' => $item->id])}}"
            class="{{ $item->trashed() ? 'text-muted' : '' }}">
            <h2 class="font-weight-bold d-inline-block">
                @if ($item->trashed())
                <del>
                    @endif
                    {{$item->title}}
                    @if ($item->trashed())
                </del>
                @endif
            </h2>
        </a>
        {{-- End Title --}}

        {{-- Tags --}}
        <x-data-tags :tags="$item->tags"></x-data-tags>
        {{-- End Tags --}}

        {{-- Edit Button --}}
        @auth
        @can('update', $item)
        <a href="{{ route('blogpost.edit', ['blogpost' => $item->id]) }}">
            <i class="fa fa-edit"></i> Edit
        </a>
        @endcan
        @endauth
        {{-- End Edit Button --}}

        {{-- Badge Baru --}}
        {{--  Conditional Jika Waktu Koten Dibuat Kurang Dari 5 Menit  --}}
        @if ((new Carbon\Carbon())->diffInMinutes($item->created_at) <= 5) <span class="badge badge-success">
            <strong>New!</strong>
            </span>
            @endif
            {{-- End Of Badge Baru --}}

            {{-- View Tanggal Upload --}}
            {{-- diffForHumans() untuk merubah waktu dari aneh menjadi format yang bisa dibaca manusia --}}
            <x-date-upload name="{{ $item->user->name }}" date="{{ $item->created_at->diffForHumans() }}">
            </x-date-upload>
            {{-- Tanggal Upload --}}

            {{-- Deskripsi --}}
            <p class="review-text">
                {{ $item->content }}
            </p>
            {{-- End Deskripsi --}}

            {{-- Jumlah Komentar --}}
            @if ($item->jumlah_komentar > 0)
            <p class="text-muted">
                <small>{{ $item->jumlah_komentar }} Komentar</small>
            </p>
            @else
            <p class="text-muted">
                <small>Not have a comment</small>
            </p>
            @endif
            {{-- End Jumlah Komentar --}}

            {{-- Button Hapus --}}
            @if (!$item->trashed())
            @auth
            @can('delete', $item)
            <form action="{{route('blogpost.destroy', ['blogpost' => $item->id])}}" method="post">
                @csrf
                {{-- Jika Method Tidak Tersedia Pada HTML gunakan @method --}}
                @method('DELETE')
                <button class="avatar btn btn-danger btn-sm" type="submit"
                    style="position: absolute; top: -10px; right: -10px;">
                    <i class="fa fa-times"></i>
                </button>
            </form>
            @endcan
            @endauth
            @endif
            {{-- End Button Hapus --}}
    </div>
</div>
@empty
<div class="col-md-12">
    <p class="text-center bg-white py-3 text-muted">Data Kosong</p>
</div>
@endforelse