<?php

namespace App\Services\Staffs;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class StaffServices
{
    public function getAll()
    {
        return User::select('id', 'name', 'email', 'auth_type', 'role', 'active')
            ->orderByDesc('id')
            ->paginate(5);
    }

    public function getStaff()
    {
        return User::select('id', 'name', 'email', 'role', 'active', 'avatar')
            ->where('role', '=', '1')
            ->orderByDesc('id')
            ->paginate(5);
    }

    public function create($request)
    {
        try {
            $user = User::create([
                'name' => (string) $request->input('name'),
                'email' => (string) $request->input('email'),
                'phone' => (string) $request->input('phone'),
                'password' => (string) Hash::make(12345678),
                'avatar' => (string) $request->input('image_path'),
                'active' => 1,
                'role' => 1
            ]);
            $user->assignRole('staff');
            notify()->success('Tạo thành công');
        } catch (\Exception $err) {
            notify()->error($err->getMessage());
            Log::info($err->getMessage());
            return false;
        }

        return true;
    }

    public function update($request, $id)
    {
        try {
            $staffModel = User::find($id);
            $staffModel->update([
                'name' => (string) $request->name,
                'email' => (string) $request->email,
                'role' => 1,
                'avatar' => (string) $request->input('image_path'),
            ]);
            notify()->success('Cập nhật thành công');
        } catch (\Exception $err) {
            notify()->error($err->getMessage());
            return false;
        }
    }

    public function findStaff($id)
    {
        return User::find($id);
    }
}
