<?php

namespace App\Models\Property;

use Illuminate\Database\Eloquent\Model;
use App\Models\Property\Category;

class Project extends Model
{
    public function type()
    {
        return $this->belongsTo(Category::class, 'prop_type_id');
    }
}
