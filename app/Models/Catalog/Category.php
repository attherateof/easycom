<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'anchor',
        'meta_title',
        'meta_description',
        'meta_image',
        'parent_id',
        'sort_order'
    ];

    /**
     * Determine if the user is an administrator.
     *
     * @param $value
     * @return string|null
     */
    protected function getBannerAttribute($value): ?string
    {
        return ($value) ? asset($value) : null;
    }

    /**
     * Determine if the user is an administrator.
     *
     * @param $value
     * @return string|null
     */
    protected function getMetaImageAttribute($value): ?string
    {
        return ($value) ? asset($value) : null;
    }

    /**
     * The products that belong to the category.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'category_products',
            'category_id',
            'product_id'
        );
    }
}
