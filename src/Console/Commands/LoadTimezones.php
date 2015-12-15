<?php

namespace Delatbabel\Keylists\Console\Commands;

use Illuminate\Console\Command;
use Delatbabel\Keylists\Models\Keytype;
use Delatbabel\Keylists\Models\Keyvalue;

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
        $bar = $this->output->createProgressBar($count);

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
