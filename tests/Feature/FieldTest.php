<?php

namespace Tests\Feature;

use App\Models\Field;
use Database\Seeders\InitDataSeeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class FieldTest extends TestCase
{
    use DatabaseTransactions;

    private const TEST_ID = 1;
    private const TEST_DATA = [
        'title' => 'Field test case 1',
        'type' => 'number',
    ];
    private const TEST_DATA_WITH_ID = [
        'id' => self::TEST_ID,
        'title' => 'Field test case 1',
        'type' => 'number',
    ];

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
    }

    /**
     * Field store test.
     *
     * @return void
     */
    public function test_field_store()
    {
        $response = $this->post(route('field.store'), self::TEST_DATA)
            ->assertOk();

        $this->assertDatabaseHas(Field::TABLE, self::TEST_DATA);
    }

    /**
     * Field index test.
     *
     * @return void
     */
    public function test_field_index()
    {
        $this->getJson(route('field.index'))
            ->assertOk()
            ->assertJsonStructure(['success', 'data']);
    }

    /**
     * Field show test.
     *
     * @return void
     */
    public function test_field_show()
    {
        /** Assert that given data does not exist */
        $this->getJson(route('field.show', ['field' => self::TEST_ID]))
            ->assertNotFound()
            ->assertJsonMissing([self::TEST_DATA_WITH_ID]);

        /** Seed some data from available seeder */
        $this->seed(InitDataSeeder::class);

        /** Assert seeded data exists when 'show' endpoint is triggered */
        $this->getJson(route('field.show', ['field' => self::TEST_ID]))
            ->assertOk()
            ->assertJsonStructure(['success', 'data'])
            ->assertJsonFragment(
                [
                    'title' => 'Company',
                    'type' => 'string',
                ],
            );
    }

    /**
     * Field update test.
     *
     * @return void
     */
    public function test_field_update()
    {
        /** Assert that given data does not exist */
        $this->getJson(route('field.update', ['field' => self::TEST_ID]))
            ->assertNotFound()
            ->assertJsonMissing([self::TEST_DATA_WITH_ID]);

        /** Seed some data from available seeder */
        $this->seed(InitDataSeeder::class);

        /** Assert seeded data is updated when 'update' endpoint is triggered */
        $this->put(route('field.update', ['field' => self::TEST_ID]), ['title' => 'New title'])
            ->assertOk();

        $this->getJson(route('field.show', ['field' => self::TEST_ID]))
            ->assertOk()
            ->assertJsonStructure(['success', 'data'])
            ->assertJsonFragment(
                [
                    'id' => 1,
                    'title' => 'New title',
                    'type' => 'string',
                ]
            );
    }

    /**
     * Field destroy test.
     *
     * @return void
     */
    public function test_field_destroy()
    {
        /** Seed some data from available seeder */
        $this->seed(InitDataSeeder::class);

        /** Assert seeded data exists when 'show' endpoint is triggered */
        $this->getJson(route('field.show', ['field' => self::TEST_ID]))
            ->assertOk()
            ->assertJsonStructure(['success', 'data'])
            ->assertJsonFragment(
                [
                    'id' => 1,
                    'title' => 'Company',
                    'type' => 'string',
                ],
            );

        /** Assert OK after deleting a field */
        $this->delete(route('field.destroy', ['field' => 1]))
            ->assertOk();

        /** Assert field with same id does not exist */
        $this->assertDatabaseMissing(Field::TABLE, ['field' => 1]);
    }
}
