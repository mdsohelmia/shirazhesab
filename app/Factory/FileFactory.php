<?php
/**
 * Created by PhpStorm.
 * User: Ali Ghasemzadeh
 * Date: 3/9/2018
 * Time: 4:13 PM
 */

namespace App\Factory;

use App\File;
use App\FilePurchase;
use Illuminate\Support\Facades\Request;

class FileFactory
{
    public static function view($item)
    {
        return redirect()->route('file.view',['id' => $item->factory_id]);
    }

    public static function service($item, $user = array())
    {

    }
    public static function create($item, $user, $options = array())
    {
        $file = File::findOrFail($item->factory_id);
        $filePurchase = new FilePurchase();
        $filePurchase->user_id = $user->id;
        $filePurchase->file_id = $item->factory_id;
        $filePurchase->price = $item->sale_price;
        $file->purchases++;
        $file->save();
        return $filePurchase->save();
    }

    public static function terminate($item, $user, $options = array())
    {

    }

    public static function suspend($item, $user, $options = array())
    {

    }

    public static function unSuspend($item, $user, $options = array())
    {

    }

    public static function pageSetting($item)
    {

    }

    public static function saveSetting($item, Request $request)
    {

    }

    public static function pageRecord($item)
    {

    }

    public static function saveRecord($record, Request $request)
    {

    }

}