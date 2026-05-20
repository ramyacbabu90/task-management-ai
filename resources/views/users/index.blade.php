@extends('layouts.app')

@section('page-title', 'Users')

@section('content')

<div class="bg-white text-black rounded-3xl p-8 shadow-2xl">

    <div class="flex justify-between items-center mb-8">

        <h2 class="text-3xl font-bold">
            Users List
        </h2>

        <div class="text-gray-500">
            Total Users: {{ $users->total() }}
        </div>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead>

                <tr class="border-b text-left">

                    <th class="pb-4">Name</th>
                    <th class="pb-4">Email</th>
                    <th class="pb-4">Role</th>
                    <th class="pb-4">Tasks</th>
                    <th class="pb-4">Joined</th>

                </tr>

            </thead>

            <tbody>

                @forelse($users as $user)

                    <tr class="border-b">

                        <td class="py-5 font-semibold">

                            {{ $user->name }}

                        </td>

                        <td class="py-5 text-gray-600">

                            {{ $user->email }}

                        </td>

                        <td class="py-5">

                            <span class="
                                px-4 py-2 rounded-full text-sm font-semibold text-white

                                @if($user->role->value === 'admin')
                                    bg-blue-500
                                @else
                                    bg-gray-500
                                @endif
                            ">

                                {{ ucfirst($user->role->value) }}

                            </span>

                        </td>

                        <td class="py-5">

                            {{ $user->tasks_count }}

                        </td>

                        <td class="py-5 text-gray-500">

                            {{ $user->created_at->format('Y-m-d') }}

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5"
                            class="py-10 text-center text-gray-500">

                            No users found

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-6">

        {{ $users->links() }}

    </div>

</div>

@endsection