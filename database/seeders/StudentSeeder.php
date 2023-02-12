<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Student;


class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = fopen(public_path().'/students.csv', 'r');
        while (($row = fgetcsv($file)) !== FALSE) {            
            $c = new Student();
            $c->id = $row[0];
            $c->first_name = $row[1];
            $c->last_name = $row[2];
            $c->email = $row[3];
            $c->save();
        }
        fclose($file);        
    }
}
