<div>
   @foreach ($listSurat as $surat)
   
   <div>
        <p>{{ $surat->tipe}}</p>
        <p>{{ $surat->tanggal_mulai}}</p>
        <p>{{ $surat->tanggal_selesai}}</p>
        <p>{{ $surat->approved ? 'Approved' : 'Not Approved' }}
         <img src="{{ asset('storage/' . $surat->ttd) }}" alt="TTD" style="max-width:200px;">
        </p>
        <a href="/surat/edit/{{ $surat->id }}">Edit</a>
        <form action="/surat/delete/{{$surat->id}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this surat?');">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
         </form>
   </div>

       
   @endforeach
</div>
