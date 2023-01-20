<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mockery\Matcher\Type;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','thumbnail','description','parent_id'];

    public function scopeSearch($query, $title)
    {
        return $query->where('title','LIKE',"%{$title}%");
        return $query->where('title', 'LIKE', "%($title)%");

    }
    public function scopeOnlyParent($query)
    {
        return $query->whereNull('parent_id');
    }
    public function parent()
    {
        return $this->belongsTo(self::class);
    }
    
    public function children()
    {
        return $this->hasMany(self::class,'parent_id');
    }
    
    public function descendants()
    {
        return $this->children()->with('descendants');
    }
}

// cái này thuộc local scope
// Lúc này bạn muốn sử dụng scope nào bạn chỉ cần gọi tên scope đó (bỏ chữ "scope" và bắt đầu bằng kí tự in thường).
// nhớ biến đặt trong title
//https://toidicode.com/query-scope-trong-eloquent-model-laravel-8-470.html