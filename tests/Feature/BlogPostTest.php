<?php

namespace Tests\Feature;

use App\BlogPosts;
use App\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogPostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testNoBlogPostsWhenNothinInDatabase()
    {
        $response = $this->get('/blogpost');
        $response->assertSeeText('Data Kosong');
    }

    public function testSee1BlogPostWhenThereIs1()
    {
        /* 
        ? This Is Arrange Part
        */

        $post = $this->_createDummy();

        /* 
        ? Act Part
        */

        $response = $this->get('/blogpost');

        /* 
        ? Assert Part
        */

        $response->assertSeeText('New Title');
        // $response->assertSeeText('Not have a comments');

        /*
        ? Untuk check Sebuah Database Dengan Data Spesifik
        */

        $this->assertDatabaseHas('blog_posts', [
            'title' => $post->title
        ]);
    }

    public function testStoreIsValid()
    {
        $params = [
            'title' => 'Valid Title',
            'content' => 'Valid Content'
        ];

        /* 
            ? Cara testCase untuk methods yang ada middleware authnya
            * Code bisa langsung digabung lihat contoh di testValidationIsWork()
        */
        $user = $this->user();
        $this->actingAs($user);

        $this->post('/blogpost', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'News Was Created!');
    }

    public function testValidationIsWork()
    {
        $params = [
            'title' => null,
            'content' => null
        ];

        $this->actingAs($this->user())->post('/blogpost', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();

        $this->assertEquals($messages['title'][0], 'The title field is required.');
        $this->assertEquals($messages['content'][0], 'The content field is required.');
    }

    public function testUpdateIsValid()
    {
        $post = $this->_createDummy();

        $this->assertDatabaseHas('blog_posts', [
            'title' => $post->title
        ]);

        $newParams = [
            'title' => 'Changed Title',
            'content' => 'Changed Content'
        ];

        $user = $this->user();
        $this->actingAs($user);

        $this->put("/blogpost/{$post->id}", $newParams)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'News Was Edited!');

        /*
            ? Bila Data Ilang Dari Database
        */

        $this->assertDatabaseMissing('blog_posts', ['title' => $post->title]);
    }

    public function testDeleteBlogPost()
    {
        $post = $this->_createDummy();

        $title = $post->title;

        $user = $this->user();
        $this->actingAs($user);

        $this->delete("/blogpost/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), $title . ' was deleted');

        $this->assertDatabaseMissing('blog_posts', ['title' => $title]);
    }

    /* 
        ? Disamping Nama Function Itu Adalah Tipe Data
    */

    private function _createDummy(): BlogPosts
    {
        return factory(BlogPosts::class)->states('new-blogpost-test')->create();
    }

    public function testPostSeeComment()
    {
        $post = $this->_createDummy();

        factory(Comment::class, 4)->create([
            'blog_post_id' => $post->id
        ]);

        $response = $this->get('/blogpost');

        $response->assertSeeText('4 Komentar');
    }
}
