<div>
    <form action="/siswa_login" method="POST">
        @csrf
        <label for="nisn">Nisn</label>
        <input name="nisn" type="text">
        <label for="nis">Nis</label>
        <input name="nis" type="text">
        <input type="submit">
    </form>
</div>
