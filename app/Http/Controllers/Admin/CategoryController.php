<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category as ModelsCategory;
use App\Models\Product;
use App\Models\Ingredients;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function Categorys(){
        $category = new ModelsCategory();
        $listCategory = $category->GetAll();
        // \Jeybin\Toastr\Toastr::error('Your error message here')->timeOut(3000)
        // ->toast();
        return view('admin.category')->with('listCategory',$listCategory);
    }
    public function AddCategory(Request $request){
        $category = new ModelsCategory();
        $insert = $category->Insert($request->name);
        return redirect('admin/loaisanpham');
    }
    public function UpdateCategory(Request $request){
        $category = new ModelsCategory();
        $update = $category->UpdateByID($request->id, $request->name);
        toastr()->success('Oops! Something went wrong!');
        return redirect('admin/loaisanpham');
    }
    public function DisableCategory(){
        $category = new ModelsCategory();
        $delete = $category->DisableByID($_REQUEST['id']);
        return redirect('admin/loaisanpham');
    }
    public function ActiveCategory(){
        $category = new ModelsCategory();
        $delete = $category->ActiveByID($_REQUEST['id']);
        return redirect('admin/loaisanpham');
    }
    public function GetProductByCategory(){
        $price = 0;
        $category = new ModelsCategory();
        $listCategory = $category->List();
        $product = new Product();
        $listProduct = $product->GetProductByCategory($_REQUEST['id']);
        $ingredients = new Ingredients(); 
        $listIngredients = null;
        $listPrice = null;
        foreach($listProduct as $a){
            $listIngredients[$a->masanpham] = $ingredients->GetIngredientByProduct($a->masanpham);
            foreach($listIngredients[$a->masanpham] as $b){
                $price += $b->dongia*$b->soluong;
            }
            $listPrice[$a->masanpham] = $price;
            $price = 0;
        }
        return view('user.category',['listProduct' => $listProduct, 'listCategory' => $listCategory, 'listIngredients' => $listIngredients, 'listPrice' => $listPrice]);
    }
}
