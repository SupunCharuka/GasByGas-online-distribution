@extends('backend.layouts.master')
@section('title', 'Role')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/select2.css') }}">
@endsection
@section('breadcrumb-title', 'Manage Role')

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('admin.role') }}">Manage Role</a></li>
    <li class="breadcrumb-item active">Update Role</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div>
            <div class="row">
                <div class="max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
                    <div>
                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        <div class="card shadow md:grid md:grid-cols-3 md:gap-1">
                            <div class="card-header px-4 py-4 md:col-span-1 flex justify-between">
                                <h5 class="text-xl font-bold text-gray-900"> {{ __('Update Role') }}</h5>
                            </div>
                            <div class="md:mt-0 md:col-span-2">
                                <form action="{{ route('admin.role.update', [$role->id]) }}" enctype="multipart/form-data"
                                    method="post">
                                    @csrf
                                    <div class="px-4 py-4 bg-white sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-4">
                                                <x-label for="name" value="{{ __('Role Name') }}" />
                                                <x-input name="name" id="role-name" type="text"
                                                    class="mt-1 block w-full" value="{{ old('title', $role->name) }}" />
                                            </div>

                                            <div class="col-span-6 sm:col-span-4">
                                                <label class="block font-medium text-sm form-label" for="permissions">
                                                    Permissions
                                                </label>

                                                <select class="single-select-placeholder js-states select2-hidden-accessible select2 form-control" id="permissions"
                                                    name="permissions[]" multiple="multiple">
                                                    @foreach ($permissions as $id => $permission)
                                                        <option value="{{ $id }}"
                                                            {{ in_array($id, old('permissions', []), true) || $role->permissions->contains($id) ? 'selected' : '' }}>
                                                            {{ $permission }}</option>
                                                    @endforeach
                                                </select>


                                            </div>

                                        </div>
                                    </div>
                                    <div
                                        class="flex items-center justify-end px-4 py-3 text-right sm:px-6  sm:rounded-bl-md sm:rounded-br-md">
                                        <x-button>
                                            {{ __('Submit') }}
                                        </x-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('assets/backend/js/select2/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#permissions').select2();
        });
    </script>
@endsection
