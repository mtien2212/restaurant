<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Ingredients;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function AllProduct(){
        $price = 0;
        $product = new Product();
        $listProduct = $product->GetAll();
        $category = new Category();
        $listCategory = $category->GetAll();
        $ingredients = new Ingredients();
        foreach($listProduct as $a){
            $listIngredients[$a->masanpham] = $ingredients->GetIngredientByProduct($a->masanpham);
            foreach($listIngredients[$a->masanpham] as $b){
                $price += $b->dongia * $b->soluong;
            }
            $listPrice[$a->masanpham] = $price;
            $price = 0;
        }
        return view('admin.product',['listProduct' => $listProduct, 'listCategory' => $listCategory, 'listIngredients' => $listIngredients, 'listPrice' => $listPrice]);
    }
    public function DetailProduct(){
        $price = 0;
        $product = new Product();
        $detail = $product->GetProductByID($_REQUEST['id']);
        $ingredients = new Ingredients();
            $listIngredients = $ingredients->GetIngredientByProduct($_REQUEST['id']);
            foreach($listIngredients as $b){
                $price += $b->dongia * $b->soluong;
            }
            $product_price = $price;
        return view('user.product',['detail'=>$detail, 'listIngredients'=>$listIngredients, 'product_price'=>$product_price]);
    }
    public function SearchProduct(Request $request){
        $product = new Product();
        $listProduct = $product->GetProductByName($request->name);
        $category = new Category();
        $listCategory = $category->GetAll();
        return view('admin.product',['listProduct' => $listProduct, 'listCategory' => $listCategory]);
    }
    public function AddProduct(Request $request){
        $product = new Product();
        $image = $request->file('image');
        $storedPath = $image->move('image', $image->getClientOriginalName());
        $insert = $product->Insert($request->name, $image->getClientOriginalName(), $request->idCategory);
        return redirect('admin/sanpham');
    }
    public function UpdateProduct(Request $request){
        $product = new Product();
        if (!$request->hasFile('image')) {
            $update = $product->UpdateByIDNoPhoto($request->id, $request->name, $request->idCategory);
            return redirect('admin/sanpham');
        }
        $image = $request->file('image');
        $storedPath = $image->move('image', $image->getClientOriginalName());
        $update = $product->UpdateByID($request->id, $request->name, $image->getClientOriginalName(), $request->idCategory);
        return redirect('admin/sanpham');
    }
    public function DisableProduct(){
        $category = new Product();
        $delete = $category->DisableByID($_REQUEST['id']);
        return redirect('admin/sanpham');
    }
    public function ActiveProduct(){
        $category = new Product();
        $delete = $category->ActiveByID($_REQUEST['id']);
        return redirect('admin/sanpham');
    }
    public function BestSellerProduct(){
        $price = 0;
        $product = new Product();
        $listProduct = $product->HomeProduct();
        $category = new Category();
        $listCategory = $category->GetAll();
        $ingredients = new Ingredients();
        foreach($listProduct as $a){
            $listIngredients[$a->masanpham] = $ingredients->GetIngredientByProduct($a->masanpham);
            foreach($listIngredients[$a->masanpham] as $b){
                $price += $b->dongia * $b->soluong;
            }
            $listPrice[$a->masanpham] = $price;
            $price = 0;
        }
        return view('user.home',['listProduct' => $listProduct, 'listCategory' => $listCategory, 'listIngredients' => $listIngredients, 'listPrice' => $listPrice]);
    }
}
