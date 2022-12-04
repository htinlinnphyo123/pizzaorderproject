<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct category list page
    public function listPage(){

        $categories = Category::when(request('key'),function($query){
                                $query->where('name','LIKE','%'.request('key').'%');
                            })
                            ->orderBy('id','desc')
                            ->paginate(5);
        // dd($categories);
        $categories->appends(request()->all());
        return view('admin.category.list',compact('categories'));
    }

    //direct category create page
    public function createPage(){
        return view('admin.category.create');
    }

    //create category
    public function create(Request $request){
        // dd($request->toarray());
        $this->categoryValidationCheck($request);
        $data = $this->getCategoryData($request);

        $getcatename = Category::create($data)->name;
        // dd($getcatename);

        return redirect()->route('category#list')->with(['createSuccess'=>'Created Successfully','getcatename'=>$getcatename]);
    }

    //delete category
    public function delete($id){
        // var_dump($id);
        // $getdeleteCategory = Category::where('id',$id)->get()->toarray()[0]['name'];
        $getdeleteCategory = Category::where('id',$id)->first()->name;
        // dd($getdeleteCategory);
        Category::where('id',$id)->delete();

        return back()->with(['deleteSuccess' => 'Deleted Successfully','getdeleteCategory'=>$getdeleteCategory]);
    }

    //return to edit page
    public function edit($id){
        $getcategoryData = Category::where('id',$id)->first();
        return view('admin.category.edit',compact(['getcategoryData']));
    }

    //update data and return to list page
    public function update(Request $request){

        $this->categoryUpdateValidationCheck($request);

        $updateData = $this->getCategoryData($request);
        // dd($id,$request->id);
        // dd($updateData);


        Category::where('id',$request->categoryId)->update($updateData);
        return redirect()->route('category#list')->with(['updateSuccess'=>'Update successfully']);
    }




    //get categoryDate from request
    private function getCategoryData($request){
        return[
            'name'=>$request->categoryName,
        ];
    }

    //category validation
    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
            'categoryName' => 'required|unique:categories,name'
        ])->validate();
    }

    //update category validation
    private function categoryUpdateValidationCheck($request){
        Validator::make($request->all(),[

            'categoryName' => 'required|min:4|unique:categories,name,'.$request->categoryId

        ],[
            'categoryName.unique' => 'Category already taken'
        ])->validate();
    }






}
