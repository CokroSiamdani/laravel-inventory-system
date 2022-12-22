<?php

namespace App\Imports;

use App\Product;
use App\Category;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $category = Category::where('name', $row['category'])->first();
        $buy_date = Carbon::parse($row['buy_date']);
        $expired_date = Carbon::parse($row['expired_date']);

        return new Product([
            'product_name' => $row['product_name'],
            'specification' => $row['specification'],
            'serial_number' => $row['serial_number'],
            'buy_date' => $buy_date,
            'expired_date' => $expired_date,
            'price' => $row['price'],
            'brand' => $row['brand'],
            'category_id' => $category->id
        ]);
    }
}
