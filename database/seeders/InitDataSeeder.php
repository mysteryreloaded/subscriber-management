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
                'type' => 'string',
            ],
            [
                'title' => 'Age',
                'type' => 'number',
            ],
        ];

        foreach ($fieldsData as $row) {
            $field = new Field();
            $field->fill($row)->save();
        }

        foreach ($subscribersData as $row) {
            (new Subscriber())->fill($row)->save();
        }

    }
}
