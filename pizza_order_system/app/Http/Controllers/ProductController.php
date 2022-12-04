<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    protected $fillable = ['product'];

    //direct list product page
    public function listPage(){
        $products = Product::when(request('key'),function($query){
                            $query->where('products.name','Like','%'.request('key').'%');
                        })
                        ->select('products.*','categories.name as category_name')
                        ->leftJoin('categories','products.category_id','categories.id')
                        ->paginate(3);
        $products->appends(request()->all());
        return view('admin.product.pizzalist',compact(['products']));
    }

    //create page product
    public function createPage(){
        $category = Category::select('id','name')->get();
        return view('admin.product.create',compact(['category']));
    }

    //create page
    public function create(Request $request){
        $this->validatePizza($request,'create');
        // dd($request->all());
        $data = $this->createPizza($request);
        if($request->hasFile('pizzaImage')){
            $fileName = uniqid().$request->pizzaImage->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        Product::create($data);
        return redirect()->route('product#list')->with(['createPizzaSuccess'=>'Created Pizza Successfully']);
    }

    ///delete pizza
    public function delete($id){
        Product::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Successfully Delete your product']);
    }

    //detail pizza
    public function detail($id){
        $product = Product::select('products.*','categories.name as category_name')
                        ->leftJoin('categories','products.category_id','categories.id')
                        ->where('products.id',$id)->first();
        return view('admin.product.detail',compact(['product']));
    }

    //edit page direct
    public function editPage($id){
        $product = Product::where('id',$id)->first();
        $category = Category::select('id','name')->get();
        // dd($product->image);
        return view('admin.product.edit',compact(['product','category']));
    }

    //update pizza
    public function update(Request $request){
        $this->validatePizza($request,'update');
        // dd($request->toarray());
        $data = $this->createPizza($request);
        $id = $request->id;

        if($request->hasFile('pizzaImage')){
            $oldName = Product::where('id',$id)->first();
            $oldName = $oldName->image;
            Storage::delete('public/'.$oldName);

            $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
            $request->pizzaImage->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        Product::where('id',$id)->update($data);
        return redirect()->route('product#list')->with(['updatePizzaSuccess'=>'Updated Your Pizza Successfully']);
    }



    //get create pizza data
    private function createPizza($request){
        return [
            'name' => $request->pizzaName,
            'description' => $request->pizzaDescription,
            'price'=>$request->pizzaPrice,
            'category_id'=>$request->categoryName,
            'waiting_time'=>$request->waitingTime
        ];
    }

    //validation for create pizza
    private function validatePizza($request,$status){

        $validationRules = [
            'pizzaName' => 'required|min:3|max:30|unique:products,name,'.$request->id,
            'pizzaDescription' => 'required|min:10',
            'pizzaPrice'=> 'required|integer|min:2000',
            'categoryName' => 'required',
            'waitingTime' => 'required'
        ];

        $validationRules['pizzaImage'] = $status == 'create' ? 'required|mimes:jpg,jpeg,png,webp|file' : 'mimes:jpg,jpeg,png,webp|file';

       Validator::make($request->all(),$validationRules)->validate();
    }


}
