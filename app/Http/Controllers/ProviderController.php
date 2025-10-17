<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProviderController extends Controller
{
    use AuthorizesRequests;

    public function list()
    {
        $this->authorize('viewAny', Provider::class);
        $providers = Provider::paginate(10);
        return view('providers.list', ['providers' => $providers]);
    }

    public function createForm()
    {
        $this->authorize('create', Provider::class);
        return view('providers.create-form');
    }

    public function create(Request $request)
    {
        $this->authorize('create', Provider::class);
        $request->validate([
            'name' => 'required|string|unique:providers,name',
            'url' => 'nullable|url', 
        ]);
        Provider::create($request->all());
        return redirect()->route('providers.list')->with('status', 'Provider created successfully.');
    }

    public function updateForm(Provider $provider)
    {
        $this->authorize('update', $provider);
        return view('providers.update-form', ['provider' => $provider]);
    }

    public function update(Request $request, Provider $provider)
    {
        $this->authorize('update', $provider);
        $request->validate([
            'name' => 'required|string|unique:providers,name,' . $provider->id,
            'url' => 'nullable|url', 
        ]);
        $provider->update($request->all());
        return redirect()->route('providers.list')->with('status', 'Provider updated successfully.');
    }

    public function delete(Provider $provider)
    {
        $this->authorize('delete', $provider);
        $provider->delete();
        return redirect()->route('providers.list')->with('status', 'Provider deleted successfully.');
    }
}