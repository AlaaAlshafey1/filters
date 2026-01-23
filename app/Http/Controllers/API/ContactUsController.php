<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
    // حفظ رسالة اتصل بنا
    public function store(Request $request)
    {
        // التحقق من البيانات
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $data['is_read'] = false; // كل الرسائل الجديدة غير مقروءة

        $contact = ContactUs::create($data);

        return response()->json([
            'success' => true,
            'message' => 'تم إرسال الرسالة بنجاح',
            'data'    => $contact
        ]);
    }
}
