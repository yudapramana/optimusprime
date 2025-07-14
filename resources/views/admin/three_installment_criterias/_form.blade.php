@php
    $type = $criteria->type ?? old('type');
    $percentage = $criteria->percentage ?? old('percentage');
@endphp

<div class="form-group">
    <label for="type">Jenis Termin</label>
    <select name="type" class="form-control" required>
        <option value="">-- Pilih Jenis --</option>
        <option value="start_date" {{ $type == 'start_date' ? 'selected' : '' }}>Start Date</option>
        <option value="mid_date" {{ $type == 'mid_date' ? 'selected' : '' }}>Mid Date</option>
        <option value="end_date" {{ $type == 'end_date' ? 'selected' : '' }}>End Date</option>
    </select>
</div>

<div class="form-group">
    <label for="percentage">Persentase (%)</label>
    <input type="number" name="percentage" class="form-control" value="{{ $percentage }}" min="1" max="100" required>
</div>
