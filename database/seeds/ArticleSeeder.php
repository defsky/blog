<?php

use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('articles')->delete();

        for ($i=1; $i<=20; $i++)
        {
            \App\Models\Article::create([
                'title'=>'title '.$i,
                'body'=>'this is the body of article '.$i,
                'user_id'=>1,    
            ]);
        }
    }
}
