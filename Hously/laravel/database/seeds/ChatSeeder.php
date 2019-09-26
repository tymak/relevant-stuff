<?php

use Illuminate\Database\Seeder;
use App\Chat;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Chat::create([
            'user_id'     => 1,
            'community_id'    => 1,
            'text'     => 'Výtah je rozbitý!',
            'warning'    => true,
            'image'    => null,
        ]);

        Chat::create([
            'user_id'     => 2,
            'community_id'    => 1,
            'text'     => 'Už zase!',
            'warning'    => false,
            'image'    => null,
        ]);

        Chat::create([
            'user_id'     => 2,
            'community_id'    => 2,
            'text'     => 'Párty u mě. V sedm večer.',
            'warning'    => false,
            'image'    => 'https://images.greetingsisland.com/images/Invitations/Party%20theme/previews/Lets-Party.png?auto=format,compress&w=440',
        ]);

        Chat::create([
            'user_id'     => 3,
            'community_id'    => 2,
            'text'     => 'Budu tam.',
            'warning'    => false,
            'image'    => null,
        ]);
    }
}
