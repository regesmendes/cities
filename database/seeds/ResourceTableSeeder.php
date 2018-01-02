<?php

use Illuminate\Database\Seeder;
use App\Resource;

class ResourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Resource::class)->create(['name' => 'clay']);
        factory(Resource::class)->create(['name' => 'stone']);
        factory(Resource::class)->create(['name' => 'wood']);
        factory(Resource::class)->create(['name' => 'food']);
    }
}
