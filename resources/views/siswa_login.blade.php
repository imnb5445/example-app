<div>
    <form action="/login" method="POST">
        @csrf
        <label for="name">Name</label>
        <input name="name" type="text">
        <label for="password">Password</label>
        <input name="password" type="password">
        <input type="submit">
    </form>
</div>
