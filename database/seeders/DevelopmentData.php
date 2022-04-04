<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ab_article;
use App\Models\ab_articlecategory;

class DevelopmentData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User Samen streuen
        $userCSV = fopen(base_path("/resources/seeders/user.csv"),"r");

        $firstLine = true;

        while(($data = fgetcsv($userCSV, 2000, ";")) !== FALSE){
            if(!$firstLine){
                User::create([
                    "ab_name" => $data[1],
                    "ab_password" => Hash::make($data[2]),
                    "ab_mail" => $data[3]
                ]);
            }
            $firstLine = false;
        }
        fclose($userCSV);

        //Artikel Samen streuen
        $csv = fopen(base_path("/resources/seeders/articles.csv"),"r");
        $firstLine = true;

        while(($data = fgetcsv($csv, 2000, ";")) !== FALSE){
            $number = $data[2];
            if(strpos($data[2],".")){
                $number = intval(str_replace('.','',$data[2]));
            }
            if(!$firstLine){
                ab_article::create([
                    "ab_name" =>  $data[1],
                    "ab_price" => $number,
                    "ab_description" => $data[3],
                    "ab_creator_id" => $data[4],
                    "ab_createdate" => $data[5]
                ]);
            }
            $firstLine = false;
        }
        fclose($csv);

        //Kategorie Same streuen

        $categorycsv = fopen(base_path("/resources/seeders/articlecategory.csv"),"r");
        $firstLine = true;

        while(($data = fgetcsv($categorycsv, 2000, ";")) !== FALSE){
            if(!$firstLine){
                if($data[2]=='NULL'){
                    ab_articlecategory::create([
                        "ab_name" => $data[1]
                    ]);
                }
                else{
                    ab_articlecategory::create([
                        "ab_name" => $data[1],
                        "ab_parent" => $data[2]
                    ]);
                }
                
            }
            $firstLine = false;
        }
        fclose($categorycsv);
    }
}
