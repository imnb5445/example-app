<div>
    @auth
        <p>you are login</p>
    @endauth
    <form action="/siswa_register" method="POST">
        @csrf
        <label for="name">Name</label>
        <input name="name" type="text">
        <label for="password">Password</label>
        <input name="password" type="text">
        <label for="email">Emaik</label>
        <input name="email" type="email">
        <label for="nis">Nis</label>
        <input name="nis" type="text">
        <label for="nisn">Nisn</label>
        <input name="nisn" type="text">
        <label for="nama_lengkap">nama_lengkap</label>
        <input name="nama_lengkap" type="text">
        <label for="kelas">Kelas</label>
        <input name="kelas" type="text">
        <label for="no_ortu">No Orangtua</label>
        <input name="no_ortu" type="text">
        <input type="submit">
    </form>
</div>


