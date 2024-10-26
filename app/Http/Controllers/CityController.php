<?php
// app/Http/Controllers/CityController.php
namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        return City::with('state')->get();
    }

    public function show($id)
    {
        return City::with('state')->findOrFail($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'state_id' => 'required|exists:states,id',
        ]);

        return City::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $city = City::findOrFail($id);
        $city->update($request->all());
        return $city;
    }

    public function destroy($id)
    {
        City::destroy($id);
        return response()->noContent();
    }
}
