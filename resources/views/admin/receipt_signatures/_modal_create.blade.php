<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="formCreate">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Tanda Tangan</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Terang</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" name="position" class="form-control">
                    </div>

                    {{-- Upload ke Cloudinary --}}
                    <div class="form-group mb-3">
                        <label>Upload Tanda Tangan (via Cloudinary)</label><br>
                        <button type="button" id="upload_signature" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-cloud-upload-alt"></i> Pilih File Gambar
                        </button>

                        {{-- Preview file --}}
                        <div id="signature_preview" class="mt-3"></div>

                        {{-- Hidden field to store Cloudinary URL --}}
                        <input type="hidden" name="signature_url" id="signature_url" required>
                        <div id="error_signature_url" class="text-danger small d-block"></div>
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="is_active" value="1"> Aktifkan TTD Ini
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Cloudinary Widget --}}
<script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
<script>
    const signatureWidget = cloudinary.createUploadWidget({
        cloudName: 'dmynbnqtt', // Ganti dengan Cloudinary Cloud Name kamu
        uploadPreset: 'angkotapp', // Ganti dengan Upload Preset kamu
        sources: ['local', 'camera'],
        multiple: false,
        cropping: false,
        folder: 'signatures',
        maxFileSize: 2000000, // 2MB
        clientAllowedFormats: ["png"],
    }, (error, result) => {
        if (!error && result && result.event === "success") {
            const imageUrl = result.info.secure_url;
            document.getElementById("signature_url").value = imageUrl;
            document.getElementById("signature_preview").innerHTML = `
                <img src="${imageUrl}" class="img-thumbnail" width="200" alt="Preview TTD">
            `;
            document.getElementById("error_signature_url").innerText = '';
        }
    });

    document.getElementById("upload_signature").addEventListener("click", function() {
        signatureWidget.open();
    }, false);
</script>
