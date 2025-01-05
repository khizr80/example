<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slugs',
        'CategoryID'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'CategoryID', 'id'); // Assuming 'CategoryID' is the foreign key in subcategories table and 'id' is the primary key in categories table.
    }
}
