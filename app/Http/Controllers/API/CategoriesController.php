<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\GeneralTrait;

class CategoriesController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        $categories = Category::slctCategories()->get();
        return $this->returnData("categories", $categories);
    }

    public function getCatById(Request $request)
    {
        $category = Category::slctCategories()->where('id', '=', $request->id)->get();
        if(count($category) == 0){
            return $this->returnError("001", "no category");
        }
        return $this->returnData("category", $category);
    }

    public function changeCatState(Request $request)
    {
        $category = Category::slctCategories()->where('id', '=', $request->id)->update(["active"=>$request->active]);
        return $this->returnSuccessMessage("fine, changed!");
    }
}
