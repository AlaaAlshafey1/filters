<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('sort_order')->get();
        return view('faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('faqs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question_ar' => 'required|string',
            'question_en' => 'nullable|string',
            'answer_ar'   => 'nullable|string',
            'answer_en'   => 'nullable|string',
        ]);

        Faq::create($request->all());

        return redirect()->route('faqs.index')->with('success','تمت الإضافة');
    }

    public function edit(Faq $faq)
    {
        return view('faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question_ar' => 'required|string',
            'question_en' => 'nullable|string',
            'answer_ar'   => 'nullable|string',
            'answer_en'   => 'nullable|string',
        ]);

        $faq->update($request->all());

        return redirect()->route('faqs.index')->with('success','تم التعديل');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return back()->with('success','تم الحذف');
    }
}
