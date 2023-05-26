<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Lists;

class CheckListCompletion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $listId = $request->route('id');
        $list = Lists::find($listId);

        if ($list && $list->completed && $list->list_type === 'single') {
            return redirect()->route('home')->with('error', 'Deze vragenlijst is al voltooid.');
        }


        return $next($request);
    }
}
