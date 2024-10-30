@extends('layout.app')
@section('title','Regester')
@section('header')
@endsection
@section('content')

<div class="container mt-5">
    <h2>New Account</h2>
    <form action="{{ route('register.create') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required>
        </div>

        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Re Password:</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re Password" required>
        </div>

        <div class="form-group">
            <label for="birth_date">Date Birthday:</label>
            <input type="date" class="form-control" id="birth_date" name="birth_date" required>
        </div>

        <div class="form-group">
            <label for="job">Job:</label>
            <input type="text" class="form-control" id="job" name="job" placeholder="job">
        </div>

        <div class="form-group">
            <label for="country">Country:</label>
            <input type="text" class="form-control" id="country" name="country" placeholder="Country" required>
        </div>

        <div class="form-group">
            <label for="state">State:</label>
            <input type="text" class="form-control" id="state" name="state" placeholder="State" required>
        </div>

        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
        </div>

        <div class="form-group">
            <label for="address1">Address 1:</label>
            <input type="text" class="form-control" id="address1" name="address1" placeholder="Address 1" required>
        </div>

        <div class="form-group">
            <label for="address2">Address 2:</label>
            <input type="text" class="form-control" id="address2" name="address2" placeholder="Address 2">
        </div>

        <div class="form-group">
            <label for="zip_code">Zip Code:</label>
            <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Zip Code" required>
        </div>

        <div class="form-group">
            <label for="phone_number">Phone:</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone" required>
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Join</button>
    </form>
</div>
@endsection
@section('script')

@endsection