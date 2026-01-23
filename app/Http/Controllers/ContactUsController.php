<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\ContactUsMessage;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    // عرض الرسائل
    public function index()
    {
        $messages = ContactUs::orderBy('created_at', 'desc')->get();
        return view('contact_us.index', compact('messages'));
    }

    // نموذج لإرسال رسالة من الواجهة العامة
    public function create()
    {
        return view('contact_us.create');
    }

    // تخزين رسالة جديدة
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        ContactUs::create($data);

        return redirect()->back()->with('success', 'تم إرسال رسالتك بنجاح');
    }

    // عرض رسالة واحدة (لتعليمها كمقروءة)
    public function show(ContactUs $contactUsMessage)
    {
        $contactUsMessage->update(['is_read' => true]);
        return view('contact_us.show', compact('contactUsMessage'));
    }

    // حذف رسالة
    public function destroy(ContactUs $contactUsMessage)
    {
        $contactUsMessage->delete();
        return back()->with('success', 'تم حذف الرسالة');
    }
}
