<div>
    @foreach ($listSurat as $surat)
   <div>
        <p>{{ $surat->nama}}</p>
        <p>{{ $surat->tipe}}</p>
        <p>{{ $surat->tanggal_mulai}}</p>
        <p>{{ $surat->tanggal_selesai}}</p>
        <p>{{ $surat->approved ? 'Approved' : 'Not Approved' }}
        <a href="/admin/review_screen/{{ $surat->id }}">Review</a>


        </p>
   </div>
   @endforeach
   <form action="/admin_logout" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>
</div>
