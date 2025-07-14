<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="formEdit" data-id="{{ $bank->id }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Bank</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="bank_name">Nama Bank</label>
                        <input type="text" name="bank_name" class="form-control" value="{{ $bank->bank_name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="account_name">Nama Pemilik Rekening</label>
                        <input type="text" name="account_name" class="form-control" value="{{ $bank->account_name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="account_number">Nomor Rekening</label>
                        <input type="text" name="account_number" class="form-control" value="{{ $bank->account_number }}" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
