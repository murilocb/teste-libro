<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Student extends Model
{
    protected $fillable = ['name', 'email', 'gender', 'date_of_birth'];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments');
    }

    public static function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'gender' => 'nullable|string|in:male,female',
            'date_of_birth' => 'required|date',
        ];
    }

    protected static function booted()
    {
        static::saving(function ($model) {
            $validator = Validator::make($model->attributesToArray(), static::rules());

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
        });
    }
}

