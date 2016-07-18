<?php

use App\Speciality;
use Illuminate\Database\Seeder;

class SpecialitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $specs = include(database_path('seeds/mixins/specialities.php'));

            foreach ($specs as $item) {

                $spec = Speciality::query()->where('name', $item)->first();

                if (empty($spec)) {
                    /** @var Speciality $spec */
                    $spec = new Speciality(['name' => $item]);
                    $spec->save();
                }
            }
        } catch (Exception $e){
            echo "Error to seed Specialities: {$e->getMessage()}\n";
        }
    }
}
