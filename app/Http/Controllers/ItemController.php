<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function view($id)
    {
        $item = Item::findOrFail($id);
        $factory = $item->factory;
        $factory = new $factory();
        return $factory->view($item);
    }


}
