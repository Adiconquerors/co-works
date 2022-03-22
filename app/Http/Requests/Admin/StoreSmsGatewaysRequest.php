<?php
namespace App\Http\Requests\Admin;

use App\SmsGateway;
use Illuminate\Foundation\Http\FormRequest;

class StoreSmsGatewaysRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return SmsGateway::storeValidation($this);
    }
}
