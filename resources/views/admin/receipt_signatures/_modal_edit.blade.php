<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="formEdit" data-id="{{ $signature->id }}">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Tanda Tangan</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Terang</label>
                        <input type="text" name="name" class="form-control" value="{{ $signature->name }}" required>
                    </div>

                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" name="position" class="form-control" value="{{ $signature->position }}">
                    </div>

                    {{-- Upload ke Cloudinary --}}
                    <div class="form-group mb-3">
                        <label>Upload Tanda Tangan Baru (opsional)</label><br>
                        <button type="button" id="upload_signature_edit" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-cloud-upload-alt"></i> Pilih File Gambar
                        </button>

                        <div id="signature_preview_edit" class="mt-3">
                            @if ($signature->signature_url)
                                <img src="{{ $signature->signature_url }}" class="img-thumbnail" width="200" alt="Preview TTD">
                            @endif
                        </div>

                        <input type="hidden" name="signature_url" id="signature_url_edit">
                        <div id="error_signature_url_edit" class="text-danger small d-block"></div>
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="is_active" value="1" {{ $signature->is_active ? 'checked' : '' }}>
                            Aktifkan TTD Ini
                        </label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit">Perbarui</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Cloudinary Widget untuk Edit --}}
<script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
<script>
    const signatureEditWidget = cloudinary.createUploadWidget({
        cloudName: 'dmynbnqtt', // Ganti dengan cloud name kamu
        uploadPreset: 'angkotapp', // Ganti dengan preset kamu
        sources: ['local', 'camera'],
        multiple: false,
        cropping: false,
        folder: 'signatures',
        maxFileSize: 2000000,
        clientAllowedFormats: ["png"],
    }, (error, result) => {
        if (!error && result && result.event === "success") {
            const imageUrl = result.info.secure_url;
            document.getElementById("signature_url_edit").value = imageUrl;
            document.getElementById("signature_preview_edit").innerHTML = `
                <img src="${imageUrl}" class="img-thumbnail" width="200" alt="Preview TTD">
            `;
            document.getElementById("error_signature_url_edit").innerText = '';
        }
    });

    document.getElementById("upload_signature_edit").addEventListener("click", function() {
        signatureEditWidget.open();
    }, false);
</script>
