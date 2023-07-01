<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\DataSource;
use Illuminate\Database\Seeder;

class NYTimesSeeder extends seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $data_source = DataSource::factory()->create([
            'name' => 'New York Times',
            'slug' => 'ny_times'
        ]);

        $categories = ["Adventure Sports", "Arts & Leisure", "Arts", "Automobiles", "Blogs", "Books",
            "Booming", "Business Day", "Business", "Cars", "Circuits", "Classifieds", "Connecticut",
            "Crosswords & Games", "Culture", "DealBook", "Dining", "Editorial", "Education", "Energy", "Entrepreneurs",
            "Environment", "Escapes", "Fashion & Style", "Fashion", "Favorites", "Financial", "Flight", "Food",
            "Foreign", "Generations", "Giving", "Global Home", "Health & Fitness", "Health", "Home & Garden", "Home",
            "Jobs", "Key", "Letters", "Long Island", "Magazine", "Market Place", "Media", "Men's Health", "Metro",
            "Metropolitan", "Movies", "Museums", "National", "Nesting", "Obits", "Obituaries", "Obituary", "OpEd",
            "Opinion", "Outlook", "Personal Investing", "Personal Tech", "Play", "Politics", "Regionals", "Retail",
            "Retirement", "Science", "Small Business", "Society", "Sports", "Style", "Sunday Business", "Sunday Review",
            "Sunday Styles", "T Magazine", "T Style", "Technology", "Teens", "Television", "The Arts",
            "The Business of Green", "The City Desk", "The City", "The Marathon", "The Millennium", "The Natural World",
            "The Upshot", "The Weekend", "The Year in Pictures", "Theater", "Then & Now", "Thursday Styles",
            "Times Topics", "Travel", "U.S.", "Universal", "Upshot", "UrbanEye", "Vacation", "Washington", "Wealth",
            "Weather", "Week in Review", "Week", "Weekend", "Westchester", "Wireless Living", "Women's Health",
            "Working", "Workplace", "World", "Your Money"];

        foreach($categories as $category){
            Category::create(["title" => $category, "data_source" => $data_source->slug]);
        }

    }
}
