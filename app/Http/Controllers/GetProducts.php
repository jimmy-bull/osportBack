<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\Details;
use App\Models\estimation;
use App\Models\MainProducts;
use App\Models\Media;
use App\Models\BidData;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

date_default_timezone_set('Europe/Paris');
class GetProducts extends Controller
{

    public static function getHome()
    {
        return MainProducts::select('name', 'status', 'user_email', 'price',  'created_at', 'id')->get();
    }

    public static function getImage($id)
    {
        return Media::where('article_id', "=", $id)->get();
    }
    public static function getCharacteristics($id)
    {
        return Details::where('article_id', "=", $id)->get();
    }
    public static function getEstimations($id)
    {
        return estimation::where('article_id', "=", $id)->value('minimum_price');
    }
    public static function getHomeWithID($id)
    {
        return MainProducts::where('id', "=", $id)->select('name', 'status', 'user_email', 'price',  'created_at', 'id')->get();
    }
    public function getALlproductsForhomePage(Request $request)
    {
        $oo =  BidData::select('article_id')->distinct()->get();
        $idTable = [];
        foreach ($oo as $key => $value) {
            array_push(
                $idTable,
                BidData::where('article_id', "=",  $value->article_id)->max('bidDirectly')
            );
        }
        return DB::table('main_products')
            ->join('media', 'main_products.id', '=', 'media.article_id')
            ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
            ->join('categories', 'main_products.id', '=', 'categories.article_id')
            // ->join('bid_data', 'main_products.id', '=', 'bid_data.article_id')
            // ->whereIn('bid_data.bidDirectly',  $idTable)
            ->where('auction_dates.end', '>=', date('Y-m-d H:i:s'))
            ->where('categories.category_id', '=', $request->category_id)
            ->select(
                'main_products.id',
                'main_products.name',
                'media.image_link',
                'auction_dates.end',
                'categories.category_name',
                'categories.category_id',
                // "bid_data.bidDirectly"
            )->get()->groupBy("id");
    }
    public function getALlproductsForhomePageID(Request $request)
    {
        return DB::table('main_products')
            ->join('media', 'main_products.id', '=', 'media.article_id')
            ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
            ->join('categories', 'main_products.id', '=', 'categories.article_id')
            ->join('estimations', 'main_products.id', '=', 'estimations.article_id')
            ->select(
                'main_products.id',
                'main_products.name',
                'media.image_link',
                'auction_dates.end',
                'categories.category_name',
                'categories.category_id',
                'main_products.description',
                'main_products.price',
                'estimations.minimum_price',
            )->where('main_products.id', '=', $request->id)->get();
    }
    public function getAlldetails(Request $request)
    {
        return Details::where('article_id', "=", $request->id)->get();
    }
    public function search(Request $request)
    {
        $bigQuery = [json_decode($request->searchQuery)];
        //return  $bigQuery ;
        $get_Cate_name = null;
        $get_Cate_id = null;
        $getIDs = [];
        $present = false;
        $state = null;
        $_finalSearch = array();
        $_fanal_attr = array();
        $_GlobalSend = array();
        $_Search_on_attr_ = null;
        $_category  = null;
        $finalId = [];

        foreach ($bigQuery as $key => $value) {
            foreach ($value as $key2 => $value2) {
                if ($key2 == "query") {
                    $get_Cate_name =  Category::where('category_name', "LIKE", "{$value->$key2}%")->select('category_name')->get();
                    $_Search_on_attr_ = Details::where('attr_values', 'LIKE', "{$value->$key2}%")->select('article_id')->get();
                }
                if ($key2 == "state") {
                    $state = $value->$key2;
                }
                if ($key2 == "category") {
                    $_category = $value->$key2;
                }
            }
            foreach ($get_Cate_name  as $key3 => $catey) {
                array_push($getIDs, Category::where('category_name', "=", $catey->category_name)->select('article_id')->get());
            }
        }
        if (count($getIDs) > 0) {
            foreach (array_unique($getIDs)[0] as $key => $value) {
                array_push($finalId, $value->article_id);
            }
            if ($state == 'live') {
                foreach (array_unique($getIDs)[0] as $key => $value) {
                    $tempryValue =  DB::table('main_products')
                        ->join('media', 'main_products.id', '=', 'media.article_id')
                        ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                        ->join('categories', 'main_products.id', '=', 'categories.article_id')
                        ->where('auction_dates.end', '>=', date('Y-m-d H:i:s'))
                        ->where('auction_dates.start', '<=', date('Y-m-d H:i:s'))
                        ->where('categories.category_name', '=',  $_category)
                        ->select(
                            'main_products.id',
                            'main_products.name',
                            'media.image_link',
                            'auction_dates.end',
                            'categories.category_name',
                            'categories.category_id'
                        )->where('main_products.id', "=", $value->article_id)
                        ->get()->groupBy("id");
                    if (count($tempryValue) > 0) {
                        array_push(
                            $_finalSearch,
                            $tempryValue
                        );
                    }
                }
            } else if ($state == 'sold') {
                foreach (array_unique($getIDs)[0] as $key => $value) {
                    $maxprice =  BidData::where('article_id', "=", $value->article_id)->max('bidDirectly');
                    if ($maxprice > estimation::where('article_id', "=", $value->article_id)->value('minimum_price')) {
                        $tempryValue =  DB::table('main_products')
                            ->join('media', 'main_products.id', '=', 'media.article_id')
                            ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                            ->join('categories', 'main_products.id', '=', 'categories.article_id')
                            ->where('auction_dates.end', '<', date('Y-m-d H:i:s'))
                            ->where('categories.category_name', '=',  $_category)
                            ->select(
                                'main_products.id',
                                'main_products.name',
                                'media.image_link',
                                'auction_dates.end',
                                'categories.category_name',
                                'categories.category_id'
                            )->where('main_products.id', '=', $value->article_id)
                            ->get()->groupBy("id");
                        if (count($tempryValue) > 0) {
                            array_push(
                                $_finalSearch,
                                $tempryValue
                            );
                        }
                    }
                }
            } else if ($state == 'comming') {
                foreach (array_unique($getIDs)[0] as $key => $value) {
                    $tempryValue =  DB::table('main_products')
                        ->join('media', 'main_products.id', '=', 'media.article_id')
                        ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                        ->join('categories', 'main_products.id', '=', 'categories.article_id')
                        ->where('auction_dates.start', '>', date('Y-m-d H:i:s'))
                        ->where('categories.category_name', '=',  $_category)
                        ->select(
                            'main_products.id',
                            'main_products.name',
                            'media.image_link',
                            'auction_dates.end',
                            'categories.category_name',
                            'categories.category_id'
                        )->where('main_products.id', '=', $value->article_id)
                        ->get()->groupBy("id");
                    if (count($tempryValue) > 0) {
                        array_push(
                            $_finalSearch,
                            $tempryValue
                        );
                    }
                }
            }
            if (count(array_unique($_finalSearch)) > 0) {
                array_push($_GlobalSend, array_unique($_finalSearch));
            }
        }

        if (count($_Search_on_attr_) > 0 && count($_GlobalSend) == 0) {
            foreach ($_Search_on_attr_ as $key => $value) {
                array_push($finalId, $value->article_id);
            }
            if ($state == 'live') {
                foreach ($_Search_on_attr_ as $key => $value) {
                    $tempryValue =  DB::table('main_products')
                        ->join('media', 'main_products.id', '=', 'media.article_id')
                        ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                        ->join('categories', 'main_products.id', '=', 'categories.article_id')
                        ->where('auction_dates.end', '>=', date('Y-m-d H:i:s'))
                        ->where('auction_dates.start', '<=', date('Y-m-d H:i:s'))
                        ->where('categories.category_name', '=',  $_category)
                        ->select(
                            'main_products.id',
                            'main_products.name',
                            'media.image_link',
                            'auction_dates.end',
                            'categories.category_name',
                            'categories.category_id'
                        )->where('main_products.id', "=", $value->article_id)
                        ->get()->groupBy("id");
                    if (count($tempryValue) > 0) {
                        array_push(
                            $_finalSearch,
                            $tempryValue
                        );
                    }
                }
            } else if ($state == 'sold') {
                foreach ($_Search_on_attr_ as $key => $value) {
                    $maxprice =  BidData::where('article_id', "=", $value->article_id)->max('bidDirectly');
                    if ($maxprice > estimation::where('article_id', "=", $value->article_id)->value('minimum_price')) {
                        $tempryValue =  DB::table('main_products')
                            ->join('media', 'main_products.id', '=', 'media.article_id')
                            ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                            ->join('categories', 'main_products.id', '=', 'categories.article_id')
                            ->where('auction_dates.end', '<', date('Y-m-d H:i:s'))
                            ->where('categories.category_name', '=',  $_category)
                            ->select(
                                'main_products.id',
                                'main_products.name',
                                'media.image_link',
                                'auction_dates.end',
                                'categories.category_name',
                                'categories.category_id'
                            )->where('main_products.id', '=', $value->article_id)
                            ->get()->groupBy("id");
                        if (count($tempryValue) > 0) {
                            array_push(
                                $_finalSearch,
                                $tempryValue
                            );
                        }
                    }
                }
            } else if ($state == 'comming') {
                foreach ($_Search_on_attr_ as $key => $value) {
                    $tempryValue =  DB::table('main_products')
                        ->join('media', 'main_products.id', '=', 'media.article_id')
                        ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                        ->join('categories', 'main_products.id', '=', 'categories.article_id')
                        ->where('auction_dates.start', '>', date('Y-m-d H:i:s'))
                        ->where('categories.category_name', '=',  $_category)
                        ->select(
                            'main_products.id',
                            'main_products.name',
                            'media.image_link',
                            'auction_dates.end',
                            'categories.category_name',
                            'categories.category_id'
                        )->where('main_products.id', '=', $value->article_id)
                        ->get()->groupBy("id");
                    if (count($tempryValue) > 0) {
                        array_push(
                            $_finalSearch,
                            $tempryValue
                        );
                    }
                }
            }
            array_push($_GlobalSend, array_unique($_finalSearch));
        }
        $fisrtSearchKeys = [];
        if (count($_GlobalSend) > 0) {
            foreach ($_GlobalSend[0] as $key => $value) {
                foreach ($value as $key2 => $value2) {
                    array_push($fisrtSearchKeys, $key2);
                }
            }
        }

        return DB::table('main_products')
            ->join('media', 'main_products.id', '=', 'media.article_id')
            ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
            ->join('categories', 'main_products.id', '=', 'categories.article_id')
            ->join('estimations', 'main_products.id', '=', 'estimations.article_id')
            ->select(
                'main_products.id',
                'main_products.name',
                'media.image_link',
                'auction_dates.end',
                'categories.category_name',
                'categories.category_id',
                'main_products.description',
                'main_products.price',
                'estimations.minimum_price',
            )->whereIn('main_products.id',  $fisrtSearchKeys)->get()->groupBy("id");
    }
    public function searchDepend($searchQuery)
    {
        $bigQuery = [$searchQuery];
        //return  $bigQuery ;
        $get_Cate_name = null;
        // $get_Cate_id = null;
        $getIDs = [];
        // $present = false;
        $state = null;
        // $_finalSearch = array();
        // $_fanal_attr = array();
        $_GlobalSend = array();
        $_Search_on_attr_ = null;
        $_category  = null;
        $finalId = [];

        // $oo =  BidData::select('article_id')->distinct()->get();
        // $idTable = [];
        // foreach ($oo as $key => $value) {
        //     array_push(
        //         $idTable,
        //         BidData::where('article_id', "=",  $value->article_id)->max('bidDirectly')
        //     );
        // }
        foreach ($bigQuery as $key => $value) {
            foreach ($value as $key2 => $value2) {
                if ($key2 == "query") {
                    $get_Cate_name =  Category::where('category_name', "LIKE", "{$value->$key2}%")->select('category_name')->distinct()->get();
                    $_Search_on_attr_ = Details::where('attr_values', 'LIKE', "{$value->$key2}%")->select('article_id')->distinct()->get();
                }
                if ($key2 == "state") {
                    $state = $value->$key2;
                }
                if ($key2 == "category") {
                    $_category = $value->$key2;
                }
            }
            foreach ($get_Cate_name  as $key3 => $catey) {
                array_push($getIDs, Category::where('category_name', "=", $catey->category_name)->select('article_id')->distinct()->get());
            }
        }


        if (count($getIDs) > 0) {

            foreach (array_unique($getIDs)[0] as $key => $value) {
                array_push($finalId, $value->article_id);
            }

            if ($state == 'live') {

                return DB::table('main_products')
                    ->join('media', 'main_products.id', '=', 'media.article_id')
                    ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                    ->join('categories', 'main_products.id', '=', 'categories.article_id')
                    ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                    // ->whereIn('bid_data.bidDirectly',  $idTable)
                    ->where('auction_dates.end', '>=', date('Y-m-d H:i:s'))
                    ->where('auction_dates.start', '<=', date('Y-m-d H:i:s'))
                    ->where('categories.category_name', '=',  $_category)
                    ->select(
                        'main_products.id',
                        'main_products.name',
                        'media.image_link',
                        'auction_dates.end',
                        'categories.category_name',
                        'categories.category_id',
                        "bid_data.bidDirectly"
                    )->whereIn('main_products.id',  $finalId)
                    ->get()->groupBy("id");
            } else if ($state == 'sold') {

                $maxprice =  BidData::where('article_id', "=", $value->article_id)->max('bidDirectly');
                if ($maxprice > estimation::where('article_id', "=", $value->article_id)->value('minimum_price')) {
                    return DB::table('main_products')
                        ->join('media', 'main_products.id', '=', 'media.article_id')
                        ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                        ->join('categories', 'main_products.id', '=', 'categories.article_id')
                        ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                        // ->whereIn('bid_data.bidDirectly',  $idTable)
                        ->where('auction_dates.end', '<', date('Y-m-d H:i:s'))
                        ->where('categories.category_name', '=',  $_category)
                        ->select(
                            'main_products.id',
                            'main_products.name',
                            'media.image_link',
                            'auction_dates.end',
                            'categories.category_name',
                            'categories.category_id',
                            "bid_data.bidDirectly"
                        )->whereIn('main_products.id',  $finalId)
                        ->get()->groupBy("id");
                } else {
                    return [];
                }
            } else if ($state == 'comming') {
                return   DB::table('main_products')
                    ->join('media', 'main_products.id', '=', 'media.article_id')
                    ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                    ->join('categories', 'main_products.id', '=', 'categories.article_id')
                    ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                    // ->whereIn('bid_data.bidDirectly',  $idTable)
                    ->where('auction_dates.start', '>', date('Y-m-d H:i:s'))
                    ->where('categories.category_name', '=',  $_category)
                    ->select(
                        'main_products.id',
                        'main_products.name',
                        'media.image_link',
                        'auction_dates.end',
                        'categories.category_name',
                        'categories.category_id',
                        "bid_data.bidDirectly"
                    )->whereIn('main_products.id',  $finalId)
                    ->get()->groupBy("id");
            }
        }


        if (count($_Search_on_attr_) > 0) {
            foreach ($_Search_on_attr_ as $key => $value) {
                array_push($finalId, $value->article_id);
            }

            if ($state == 'live') {
                return DB::table('main_products')
                    ->join('media', 'main_products.id', '=', 'media.article_id')
                    ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                    ->join('categories', 'main_products.id', '=', 'categories.article_id')
                    ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                    // ->whereIn('bid_data.bidDirectly',  $idTable)
                    ->where('auction_dates.end', '>=', date('Y-m-d H:i:s'))
                    ->where('auction_dates.start', '<=', date('Y-m-d H:i:s'))
                    ->where('categories.category_name', '=',  $_category)
                    ->select(
                        'main_products.id',
                        'main_products.name',
                        'media.image_link',
                        'auction_dates.end',
                        'categories.category_name',
                        'categories.category_id',
                        "bid_data.bidDirectly"
                    )->whereIn('main_products.id',  $finalId)
                    ->get()->groupBy("id");
            } else if ($state == 'sold') {

                $maxprice =  BidData::where('article_id', "=", $value->article_id)->max('bidDirectly');
                if ($maxprice > estimation::where('article_id', "=", $value->article_id)->value('minimum_price')) {
                    return  DB::table('main_products')
                        ->join('media', 'main_products.id', '=', 'media.article_id')
                        ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                        ->join('categories', 'main_products.id', '=', 'categories.article_id')
                        ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                        // ->whereIn('bid_data.bidDirectly',  $idTable)
                        ->where('auction_dates.end', '<', date('Y-m-d H:i:s'))
                        ->where('categories.category_name', '=',  $_category)
                        ->select(
                            'main_products.id',
                            'main_products.name',
                            'media.image_link',
                            'auction_dates.end',
                            'categories.category_name',
                            'categories.category_id',
                            "bid_data.bidDirectly"
                        )->whereIn('main_products.id',  $finalId)
                        ->get()->groupBy("id");
                } else {
                    return [];
                }
            } else if ($state == 'comming') {
                return DB::table('main_products')
                    ->join('media', 'main_products.id', '=', 'media.article_id')
                    ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                    ->join('categories', 'main_products.id', '=', 'categories.article_id')
                    ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                    // ->whereIn('bid_data.bidDirectly',  $idTable)
                    ->where('auction_dates.start', '>', date('Y-m-d H:i:s'))
                    ->where('categories.category_name', '=',  $_category)
                    ->select(
                        'main_products.id',
                        'main_products.name',
                        'media.image_link',
                        'auction_dates.end',
                        'categories.category_name',
                        'categories.category_id',
                        "bid_data.bidDirectly"
                    )->whereIn('main_products.id',  $finalId)
                    ->get()->groupBy("id");
            }
        }
        if (count($getIDs) == 0 && count($_Search_on_attr_) == 0) {
            return [];
        }
    }

    public function getALLYATTR(Request $request)
    {
        return  DB::table('details')->join(
            'categories',
            'categories.article_id',
            '=',
            'details.article_id'
        )->where('categories.category_name', '=', $request->cat)
            ->select(['details.attr_type', 'details.attr_values'])->distinct()
            ->get();
    }

    public function __BigSearch(Request $request)
    {
        $big = json_decode($request->searchQuery);
        $customObj = new \stdClass();
        $customObj->query = $big->query;
        $customObj->category = $big->category;
        $customObj->state = $big->state;

        if (count($this->searchDepend($customObj)) > 0) {
            $fisrtSearchKeys = [];
            foreach ($this->searchDepend($customObj)[0] as $key => $value) {
                foreach ($value as $key2 => $value2) {
                    array_push($fisrtSearchKeys, $key2);
                }
            }
            unset($big->query);
            unset($big->category);
            unset($big->state);
            $finalQueryBig = [];
            $i = 0;

            $oo =  BidData::select('article_id')->distinct()->get();
            $idTable = [];
            foreach ($oo as $key => $value) {
                array_push(
                    $idTable,
                    BidData::where('article_id', "=",  $value->article_id)->max('bidDirectly')
                );
            }

            if (count((array)$big) > 0) {
                foreach ($big as $key => $value) {
                    if (count($value) == 1) {
                        array_push($finalQueryBig, 'attr_type' . ' =' . $key . " AND attr_values =" . implode(" AND ",  $value));
                    } else if (count($value) > 1) {
                        array_push($finalQueryBig, 'attr_type' . ' =' . $key . " AND attr_values =" . implode(" OR attr_values =",  $value));
                    }
                    $i++;
                }

                $finalString = implode(" OR ", $finalQueryBig);
                $found = ["=", "OR", "AND"];
                $replacement = ['= "', '" OR', '" AND'];
                $finalDetails = Details::whereRaw(str_replace($found, $replacement, $finalString) . '"')->select('article_id')->get();
                $countFinalDeatails = [];

                foreach ($finalDetails as $key => $value) {
                    array_push($countFinalDeatails, $value->article_id);
                }

                $finalArticle_id = [];
                foreach (array_count_values($countFinalDeatails) as $key => $value) {
                    if ($value == $i) {
                        array_push($finalArticle_id, $key);
                    }
                }
                $realFinalIDS = [];
                foreach (array_intersect($finalArticle_id, $fisrtSearchKeys) as $key => $value) {
                    array_push($realFinalIDS, $value);
                }

                return DB::table('main_products')
                    ->join('media', 'main_products.id', '=', 'media.article_id')
                    ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                    ->join('categories', 'main_products.id', '=', 'categories.article_id')
                    ->join('estimations', 'main_products.id', '=', 'estimations.article_id')
                    ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                    // ->whereIn('bid_data.bidDirectly',  $idTable)
                    ->select(
                        'main_products.id',
                        'main_products.name',
                        'media.image_link',
                        'auction_dates.end',
                        'categories.category_name',
                        'categories.category_id',
                        'main_products.description',
                        'main_products.price',
                        'estimations.minimum_price',
                        "bid_data.bidDirectly"
                    )->whereIn('main_products.id',  $realFinalIDS)->get()->groupBy("id");
            } else {
                return [];
            }
        } else {
            return [];
        }
    }


    //get product globally

    public function getALlproductsForhomePageNew($request, $take, $skip)
    {

        // $oo =  BidData::select('article_id')->distinct()->get();
        // $idTable = [];
        // foreach ($oo as $key => $value) {
        //     array_push(
        //         $idTable,
        //         BidData::where('article_id', "=",  $value->article_id)->max('bidDirectly')
        //     );
        // }


        $total =  count(DB::table('main_products')
            ->join('media', 'main_products.id', '=', 'media.article_id')
            ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
            ->join('categories', 'main_products.id', '=', 'categories.article_id')
            ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
            // ->whereIn('bid_data.bidDirectly',  $idTable)
            ->where('auction_dates.end', '>=', date('Y-m-d H:i:s'))
            ->where('categories.category_id', '=', $request)
            ->select(
                'main_products.id',
                'main_products.name',
                'media.image_link',
                'auction_dates.end',
                'categories.category_name',
                'categories.category_id',
                "bid_data.bidDirectly"
            )
            ->get()->groupBy("id"));

        $toshow =  DB::table('main_products')
            ->join('media', 'main_products.id', '=', 'media.article_id')
            ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
            ->join('categories', 'main_products.id', '=', 'categories.article_id')
            ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
            // ->whereIn('bid_data.bidDirectly',  $idTable)
            ->where('auction_dates.end', '>=', date('Y-m-d H:i:s'))
            ->where('categories.category_id', '=', $request)
            ->select(
                'main_products.id',
                'main_products.name',
                'media.image_link',
                'auction_dates.end',
                'categories.category_name',
                'categories.category_id',
                "bid_data.bidDirectly"
            )->orderBy("bid_data.bidDirectly", 'desc')
            ->get()->groupBy("id")->skip($skip)->take($take);

        return [$toshow, $total];
    }

    public function __BigSearchNew($searchQuery, $take, $skip)
    {
        $big = json_decode($searchQuery);
        $customObj = new \stdClass();
        $customObj->query = $big->query;
        $customObj->category = $big->category;
        $customObj->state = $big->state;

        if (count($this->searchDepend($customObj)) > 0) {
            $fisrtSearchKeys = [];
            foreach ($this->searchDepend($customObj) as $key => $value) {
                // foreach ($value as $key2 => $value2) {
                array_push($fisrtSearchKeys, $key);
                //  }
            }
            //    return $fisrtSearchKeys;
            unset($big->query);
            unset($big->category);
            unset($big->state);
            $finalQueryBig = [];
            $i = 0;
            //return count((array)$big);
            if (count((array)$big) > 0) {
                foreach ($big as $key => $value) {
                    if (count($value) == 1) {
                        array_push($finalQueryBig, 'attr_type' . ' =' . $key . " AND attr_values =" . implode(" AND ",  $value));
                    } else if (count($value) > 1) {
                        array_push($finalQueryBig, 'attr_type' . ' =' . $key . " AND attr_values =" . implode(" OR attr_values =",  $value));
                    }
                    $i++;
                }

                $finalString = implode(" OR ", $finalQueryBig);
                $found = ["=", "OR", "AND"];
                $replacement = ['= "', '" OR', '" AND'];
                $finalDetails = Details::whereRaw(str_replace($found, $replacement, $finalString) . '"')->select('article_id')->get();
                $countFinalDeatails = [];

                foreach ($finalDetails as $key => $value) {
                    array_push($countFinalDeatails, $value->article_id);
                }

                $finalArticle_id = [];
                foreach (array_count_values($countFinalDeatails) as $key => $value) {
                    if ($value == $i) {
                        array_push($finalArticle_id, $key);
                    }
                }
                $realFinalIDS = [];
                foreach (array_intersect($finalArticle_id, $fisrtSearchKeys) as $key => $value) {
                    array_push($realFinalIDS, $value);
                }

                // $oo =  BidData::select('article_id')->distinct()->get();
                // $idTable = [];
                // foreach ($oo as $key => $value) {
                //     array_push(
                //         $idTable,
                //         BidData::where('article_id', "=",  $value->article_id)->max('bidDirectly')
                //     );
                // }
                $total =  count(DB::table('main_products')
                    ->join('media', 'main_products.id', '=', 'media.article_id')
                    ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                    ->join('categories', 'main_products.id', '=', 'categories.article_id')
                    ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                    // ->whereIn('bid_data.bidDirectly',  $idTable)
                    ->join('estimations', 'main_products.id', '=', 'estimations.article_id')
                    ->select(
                        'main_products.id',
                        'main_products.name',
                        'media.image_link',
                        'auction_dates.end',
                        'categories.category_name',
                        'categories.category_id',
                        'main_products.description',
                        'main_products.price',
                        'estimations.minimum_price',
                        "bid_data.bidDirectly"
                    )->whereIn('main_products.id',  $realFinalIDS)->get()->groupBy("id"));

                $toshow =

                    DB::table('main_products')
                    ->join('media', 'main_products.id', '=', 'media.article_id')
                    ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                    ->join('categories', 'main_products.id', '=', 'categories.article_id')
                    ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                    // ->whereIn('bid_data.bidDirectly',  $idTable)
                    ->join('estimations', 'main_products.id', '=', 'estimations.article_id')
                    ->select(
                        'main_products.id',
                        'main_products.name',
                        'media.image_link',
                        'auction_dates.end',
                        'categories.category_name',
                        'categories.category_id',
                        'main_products.description',
                        'main_products.price',
                        'estimations.minimum_price',
                        "bid_data.bidDirectly"
                    )->orderBy("bid_data.bidDirectly", 'desc')->whereIn('main_products.id',  $realFinalIDS)->get()->groupBy("id")
                    ->skip($skip)->take($take);

                return [$toshow, $total];
            } else {
                return [[], 0];
            }
        } else {
            return [[], 0];
        }
    }

    public function searchNew($searchQuery, $take, $skip)
    {
        $bigQuery = [json_decode($searchQuery)];
        //return  $bigQuery ;
        $get_Cate_name = null;
        // $get_Cate_id = null;
        $getIDs = [];
        // $present = false;
        $state = null;
        // $_finalSearch = array();
        // $_fanal_attr = array();
        $_GlobalSend = array();
        $_Search_on_attr_ = null;
        $_category  = null;
        $finalId = [];

        // $oo =  BidData::select('article_id')->distinct()->get();
        // $idTable = [];
        // foreach ($oo as $key => $value) {
        //     array_push(
        //         $idTable,
        //         BidData::where('article_id', "=",  $value->article_id)->max('bidDirectly')
        //     );
        // }

        foreach ($bigQuery as $key => $value) {
            foreach ($value as $key2 => $value2) {
                if ($key2 == "query") {
                    $get_Cate_name =  Category::where('category_name', "LIKE", "{$value->$key2}%")->select('category_name')->distinct()->get();
                    $_Search_on_attr_ = Details::where('attr_values', 'LIKE', "{$value->$key2}%")->select('article_id')->distinct()->get();
                }
                if ($key2 == "state") {
                    $state = $value->$key2;
                }
                if ($key2 == "category") {
                    $_category = $value->$key2;
                }
            }
            foreach ($get_Cate_name  as $key3 => $catey) {
                array_push($getIDs, Category::where('category_name', "=", $catey->category_name)->select('article_id')->distinct()->get());
            }
        }


        if (count($getIDs) > 0) {
            foreach (array_unique($getIDs)[0] as $key => $value) {
                array_push($finalId, $value->article_id);
            }

            if ($state == 'live') {
                $toshow =  DB::table('main_products')
                    ->join('media', 'main_products.id', '=', 'media.article_id')
                    ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                    ->join('categories', 'main_products.id', '=', 'categories.article_id')
                    ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                    // ->whereIn('bid_data.bidDirectly',  $idTable)
                    ->where('auction_dates.end', '>=', date('Y-m-d H:i:s'))
                    ->where('auction_dates.start', '<=', date('Y-m-d H:i:s'))
                    ->where('categories.category_name', '=',  $_category)

                    ->select(
                        'main_products.id',
                        'main_products.name',
                        'media.image_link',
                        'auction_dates.end',
                        'categories.category_name',
                        'categories.category_id',
                        "bid_data.bidDirectly"
                    )->orderBy("bid_data.bidDirectly", 'desc')->whereIn('main_products.id',  $finalId)
                    ->get()->groupBy("id")->skip($skip)->take($take);

                $total =  DB::table('main_products')
                    ->join('media', 'main_products.id', '=', 'media.article_id')
                    ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                    ->join('categories', 'main_products.id', '=', 'categories.article_id')
                    ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                    // ->whereIn('bid_data.bidDirectly',  $idTable)
                    ->where('auction_dates.end', '>=', date('Y-m-d H:i:s'))
                    ->where('auction_dates.start', '<=', date('Y-m-d H:i:s'))
                    ->where('categories.category_name', '=',  $_category)
                    ->select(
                        'main_products.id',
                        'main_products.name',
                        'media.image_link',
                        'auction_dates.end',
                        'categories.category_name',
                        'categories.category_id',
                        "bid_data.bidDirectly"
                    )->whereIn('main_products.id',  $finalId)
                    ->get()->groupBy("id");

                return [$toshow, count($total)];
            } else if ($state == 'sold') {

                // $maxprice =  BidData::where('article_id', "=", $value->article_id)->max('bidDirectly');
                // if ($maxprice > estimation::where('article_id', "=", $value->article_id)->value('minimum_price')) {
                $toshow =  DB::table('main_products')
                    ->join('media', 'main_products.id', '=', 'media.article_id')
                    ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                    ->join('categories', 'main_products.id', '=', 'categories.article_id')
                    ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                    ->join('estimations', 'main_products.id', '=', 'estimations.article_id')
                    //  ->where('estimations.minimum_price', '<=', "bid_data.bidDirectly")
                    // ->whereIn('bid_data.bidDirectly',  $idTable)
                    ->where('auction_dates.end', '<', date('Y-m-d H:i:s'))
                    ->where('categories.category_name', '=',  $_category)
                    ->select(
                        'main_products.id',
                        'main_products.name',
                        'media.image_link',
                        'auction_dates.end',
                        'categories.category_name',
                        'categories.category_id',
                        "bid_data.bidDirectly"
                    )->orderBy("bid_data.bidDirectly", 'desc')->whereIn('main_products.id',  $finalId)
                    ->get()->groupBy("id")->skip($skip)->take($take);

                $total =  DB::table('main_products')
                    ->join('media', 'main_products.id', '=', 'media.article_id')
                    ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                    ->join('categories', 'main_products.id', '=', 'categories.article_id')
                    ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                    // ->whereIn('bid_data.bidDirectly',  $idTable)
                    ->where('auction_dates.end', '<', date('Y-m-d H:i:s'))
                    ->where('categories.category_name', '=',  $_category)
                    ->select(
                        'main_products.id',
                        'main_products.name',
                        'media.image_link',
                        'auction_dates.end',
                        'categories.category_name',
                        'categories.category_id',
                        "bid_data.bidDirectly"
                    )->whereIn('main_products.id',  $finalId)
                    ->get()->groupBy("id");

                return [$toshow, count($total)];
                // } else {
                //     return [[], 0];
                // }
            } else if ($state == 'comming') {
                $toshow =  DB::table('main_products')
                    ->join('media', 'main_products.id', '=', 'media.article_id')
                    ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                    ->join('categories', 'main_products.id', '=', 'categories.article_id')
                    ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                    // ->whereIn('bid_data.bidDirectly',  $idTable)
                    ->where('auction_dates.start', '>', date('Y-m-d H:i:s'))
                    ->where('categories.category_name', '=',  $_category)
                    ->select(
                        'main_products.id',
                        'main_products.name',
                        'media.image_link',
                        'auction_dates.end',
                        'categories.category_name',
                        'categories.category_id',
                        "bid_data.bidDirectly"
                    )->orderBy("bid_data.bidDirectly", 'desc')->whereIn('main_products.id',  $finalId)
                    ->get()->groupBy("id")->skip($skip)->take($take);


                $total =  DB::table('main_products')
                    ->join('media', 'main_products.id', '=', 'media.article_id')
                    ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                    ->join('categories', 'main_products.id', '=', 'categories.article_id')
                    ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                    // ->whereIn('bid_data.bidDirectly',  $idTable)
                    ->where('auction_dates.start', '>', date('Y-m-d H:i:s'))
                    ->where('categories.category_name', '=',  $_category)
                    ->select(
                        'main_products.id',
                        'main_products.name',
                        'media.image_link',
                        'auction_dates.end',
                        'categories.category_name',
                        'categories.category_id',
                        "bid_data.bidDirectly"
                    )->whereIn('main_products.id',  $finalId)
                    ->get()->groupBy("id");

                return [$toshow, count($total)];
            } else {
                return [[], 0];
            }
        }


        if (count($_Search_on_attr_) > 0) {

            foreach ($_Search_on_attr_ as $key => $value) {
                array_push($finalId, $value->article_id);
            }

            if ($state == 'live') {
                //return 'ok';
                $toshow =  DB::table('main_products')
                    ->join('media', 'main_products.id', '=', 'media.article_id')
                    ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                    ->join('categories', 'main_products.id', '=', 'categories.article_id')
                    ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                    // ->whereIn('bid_data.bidDirectly',  $idTable)
                    ->where('auction_dates.end', '>=', date('Y-m-d H:i:s'))
                    ->where('auction_dates.start', '<=', date('Y-m-d H:i:s'))
                    ->where('categories.category_name', '=',  $_category)
                    ->select(
                        'main_products.id',
                        'main_products.name',
                        'media.image_link',
                        'auction_dates.end',
                        'categories.category_name',
                        'categories.category_id',
                        "bid_data.bidDirectly"
                    )->orderBy("bid_data.bidDirectly", 'desc')->whereIn('main_products.id',  $finalId)
                    ->get()->groupBy("id")->skip($skip)->take($take);

                $total =  DB::table('main_products')
                    ->join('media', 'main_products.id', '=', 'media.article_id')
                    ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                    ->join('categories', 'main_products.id', '=', 'categories.article_id')
                    ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                    // ->whereIn('bid_data.bidDirectly',  $idTable)
                    ->where('auction_dates.end', '>=', date('Y-m-d H:i:s'))
                    ->where('auction_dates.start', '<=', date('Y-m-d H:i:s'))
                    ->where('categories.category_name', '=',  $_category)
                    ->select(
                        'main_products.id',
                        'main_products.name',
                        'media.image_link',
                        'auction_dates.end',
                        'categories.category_name',
                        'categories.category_id',
                        "bid_data.bidDirectly"
                    )->whereIn('main_products.id',  $finalId)
                    ->get()->groupBy("id");

                return [$toshow, count($total)];
            } else if ($state == 'sold') {

                $maxprice =  BidData::where('article_id', "=", $value->article_id)->max('bidDirectly');
                if ($maxprice > estimation::where('article_id', "=", $value->article_id)->value('minimum_price')) {
                    $toshow =  DB::table('main_products')
                        ->join('media', 'main_products.id', '=', 'media.article_id')
                        ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                        ->join('categories', 'main_products.id', '=', 'categories.article_id')
                        ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                        // ->whereIn('bid_data.bidDirectly',  $idTable)
                        ->where('auction_dates.end', '<', date('Y-m-d H:i:s'))
                        ->where('categories.category_name', '=',  $_category)
                        ->select(
                            'main_products.id',
                            'main_products.name',
                            'media.image_link',
                            'auction_dates.end',
                            'categories.category_name',
                            'categories.category_id',
                            "bid_data.bidDirectly"
                        )->orderBy("bid_data.bidDirectly", 'desc')->whereIn('main_products.id',  $finalId)
                        ->get()->groupBy("id")->skip($skip)->take($take);

                    $total =  DB::table('main_products')
                        ->join('media', 'main_products.id', '=', 'media.article_id')
                        ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                        ->join('categories', 'main_products.id', '=', 'categories.article_id')
                        ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                        // ->whereIn('bid_data.bidDirectly',  $idTable)
                        ->where('auction_dates.end', '<', date('Y-m-d H:i:s'))
                        ->where('categories.category_name', '=',  $_category)
                        ->select(
                            'main_products.id',
                            'main_products.name',
                            'media.image_link',
                            'auction_dates.end',
                            'categories.category_name',
                            'categories.category_id',
                            "bid_data.bidDirectly"
                        )->whereIn('main_products.id',  $finalId)
                        ->get()->groupBy("id");

                    return [$toshow, count($total)];
                } else {
                    return [[], 0];
                }
            } else if ($state == 'comming') {
                $toshow =  DB::table('main_products')
                    ->join('media', 'main_products.id', '=', 'media.article_id')
                    ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                    ->join('categories', 'main_products.id', '=', 'categories.article_id')
                    ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                    // ->whereIn('bid_data.bidDirectly',  $idTable)
                    ->where('auction_dates.start', '>', date('Y-m-d H:i:s'))
                    ->where('categories.category_name', '=',  $_category)
                    ->select(
                        'main_products.id',
                        'main_products.name',
                        'media.image_link',
                        'auction_dates.end',
                        'categories.category_name',
                        'categories.category_id',
                        "bid_data.bidDirectly"
                    )->orderBy("bid_data.bidDirectly", 'desc')->whereIn('main_products.id',  $finalId)
                    ->get()->groupBy("id")->skip($skip)->take($take);


                $total =  DB::table('main_products')
                    ->join('media', 'main_products.id', '=', 'media.article_id')
                    ->join('auction_dates', 'main_products.id', '=', 'auction_dates.article_id')
                    ->join('categories', 'main_products.id', '=', 'categories.article_id')
                    ->leftJoin('bid_data', 'main_products.id', '=', 'bid_data.article_id')
                    // ->whereIn('bid_data.bidDirectly',  $idTable)
                    ->where('auction_dates.start', '>', date('Y-m-d H:i:s'))
                    ->where('categories.category_name', '=',  $_category)
                    ->select(
                        'main_products.id',
                        'main_products.name',
                        'media.image_link',
                        'auction_dates.end',
                        'categories.category_name',
                        'categories.category_id',
                        "bid_data.bidDirectly"
                    )->whereIn('main_products.id',  $finalId)
                    ->get()->groupBy("id");

                return [$toshow, count($total)];
            }
        }
        if (count($getIDs) == 0 && count($_Search_on_attr_) == 0) {

            return [[], 0];
        }
    }

    public function getGBlobalProduct(Request $request)
    {
        $pagefrom_front = 1;
        $toTake = 25;

        if (count((array)json_decode($request->second)) != 0 || count((array)json_decode($request->second)) != null) {
            if (property_exists(json_decode($request->second), 'page')) {

                $pagefrom_front = json_decode($request->second)->page;
                if (intval($pagefrom_front[0]) <= 0) {
                    $pagefrom_front[0] = 1;
                }
                $currentPage = intval($pagefrom_front[0]) - 1;
                $skip = $currentPage * $toTake;
                $stock =  json_decode($request->second);
                unset($stock->page);


                if (count((array)$stock) > 3) {
                    return $this->__BigSearchNew(json_encode($stock), $toTake, $skip);
                } else if (count((array)$stock)  == 3) {
                    return  $this->searchNew(json_encode($stock), $toTake, $skip);
                } else if (count((array)$stock)  == 0) {
                    return $this->getALlproductsForhomePageNew($request->first, $toTake, $skip);
                } else {
                    return [
                        [], 0
                    ];
                }
            } else {
                $currentPage = $pagefrom_front - 1;
                $skip = $currentPage * $toTake;
                if (count((array)json_decode($request->second)) > 3) {
                    return $this->__BigSearchNew($request->second, $toTake, $skip);
                    // return $request->second;
                } else if (count((array)json_decode($request->second)) == 3) {
                    return  $this->searchNew($request->second, $toTake, $skip);
                    //  return $request->second;
                } else {
                    return [
                        [], 0
                    ];
                }
                //  else if (count((array)json_decode($request->second)) == 1 || count((array)json_decode($request->second)) == null) {
                //     return $this->getALlproductsForhomePageNew($request->first, $toTake,  $skip);
                // }
            }
        } else if (count((array)json_decode($request->second)) == 0 || count((array)json_decode($request->second)) == null) {
            return $this->getALlproductsForhomePageNew($request->first, $toTake, 0);
        } else {
            return [
                [], 0
            ];
        }
    }
}

/**
 *  
 */
