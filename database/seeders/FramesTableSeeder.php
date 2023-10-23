<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Frame;

class FramesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $frames = [
            [
                'id'             => 1,
                'name'           => 'Morning',
                'start_time'     => '07:00:00',
                'end_time'       => '11:00:00',
                'slug'           => 'morning',
                'user_id'        => 1
            ],
            [
                'id'             => 2,
                'name'           => 'After Noon',
                'start_time'     => '13:00:00',
                'end_time'       => '17:00:00',
                'slug'           => 'after-noon',
                'user_id'        => 1
            ],
            [
                'id'             => 3,
                'name'           => 'Night',
                'start_time'     => '19:00:00',
                'end_time'       => '23:00:00',
                'slug'           => 'night',
                'user_id'        => 1
            ],
        ];

        foreach ($frames as $frame) {
            Frame::updateOrCreate($frame);
        }
    }
}
