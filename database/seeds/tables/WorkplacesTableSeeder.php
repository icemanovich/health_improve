<?php

use App\Workplace;
use Illuminate\Database\Seeder;

class WorkplacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $data = include(database_path('seeds/mixins/workplaces.php'));

            foreach ($data as $item) {

                $place = Workplace::query()->where('name', $item['name'])->first();

                if (empty($place)) {
                    /** @var Workplace $spec */
                    $place = new Workplace($item);
                    $place->save();
                }
            }
        } catch (Exception $e){
            echo "Error to seed Workplaces: {$e->getMessage()}\n";
        }
    }
}
