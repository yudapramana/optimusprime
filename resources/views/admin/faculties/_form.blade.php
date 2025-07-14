@php
    $isEdit = isset($faculty);
@endphp

<div class="form-group">
    <label for="name">Nama Fakultas</label>
    <input type="text" name="name" class="form-control" value="{{ $isEdit ? $faculty->name : old('name') }}" placeholder="Contoh: Fakultas Ekonomi">
</div>

<div class="form-group">
    <label for="code">Kode Fakultas</label>
    <input type="text" name="code" class="form-control" value="{{ $isEdit ? $faculty->code : old('code') }}" placeholder="Contoh: FEK">
</div>

<div class="form-group">
    <label for="tuition_fee">Biaya Kuliah</label>
    <input type="number" step="0.01" name="tuition_fee" class="form-control" value="{{ $isEdit ? $faculty->tuition_fee : old('tuition_fee') }}" placeholder="Contoh: 3500000">
</div>

<div class="form-group">
    <label for="status">Status</label>
    <select name="status" class="form-control">
        <option value="1" {{ $isEdit && $faculty->status ? 'selected' : '' }}>Aktif</option>
        <option value="0" {{ $isEdit && !$faculty->status ? 'selected' : '' }}>Nonaktif</option>
    </select>
</div>
