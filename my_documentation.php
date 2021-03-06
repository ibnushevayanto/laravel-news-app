<?php

/*
 * +++ FUN FACT +++

// =======================================================================================================================

? Perdbedaan find dengan where
! Kalau where itu menghasilkan multiple data tetapi find menghasilkan single data

? Command yang mungkin anda cari

! php artisan clear-compiled
! composer dump-autoload
! php artisan optimize

// =======================================================================================================================

 * +++ QUERY RELATIONSHIP +++

// =======================================================================================================================

 * Note Mengenai Relation [One To One] And [One To Many] :

? Relationship Insert Data
? $author adalah primaryKey Sedangkan $profile adalah yang menerima foreignKey
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

// =======================================================================================================================

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

// =======================================================================================================================

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

// =======================================================================================================================

 * Gate

// =======================================================================================================================

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

// =======================================================================================================================

 * Cara Membuat Policy
! php artisan make:policy NamePolicy --model=BlogPosts

// =======================================================================================================================

 * Cara Menggunakan Policy
! Ada di AuthServiceProvider.php

// =======================================================================================================================

 * Cara Memverifikasi Policy Di Blade Template Laravel
? Check daftarblogpost.blade.php, method @can
? Jika menggunakanka @can sebaiknya periksa dulu apakah di telah authentikasi agar tidak mempengaruhi performa

// =======================================================================================================================

* Cara Kerja Policy
? Dia dibind by Model
? saat @can('update', $item)
? Maka $item akan dicheck dia menggunakan model apa

// =======================================================================================================================

* Cara auhtorize policy

! $this->authorize('create', BlogPosts::class);
? Minimal harus ada collection dari Data Model

* Jika Sudah Terdaftar Bisa Langsung Begini
! $this->authorize(BlogPosts::class);

* Jika Menggunakan Gate::denies()
? Harus Menggunakan Nama Method Policynya
! Gate::denies('update', BlogPosts::find(11))

// =======================================================================================================================

 * Cara Mengamankan Route Menggunakan Middleware & Gate
? Check di web.php

// =======================================================================================================================

 * +++ QUERY SCOPES +++

// =======================================================================================================================

 * Global Query Scopes
? Cara Membuat Global Query Scopes
? Check App/Scopes/LatestScope.php

// =======================================================================================================================

 * Local Query Scopes
? Cara Membuat Local Query Scopes
? Check App/BlogPosts

// =======================================================================================================================

 * Cara Memblock Global Query Scope
? Check di AdminScope.php

// =======================================================================================================================

 * +++ Components Blade Laravel +++

// =======================================================================================================================

 * Cara Membuat & Menggunakan Component Laravel Blade

? Cara Pertama
! Membuat dan menggunakan check di detailblopost.blade.php pada [badge]

 * Cara Kedua
! Untuk membuat instansiasi check di AppServiceProvider.php
! Untuk menggunakan check di detailblopost.blade.php pada [badge]

// =======================================================================================================================

 * +++ Cache +++

// =======================================================================================================================

 * Cara Menerima dan menyimpan cache
! Check BlogPostController pada method index()

// =======================================================================================================================

 * Cara menghapus cache
! Check pada BlogPosts.php di model event updated

// =======================================================================================================================

 * Cara Menyimpan cache
? Menggunakan Cache::put();
? contoh : Cache::put('data', 'ada data disini', 5);
? parameter pertama adalah nama cache, parameter kedua isi dari cache, sedangkan parameter ketiga adalah waktu tersimpannya cache dalam satuan menit
! jika tidak menggunakan parameter ketiga, maka cache akan tersimpan selamanya

// =======================================================================================================================

 * Cara check apakah cache sudah digunakan atau belum
? menggunakan Cache::has('nama_cache')
? contoh : Cache::has('data')
? akan menghasilkan nilai boolean true or false

// =======================================================================================================================

 * Cara mendapatkan isi dari cache
? menggunakan Cache::get('nama_cache')
? contoh : Cache::get('data')
! Jika nama cache tidak tersedia akan menghasilkan nilai null

? Jika nama cache tidak tersedia dan mau menggunakan default value caranya dengan menambahkan parameter kedua, sperti dibawah ini :
? Cache::get('data2', 'default value')

// =======================================================================================================================

 * Cache Counter Value [Increment, Decrement]

 * membuat cache increment
? Cache::increment('key', 0);
 * jika kita melakukan ini
? Cache::increment('key');
 * maka nilai akan bertambah satu

// =======================================================================================================================

 * Cache Tags
! important : Cache::tags(); hanya support pada memchached atau redis saja, tidak support pada file system dan mysql
! Note : Cache::tags juga bisa menggunakan method function yang sama dengan Cache biasa
! Contoh Seperti Dibawah Ini

// =======================================================================================================================

 * Cara store data menggunakan cache::tags
? Parameter dalam tags harus berupa array
? Parameter pertama dalam method put() adalah nama cache, parameter kedua adalah isi cache, parameter ketiga adalah waktu cache dalam hitungan sekon
? Cache::tags(['artist', 'people'])->put('Ibnu', 'Hello iam ibnu', 600)

// =======================================================================================================================

 * Cara get data dari cache::tags
? Cache::tags(['artist', 'people'])->get('Ibnu')

// =======================================================================================================================

 * Cara Menghapus Semua cache::tags yang terhubung
? Cache::tags(['artist'])->flush()

// =======================================================================================================================

 * +++ Many To Many Relation +++

 * Cara membuat instansiasi modelnya check BlogPosts.php / Tags.php

// =======================================================================================================================

 * Cara Cara Storing Data Many To Many

! Defaultnya timestamps tidak ikut disertakan jadi kalau mau diikutsertakan check BlogPosts.php method tags()
// =======================================================================================================================

? Pertama dengan menggunakan attach

 * $blogposts->tags()->attach($tag)
? Cara menambahkan banyak data secara langsung dengan menggunakan attach
 * $blogposts->tags()->attach([$tag1->id, $tag2->id])

! Catatan menstore data dengan menggunakan attach sangat tidak direkomendasikan, ini karena data akan menjadi duplikat
! Response setelah function attach dijalankan adalah null

// =======================================================================================================================

? Kedua dengan menggunakan syncWithoutDetaching

 * $blogposts->tags()->syncWithoutDetaching($tag)
? Cara menambahkan banyak data secara langsung dengan menggunakan attach
 * $blogposts->tags()->syncWithoutDetaching([$tag->id])

! Gunakan syncWithoutDetaching jika anda ingin data semuanya unique tidak ada yang sama
! Response saat syncWithoutDetaching selesai dijalankan :
!   [
!       "attached" => [
!           2, 3  // id dari tags yang berhasil di masukkan
!       ],
!       "detached" => [],
!       "updated" => [],
!   ]

// =======================================================================================================================

? Ketga dengan menggunakan sync
 * $blogposts->tags()->sync($tag)
? Cara menambahkan banyak data secara langsung dengan menggunakan attach
 * $blogposts->tags()->sync([$tag->id])

! Gunakan sync() jika anda ingin data semuanya unique tidak ada yang sama dan diperbarui
! Response saat sync() selesai dijalankan :
!   [
!       "attached" => [
!           2, 3  // id dari tags yang berhasil di masukkan
!       ],
!       "detached" => [
!           1, 3 // id tags yang dihapus karena sama
!       ],
!       "updated" => [],
!   ]

 * Fun Fact
? Cara menghapus semua tag secara langsung menggunakan sync
 * $blogposts->tags()->sync([])

// =======================================================================================================================

? Cara Menghapus Relation Many To Many

 * $blogposts->tags()->detach($tag);
? Jika ingin menghapus sekaligus
 * $blogposts->tags()->detach([$tag->id, $tag2->id]);

// =======================================================================================================================

? Cara mendapatkan data dari many to many

 * Contoh :
 * $blogpost = BlogPosts::with('tags')->find(1);

// =======================================================================================================================

 * +++ Blade View Composer +++

// =======================================================================================================================

 * Artinya ini adalah parameter bawaan setiap kita mereturn view jadi tidak perlu lagi menulis syntax lagi

 * Cara membuat Blade View Composer
? Silahkan Check app/Http/ViewComposers/ActivityComposer

// =======================================================================================================================

 * +++ Laravel Upload File +++

// =======================================================================================================================

 * Cara check apakah file terkirim
! $request->hasFile('cover');
 * Menghasilkan nilai boolean true / false

// =======================================================================================================================

 * Cara mendapatkan tipe data file
! $file = $request->file('cover');

// =======================================================================================================================

 * Cara mendapatkan tipe dari file
! dump($file->getClientMimeType());

// =======================================================================================================================

 * Cara mendapatkan extensi dari file
! dump($file->getClientOriginalExtension());

// =======================================================================================================================

 * Cara mendapatkan nama file
! dump($file->getClientOriginalName());

// =======================================================================================================================

 * Cara mencari tipe asli dari file
! dump($file->guessExtension());

// =======================================================================================================================
 * Store

 * Cara mengupload file, parameter pertama adalah nama folder
 * Nama File akan Digenerate Secara Automatis
 * Menghasilkan nama file setelah digenerate
 * covers/asjajajsahjhassa.jpg
! $file->store('covers');

// =======================================================================================================================
 * putFile

 * Cara mengupload file, menggunakan facade Store
 * disk parameter adalah configurasi yang ingin digunakan [public, local, s3]
 * putFile parameter parameter pertama adalah nama folder, sedangkan parameter kedua adalah file yang ingin diupload
 * jika didump kode dibawah akan menghasilkan string seperti ini : covers/asjajajsahjhassa.jpg
! dump(Storage::disk('public')->putFile('covers', $file));

// =======================================================================================================================
 * storeAs

 * Jika ingin mengupload dengan nama yang ditentukan gunakan storeAs()
 * Parameter pertama adalah nama folder sedangkan parameter kedua adalah nama file yang kita inginkan
! dump($file->storeAs('covers', $blogpost->id . "." . $file->guessExtension()));

// =======================================================================================================================
 * putFileAs

 * Upload file dengan nama yang diinginkan menggunakan facade storage
 * sama seperti put file tetapi memiliki 3 parameter
 * dan parameter ketiga ialah nama file yang kita inginkan
! dump(Storage::disk('public')->putFileAs('covers', $file, $blogpost->id . "." . $file->guessExtension()));

// =======================================================================================================================

 * cara mendapatkan url gambar

! $file = $request->file('cover');
! $fileupload = Storage::disk('public')->putFileAs('covers', $file, $blogpost->id . "." . $file->guessExtension());
! dump(Storage::disk('public')->url($fileupload));

? Contoh penggunaan bisa dicheck pada detailblogpost

// =======================================================================================================================

* menghapus file

! $path = Storage::disk('public')->put('covers', $file);
! Storage::disk('public')->delete($path);

// =======================================================================================================================

* Polymorph One To One

? Syarat Membuat Polymorph
* Pada column yang ingin dibuat polymorph harus ada type dan idnya contoh :
* image_for_id dan image_for_type
* diatas adalah wajib

? untuk membuat relasi database
* check add_polymorph_to_image_table.php 

? penjelasan untuk model relation pada images table
* check Image.php pada method image()

? penjelasan untuk model relation pada table yang akan menyimpan pada images table
* check BlogPosts.php / User.php pada method image()

? Untuk menstore data ke images php
* check BlogPostController.php pada method store

// =======================================================================================================================

* Polymorph One To Many 

* Chechk Relasi Model Antara Comment Dengan BlogPost Atau Comment Dengan User

// =======================================================================================================================

* Traits

? Apa Itu Traits Konsepnya Seperti Extend Dalam Php Agar Kode Dapat Terorganisir Dengan Baik

// =======================================================================================================================

* Laravel API

? Resource

* Membutuhkan resources untuk menapilkan response

* Cara membuat response api check pada CommentController function index 
* dan resources nya pada App/Resources/Comment

? Cara agar resource tidak menapilkan response default check pada AppServiceProvider

? Cara membuat route api check pada api.php

? Cara agar response pada resource tidak default data check pada AuthServiceProvider.php

// =======================================================================================================================

*/
