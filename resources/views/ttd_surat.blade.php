<div>
   <div>
   <p>{{ $surat->nis }}</p>
    <p>{{ $surat->nisn }}</p>
    <p>{{ $surat->nama }}</p>
    <p>{{ $surat->tipe }}</p>
    <p>{{ $surat->alasan }}</p>
    <p>{{ $surat->tanggal_mulai }}</p>
    <p>{{ $surat->tanggal_selesai }}</p>
    <form action="/surat_ttd/{{ $surat->id }}" method="POST">
        @csrf
        @method('PUT')

        <canvas id="ttd-pad" style="border:1px solid #ccc;"></canvas>
        <input type="hidden" name="ttd_data" id="ttd_data">

    <button type="submit">Submit</button>
</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script>
    var canvas = document.getElementById('ttd-pad');
    var signaturePad = new SignaturePad(canvas);

    document.querySelector('form').addEventListener('submit', function (e) {
        var dataURL = signaturePad.toDataURL(); // menghasilkan base64
        document.getElementById('ttd_data').value = dataURL;
    });
</script>
  