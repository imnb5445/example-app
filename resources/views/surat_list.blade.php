<div>
   @foreach ($listSurat as $surat)
   
   <div>
        <p>{{ $surat->tipe}}</p>
        <p>{{ $surat->tanggal_mulai}}</p>
        <p>{{ $surat->tanggal_selesai}}</p>
        <p>{{ $surat->approved ? 'Approved' : 'Not Approved' }}
        </p>
   </div>

       
   @endforeach
</div>
