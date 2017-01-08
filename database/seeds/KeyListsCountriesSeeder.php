<?php

use Delatbabel\Keylists\Models\Keytype;
use Delatbabel\Keylists\Models\Keyvalue;
use Illuminate\Database\Seeder;

class KeyListsCountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Create a keytype for country codes.
        //
        /** @var Keytype $keytype */
        $keytype = Keytype::create([
            'name'          => 'country_dialling',
            'description'   => 'Country Dialling Codes',
            'created_by'    => 'loader',
            'updated_by'    => 'loader',
        ]);

        // Read all of the country data from the supplied data file.
        $file = fopen(base_path('vendor') . '/delatbabel/keylists/database/data/country_dialling_codes.csv', 'rb');
        while ($line = fgetcsv($file)) {
            list($id, $country_name, $country_code, $country_iso, $country_iso3) = $line;

            if (! is_numeric($id)) {
                continue;
            }

            try {
                Keyvalue::create([
                    'keytype_id'    => $keytype->id,
                    'keyvalue'      => $country_iso,
                    'keyname'       => $country_name,
                    'extended_data' => [
                        'dialling_code'     => $country_code,
                        'iso3'              => $country_iso3,
                    ]
                ]);
            } catch (\Exception $e) {

                // There are regions with duplicate ISO codes that match their parent update
                Keyvalue::create([
                    'keytype_id'    => $keytype->id,
                    'keyvalue'      => $country_iso . '-' . $id,
                    'keyname'       => $country_name,
                    'extended_data' => [
                        'dialling_code'     => $country_code,
                        'iso3'              => $country_iso3,
                    ]
                ]);
            }
        }
    }
}
