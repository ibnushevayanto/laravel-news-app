<?php

/*

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

*/