<?php

namespace App\Console\Commands;

use App\Product;
use App\ProductBrand;
use App\ProductCode;
use App\ProductGroup;
use App\ProductImage;
use App\ProductReplacement;
use App\ProductSupplier;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GenerateRobarckoData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'finalbytes:generate:robarcko';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will generate all data from the \'just\' retrieved robarcko data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ini_set('memory_limit', '4G');
        ini_set('max_execution_time', 3600);

        $input = Storage::disk('suppliers')->get('robarcko/orignal.json');
        $input = $this->convert_data($input);
        Storage::disk('suppliers')->put('robarcko/data.json', $input);

        $JSON = Storage::disk('suppliers')->get('robarcko/data.json');

        if ($this->json_validate($JSON)) {
            $data1 = json_decode($JSON, true);

            foreach ($data1 AS $item) {
                $this->createProduct('Robarcko', $item);
            }

        } else {
            //TODO
            //retry or send email

        }

    }

    private function convert_data($data) {
        //if the JSON contains \" convert it to inch
        //Will divide the one liner string to multiple lines :D
        //all K�HNER should be translated to KÜHNER

        $data = str_replace('\"', '&quot;', $data);
        $data = str_replace(',{"Id"', ', {"Id"', $data);

        $data = str_replace('K�HNER','KÜHNER', $data);

        return $data;
    }

    private function json_validate($string) {
        if (is_string($string)) {
            json_decode($string);
            return (json_last_error() === JSON_ERROR_NONE);
        }
        return false;
    }

    private function createProduct($_supplier, $item) {
        $supplier = ProductSupplier::firstOrCreate([
            'name' => $_supplier,
            'abbr' => Str::upper(substr($_supplier,0,4))
        ]);

        $code = ProductCode::firstOrCreate([
            'name' => ($item['Code'] ?: 'Onbekend')
        ]);

        $group = ProductGroup::firstOrCreate([
            'name' => ($item['ProductGroup'] ?: 'Onbekend')
        ]);

        $mountOn = ProductBrand::firstOrCreate([
            'name' => ($item['MountedOn'] ?: 'Onbekend')
        ]);

        $replacementFor = ProductBrand::firstOrCreate([
            'name' => ($item['ReplacementFor'] ?: 'Onbekend')
        ]);

        $product = Product::updateOrCreate(
            ['extern_id' => $item['Id']],
            [
                'code_id' => $code->id,
                'group_id' => $group->id,
                'mountedon_id' => $mountOn->id,
                'supplier_id' => $supplier->id,
                'replacement_for_id' => $replacementFor->id,

                'current' => $item['Current'],
                'delivery_from' => $item['DeliveryFrom'],
                'description' => $item['Description'],
                'details' => $item['Details'],
                'info' => $item['Info'],
                'kw' => $item['KW'],
                'customer_price_code' => $item['KlantPrijsCode'],
                'oem_number' => $item['OEMNummer'],
                'power' => $item['Power'],
                'price' => $this->calcPrice($item['Price']),
                'price_old' => $item['Price'],
                'features' => $item['ProductKenmerken'],
                'pulley_details' => $item['PulleyDetails'],
                'pulley_type' => $item['PulleyType'],
                'rotation' => $item['Rotation'],
                'stock' => $item['Stock'],
                'teeth' => $item['Teeth'],
                'voltage' => $item['Voltage']
            ]
        );

        $images = ['ImageAPath','ImageBPath','ImageCPath','ImageDPath','ImageEPath'];
        foreach ($images AS $image_type) {
            if (!empty($item[$image_type])) {
                ProductImage::firstOrCreate([
                    'product_id' => $product->id,
                    'type' => 'image',
                    'link' => $item[$image_type]
                ]);
            }
        }

        if (!empty($item['ImageDiagramPath'])) {
            ProductImage::firstOrCreate([
                'product_id' => $product->id,
                'type' => 'diagram',
                'link' => $item['ImageDiagramPath']
            ]);
        }

        $images = ['ImageTurning1Path','ImageTurning2Path'];
        foreach ($images AS $image_type) {
            if (!empty($item[$image_type])) {
                ProductImage::firstOrCreate([
                    'product_id' => $product->id,
                    'type' => 'turning',
                    'link' => $item[$image_type]
                ]);
            }
        }

//        foreach ($item['Replacing'] AS $replace_item) {
//
//            $brand = ProductBrand::firstOrCreate([
//                'name' => ($replace_item['Merk'] ?: 'Onbekend')
//            ]);
//
//            $code = ProductCode::firstOrCreate([
//                'name' => ($replace_item['Code'] ?: 'Onbekend')
//            ]);
//
//            ProductReplacement::firstOrCreate([
//                'product_id' => $product->id,
//                'brand_id' => $brand->id,
//                'code_id' => $code->id
//            ]);
//        }


        dd($item);





    }

    private function calcPrice($price) {
        return ($price * 1.21);
    }
}
