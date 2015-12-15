<?php

namespace Delatbabel\Keylists\Console\Commands;

use Illuminate\Console\Command;
use Delatbabel\Keylists\Models\Keytype;
use Delatbabel\Keylists\Models\Keyvalue;

class LoadExchangeRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'keylists:loadusdrates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load USD Exchange Rates';

    /**
     * Filename to load from, as a one off if you don't have an API key
     *
     * @var string
     */
    protected $filename = __DIR__ . '/../../../database/data/exchange_rates.json';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // To get the data from the openexchangerates.org site, then uncomment
        // these lines and substitute in your own app_id.
        /*
        $request_url = 'https://openexchangerates.org/api/latest.json';
        $params = [
            'app_id' => 'YOUR_APP_ID_HERE',
        ];

        $client = new \GuzzleHttp\Client();
        $client->setDefaultOption('verify', false);

        $request_response = $client->get($request_url, ['query' => $params]);
        $response_data = json_decode($request_response->getBody()->getContents(), true);
        if (empty($response_data) or ! empty($response_data['error'])) {
            throw new \Exception('Empty response from api.');
        }
        */
        
        // To pull the data from the one off JSON file, then just use these
        // lines.
        $json_data = file_get_contents($this->filename);
        $response_data = json_decode($json_data, true);
        
        /** @var Keytype $keytype */
        $keytype = Keytype::create([
            'name'          => 'usd_rates',
            'description'   => 'USD Exchange Rates',
            'created_by'    => 'loader',
            'updated_by'    => 'loader',
        ]);

        
        // Get this in advance
        $ratedata = $response_data['rates'];
        $count = count($ratedata);
        $bar = $this->output->createProgressBar($count);

        foreach ($ratedata as $code => $rate) {
            $keyval = Keyvalue::firstOrNew([
                'keytype_id'    => $keytype->id,
                'keyvalue'      => $code,
            ]);
            $keyval->keyname          = "USD to $code Exchange Rate";
            $keyval->extended_data    = [
                'exchange_rate' => $rate,
            ];
            $keyval->save();

            // progress advance
            $bar->advance();
        }

        // Finished
        $bar->finish();
        $this->output->writeln('Finished');
    }
}
