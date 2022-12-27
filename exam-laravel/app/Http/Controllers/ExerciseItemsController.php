<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExerciseItems;
use App\Models\ExerciseCategories;
use Illuminate\Support\Facades\Validator;

class ExerciseItemsController extends Controller
{
    public function index()
    {
        $items = ExerciseItems::all();
        $category = ExerciseCategories::get();
        return view('items.index', compact('items', 'category'));
    }

    public function create()
    {
        $category = ExerciseCategories::get();
        return view('items.create', compact('category'));
    }

    public function store(Request $request)
    {
        request()->validate([

            'category_id' => 'required',
            'question' => 'required',
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'answer' => 'required',
            'active' => 'required',
            'image'       => 'required|max:2048|mimes:jpg,jpeg,png',
        ]);

        $image = time() . '.' . $request->image->extension();
        $request->image->move(public_path('items'),$image);

        $items = ExerciseItems::create([
            
            'category_id' => $request->category_id,
            'question' => $request->question,
            'a' => $request->a,
            'b' => $request->b,
            'c' => $request->c,
            'd' => $request->d,
            'active' => $request->active,
            'answer' => $request->answer,
            'image'       => $image,
        ]);

        return redirect()->route('items.manage')->with('succes', "The Items <strong>{$request->name}</strong> created successfully");
    }

    public function destroy($id)
    {
        $items = ExerciseItems::find($id);
        $items->delete();
        return redirect()->route('items.manage')->with('success', "The Items <strong>{$items->name}</strong> deleted successfully");
    }

    public function edit($id)
    {
        if ($id == null) {
            return redirect()->route('items.manage')->with('error', 'The ID is empty!');
        } else {
            $category = ExerciseCategories::all();
            $items = ExerciseItems::find($id);

            if ($items) {
                return view('items.edit', compact('items', 'category'));
            } else {
                return redirect()->route('items.manage')->with('error', "The #ID {$id} not found in Database!");
            }
        }
    }

    public function update(Request $request, ExerciseItems $items, ExerciseCategories $category)
    {

        $category = ExerciseCategories::all();

        $rule = [
            'category_id' => 'required',
            'question' => 'required',
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'answer' => 'required',
            'active' => 'required',
            'image'       => 'required|max:2048|mimes:jpg,jpeg,png',
        ];

        $messages = [
            'category_id' => 'required',
            'question.required' => 'The field <strong>name</strong> is required!',
            'a.required' => 'The field <strong>name</strong> is required!',
            'b.required' => 'The field <strong>name</strong> is required!',
            'c.required' => 'The field <strong>name</strong> is required!',
            'd.required' => 'The field <strong>name</strong> is required!',
            'answer.required' => 'The field <strong>name</strong> is required!',
            'active.required' => 'The field <strong>name</strong> is required!',
            'image.required'       => 'The field <strong>name</strong> is required!',
        ];

        $validator = Validator::make($request->all(), $rule, $messages);

        if ($validator->fails()) {
            return redirect()->route('items.edit', $items->id)->withErrors($validator)->withInput();
        } else {
            $items->update($request->all());
            return redirect()->route('items.manage')
                             ->with('success', "The Items <strong>{$request->name}</strong> updated successfully");
        }


        // request()->validate([

        //     'category_id' => 'required',
        //     'question' => 'required',
        //     'a' => 'required',
        //     'b' => 'required',
        //     'c' => 'required',
        //     'd' => 'required',
        //     'answer' => 'required',
        //     'active' => 'required',
        //     'image'       => 'required|max:2048|mimes:jpg,jpeg,png',
        // ]);


        // $image = time() . '.' . $request->image->extension();
        // $request->image->move(public_path('items'),$image);

        // ExerciseItems::create([
        //     'category_id' => $request->category_id,
        //     'question' => $request->question,
        //     'a' => $request->a,
        //     'b' => $request->b,
        //     'c' => $request->c,
        //     'd' => $request->d,
        //     'active' => $request->active,
        //     'answer' => $request->answer,
        //     'image'       => $image,
        // ]);

        // return redirect()->route('items.manage')->with('succes', "The Category <strong>{$request->name}</strong> created successfully");
    }
}
