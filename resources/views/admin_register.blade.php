<div>
   <div>
    <form action="/admin_register" method="POST">
        @csrf
        <label for="name">Name</label>
        <input name="name" type="text">
        <label for="password">Password</label>
        <input name="password" type="text">
        <label for="email">Email</label>
        <input name="email" type="text">
        <input type="submit">
    </form>
</div>
</div>
