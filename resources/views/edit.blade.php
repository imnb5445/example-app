@php
    use Carbon\Carbon;
    $mulai   = $surat->tanggal_mulai ? Carbon::parse($surat->tanggal_mulai) : null;
    $selesai = $surat->tanggal_selesai ? Carbon::parse($surat->tanggal_selesai) : null;
    $prefillDurasi = ($mulai && $selesai) ? $mulai->diffInDays($selesai) : null;
    $readOnly = $surat->approved ?? false;
@endphp

<div>
    <form action="/surat/edit/{{ $surat->id }}" method="POST">
        @csrf
        @method('PUT')

        <label for="tipe">Tipe</label>
        <select name="tipe" id="type" {{ $readOnly ? 'disabled' : '' }}>
            <option value="sakit" {{ old('tipe', $surat->tipe) === 'sakit' ? 'selected' : '' }}>sakit</option>
            <option value="izin"  {{ old('tipe', $surat->tipe) === 'izin'  ? 'selected' : '' }}>izin</option>
        </select>

        <label for="alasan">Alasan</label>
        <textarea name="alasan" id="alasan" cols="30" rows="10" {{ $readOnly ? 'disabled' : '' }}>{{ old('alasan', $surat->alasan) }}</textarea>

        {{-- Durasi is for UI only, not saved (no name="durasi") --}}
        <label for="durasi">Durasi (hari)</label>
        <input
            type="number"
            id="durasi"
            min="1"
            max="30"
            value="{{ old('durasi', $prefillDurasi) }}"
            placeholder="Jumlah hari" 
             {{ $readOnly ? 'disabled' : '' }}/>

        <label for="tanggal_mulai">Tanggal Mulai</label>
        <input
            type="date"
            name="tanggal_mulai"
            id="tanggal_mulai"
            value="{{ old('tanggal_mulai', $surat->tanggal_mulai) }}" 
             {{ $readOnly ? 'disabled' : '' }}/>

        <label for="tanggal_selesai">Tanggal Selesai</label>
        <input
            type="date"
            name="tanggal_selesai"
            id="tanggal_selesai"
            value="{{ old('tanggal_selesai', $surat->tanggal_selesai) }}"
            readonly 
             {{ $readOnly ? 'disabled' : '' }}/>

        <input name="user_id" type="hidden" value="{{ $surat->user_id }}" />

        @if (!$readOnly)
            <input type="submit" value="Update Surat">
        @endif
    </form>
    @if ($readOnly && !$surat->ttd == null)
        <form action="/surat/download/{{ $surat->id }}" method="post">
            @csrf
             <button type="submit">Download</button>
            </form>
    @endif

    <a href="/siswa/dashboard">Kembali</a>
</div>

<script>
    const startDateInput = document.getElementById('tanggal_mulai');
    const durationInput  = document.getElementById('durasi');
    const endDateInput   = document.getElementById('tanggal_selesai');

    function calculateEndDate() {
        const start = startDateInput.value ? new Date(startDateInput.value) : null;
        const dur   = parseInt(durationInput.value, 10);

        if (start && !isNaN(start.getTime()) && Number.isInteger(dur) && dur > 0) {
            const end = new Date(start);
            end.setDate(end.getDate() + dur);
            const yyyy = end.getFullYear();
            const mm   = String(end.getMonth() + 1).padStart(2, '0');
            const dd   = String(end.getDate()).padStart(2, '0');
            endDateInput.value = `${yyyy}-${mm}-${dd}`;
        }
    }

    function fillDurationFromExistingDates() {
        if (startDateInput.value && endDateInput.value && !durationInput.value) {
            const sd = new Date(startDateInput.value);
            const ed = new Date(endDateInput.value);
            if (!isNaN(sd.getTime()) && !isNaN(ed.getTime())) {
                const msPerDay = 24 * 60 * 60 * 1000;
                const diff = Math.round((ed - sd) / msPerDay);
                if (diff >= 0) durationInput.value = diff;
            }
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        fillDurationFromExistingDates(); // prefill durasi on edit
        // if user changes durasi or start date, recompute end date
        calculateEndDate();
    });

    startDateInput.addEventListener('input', calculateEndDate);
    durationInput.addEventListener('input', calculateEndDate);
</script>
