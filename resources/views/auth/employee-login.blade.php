<form method="POST" action="{{ route('employee.login') }}">
    @csrf
    <input type="email" name="email" placeholder="Employee Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login as Employee</button>
</form>
