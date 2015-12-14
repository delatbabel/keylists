<?php

namespace Delatbabel\Keylists\Console\Commands;

use Illuminate\Console\Command;
use Delatbabel\Keylists\Models\Keytype;
use Delatbabel\Keylists\Models\Keyvalue;

class LoadISO3166Countries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'keylists:loadiso3166countries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load ISO3166 Country Codes';

    /**
     * Filename to load from
     *
     * @var string
     */
    protected $filename = __DIR__ . '/../../../database/data/ISO3166Countries.csv';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $keytype = Keytype::create([
            'name'          => 'countries',
            'description'   => 'ISO 3166 Country Codes',
            'created_by'    => 'loader',
            'updated_by'    => 'loader',
        ]);

        $handle = fopen($this->filename, 'r');

        // Get this in advance by calling wc -l $file
        $count = 246;
        $bar = $this->output->createProgressBar($count);

        while ($data = fgetcsv($handle)) {
            list($country_code, $country_name) = $data;

            // progress advance
            $bar->advance();

            // Skip the first line
            if ($country_code == "country_code") {
                continue;
            }

            // Create the entry
            Keyvalue::create([
                'keytype_id'    => $keytype->id,
                'keyvalue'      => $country_code,
                'keyname'       => $country_name,
                'created_by'    => 'loader',
                'updated_by'    => 'loader',
            ]);
        }

        fclose($handle);
        $bar->finish();
    }
}
