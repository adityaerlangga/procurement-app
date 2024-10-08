@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="row">
            <div class="col-12">
                <div class="mx-4">
                    @if (session('success'))
                        <div class="alert alert-success text-white" role="alert">
                            <strong>Success!</strong> {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger text-white" role="alert">
                            <strong>Error!</strong> {{ session('error') }}
                        </div>
                    @endif
                </div>
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between align-items-center">
                            <!-- Section Title -->
                            <div>
                                <h5 class="mb-0">All Users</h5>
                            </div>

                            <!-- Search Form and New User Button -->
                            <div class="d-flex align-items-center">
                                <!-- New User Button -->
                                <a href="/users/create"
                                    class="btn btn-success ms-3 d-flex align-items-center justify-content-center"
                                    style="height: 42px;">
                                    <i class="fas fa-plus me-1"></i> New User
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive px-5 py-2">
                            <table id="users-table" class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Photo</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Name</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Email</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Role</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Creation Date</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="ps-4">
                                                <p class="text-xs font-weight-bold mb-0">{{ $i++ }}</p>
                                            </td>
                                            <td>
                                                <div>
                                                    <img src="https://is3.cloudhost.id/vhiweb/vhiweb/uploads/default.jpeg"
                                                        class="avatar avatar-sm me-3">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $user?->name }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $user?->email }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $user->getRoleNames()->first() }}</p>
                                            </td>
                                            <td class="text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $user->created_at }}</span>
                                            </td>
                                            <td class="text-center">
                                                <a href="/users/{{ $user->id }}/edit" class="mx-3"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                                    <i class="fas fa-user-edit text-secondary"></i>
                                                </a>
                                                <span>
                                                    <form action="/users/{{ $user->id }}" method="POST"
                                                        class="d-inline form-delete-user-{{ $user->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <i class="cursor-pointer fas fa-trash text-secondary btn-delete-user"
                                                            data-id="{{ $user->id }}"></i>
                                                    </form>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            console.log('ready');
            // Initialize DataTable
            $('#users-table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true
            });

            // Delegate the click event to dynamically created elements
            $(document).on('click', '.btn-delete-user', function() {
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('.form-delete-user-' + id).submit();
                    }
                });
            });

        });
    </script>
@endsection
