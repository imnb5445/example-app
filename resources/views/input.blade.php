<div>
    <form action="/create_surat" method="POST">
        @csrf
        <label for="tipe">Tipe</label>
        <select name="tipe" id="type">
            <option value="" selected disabled>pilih tipe surat</option>
            <option value="sakit">sakit</option>
            <option value="izin">izin</option>
        </select>
        <label for="alasan">Alasan</label>
        <textarea name="alasan" id="alasan" cols="30" rows="10"></textarea>
        <label for="durasi">Durasi</label>
        <input type="number" name="durasi" id="durasi" min="1" max="30">
        <label for="tanggal_mulai">Tanggal Mulai</label>
        <input type="date" name="tanggal_mulai" id="tanggal_mulai">
        <label for="tanggal_selesai">Tanggal Selesai</label>
        <input type="date" name="tanggal_selesai" id="tanggal_selesai" readonly>
        <input type="submit">
    </form>
</div>

<script>
    const startDateInput = document.getElementById('tanggal_mulai');
    const durationInput = document.getElementById('durasi');
    const endDateInput = document.getElementById('tanggal_selesai');

    function calculateEndDate() {
        const startDate = new Date(startDateInput.value);
        const duration = parseInt(durationInput.value);

        if (!isNaN(startDate.getTime()) && duration > 0) {
            // Add duration days to start date
            const endDate = new Date(startDate);
            endDate.setDate(endDate.getDate() + duration);

            // Format as YYYY-MM-DD for input
            const yyyy = endDate.getFullYear();
            const mm = String(endDate.getMonth() + 1).padStart(2, '0');
            const dd = String(endDate.getDate()).padStart(2, '0');
            endDateInput.value = `${yyyy}-${mm}-${dd}`;
        } else {
            endDateInput.value = '';
        }
    }

    startDateInput.addEventListener('input', calculateEndDate);
    durationInput.addEventListener('input', calculateEndDate);
</script>
