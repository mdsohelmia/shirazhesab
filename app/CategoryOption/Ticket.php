<?php
/**
 * Created by PhpStorm.
 * User: Ali Ghasemzadeh
 * Date: 4/27/2018
 * Time: 10:02 PM
 */

namespace App\CategoryOption;

use Illuminate\Support\Facades\Request;
use App\Category;

class Ticket
{
    public function form($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.option.ticket',['category' => $category]);
    }

    public function store(Request $request)
    {

    }
}