<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExerciseCategories;
use Illuminate\Support\Facades\Validator;

class ExerciseCategoriesController extends Controller
{
    public function index()
    {
        $category =  ExerciseCategories::all();
        return view('categories.index', compact('category'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $rule = [
            'name' => 'required',
            'slug' => 'required',
        ];

        $messages = [
            'name.required' => 'The field <strong>name</strong> is required!',
            'slug.required' => 'The field <strong>name</strong> is required!',
        ];

        $validator = Validator::make($request->all(), $rule, $messages);

        if ($validator->fails()) {
            return redirect()->route('categories.create')->withErrors($validator)->withInput();
        } else {
            ExerciseCategories::create($request->all());
            return redirect()->route('categories.manage')->with('succes', "The Category <strong>{$request->name}</strong> created successfully");
        }
    }

    public function edit($id)
    {
        if ($id == null) {
            return redirect()->route('categories.manage')->with('error', 'The ID is empty!');
        } else {
            $category = ExerciseCategories::find($id);

            if ($category) {
                return view('categories.edit', compact('category'));
            } else {
                return redirect()->route('categories.manage')->with('error', "The #ID {$id} not found in Database!");
            }
        }
    }

    public function update(Request $request, ExerciseCategories $category)
    {
        $rule = [
            'name' => 'required',
            'slug' => 'required',
        ];

        $messages = [
            'name.required' => 'The field <strong>name</strong> is required!',
            'slug.required' => 'The field <strong>name</strong> is required!',
        ];

        $validator = Validator::make($request->all(), $rule, $messages);

        if ($validator->fails()) {
            return redirect()->route('categories.edit', $category->id)->withErrors($validator)->withInput();
        } else {
            $category->update($request->all());
            return redirect()->route('categories.manage')
                             ->with('success', "The Category <strong>{$request->name}</strong> updated successfully");
        }

    }

    public function destroy($id)
    {
        $category = ExerciseCategories::find($id);
        $category->delete();
        return redirect()->route('categories.manage')->with('success', "The Category <strong>{$category->name}</strong> deleted successfully");
    }
}
