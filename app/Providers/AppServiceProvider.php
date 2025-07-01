<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        Paginator::useTailwind();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    
public function handle($request, Closure $next)
{
    if (auth()->check() && auth()->user()->is_blocked) {
        Auth::logout();
        return redirect()->route('login')->withErrors(['email' => 'Your account has been blocked.']);
    }

    return $next($request);
}






}
