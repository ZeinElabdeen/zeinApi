<?php

use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i< 5; $i++) {
            $plan = new \App\Models\Plan;
            $plan->title_en = 'plan 1';
            $plan->title_ar = 'الخطة 1';
            $plan->ads_count = $i*2;
            $plan->price = $i*50;
            $plan->save();
        }
    }
}
