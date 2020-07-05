<?php

/*

    * Note Mengenai Relation [One To One] And [One To Many] : 

    ? Relationship Insert Data
    ? $author adalah primaryKey Sedangkan $profile adalah foreignKey
    ! 1. $author->profile()->save($profile);
    ! 2. $profile->author()->associate($author)->save();

    * Note Mengenai Relationship Existance

    ? Mencari Record BlogPosts Yang Sudah Memiliki Komentar
    ! BlogPosts::has('comments')->get()

    ? Mencari BlogPosts Yang Mempunyai Komentar Lebih Dari 5
    ! BlogPosts::has('comments', '>', '5')->get()

    ? Mencari BlogPosts Yang Mempunyai Content Tertentu
    ! BlogPosts::whereHas('comments', function($query){ $query->where('content', 'like', '%test%'); })->get()
*/