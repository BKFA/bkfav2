<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Topic;

class MenuComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('topics', Topic::select('name_topic', 'slug_topic')->get());
    }
}
