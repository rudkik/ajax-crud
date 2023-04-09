@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Users</h1>
        <form id="addUserForm" class="mb-4">
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="First name" name="first_name" required>
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Last name" name="last_name" required>
                </div>
                <div class="col">
                    <input type="email" class="form-control" placeholder="Email" name="email" required>
                </div>
                <div class="col">
                    <input type="number" class="form-control" placeholder="Age" name="age" min="1" required>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">Add User</button>
                </div>
            </div>
        </form>
        <table class="table">
            <thead>
            <tr>
                <th scope="col"><a href="#" class="sort" data-sort-by="first_name">First Name</a></th>
                <th scope="col"><a href="#" class="sort" data-sort-by="last_name">Last Name</a></th>
                <th scope="col"><a href="#" class="sort" data-sort-by="email">Email</a></th>
                <th scope="col"><a href="#" class="sort" data-sort-by="age">Age</a></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody id="usersList"></tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script>
        let sortBy = null;
        let sortOrder = 'asc';

        function loadUsers() {
            const url = new URL('/users', window.location.href);
            if (sortBy) {
                url.searchParams.append('sortBy', sortBy);
                url.searchParams.append('sortOrder', sortOrder);
            }

            $.getJSON(url, function (data) {
                const usersList = $('#usersList');
                usersList.empty();

                data.forEach(function (user) {
                    usersList.append(
                        `<tr>
                            <td>${user.first_name}</td>
                            <td>${user.last_name}</td>
                            <td>${user.email}</td>
                            <td>${user.age}</td>
                            <td>
                                <button class="btn btn-danger btn-sm delete-user" data-user-id="${user.id}">Delete</button>
                            </td>
                        </tr>`
                    );
                });
            });
        }

        $('#addUserForm').submit(function (event) {
            event.preventDefault();

            const form = $(this);
            const formData = form.serialize();

            $.ajax({
                type: 'POST',
                url: '/users',
                data: formData,
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function () {
                    form.trigger('reset');
                    loadUsers();
                },
                error: function (xhr) {
                    alert(xhr.responseText);
                }
            });
        });

        $('body').on('click', '.delete-user', function () {
            const userId = $(this).data('user-id');

            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    type: 'DELETE',
                    url: '/users/' + userId,
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function () {
                        loadUsers();
                    },
                    error: function (xhr) {
                        alert(xhr.responseText);
                    }
                });
            }
        });



        $('.sort').click(function (event) {
        event.preventDefault();
        const sortByNew = $(this).data('sort-by');

        if (sortBy === sortByNew) {
            sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
        } else {
            sortBy = sortByNew;
            sortOrder = 'asc';
        }

        loadUsers();
        });

        loadUsers();
    </script>
@endsection
