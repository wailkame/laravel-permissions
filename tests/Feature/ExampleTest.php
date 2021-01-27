<?php

namespace Tests\Feature;
use App\User;
use App\Article;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSimpleUserCanAccessCategories()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/category');
        $response->assertStatus(403);
    }

    public function testAdminCanAccessCategories(){
        $admin = factory(User::class)->create(['role_id' => 2]);
        $response = $this->actingAs($admin)->get('/category');
        $response->assertStatus(200);
    }

    public function testUserCantSeePublishedCheckedboxInCreateArticleForm(){
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/article/create');
        $response->assertDontSee('Published');
    }

    public function testAdminCanSeePublishedCheckedboxInCreateArticleForm(){
        $admin = factory(User::class)->create(['role_id' => 2]);
        $response = $this->actingAs($admin)->get('/article/create');
        $response->assertSee('Published');
    }

    public function testPublisherCanSeePublishedCheckedboxInCreateArticleForm(){
        $publisher = factory(User::class)->create(['role_id' => 3]);
        $response = $this->actingAs($publisher)->get('/article/create');
        $response->assertSee('Published');
    }

    public function testUserCantSeePublishedCheckedboxInEditArticleForm(){
        $user = factory(User::class)->create();
        $article = factory(Article::class)->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)->get('/article/'.$article->id.'/edit');
        $response->assertDontSee('Published');
    }

    public function testAdminCanSeePublishedCheckedboxInEditArticleForm(){
        $admin = factory(User::class)->create(['role_id' => 2]);
        $article = factory(Article::class)->create(['user_id' => $admin->id]);
        $response = $this->actingAs($admin)->get('/article/'.$article->id.'/edit');
        $response->assertSee('Published');
    }

    public function testPublisherCanSeePublishedCheckedboxInEditArticleForm(){
        $publisher = factory(User::class)->create(['role_id' => 3]);
        $article = factory(Article::class)->create(['user_id' => $publisher->id]);
        $response = $this->actingAs($publisher)->get('/article/'.$article->id.'/edit');
        $response->assertSee('Published');
    }
}
