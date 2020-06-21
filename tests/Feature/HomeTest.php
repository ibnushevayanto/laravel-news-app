<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHomePageIsWorkingCorrecctly()
    {
        $response = $this->get('/');
        /*
        ? Untuk Melihat Apakah Di Page Ditemukan Text Seperti Yang Tertera
        */
        $response->assertSeeText('Landing Page');
    }

    public function testContactPageIsWorkingCorrectly()
    {
        $response = $this->get('/contact');

        $response->assertSeeText('Contact');
    }
}
