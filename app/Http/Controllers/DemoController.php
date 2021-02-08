<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DemoController extends Controller
{
    public function index() {
        return view('demo');
    }

    public function search() {
        ini_set('memory_limit', '4G');
        ini_set('max_execution_time', 3600);

        $search = request()->get('search');

//        $product = $this->searchInProducts($search);
//        if (is_object($product)) {
//            return $product;
//        }

        $products = $this->searchInReplacements($search);

        if (is_object($products)) {
            return $products;
        }

        //Remove all - from the search query
        $search = str_replace('-','', $search);

        $product = $this->searchInProducts($search);
        if (is_object($product)) {
            return $product;
        }

        $products = $this->searchInReplacements($search);
        if (is_object($products)) {
            return $products;
        }

        return ['eind'=>'0'];
    }

    private function searchInProducts($search) {
        $rows = DB::select('SELECT fb_p.id
            FROM fb_products AS fb_p
            INNER JOIN fb_product_codes AS fb_pc ON fb_pc.`id` = fb_p.`code_id`
            WHERE fb_pc.`name` = ?'
            , [$search]);

        if (isset($rows[0])) {
            return Product::find($rows[0]->id);
        }
        return false;
    }

    private function searchInReplacements($search) {
        $rows = DB::select('SELECT fb_p.id
            FROM fb_products AS fb_p
            INNER JOIN `fb_product_replacements` AS fb_pr ON fb_pr.`product_id` = fb_p.`id`
            INNER JOIN `fb_product_codes` AS fb_c ON fb_c.`id` = fb_pr.`code_id`
            WHERE fb_c.`name` = ?'
            , [$search]);

        if ($rows) {
            $arr = [];
            foreach($rows AS $row){
                $arr[] = $row->id;
            }

            var_dump($arr);

            $ids = implode(', ', $arr);

            //\DB::enableQueryLog();
            $rows = Product::whereIn('id', [$ids])->get();
            //$ids = '1, 2, 3';
            //$rows = DB::select('SELECT * FROM fb_products WHERE id IN (?)', [$ids]);
            //$rows = DB::table('fb_product')->whereIn('id', [$ids])->get();


            dd($rows);
            //dd(\DB::getQueryLog());

        }
        return false;
    }
}
