<?php

namespace Tests\Feature;

use App\Models\Subscriber;
use Database\Seeders\InitDataSeeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SubscriberTest extends TestCase
{
    use DatabaseTransactions;

    private const TEST_EMAIL = 'example1@email.com';
    private const TEST_DATA = [
        'name' => 'Subscriber test case 1',
        'email' => self::TEST_EMAIL,
        'state' => 'junk',
    ];

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
    }

    /**
     * Subscriber store test.
     *
     * @return void
     */
    public function test_subscriber_store()
    {
        $response = $this->post(route('subscriber.store'), self::TEST_DATA);
        $response->assertStatus(200);
        $this->assertDatabaseHas(Subscriber::TABLE, self::TEST_DATA);
    }

    /**
     * Subscriber index test.
     *
     * @return void
     */
    public function test_subscriber_index()
    {
        $this->getJson(route('subscriber.index'))
            ->assertOk()
            ->assertJsonStructure(['success', 'data']);
    }

    /**
     * Subscriber show test.
     *
     * @return void
     */
    public function test_subscriber_show()
    {
        /** Assert that given data does not exist */
        $this->getJson(route('subscriber.show', ['subscriber' => 1]))
            ->assertNotFound()
            ->assertJsonMissing([self::TEST_DATA]);

        /** Seed some data from available seeder */
        $this->seed(InitDataSeeder::class);

        /** Assert seeded data exists when 'show' endpoint is triggered */
        $this->getJson(route('subscriber.show', ['subscriber' => 1]))
            ->assertOk()
            ->assertJsonStructure(['success', 'data'])
            ->assertJsonFragment(
                [
                    'name' => 'Test Subscriber 1',
                    'email' => self::TEST_EMAIL,
                    'state' => 'active',
                ]
            );
    }

    /**
     * Subscriber update test.
     *
     * @return void
     */
    public function test_subscriber_update()
    {
        /** Assert that given data does not exist */
        $this->getJson(route('subscriber.update', ['subscriber' => 1]))
            ->assertNotFound()
            ->assertJsonMissing([self::TEST_DATA]);

        /** Seed some data from available seeder */
        $this->seed(InitDataSeeder::class);

        /** Assert seeded data is updated when 'update' endpoint is triggered */
        $this->put(route('subscriber.update', ['subscriber' => 1]), ['name' => 'New name'])
            ->assertOk();

        $this->getJson(route('subscriber.show', ['subscriber' => 1]))
            ->assertOk()
            ->assertJsonStructure(['success', 'data'])
            ->assertJsonFragment(
                [
                    'name' => 'New name',
                    'email' => self::TEST_EMAIL,
                    'state' => 'active',
                ]
            );
    }

    /**
     * Subscriber destroy test.
     *
     * @return void
     */
    public function test_subscriber_destroy()
    {
        /** Seed some data from available seeder */
        $this->seed(InitDataSeeder::class);

        /** Assert seeded data exists when 'show' endpoint is triggered */
        $this->getJson(route('subscriber.show', ['subscriber' => 1]))
            ->assertOk()
            ->assertJsonStructure(['success', 'data'])
            ->assertJsonFragment(
                [
                    'name' => 'Test Subscriber 1',
                    'email' => 'example1@email.com',
                    'state' => 'active',
                ]
            );

        /** Assert OK after deleting a subscriber */
        $this->delete(route('subscriber.destroy', ['subscriber' => 1]))
            ->assertOk();

        /** Assert subscriber with same email does not exist */
        $this->assertDatabaseMissing(Subscriber::TABLE, ['email' => self::TEST_EMAIL]);
    }
}
