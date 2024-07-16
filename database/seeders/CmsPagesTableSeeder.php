<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CmsPage;

class CmsPagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $page = new CmsPage;
        $page->title = "About Us" ;
        $page->description = "Content is comming soon" ;
        $page->url = "about-us" ;
        $page->meta_title = "About Us" ;
        $page->meta_description = "About Us Content" ;
        $page->meta_keywords = "About Us " ;
        $page->status = 1 ;
        $page->save() ;

        $page = new CmsPage;
        $page->title = "Terms & Conditions" ;
        $page->description = "Content is comming soon" ;
        $page->url = "terms-condition" ;
        $page->meta_title = "Terms & Conditions" ;
        $page->meta_description = "Terms & Conditions Content" ;
        $page->meta_keywords = "Terms & Conditions " ;
        $page->status = 1 ;
        $page->save() ;

    }
}
