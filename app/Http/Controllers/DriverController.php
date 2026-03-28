<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use App\Models\City;
class DriverController extends Controller
{
    public function index()
    {
        $localCity = City::where('is_local', true)->first();

        if (!$localCity) {
            return redirect()->route('settings.index')
                ->with('error', 'الرجاء تحديد المدينة المحلية أولاً من صفحة الإعدادات');
        }

        $drivers = Driver::latest()->paginate(10);

        return view('drivers.index', compact('drivers'));
    }

    public function create()
    {
        return view('drivers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        Driver::create($request->all());

        return redirect()->route('drivers.index')
            ->with('success', 'تم إضافة السائق بنجاح');
    }

    public function edit(Driver $driver)
    {
        return view('drivers.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $driver->update($request->all());

        return redirect()->route('drivers.index')
            ->with('success', 'تم تحديث بيانات السائق بنجاح');
    }

    // public function destroy(Driver $driver)
    // {
    //     $driver->delete();

    //     return redirect()->route('drivers.index')
    //         ->with('success', 'تم حذف السائق بنجاح');
    // }
}
