<?php

use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;
use App\category;

class categorySeeder extends CsvSeeder
{
	
	public function __construct()
	{
		$this->table = 'categories';
		$this->csv_delimiter = ',';
		$this->filename = base_path().'/database/seeds/csvs/cat.csv';
	$this->mapping = [
	    0 => 'id',
	    1 => 'name',
	    2 => 'family_name',
	];		
	}

	
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		//DB::table($this->table)->truncate();

		parent::run();		
    }
}
