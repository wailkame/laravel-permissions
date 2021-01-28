<?php

namespace Tests\Feature;

use App\User;
use App\Article;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;


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

    public function testPublisherCannotAccessCategories(){
        $publisher = factory(User::class)->create(['role_id' => 3]);
        $response = $this->actingAs($publisher)->get('/category');
        $response->assertStatus(403);
    }

    public function testAdminCanSeeUserColumnInArticleTable(){
        $admin = factory(User::class)->create(['role_id' => 2]);
        $response = $this->actingAs($admin)->get('article');
        $response->assertSee('User');
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

    public function testUserCannotPublishArticle(){

        $user = factory(User::class)->create();
        $articleData = ['title'=> 'Title', 'description'=> 'Full Text', 'published' => 1];
        $response = $this->actingAs($user)->post('/article', $articleData);
        $response->assertRedirect();

        $article = Article::where('user_id' , $user->id)->latest()->firstOrFail();
        
        $this->assertNull($article->published_at);

        $response = $this->actingAs($user)->put('/article/'.$article->id, $articleData);
        $response->assertRedirect();

        $article = Article::where('user_id' , $user->id)->latest()->firstOrFail();
        $this->assertNull($article->published_at);

    }

    public function testAdminCanSaveAndNotPublishArticle(){

        $admin = factory(User::class)->create(['role_id' => 2]);
        $articleData = ['title'=> 'Title', 'description'=> 'Full Text'];
        $response = $this->actingAs($admin)->post('/article', $articleData);
        $response->assertRedirect();

        $article = Article::where('user_id' , $admin->id)->latest()->firstOrFail();
        $this->assertNull($article->published_at);

        
        $response = $this->actingAs($admin)->put('/article/'.$article->id, $articleData);
        $response->assertRedirect();

        $article = Article::where('user_id' , $admin->id)->latest()->firstOrFail();
        $this->assertNull($article->published_at);

    }

    public function testPublisherCanSaveAndNotPublishArticle(){
        

        $publisher = factory(User::class)->create(['role_id' => 3]);
        $articleData = ['title'=> 'Title', 'description'=> 'Full Text'];
        $response = $this->actingAs($publisher)->post('/article', $articleData);
        $response->assertRedirect();

        $article = Article::where('user_id' , $publisher->id)->latest()->firstOrFail();
        $this->assertNull($article->published_at);

       
        $response = $this->actingAs($publisher)->put('/article/'.$article->id, $articleData);
        $response->assertRedirect();

        $article = Article::where('user_id' , $publisher->id)->latest()->firstOrFail();
        $this->assertNull($article->published_at);

    }

    public function testAdminCanPublishAndUnpublishArticle(){
        

        $admin = factory(User::class)->create(['role_id' => 2]);
        $articleData = ['title'=> 'Title', 'description'=> 'Full Text', 'published' => 1];
        $response = $this->actingAs($admin)->post('article', $articleData);
        $response->assertRedirect();

        $article = Article::where('user_id' , $admin->id)->latest()->firstOrFail();
        $this->assertNotNull($article->published_at);

        $articleData = ['title'=> 'Title', 'description'=> 'Full Text'];
        $response = $this->actingAs($admin)->put('/article/'.$article->id, $articleData);
        $response->assertRedirect();
        
        $article = Article::where('user_id' , $admin->id)->latest()->firstOrFail();
        $this->assertNull($article->published_at);

    }
}
