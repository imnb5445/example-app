<div>
    <div>
    <p>{{ $surat->nis }}</p>
    <p>{{ $surat->nisn }}</p>
    <p>{{ $surat->nama }}</p>
    <p>{{ $surat->tipe }}</p>
    <p>{{ $surat->alasan }}</p>
    <p>{{ $surat->tanggal_mulai }}</p>
    <p>{{ $surat->tanggal_selesai }}</p>
      <img src="{{ public_path('storage/' . $surat->ttd) }}" alt="TTD" style="max-width:200px;">
    
    
</div>
</div>
