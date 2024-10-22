<?php

namespace App\Services;

use App\Helpers\FormatNumeric;
use App\Helpers\PrefixNumber;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Prepaid;
use App\Models\Type;
use Illuminate\Support\Str;

class PrepaidService
{
    public function getProductsByCategory($categoryName = 'Pulsa', $brandSlug = 'TELKOMSEL', $type = null)
    {
        return Prepaid::join('types', 'prepaids.type_id', '=', 'types.id')
            ->join('brands', 'types.brand_id', '=', 'brands.id')
            ->join('categories', 'brands.category_id', '=', 'categories.id')
            ->where('categories.slug', Str::slug($categoryName))
            ->where('brands.slug', Str::slug($brandSlug))
            ->when($type, function ($query) use ($type) {
                $query->where('types.slug', Str::slug($type));
            })
            ->orderBy('selling_price')
            ->get();
    }

    public function getProductsByPhonePrefix($categoryName, $phoneNumber, $type = null)
    {
        $no = FormatNumeric::filterNumber($phoneNumber);
        $brand = PrefixNumber::getPrefixByNumberPhone($no);

        return $this->getProductsByCategory($categoryName, $brand, $type);
    }

    public function getTypesByPhoneNumber(string $customerNo = '0')
    {
        $no = FormatNumeric::filterNumber($customerNo);
        $prefix = PrefixNumber::getPrefixByNumberPhone($no);

        $category = Category::where('name', 'Data')->first();

        $brand = Brand::where('category_id', $category->id)->where('slug', Str::slug($prefix))->first();

        if (!$brand) {
            return [];
        }

        $result = Type::select('slug', 'name')->where('brand_id', $brand->id)->get();

        return $result->isEmpty() ? [] : $result;
    }

    public function getBrandByCategory($categoryName)
    {
        $category = Category::where('name', $categoryName)->first();

        if(!$category) {
            return [];
        }

        $brands = Brand::select(['name','slug'])
            ->where('category_id', $category->id)
            ->orderBy('name')
            ->get();

        return $brands;
    }
}
