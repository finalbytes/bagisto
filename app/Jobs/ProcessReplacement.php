<?php

namespace App\Jobs;

use App\ProductBrand;
use App\ProductCode;
use App\ProductReplacement;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessReplacement implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $product_id = 0;
    private $items = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($product_id, $items)
    {
        $this->product_id = $product_id;
        $this->items = $items;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->items AS $item) {

            $brand = ProductBrand::firstOrCreate([
                'name' => ($item['Merk'] ?: 'Onbekend')
            ]);

            $code = ProductCode::firstOrCreate([
                'name' => ($item['Code'] ?: 'Onbekend')
            ]);

            ProductReplacement::firstOrCreate([
                'product_id' => $this->product_id,
                'brand_id' => $brand->id,
                'code_id' => $code->id
            ]);
        }
    }
}
