<div class="form-group">
    <label for="year">Tahun</label>
    <input type="number" name="year" class="form-control" value="{{ old('year', $semester->year ?? '') }}" required>
</div>

<div class="form-group">
    <label for="semester">Semester</label>
    <select name="semester" class="form-control" required>
        <option value="">-- Pilih Semester --</option>
        <option value="ganjil" {{ old('semester', $semester->semester ?? '') == 'ganjil' ? 'selected' : '' }}>Ganjil</option>
        <option value="genap" {{ old('semester', $semester->semester ?? '') == 'genap' ? 'selected' : '' }}>Genap</option>
    </select>
</div>

<div class="form-group">
    <label for="start_date">Tanggal Mulai</label>
    <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $semester->start_date ?? '') }}" required>
</div>

<div class="form-group">
    <label for="mid_date">Tanggal Tengah (Opsional)</label>
    <input type="date" name="mid_date" class="form-control" value="{{ old('mid_date', $semester->mid_date ?? '') }}">
</div>

<div class="form-group">
    <label for="end_date">Tanggal Akhir</label>
    <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $semester->end_date ?? '') }}" required>
</div>
