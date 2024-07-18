<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use App\Models\District;
use App\Models\DSDivision;
use App\Models\master\Item;
use App\Models\master\Menu;
use Illuminate\Http\Request;
use App\Models\RegimentDepartment;

class AjaxController extends Controller
{
    public function getMenus(Request $request)
    {
        $rationTimeId = $request->input('ration_time_id');
        $rationDateId = $request->input('ration_date_id');

        // Fetch menus based on ration_time_id and ration_date_id
        $menus = Menu::where('ration_time_id', $rationTimeId)
                    ->where('ration_date_id', $rationDateId)
                    ->get();

        // Return a JSON response
        return response()->json($menus);
    }

    public function getItems(Request $request)
    {
        $rationTimeId = $request->input('ration_time_id');
        $rationDateId = $request->input('ration_date_id');

        // Fetch items related to the given ration_time_id and ration_date_id
        $items = Item::whereHas('menuitems', function ($query) use ($rationTimeId, $rationDateId) {
                        $query->whereHas('selectmenu', function ($query) use ($rationTimeId, $rationDateId) {
                            $query->where('ration_time_id', $rationTimeId)
                                ->where('ration_date_id', $rationDateId);
                        });
                    })->get();

        // Return a JSON response
        return response()->json($items);
    }

    public function getMeasurements(Request $request)
    {
        $itemId = $request->input('item_id');        

        $item = Item::with('measurement')->find($itemId);

        if ($item) {
            return response()->json(['measurement' => $item->measurement]);
        } else {
            return response()->json(['measurement' => null]);
        }
    }
    

}
