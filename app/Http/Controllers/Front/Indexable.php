<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;


trait Indexable
{
    /**
     * The PostRepository instance.
     *
     * @var \App\Repositories\PostRepository
     */
    protected $repository;

    /**
     * The table.
     *
     * @var string
     */
    protected $table;

    /**
     * Display a listing of the records.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $parameters = $this->getParameters ($request);
        // Get records and generate links for pagination
        $records = $this->repository->getAll (config ("app.nbrPages.front.$this->table"), $parameters);
        $links = $records->appends($parameters)->links ('front.pagination');

        //Ajax response
        if ($request->ajax ()) {
            return response ()->json ([
                'list' => view('front.partials.home-list', [$this->table => $records])->render(),
                'pagination' => $links->toHtml(),
                'type' => $parameters['type'],
            ]);
        }

        return view ('front.pages.home', [$this->table => $records, 'links' => $links,  'type' => $parameters['type']]);
    }

    /**
     * Get parameters.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function getParameters($request)
    {
        // Default parameters
        $parameters = config("parameters.$this->table");
        // Build parameters with request
        foreach ($parameters as $parameter => &$value) {
            if (isset($request->$parameter)) {
                $value = $request->$parameter;
            }
        }
        return $parameters;
    }
}