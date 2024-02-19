<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Catalog\Product;

class Category extends Model
{
    use HasFactory;
     /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'categories';
   /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'title',
        'display_type', // 0 = products and content, 1 = product, 2 = content
        'slug',
        'description',
        'banner',
        'meta_title',
        'meta_description',
        'meta_image',
        'parent_id',
        'sort_order'
    ];


    /**
     * The products that belong to the category.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class,'category_products', 'category_id', 'product_id');
    }
}
