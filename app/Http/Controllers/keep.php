<?php $tempryValue =  DB::table('main_products')
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
                    )->whereIn('main_products.id', $finalId)
                    ->get()->groupBy("id");
                if (count($tempryValue) > 0) {
                    array_push(
                        $_finalSearch,
                        $tempryValue
                    );
                }