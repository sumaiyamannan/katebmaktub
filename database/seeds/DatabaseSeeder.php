<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        /* this will  create 10 users
        factory(App\User::class, 10)-> create()
*/
     // DB::table('users')->truncate(); //raw sql statements
      //  DB::table('authors')->truncate();
/*        $this->call([
            RoleTableSeeder::class
        ]);
       factory('App\User',10)->create()->each(function($user){
                $user->authors()->save(
                    factory('App\Author')->make()
                );

            }
        );*/
       factory('App\Author',50)->create();


    }

}
