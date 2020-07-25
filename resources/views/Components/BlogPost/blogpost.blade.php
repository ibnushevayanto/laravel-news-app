<div>
    <x-data-tags :tags="$blogpost->tags"></x-data-tags>
    <h1>{{ $blogpost->title }}
        <x-badge type="primary" show="{{ now()->diffInMinutes($blogpost->created_at) <= 5 }}">
            New!
        </x-badge>
    </h1>
    {{-- Ini adalah cara pertama membuat component --}}
    {{-- Sama seperti view arahkan ke file components nya --}}
    {{-- Cara mengirim parameter juga sama seperti views() --}}
    {{-- @component('Components.badge', ['type'=> 'primary']) 
                    New!
                    @endcomponent  --}}

    {{-- Ini adalah cara kedua membuat component --}}
    {{-- Cara menggunakan component yang sudah di instansiasi --}}

    <x-date-upload date="{{ $blogpost->created_at->diffForHumans() }}" name="{{ $blogpost->user->name }}">
    </x-date-upload>
    <div class="text-muted">
        <b><i class="fa fa-eye"></i> {{ $watched }}</b>
    </div>
    <div class="content mt-4">
        <h5 class="text-muted font-weight-bold" style="line-height: 30px">
            {{ $blogpost->content }}
        </h5>
    </div>
</div>