<?php

namespace App\Http\Controllers\Route;

use App\Http\Controllers\Controller;
use App\Models\RouteModel;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index() {
        $routes = RouteModel::all();
        return view('routes.index', compact('routes'));
    }

    public function create() {
        return view('routes.create');
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required|string|max:255']);
        RouteModel::create($request->only('name'));
        return redirect()->route('routes.index')->with('success', 'Route created.');
    }

    public function edit(RouteModel $route) {
        return view('routes.edit', compact('route'));
    }

    public function update(Request $request, RouteModel $route) {
        $request->validate(['name' => 'required|string|max:255']);
        $route->update($request->only('name'));
        return redirect()->route('routes.index')->with('success', 'Route updated.');
    }
}