<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;

class ListProductController extends Controller
{
    public function getList(Request $request)
    {
        if ($request) {
            $data['products'] = Product::filter($request)->with('menu')->where('active', 1)->paginate(16);
        }
        if(!url()->current()) {
            $data['url'] = '';
        } else {
            $data['url'] = url()->current();
        }
        return view('client.list-products', $data);
    }

    public function getListMenu($id)
    {
        if(!url()->current()) {
            $data['url'] = '';
        } else {
            $data['url'] = url()->current();
        }
        $data['products'] = Product::with('menu')->where('menu_id', '=', $id)
        ->where('active', 1)
        ->paginate(9);
        $data['name'] = Menu::find($id)->name;
        return view('client.list-products',$data);
    }
}
