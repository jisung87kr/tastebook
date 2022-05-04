<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    protected $member, $admin, $author;

    /**
     * A basic feature test example.
     * 1. 권한 & 유저 셋업
     * 2. 포스트 셋업
     * 3. 방문자 포스트 생성
     * 4. 방문자 인덱스 접근
     * 8
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->setupUsers();
        $this->setupPermissions();
        $this->setupRoles();
        $this->setupPosts();
    }

    public function setupUsers()
    {
        $this->member = User::create([
            'name' => 'member',
            'email' => 'member@test.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        $this->author = User::create([
            'name' => 'author',
            'email' => 'author@test.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        $this->admin = User::create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);;
    }

    public function setupPermissions()
    {
        $this->app->make(PermissionRegistrar::class)->forgetCachedPermissions();

        Permission::create(['name' => 'create posts']);
        Permission::create(['name' => 'edit own posts']);
        Permission::create(['name' => 'edit all posts']);
        Permission::create(['name' => 'delete own posts']);
        Permission::create(['name' => 'delete any posts']);
        Permission::create(['name' => 'view own unpublished posts']);
        Permission::create(['name' => 'view all unpublished posts']);

        Permission::create(['name' => 'create comments']);
        Permission::create(['name' => 'edit own comments']);
        Permission::create(['name' => 'edit all comments']);
        Permission::create(['name' => 'delete own comments']);
        Permission::create(['name' => 'delete any comments']);

        $this->app->make(PermissionRegistrar::class)->registerPermissions();
    }

    public function setupRoles()
    {
        Role::create(['name' => 'member']);
        $this->member->givePermissionTo(['create comments', 'edit own comments', 'delete own comments']);

        Role::create(['name' => 'author']);
        $this->author->givePermissionTo(['create posts', 'edit own posts', 'delete own posts', 'view own unpublished posts']);
        $this->author->givePermissionTo(['create comments', 'edit own comments', 'delete own comments']);

        Role::create(['name' => 'admin']);
        $this->admin->givePermissionTo(['create posts', 'edit all posts', 'delete any posts', 'view all unpublished posts']);
        $this->admin->givePermissionTo(['create comments', 'edit all comments', 'delete any comments']);
    }

    public function setupPosts()
    {
        $categories = Category::factory(3)->create();
        Post::create([
            'id' => 1,
            'user_id'     => $this->author->id,
            'category_id' => $categories->pluck('id')->random(),
            'subject'     => "first post",
            'content'     => "fist post body",
            'slug'        => "first post",
            'published_at' => Carbon::now()
        ]);

        Post::create([
            'id' => 2,
            'user_id'     => $this->author->id,
            'category_id' => $categories->pluck('id')->random(),
            'subject'     => "unpublished second post",
            'content'     => "unpublished second post body",
            'slug'        => "unpublished second post",
        ]);

        Post::create([
            'id' => 3,
            'user_id'     => $this->admin->id,
            'category_id' => $categories->pluck('id')->random(),
            'subject'     => "third post",
            'content'     => "third post body",
            'slug'        => "third post",
            'published_at' => Carbon::now()
        ]);

        Post::create([
            'id' => 4,
            'user_id'     => $this->admin->id,
            'category_id' => $categories->pluck('id')->random(),
            'subject'     => "unpublished forth post",
            'content'     => "unpublished forth post body",
            'slug'        => "unpublished forth post",
        ]);
    }

    /**
     * 공개된 글만 조회
     * @test
     */
    public function show_index()
    {
        $this->withoutExceptionHandling();
        $response = $this->actingAs($this->author)->get('/posts');
        $response->assertStatus(200);
        $response->assertSee('first post');
        $response->assertSee('third post');
    }

    /**
     * 자신의 비공개글 조회
     * @test
     */
    public function authors_can_view_own_unpublished_posts()
    {
        $this->withoutExceptionHandling();
        $response = $this->actingAs($this->author)->get('/posts/2');
        $response->assertStatus(200);
        $response->assertSee('unpublished second post');
    }

    /**
     * 관리자 비공개글 조회
     * @test
     */
    public function admin_can_view_all_unpublished_posts()
    {
        $this->withoutExceptionHandling();
        $response = $this->actingAs($this->admin)->get('/posts/2');
        $response->assertStatus(200);
        $response->assertSee('unpublished second post');

        $response = $this->actingAs($this->admin)->get('/posts/4');
        $response->assertStatus(200);
        $response->assertSee('unpublished forth post');
    }

    /**
     * 작가 게시글 작성
     * @test
     */
    public function author_can_create_post()
    {
        $this->withoutExceptionHandling();
        $response = $this->actingAs($this->author)->get('/posts/create');
        $response->assertStatus(200);
    }

    /**
     * 관리자 게시글 작성
     * @test
     */
    public function admin_can_create_post()
    {
        $this->withoutExceptionHandling();
        $response = $this->actingAs($this->admin)->get('/posts/create');
        $response->assertStatus(200);
    }

    /**
     * 자신의 게시글 수정
     * @test
     */
    public function author_can_edit_own_post()
    {
        $this->withoutExceptionHandling();
        $response = $this->actingAs($this->admin)->get('/posts/1/edit');
        $response->assertStatus(200);
        $response->assertSee('first post');
    }

    /**
     * 관리자 게시글 수정
     * @test
     */
    public function admin_can_edit_all_post()
    {
        $this->withoutExceptionHandling();
        $response = $this->actingAs($this->admin)->get('/posts/1/edit');
        $response->assertStatus(200);
        $response->assertSee('first post');
    }

    /**
     * 작가 게시글 삭제
     * @test
     */
    public function author_can_delete_own_post()
    {
        $this->withoutExceptionHandling();
        $response = $this->actingAs($this->author)->delete('/posts/1');
        $response->assertStatus(302);
    }

    /**
     * 관리자 게시글 삭제
     * @test
     */
    public function admin_can_delete_all_post()
    {
        $this->withoutExceptionHandling();
        $response = $this->actingAs($this->author)->delete('/posts/1');
        $response->assertStatus(302);
    }

}
