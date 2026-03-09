<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * تحديد إذا كان المستخدم مخول لاستخدام هذا الطلب
     */
    public function authorize(): bool
    {
        return true; // غيّر هذا من false إلى true
    }

    /**
     * قواعد التحقق من صحة البيانات
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'wilaya_id' => 'required|exists:wilayas,id',
            'address' => 'required|string|max:500',
            'payment_method' => 'required|in:cash_on_delivery,ccp,baridi_mob'
        ];
    }

    /**
     * رسائل الخطأ المخصصة
     */
    public function messages(): array
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'phone.required' => 'رقم الهاتف مطلوب',
            'wilaya_id.required' => 'الولاية مطلوبة',
            'address.required' => 'العنوان مطلوب',
            'payment_method.required' => 'طريقة الدفع مطلوبة'
        ];
    }
}