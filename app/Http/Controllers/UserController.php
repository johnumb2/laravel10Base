<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use App\Models\UserPermission;
use App\Services\EmailService;
use App\Services\PermissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UserController extends Controller
{
    public function showSignupForm(): View
    {
        return view('auth.signup');
    }

    public function handleSignup(Request $request): View
    {
        // Validate input data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',  // Ensure the email is unique
            'password' => 'required|min:8|confirmed',
        ]);

        // Hash the password
        $hashedPassword = bcrypt($validatedData['password']);

        // Generate a 10 character random string, hash it and store in User model
        $hashcode = base64_encode(Str::random(10));

        // Create a new user in your database
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $hashedPassword,
            'hashcode' => $hashcode
        ]);

        // Usage in handleSignup method
        $service = new EmailService();
        $service->sendVerificationEmail($validatedData['email'], $hashcode);

        return view('user.signup_success');
    }


    /**
     * Display a listing of all users.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $users = User::paginate(10);

        return view('user.users', ['users' => $users]);
    }


    /**
     * Show the form for editing the specified user.
     *
     * @param int $id
     * @return View
     */
    public function edit($id): View
    {
        // Check if authenticated user has 'admin' permission
        $permissionService = new PermissionService();
        if (!$permissionService->hasPermission('User Management')) {
            return view('error', ['message' => 'You do not have the necessary permissions to edit user.']);
        }

        // Find the user record
        $editUser = User::find($id);
        if (!$editUser) {
            return view('error', ['message' => 'User not found.']);
        }

        // Get all the permissions
        $permissions = Permission::all();

        return view('user.edit_user', ['user' => $editUser, 'permissions' => $permissions]);
    }


    /**
     * Update the specified user in storage.
     *
     * @param Request $request
     * @param $id
     * @return View
     */
    public function update(Request $request, $id)
    {
        // Check if authenticated user has 'admin' permission
        $permissionService = new PermissionService();
        if (!$permissionService->hasPermission('User Management')) {
            return view('error', ['message' => 'You do not have the necessary permissions to edit user.']);
        }

        // Find the user record
        $editUser = User::find($id);
        if (!$editUser) {
            return view('error', ['message' => 'User not found.']);
        }

        // Validate input data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $editUser->id,
            'permissions' => 'required|array',
            'permissions-*' => 'exists:permissions,id',
        ]);

        // Update the user record
        $editUser->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email']
        ]);

        // Update permissions
        $editUser->permissions()->delete(); // remove old permissions
        foreach ($validatedData['permissions'] as $permission) {
            UserPermission::create(['user_id' => $editUser->id, 'permission_id' => $permission]);
        }

        return redirect()->route('users');
    }


    /**
     * Remove the specified user from the database.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $permissionService = new PermissionService();
        // Check if authenticated user has 'admin' permission
        if (!$permissionService->hasPermission('User Management')) {
            return view('error', ['message' => 'You do not have the necessary permissions to delete user.']);
        }

        // Get the user
        $user = User::find($id);

        if ($user) {
            // Delete the User
            $user->delete();
        } else {
            return view('error', ['message' => 'User not found.']);
        }

        return redirect()->route('users')->with('message', 'User has been deleted.');
    }
}
