<div>
    <p>{{ $surat->nis }}</p>
    <p>{{ $surat->nisn }}</p>
    <p>{{ $surat->nama }}</p>
    <p>{{ $surat->tipe }}</p>
    <p>{{ $surat->alasan }}</p>
    <p>{{ $surat->tanggal_mulai }}</p>
    <p>{{ $surat->tanggal_selesai }}</p>
    

   <form action="/admin/approved/{{ $surat->id }}" method="POST">
    @csrf
    @method('PUT')
    <button type="submit">Approved</button>
    </form>
</div>
