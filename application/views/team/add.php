<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Team</h4>
                <div class="row">
                    <div class="col-md-4">
                        <label for="nama_tim">Nama Tim</label>
                        <input type="text" class="form-control" id="nama_tim" name="nama_tim">
                    </div>
                    <div class="col-md-4">
                        <label for="logo_tim">Logo Tim</label>
                        <input type="text" class="form-control" id="logo_tim" name="logo_tim">
                    </div>
                    <div class="col-md-4">
                        <label for="tahun_berdiri">Tahun Berdiri</label>
                        <input type="number" class="form-control" id="tahun_berdiri" name="tahun_berdiri">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-4">
                        <label for="alamat_markas_tim">Alamat Markas Tim</label>
                        <textarea name="alamat_markas_tim" id="alamat_markas_tim" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="col-md-4">
                        <label for="kota_markas_tim">Kota Markas Tim</label>
                        <input type="text" class="form-control" id="kota_markas_tim" name="kota_markas_tim">
                    </div>
                </div>
                <div class="mt-4">
                    <button class="btn btn-success btn-block" onclick="checkData()"><b>Submit</b></button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function checkData() {
        var nama_tim = $('#nama_tim').val()
        var logo_tim = $('#logo_tim').val()
        var tahun_berdiri = $('#tahun_berdiri').val()
        var kota_markas_tim = $('#kota_markas_tim').val()
        var alamat_markas_tim = $('#alamat_markas_tim').val()
   
        if (nama_tim != '' && logo_tim != '' && tahun_berdiri != '' && kota_markas_tim != '' && alamat_markas_tim != '') {
            submitData()
        } else {
            if (nama_tim == '') {
                getWarning("Nama tim tidak boleh kosong")
            } else if (logo_tim == '') {
                getWarning("Logo tim tidak boleh kosong")
            } else if (tahun_berdiri == '') {
                getWarning("Tahun berdiri tidak boleh kosong")
            } else if (kota_markas_tim == '') {
                getWarning("Kota markas tim tidak boleh kosong")
            } else if (alamat_markas_tim == '') {
                getWarning("Alamat markas tim tidak boleh kosong")
            }
        }
    }

    function submitData() {
        var nama_tim = $('#nama_tim').val()
        var logo_tim = $('#logo_tim').val()
        var tahun_berdiri = $('#tahun_berdiri').val()
        var kota_markas_tim = $('#kota_markas_tim').val()
        var alamat_markas_tim = $('#alamat_markas_tim').val()

        $.ajax({
            url: "<?= base_url('team/submit') ?>",
            type: "POST",
            dataType: "json",
            data: {
                'nama_tim': nama_tim,
                'logo_tim': logo_tim,
                'tahun_berdiri': tahun_berdiri,
                'kota_markas_tim': kota_markas_tim,
                'alamat_markas_tim': alamat_markas_tim,
            },
            success: function(response) {
                if (response.status == 500) {
                    getError(response.message)
                } else {
                    getSuccess(response.message)
                }
                
            },
            error: function(e) {
                getError(e)
            }
        })
    }

    function clearForm() {
        $('#nama_tim').val('')
        $('#logo_tim').val('')
        $('#tahun_berdiri').val('')
        $('#kota_markas_tim').val('')
        $('#alamat_markas_tim').val('')
    }

    function getSuccess(msg) {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: msg,
            showConfirmButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                directSuccess()
                clearForm()
            }
        })
    }

    function directSuccess(){
        window.location.href = "<?= base_url('team') ?>";
    }

    function getWarning(msg) {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: msg
        })
    }

    function getError(msg) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: msg
        })
    }
</script>