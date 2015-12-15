<?php
/**
 * LoadAUStates
 */
namespace Delatbabel\Keylists\Console\Commands;

use Illuminate\Console\Command;
use Delatbabel\Keylists\Models\Keytype;
use Delatbabel\Keylists\Models\Keyvalue;

/*
 * LoadAUStates
 *
 * This is an example of a script to load data into the keytypes/keyvalues
 * tables from a CSV file.  The CSV file used in this case contains a list
 * of Australian states and territories.
 */
class LoadAUStates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'keylists:loadaustates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load Australian States';

    /**
     * Filename to load from
     *
     * @var string
     */
    protected $filename = __DIR__ . '/../../../database/data/AUSstates.csv';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /** @var Keytype $keytype */
        $keytype = Keytype::create([
            'name'          => 'states.au',
            'description'   => 'Australian States',
            'created_by'    => 'loader',
            'updated_by'    => 'loader',
        ]);

        $handle = fopen($this->filename, 'r');

        // Get this in advance by calling wc -l $file
        $count = 8;
        $bar = $this->output->createProgressBar($count);

        while ($data = fgetcsv($handle)) {
            try {
                list($country, $state_code, $state_name) = $data;
            } catch (\Exception $e) {
                continue;
            }

            // progress advance
            $bar->advance();

            // Create the entry
            Keyvalue::create([
                'keytype_id'    => $keytype->id,
                'keyvalue'      => $state_code,
                'keyname'       => $state_name,
                'created_by'    => 'loader',
                'updated_by'    => 'loader',
            ]);
        }

        fclose($handle);
        $bar->finish();

        $this->output->writeln('Finished');
    }
}
