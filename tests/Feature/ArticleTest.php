<?php

namespace Tests\Feature;

use App\Models\User;
use App\Notifications\ArticleCreatedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_user_can_store_article_and_receive_notification()
    {
        Notification::fake();

        $user = User::factory()->create();
        $data = [
            'user_id' => $user->id,
            'title' => $this->faker()->unique()->sentence,
            'description' => $this->faker()->sentence(),
        ];

        $response = $this->actingAs($user)->postJson(route('api.article.store', $data));

        $response->assertStatus(Response::HTTP_CREATED);

        Notification::assertSentTo($user, ArticleCreatedNotification::class);

        $this->assertDatabaseHas('articles', $data);
    }
}
