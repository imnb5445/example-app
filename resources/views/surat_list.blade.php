<div>
   @foreach ($listSurat as $surat)
   
   <div>
        <p>{{ $surat->tipe}}</p>
        <p>{{ $surat->tanggal_mulai}}</p>
        <p>{{ $surat->tanggal_selesai}}</p>
        <p>{{ $surat->approved ? 'Approved' : 'Not Approved' }}</p>
        <a href="/surat/edit/{{ $surat->id }}">
         @if ($surat->approved)
           View
           @else
           Edit
         @endif
        </a>
        <form action="/surat/delete/{{$surat->id}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this surat?');">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
         </form>
   </div>

       
   @endforeach
</div>
