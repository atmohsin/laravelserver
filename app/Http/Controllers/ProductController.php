<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Resources\Product as ProductResource;

class ProductController extends Controller
{
  public function productlist(){
    return new ProductResource(Product::findAll());
  }

  public function show ($id)
  {
      return new ProductResource(Product::find($id));
  }
}
