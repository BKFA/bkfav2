<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Tag;

class TagComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('tags', Tag::all());
    }
}
