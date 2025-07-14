@php
    $facultyOptions = \App\Models\Faculty::pluck('name', 'id');
@endphp

@if ($type == 'edit')
    <input type="hidden" name="user_id" value="{{ $student->user_id }}">
@endif

<div class="form-group">
    <label for="name">Nama</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $student->user->name ?? '') }}">
</div>

<div class="form-group">
    <label for="nim">NIM</label>
    <input type="text" name="nim" class="form-control" value="{{ old('nim', $student->nim ?? '') }}">
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $student->email ?? '') }}">
</div>

<div class="form-group">
    <label for="faculty_id">Fakultas</label>
    <select name="faculty_id" class="form-control">
        <option value="">Pilih Fakultas</option>
        @foreach ($facultyOptions as $id => $name)
            <option value="{{ $id }}" @selected(old('faculty_id', $student->faculty_id ?? '') == $id)>
                {{ $name }}
            </option>
        @endforeach
    </select>
</div>
