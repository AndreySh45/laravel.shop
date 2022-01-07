<?php


namespace App\ViewComposers;

use App\Models\Category;
use Illuminate\View\View;

class CategoriesComposer
{
    public function compose(View $view)
    {
        $categories = Category::orderBy('id')->get();
        $view->with('categories', $categories);
    }
}
