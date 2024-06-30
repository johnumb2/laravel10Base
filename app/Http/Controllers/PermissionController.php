<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PermissionController extends Controller
{
    /**
     * Display the permission form.
     *
     * @return view
     */
    public function showPermissionForm(): view
    {
        // Replace 'form' with the actual view name for your form.
        return view('permissions.permission');
    }


    /**
     * Display a listing of the permissions.
     *
     * @return view
     */
    public function index(): view
    {
        $permissions = Permission::paginate(10);

        // Replace 'permissions.index' with the actual view name for your permissions listing.
        return view('permissions.permissions', ['permissions' => $permissions]);
    }


    /**
     * Store a newly created permission in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function create(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
            'description' => 'nullable',
        ]);

        $permission = Permission::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // redirect to index page.
        return redirect()->route('permissions');
    }
}
