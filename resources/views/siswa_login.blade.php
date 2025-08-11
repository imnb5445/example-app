<div>
    <form action="/siswa_login" method="POST">
        @csrf
        <label for="name">Name</label>
        <input name="name" type="text">
        <label for="password">Password</label>
        <input name="password" type="text">
        <input type="submit">
    </form>
</div>
