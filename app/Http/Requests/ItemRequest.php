<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class ItemRequest extends FormRequest
{

    /**
     * Add parameters to be validated
     * 
     * @return array
     */
    public function all($keys = null)
    {
        $data = parent::all($keys);
        $data['id'] = $this->route('id');
        return $data;
    }

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
        //return [];
        switch ($this->method()) {
            case 'POST':{
                return [
                    'name'          => 'required|string|max:100',
                    'description'   => 'required|string|max:500',
                    'price'         => 'required|numeric|max:9999999999',
                    'image'         => 'required|mimes:jpeg,jpg,png,gif|max:10000'
                ];
            }
            case 'PUT':
            case 'PATCH':{
                return [
                    'id'            => 'required|exists:items,id',
                    'name'          => 'string|max:100',
                    'description'   => 'string',
                    'price'         => 'numeric|max:9999999999',
                    'image'         => 'mimes:jpeg,jpg,png,gif|max:10000'
                ];
            }
            case 'DELETE':{
                return [
                    'id'            => 'required|exists:items,id'
                ];
            }
        }
    }

    public function messages()
    {
        return [
            'id.exists'             => 'The record didn\'t exist',
            'name.required'         => 'The name is required.',
            'name.string'           => 'The name need to be text.',
            'name.max'              => "The name can't be longer than 100 characters.",
            'description.required'  => 'The description is required.',
            'description.string'    => 'The description need to be text.',
            'description.max'       => '',
            'price.required'        => 'The price is required.',
            'price.float'           => 'The price need to be numeric.',
            'price.max'             => '',
            'image.required'        => 'The image is required.',
            'image.mimes'           => 'Only accpeted format for the image: jpeg,jpg,png,gif.',
            'image.max'             => "The image can't weight more than 9MB"
        ];
    }

    public function response(array $errors)
    {
        return response()->json($errors, 422);
    }


    public function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(
            response()->json(['error' => $errors
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
