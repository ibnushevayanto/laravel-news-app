<?php

/*
    * +++ FUN FACT +++

    ? Perdbedaan find dengan where
    ! Kalau where itu menghasilkan multiple data tetapi find menghasilkan single data

    // =======================================================================================================================

    * +++ QUERY RELATIONSHIP +++

    * Note Mengenai Relation [One To One] And [One To Many] : 

    ? Relationship Insert Data
    ? $author adalah primaryKey Sedangkan $profile adalah foreignKey
    ! 1. $author->profile()->save($profile);
    ! 2. $profile->author()->associate($author)->save();

    // =======================================================================================================================

    * Note Mengenai Relationship Existance

    ? Mencari Record BlogPosts Yang Sudah Memiliki Komentar
    ! BlogPosts::has('comments')->get();

    ? Mencari BlogPosts Yang Mempunyai Komentar Lebih Dari 5
    ! BlogPosts::has('comments', '>', '5')->get();

    ? Mencari Komentar Pada BlogPosts Yang Mempunyai Content Tertentu
    ! BlogPosts::whereHas('comments', function($query){ 
    !    $query->where('content', 'like', '%test%'); 
    ! })->get();

    // =======================================================================================================================

    * Note Mengenai Relationship Absence

    ? Mencari Record Yang Tidak Memiliki Komentar
    ! BlogPosts::has('comments')->get();

    ? Mencari Komentar Yang Tidak Memiliki Content Yang Diinginkan
    ! BlogPosts::whereDoesntHave('comments', function($query){ 
    !    $query->where('content', 'like', '%abc%'); 
    ! })->get();
    
    // =======================================================================================================================
    
    * Note Mengenai withCount

    ? Menampilkan Jumlah Komentar
    ! BlogPosts::withCount(['comments as jumlah_komentar'])->get();

    ? Menampilkan Jumlah Komentar Semuanya Dan Terbaru
    ! BlogPosts::withCount(['comments as jumlah_komentar', 'comments as komentar_terbaru' => function($query){ $query->where('created_at', '>=', '2020-07-08 12:13:07'); }])->get();
        
    // =======================================================================================================================

    * +++ MODEL FACTORY +++
    
    ? Cara Membuat Factory
    ! php artisan make:factory CommentFactory --model=Comment
    ! factory berada di folder database/factories
    
    // =======================================================================================================================

    ? Contoh Cara Memanggil Factory
    ! factory(App\Comment::class)->create(['blog_post_id' => 2]);

    // =======================================================================================================================

    * +++ Authentication +++
        
    * Sebelum Menggunakan Wajib Menggunakan Facade : 
    ! use Illuminate\Support\Facades\Auth;

    // =======================================================================================================================
    
    * Untuk Mendapatkan ID Dari User Menggunakan : 
    ! Auth::id();

    // =======================================================================================================================

    * Untuk Mendapatkan Semua Data User Menggunakan : 
    ! Auth::user(); example :
    ! Auth::user()->email;

    // =======================================================================================================================

    * Untuk Mengecheck Apakah Sudah Melakukan Autentikasi Menggunakan : 
    ! Auth::check();
    ? Menghasilkan Nilai TRUE / FALSE

    // =======================================================================================================================

    * +++ Soft Deletes +++

    * Cara Membuat SoftDeletes
    ? Silahkan Check BlogPosts Model dan add_soft_deletes_to_blog_posts_table
    
    // =======================================================================================================================

    * Query Yang Bisa Digunakan Dalam Soft Delete

    * Cara Mendapatkan Semua Record Yang Sudah Dihapus Maupun Belum Dihapus
    ! BlogPosts::withTrashed()->get()->pluck('id');
    ? FYI : pluck hanya membuat menjadi tampil idnya saja

    // =======================================================================================================================

    * Cara Mendapatkan Hanya Record Yang Sudah Dihapus 
    ! BlogPosts::onlyTrashed()->get()->pluck('id);

    // =======================================================================================================================
    
    * Check Apakah Record Sudah Dihapus
    ! $bp = BlogPosts::find(11);
    ! $bp->trashed();
    ? Akan Menghasilkan Nilai TRUE / FALSE

    // =======================================================================================================================

    * Cara Merestore BlogPosts Yang Sudah Dihapus
    ! $bp = BlogPosts::onlyTrashed()->find(1);
    ! $bp->restore();

    // =======================================================================================================================

    * +++ Authorization +++

    * Gate

    * Cara Membuat Gate
    ? Penjelesan Ada Di File AuthServiceProvider.php
    
    // =======================================================================================================================

    * Cara Menggunakan Gate
    ? Penjelasan Ada Di File BlogPostController.php Pada methods update dan edit

    // =======================================================================================================================

    ? Selain Menggunakan Gate::denies(); Kita juga bisa menggunakan authorize()
    ? Contoh Kode BIsa Diliat Di BlogPostController.php Pada method destroy

    // =======================================================================================================================

    * Cara Check Authorize User Lain
    ! Gate::forUser($user)->denies('update-post', $post);
    ! Gate::forUser($user)->allows('update-post', $post);
    ? Akan menghasilkan nilai boolean

    // =======================================================================================================================

    * Policy

    * Cara Membuat Policy
    ! php artisan make:policy NamePolicy --model=BlogPosts

    // =======================================================================================================================

    * Cara Menggunakan Policy
    ! Ada di AuthServiceProvider.php

    // =======================================================================================================================

    * Cara Memverifikasi Policy Di Blade Template Laravel
    ? Check daftarblogpost.blade.php, method @can

    // =======================================================================================================================

    * Cara Mengamankan Route Menggunakan Middleware & Gate
    ? Check di web.php

    // =======================================================================================================================

    * +++ QUERY SCOPES +++

    * Global Query Scopes
    ? Cara Membuat Global Query Scopes
    ? Check App/Scopes/LatestScope.php

    // =======================================================================================================================
    
    * Local Query Scopes
    ? Cara Membuat Local Query Scopes
    ? Check App/BlogPosts

*/