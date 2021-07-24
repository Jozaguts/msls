<?php

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

if (! function_exists('paginator')) {
    function paginator(collection $array, $request): Paginator
    {
        $total=count($array);
        $per_page = 15;
        $current_page = $request->input("page") ?? 1;

        $starting_point = ($current_page * $per_page) - $per_page;
        $array = $array->toArray();
        $array = array_slice($array, $starting_point, $per_page, true);

        return new Paginator($array, $total, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
    }
}
