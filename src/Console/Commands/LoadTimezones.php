<?php
/**
 * LoadTimezones
 */
namespace Delatbabel\Keylists\Console\Commands;

use Delatbabel\Keylists\Models\Keytype;
use Delatbabel\Keylists\Models\Keyvalue;
use Illuminate\Console\Command;

/**
 * Class LoadTimezones
 *
 * This is an example of a script to load data into the keytypes/keyvalues
 * tables from a PHP function. In this ase the function used is
 * timezone_identifiers_list() which contains the list of timezones
 * supported by PHP.
 */
class LoadTimezones extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'keylists:loadtimezones';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load Timezone Names';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /** @var Keytype $keytype */
        $keytype = Keytype::create([
            'name'          => 'timezones',
            'description'   => 'Time Zones',
            'created_by'    => 'loader',
            'updated_by'    => 'loader',
        ]);

        // Get this in advance
        $count = 417;
        $bar   = $this->output->createProgressBar($count);

        $timezone_list = timezone_identifiers_list();

        foreach ($timezone_list as $timezone) {
            // Create the entry
            Keyvalue::create([
                'keytype_id'    => $keytype->id,
                'keyvalue'      => $timezone,
                'keyname'       => $timezone,
                'created_by'    => 'loader',
                'updated_by'    => 'loader',
            ]);

            // progress advance
            $bar->advance();
        }

        // Finished
        $bar->finish();
        $this->output->writeln('Finished');
    }
}
