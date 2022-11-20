<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesAttributes extends Controller
{
    public function getAll()
    {
        if (DB::table('category_attributes')->count() == 0) {
            return 'Empty';
        } else if (DB::table('category_attributes')->count() > 0) {
            return DB::table('category_attributes')->get();
        }
    }
    public function getATTR_CAT()
    {
        $tableFInal = [];

        $getDirect_categoryID = DB::table('mshop_catalog')->where('label', '=', 'Direct category')
            ->select('id')->get();

        array_push($tableFInal, DB::table('mshop_catalog')->where('Parentid', '=', $getDirect_categoryID[0]->id)
            ->select(['id', 'Label'])->get());

        array_push($tableFInal, DB::table('mshop_attribute_type')->select(['Label'])->groupBy('Label')->get());
        return $tableFInal;
    }

    public function getATTR_WAYS(Request $request)
    {
        return  DB::table('category_attributes')
            ->join(
                'attribute_ways',
                'category_attributes.attribute_type',
                '=',
                'attribute_ways.attribute_type'
            )->join('details_descs', "category_attributes.attribute_type",  '=', "details_descs.attribute_type")
            ->where('category_attributes.catID', '=', $request->catID)->select(['category_attributes.attribute_type', 'values', 'ways', 'attribute_desc'])->get();
    }
}

/** mshop_attribute
 *  CategoryAttribute nom de sideBAr
 *    
 *   les Champs sur adminPAge: 
 *    - category = selectioner parmis toutes les categorie existante
 *    - attributes  = selectionner parmis touts les attribut deja crée
 *    - VAlues = la valeurs de l'attribut seléctioner pour la categories
 *      
 *     champs de base de la donner pour les attribut des categories
 *      id / catID / attribute_type/ values
 *    
 */
