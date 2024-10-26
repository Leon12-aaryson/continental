<?php
// app/Http/Controllers/StateController.php
namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index()
    {
        return State::with('country')->get();
    }

    public function show($id)
    {
        return State::with('country')->findOrFail($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'country_id' => 'required|exists:countries,id',
        ]);

        return State::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $state = State::findOrFail($id);
        $state->update($request->all());
        return $state;
    }

    public function destroy($id)
    {
        State::destroy($id);
        return response()->noContent();
    }
}
