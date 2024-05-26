<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Course extends Model
{
    protected $fillable = ['title', 'description'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments');
    }

    public static function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
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

