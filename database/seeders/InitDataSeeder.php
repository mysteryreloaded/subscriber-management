<?php

namespace Database\Seeders;

use App\Models\Field;
use App\Models\Subscriber;
use Illuminate\Database\Seeder;

class InitDataSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $subscribersData = [
            [
                'name' => 'Test Subscriber 1',
                'email' => 'example1@email.com',
                'state' => 'active',
            ],
            [
                'name' => 'Test Subscriber 2',
                'email' => 'example2@email.com',
                'state' => 'active',
            ]
        ];

        $fieldsData = [
            [
                'title' => 'Company',
                'value' => 'First company',
                'type' => 'string',
            ],
            [
                'title' => 'Age',
                'value' => 28,
                'type' => 'number',
            ],
        ];

        foreach ($subscribersData as $row) {
            (new Subscriber())->fill($row)->save();
        }

        $subscribers = Subscriber::all()->pluck('id');
        foreach ($fieldsData as $row) {
            $field = new Field();
            $field->fill($row)->save();
            $field->subscribers()->attach($subscribers);
        }
    }
}
