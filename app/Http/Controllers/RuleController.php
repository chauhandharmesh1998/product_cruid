<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Rule;

class RuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rules = Rule::latest()->get();
        return view('rules.index', compact('rules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rule_name' => 'required',
            'apply_tags' => 'required',
            'conditions' => 'required|array|min:1'
        ]);

        $rule = Rule::create([
            'rule_name' => $request->rule_name,
            'apply_tags' => $request->apply_tags,
        ]);

        foreach ($request->conditions as $condition) {
            $rule->conditions()->create($condition);
        }

        return redirect()->route('rule.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function applyRule($id)
    {
        $rule = Rule::with('conditions')->findOrFail($id);
        $products = Product::all();
        foreach ($products as $product) {
            if ($this->matchConditions($product, $rule->conditions)) {
                $product->tags = $this->mergeTags(
                    $product->tags,
                    $rule->apply_tags
                );
                $product->save();
            }
        }
        return back();
    }
    private function matchConditions($product, $conditions)
    {
        foreach ($conditions as $condition) {
            $productValue = $product->{$condition->field};
            $conditionValue = $condition->value;

            switch ($condition->operator) {
                case '==':
                    if ($productValue != $conditionValue) return false;
                    break;

                case '>':
                    if ($productValue <= $conditionValue) return false;
                    break;

                case '<':
                    if ($productValue >= $conditionValue) return false;
                    break;
            }
        }
        return true;
    }
    private function mergeTags($old, $new)
    {
        $oldTags = $old ? explode(',', $old) : [];
        $newTags = explode(',', $new);

        return implode(',', array_unique(array_merge($oldTags, $newTags)));
    }
}
