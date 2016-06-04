<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'hash_id',
        'name',
        'original_name',
        'path',
        'type',
        'size',
        'md5'
    ];

    public function getThumbnailPathAttribute()
    {
        return str_replace($this->getAttribute('name'), 'thumbnails_' . $this->getAttribute('name'), $this->getAttribute('path'));
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|max:500',
            'code' => 'required|unique:products|max:500',
            'description' => 'required'
        ];

        $nbr = count($this->input('image')) - 1;
        foreach (range(0, $nbr) as $index) {
            $rules['image.' . $index] = 'image|max:4000';
        }

        return $rules;
    }
}