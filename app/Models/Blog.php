<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slugs', 'content', 'image', 'SubCategoryId', 'UserId'
    ];
    
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'SubCategoryId');
    }

    public function getCategoryTitle()
    {
        $subid=$this->SubCategoryId;
        $sub=Subcategory::find($subid);
        $catid=$sub->CategoryID;
        $cat=Category::find($catid);
        return $cat->title;
        
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'UserId');
    }
}
