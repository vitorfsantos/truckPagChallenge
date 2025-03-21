<?php

namespace App\Modules\Foods\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;

class FoodsUpdateRequest extends FormRequest
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
   * @return array<string, mixed>
   */
  public function rules()
  {
    return [
      'code'               => ['required', 'string'],
      'status'             => ['required', Rule::in(['draft', 'trash', 'published'])],
      'url'                => ['required', 'string'],
      'creator'            => ['required', 'string'],
      'created_t'          => ['required', 'integer'],
      'last_modified_t'    => ['required', 'integer'],
      'product_name'       => ['required', 'string'],
      'quantity'           => ['required', 'string'],
      'brands'             => ['required', 'string'],
      'categories'         => ['required', 'string'],
      'labels'             => ['required', 'string'],
      'cities'             => ['required', 'string'],
      'purchase_places'    => ['required', 'string'],
      'stores'             => ['required', 'string'],
      'ingredients_text'   => ['required', 'string'],
      'traces'             => ['required', 'string'],
      'serving_size'       => ['required', 'string'],
      'serving_quantity'   => ['nullable', 'numeric', 'between:0,99999999.99'],
      'nutriscore_score'   => ['nullable', 'integer'],
      'nutriscore_grade'   => ['required', 'string', 'size:1'],
      'main_category'      => ['required', 'string'],
      'image_url'          => ['required', 'string'],
    ];
  }

  // public function messages()
  // {
  //   return [
  //     "title.required" => "O campo title é obrigatório.",
  //     "title.string" => "O campo title deve ser do tipo string.",

  //     "phone_number.required" => "O campo phone_number é obrigatório.",
  //     "phone_number.string" => "O campo phone_number deve ser do tipo string.",
  //     "phone_number.regex" => "O campo phone_number deve conter um número válido.",

  //     "message.required" => "O campo message é obrigatório.",
  //     "message.string" => "O campo message deve ser do tipo string.",

  //     "start_time.required" => "O campo start_time é obrigatório.",
  //     "start_time.date_format" => "O campo start_time deve estar no formato HH:mm.",

  //     "end_time.required" => "O campo end_time é obrigatório.",
  //     "end_time.date_format" => "O campo end_time deve estar no formato HH:mm.",
  //     "end_time.after" => "O campo end_time deve ser posterior a start_time.",

  //     "weekend.required" => "O campo weekend é obrigatório.",
  //     "weekend.boolean" => "O campo weekend deve ser verdadeiro (true) ou falso (false).",

  //     "company.required" => "O campo company é obrigatório.",
  //     "company.array" => "O campo company deve ser um array.",
  //     "company.min" => "O campo company deve conter pelo menos um ULID.",
  //     "company.*.required" => "Cada item do campo company deve ser um ULID válido.",
  //     "company.*.ulid" => "Cada item do campo company deve ser um ULID válido.",
  //   ];
  // }

  protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
  {
    $response = new Response([
      'error'      => 'Invalid params',
      'code'       => 422,
      'validation' => $validator->errors()
    ], 422);

    throw new ValidationException($validator, $response);
  }
}
