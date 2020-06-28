<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function landing()
    {
        return view('Landing.landing');
    }

    public function contact()
    {
        return view('Contact.contact');
    }
    public function test($id, $naga)
    {
        dd(['id' => $id, 'naga' => $naga]);
    }
}

/*

    * Note Mengenai Relation One To One : 

    ! One To One Relationship Memasukkan Data : 
    ! 1. $author->profile()->save($profile);
    ! 2. $profile->author()->associate($author)->save();

*/
