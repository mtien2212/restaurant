<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ingredients;
use App\Models\Product;

class IngredientsController extends Controller
{
    //
    public function AllIngredients(){
        $product = new Ingredients();
        $listIngredients = $product->GetAll();
        return view('admin.ingredients')->with('listIngredients',$listIngredients);
    }
    public function SearchIngredients(Request $request){
        $product = new Product();
        $name_product = $product->GetProductByID($_REQUEST['id']);
        $ingredients = new Ingredients();
        $allIngredients = $ingredients->GetIngredientsByName($_REQUEST['name']);
        $listIngredients = $ingredients->GetIngredientByProduct($_REQUEST['id']);
        $price = 0;
            foreach($listIngredients as $b){
                $price += $b->dongia * $b->soluong;
            }
        return view('admin.product_ingredients',['allIngredients' => $allIngredients, 'listIngredients' => $listIngredients, 'name_product' => $name_product, 'price' => $price]);
    }
    public function AddIngredients(Request $request){
        $ingredients = new Ingredients();
        $insert = $ingredients->Insert($request->name, $request->weight, $request->unit, $request->price );
        return redirect('admin/nguyenlieu');
    }
    public function UpdateIngredients(Request $request){
        $ingredients = new Ingredients();
        $update = $ingredients->UpdateByID($request->id, $request->name, $request->weight, $request->unit, $request->price);
        return redirect('admin/nguyenlieu');
    }
    public function DisableIngredients(){
        $ingredients = new Ingredients();
        $delete = $ingredients->DisableByID($_REQUEST['id']);
        return redirect('admin/nguyenlieu');
    }
    public function ActiveIngredients(){
        $ingredients = new Ingredients();
        $delete = $ingredients->ActiveByID($_REQUEST['id']);
        return redirect('admin/nguyenlieu');
    }
    public function ProductIngredients(){
        $price = 0;
        $product = new Product();
        $name_product = $product->GetProductByID($_REQUEST['id']);
        $ingredients = new Ingredients();
        $allIngredients = $ingredients->GetAll();
        $listIngredients = $ingredients->GetIngredientByProduct($_REQUEST['id']);
            foreach($listIngredients as $b){
                $price += $b->dongia * $b->soluong;
            }
            $product_price = $price;
        return view('admin.product_ingredients',['allIngredients' => $allIngredients, 'listIngredients' => $listIngredients, 'name_product' => $name_product, 'price' => $price]);
    }
    public function AddProductIngredients(){
        $ingredients = new Ingredients();
        $check = $ingredients->CheckProductIngredients($_REQUEST['id'], $_REQUEST['idi']);
        if(!$check){
            $insert = $ingredients->InsertProductIngredients($_REQUEST['id'], $_REQUEST['idi']);
            return redirect("admin/nguyenlieusanpham?id=".$_REQUEST['id']);
        }
        \Jeybin\Toastr\Toastr::error('Nguyên liệu đã có trong sản phẩm')->timeOut(3000)
        ->toast();
        return redirect("admin/nguyenlieusanpham?id=".$_REQUEST['id']);
    }
    public function DeleteProductIngredients(){
        $ingredients = new Ingredients();
        $delete = $ingredients->DeleteProductIngredients($_REQUEST['id'], $_REQUEST['idi']);
        return redirect("admin/nguyenlieusanpham?id=".$_REQUEST['id']);
    }
    public function UpdateProductIngredients(){
        if($_REQUEST['quality'] < 1){
            return redirect("admin/nguyenlieusanpham?id=".$_REQUEST['id']);
        }
        $ingredients = new Ingredients();
        $update = $ingredients->UpdateQuantity($_REQUEST['id'], $_REQUEST['idi'], $_REQUEST['quality']);
        return redirect("admin/nguyenlieusanpham?id=".$_REQUEST['id']);
    }
}
