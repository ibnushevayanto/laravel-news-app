@extends('Layout.default')

@section('title', 'Detail BlogPost')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="mb-5">
                <a href="{{ route('blogpost.index') }}" style="color: #acacac;">
                    <i class="fa fa-arrow-left"></i> <span class="font-weight-bold">Back</span>
                </a>
            </div>
            <div>
                <h1>{{ $blogpost->title }}</h1>

                {{-- Ini adalah cara pertama membuat component --}}
                {{-- Sama seperti view arahkan ke file components nya --}}
                {{-- Cara mengirim parameter juga sama seperti views() --}}
                {{-- @component('Components.badge', ['type'=> 'primary']) 
                    New!
                    @endcomponent  --}}

                {{-- Ini adalah cara kedua membuat component --}}
                {{-- Cara menggunakan component yang sudah di instansiasi --}}
                <x-badge type="primary" show="{{ now()->diffInMinutes($blogpost->created_at) <= 5 }}">
                    New!
                </x-badge>
                <x-date-upload date="{{ $blogpost->created_at->diffForHumans() }}" name="{{ $blogpost->user->name }}">
                </x-date-upload>
                <div class="content mt-4">
                    <h5 class="text-muted font-weight-bold" style="line-height: 30px">
                        {{ $blogpost->content }}
                    </h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-md-center mt-5 mb-3">
        <div class="col-md-8">
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
        </div>
    </div>
</div>
@endsection