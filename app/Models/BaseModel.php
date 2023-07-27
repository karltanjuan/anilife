<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasFactory;

    protected function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucwords(strtolower($value));
    }

    protected function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucwords(strtolower($value));
    }

    protected function setMiddleNameAttribute($value)
    {
        $this->attributes['middle_name'] = ucwords(strtolower($value));
    }

    protected function setSuffixAttribute($value)
    {
        $this->attributes['suffix'] = ucwords(strtolower($value));
    }

    protected function setHouseNumberAttribute($value)
    {
        $this->attributes['house_no'] = ucwords(strtolower($value));
    }
}
