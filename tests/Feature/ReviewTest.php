<?php

namespace Tests\Feature;

use App\Company;
use App\Review;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReviewTest extends TestCase
{
    public function testReviewsCreatedCorectly()
    {
        $user = factory(User::class)->create();
        factory(Company::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'company_id' => 1,
            'rating' => 4,
            'comment' => ''
        ];

        $this->json('POST', 'api/reviews', $payload, $headers)
            ->assertStatus(201);

        $review = Review::find(1);
        $this->assertEquals($review->id, 1);
    }

    public function testReviewsListedCorreclty()
    {
        Review::create([
            'user_id' => 1,
            'company_id' => 1,
            'rating' => 5,
            'comment' => 'Comment text 1'
        ]);
        Review::create([
            'user_id' => 2,
            'company_id' => 1,
            'rating' => 3,
            'comment' => 'Comment text 2'
        ]);

        $this->json('GET', 'api/reviews')
            ->assertStatus(200)
            ->assertJson([
                ['id' => 1, 'user_id' => 1, 'company_id' => 1, 'rating' => 5, 'comment' => 'Comment text 1'],
                ['id' => 2, 'user_id' => 2, 'company_id' => 1, 'rating' => 3, 'comment' => 'Comment text 2'],
            ])
            ->assertJsonStructure([
                '*' => ['id', 'user_id', 'company_id', 'rating', 'comment', 'created_at', 'updated_at'],
            ]);
    }

    public function testReviewsCompanyIdValidatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'company_id' => 2,
            'rating' => 1,
            'comment' => 'Meh'
        ];

        $this->json('POST', 'api/reviews', $payload, $headers)
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                    "errors" => [
                        "company_id" => [
                            "The selected company id is invalid."
                        ]
                    ]
            ]);
    }


    public function testReviewsRatingValidatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        factory(Company::class)->create();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'company_id' => 1,
            'rating' => 199,
            'comment' => 'Meh'
        ];

        $this->json('POST', 'api/reviews', $payload, $headers)
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "rating" => [
                        "The rating must be between 0 and 5."
                    ]
                ]
            ]);
    }

    public function testReviewsCommentSanitizedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        factory(Company::class)->create();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'company_id' => 1,
            'rating' => 3,
            'comment' => '  <p>Параграф.</p><!-- Комментарий --> <a href="#fragment">Еще текст</a>  <script>alert(\'Boo!\');</script>  '
        ];

        $this->json('POST', 'api/reviews', $payload, $headers)
            ->assertStatus(201);
        $this->assertEquals(
            'Параграф. Еще текст  alert(&#39;Boo!&#39;);',
            Review::find(1)->toArray()['comment']
        );
    }
}
