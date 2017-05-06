<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use ventureoak\Models\Company;
use ventureoak\Models\Review;

class JsonSeeder extends Seeder
{

    public function run()
    {
        // Empty tables and resets auto_increment counters
        DB::table('reviews')->truncate();
        DB::table('companies')->truncate();

        $json = File::get("database/json/data.json");
        $data = json_decode($json);

        foreach ($data as $companies) {
            foreach ($companies as $company) {
                $currentCompany = Company::create([
                    'name' => $company->name,
                    'slug' => $company->slug,
                    'city' => $company->city,
                    'country' => $company->country,
                    'industry' => $company->industry
                ]);

                foreach ($company->reviews as $review) {
                    Review::create([
                        'company_id' => $currentCompany->id,
                        'title' => $review->title,
                        'user_email' => $review->user,
                        'rating_culture' => $review->rating->culture,
                        'rating_management' => $review->rating->management,
                        'rating_work_live_balance' => $review->rating->work_live_balance,
                        'rating_career_development' => $review->rating->career_development,
                        'pro' => $review->pro,
                        'contra' => $review->contra,
                        'suggestions' => $review->suggestions,
                    ]);
                }
            }
        }
    }
}