<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Campaign;
use App\Models\Product;
use Carbon\Carbon;

class UpdateExpiredCampaigns extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'campaigns:update-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update expired campaigns and set product campaign data to null';

    /**
     * Execute the console command.
     */

     public function __construct()
     {
         parent::__construct();
     }

     
    public function handle()
    {
        $currentDate = Carbon::now();
        $expiredCampaigns = Campaign::where('expiry_date', '<', $currentDate)->get();

        if ($expiredCampaigns->isEmpty()) {
            $this->info('No expired campaigns found.');
            return;
        }

        // Loop through each expired campaign and update the related products
        foreach ($expiredCampaigns as $campaign) {
            Product::where('campaign_id', $campaign->id)
                ->update([
                    'campaign_id' => null,
                    'campaign_price' => null,
                ]);

            $this->info("Updated products for campaign: {$campaign->name}");
        }

        $this->info('Expired campaigns updated successfully.');
    }

  
    
}
