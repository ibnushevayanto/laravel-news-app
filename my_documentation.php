<?php

/*

    * Note Mengenai Relation One To One And One To Many : 
    ! One To One Relationship Insert Data :
    ? $author adalah primaryKey Sedangkan $profile adalah foreignKey
    ! 1. $author->profile()->save($profile);
    ! 2. $profile->author()->associate($author)->save();

    * Note Mengenai Relationship Existance
    ! BlogPosts::has('comments')->get()
    ? Mencari Record BlogPosts Yang Sudah Memiliki Komentar
    
*/