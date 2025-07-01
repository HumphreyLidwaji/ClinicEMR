<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);
        Service::create($request->only('name', 'price'));
        return redirect()->route('services.index')->with('success', 'Service created.');
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);
        $service->update($request->only('name', 'price'));
        return redirect()->route('services.index')->with('success', 'Service updated.');
    }
}