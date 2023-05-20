<?php

namespace App\Http\Controllers\User;

use Inertia\Inertia;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\User\UserService;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->userService = new UserService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->userService->getAll();
        return Inertia::render('User/Index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('User/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:' . User::class,
            'role' => 'required|string',
            'password' => 'required|string',
        ]);
        $validatedData['password'] = Hash::make($request->password);

        $store = $this->userService->create($validatedData);
        if (!$store) return redirect()->back();
        return redirect('/user');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $user = $this->userService->getFirst($slug, 'slug');
        return Inertia::render('User/Show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = $this->userService->getFirst($id);
        return Inertia::render('User/Edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:' . User::class . ',id,' . $id,
            'role' => 'required|string',
        ]);
        if ($request->password) {
            $validatedData['password'] = Hash::make($request->password);
        }

        $update = $this->userService->update($id, $validatedData);
        if (!$update) return redirect()->back();
        return Inertia::location('/user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = $this->userService->delete($id);
        if (!$delete) return redirect()->back();
        return Inertia::location('/user');
    }
}