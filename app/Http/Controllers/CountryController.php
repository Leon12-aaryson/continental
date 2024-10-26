<?php



// app/Http/Controllers/CountryController.php
namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    // public function index()
    // {
    //     // Fetch countries with their states and cities
    //     $countries = Country::with(['states', 'cities'])->get();
    //     return response()->json($countries);
    // }

    public function index()
    {

        return Country::all();
    }



    public function show($id)
    {
        dd($id);
        return Country::findOrFail($id);
    }

    public function store(Request $request)

    {
        $request->validate([
            'name' => 'required|string',
        ]);

        return Country::create($request->all());

    }

    public function update(Request $request, $id)
    {
        $country = Country::findOrFail($id);
        $country->update($request->all());
        return $country;
    }

    public function destroy($id)
    {
        Country::destroy($id);
        return response()->noContent();
    }
}
