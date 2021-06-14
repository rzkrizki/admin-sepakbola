<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Jadwal Pertandingan</h4>
                <div class="row">
                    <div class="col-md-3">
                        <label for="tanggal_pertandingan">Tanggal Pertandingan</label>
                        <input type="date" class="form-control" id="tanggal_pertandingan" name="tanggal_pertandingan" value="<?= $result->tanggal_pertandingan ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="waktu_pertandingan">Waktu Pertandingan</label>
                        <input type="time" class="form-control" id="waktu_pertandingan" name="waktu_pertandingan" value="<?= $result->waktu_pertandingan ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="tim_tuan_rumah">Tim Tuan Rumah</label>
                        <select name="tim_tuan_rumah" id="tim_tuan_rumah" class="form-control" required>
                            <option value="">Pilih Salah Satu</option>
                            <?php foreach($team as $row){ ?>
                                <option value="<?= $row->id ?>" <?php if($result->tim_tuan_rumah == $row->id) { echo "selected" ;} ?>><?= $row->nama_tim ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="tim_tamu">Tim Tamu</label>
                        <select name="tim_tamu" id="tim_tamu" class="form-control" required>
                            <option value="">Pilih Salah Satu</option>
                            <?php foreach($team as $row){ ?>
                                <option value="<?= $row->id ?>" <?php if($result->tim_tamu == $row->id) { echo "selected" ;} ?>><?= $row->nama_tim ?></option>
                            <?php } ?>
                        </select>
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
        var tanggal_pertandingan = $('#tanggal_pertandingan').val()
        var waktu_pertandingan = $('#waktu_pertandingan').val()
        var tim_tuan_rumah = $('#tim_tuan_rumah').val()
        var tim_tamu = $('#tim_tamu').val()
   
        if (tanggal_pertandingan != '' && waktu_pertandingan != '' && tim_tuan_rumah != '' && tim_tamu != '') {
            submitData()
        } else {
            if (tanggal_pertandingan == '') {
                getWarning("Tanggal pertandingan tidak boleh kosong")
            } else if (waktu_pertandingan == '') {
                getWarning("Waktu pertandingan tidak boleh kosong")
            } else if (tim_tuan_rumah == '') {
                getWarning("Silahkan pilih tim tuan rumah terlebih dahulu")
            } else if (tim_tamu == '') {
                getWarning("Silahkan pilih tim tamu terlebih dahulu")
            }
        }
    }

    function submitData() {
        var id = '<?= $result->id ?>'
        var tanggal_pertandingan = $('#tanggal_pertandingan').val()
        var waktu_pertandingan = $('#waktu_pertandingan').val()
        var tim_tuan_rumah = $('#tim_tuan_rumah').val()
        var tim_tamu = $('#tim_tamu').val()

        $.ajax({
            url: "<?= base_url('schedule/update') ?>",
            type: "POST",
            dataType: "json",
            data: {
                'id': id,
                'tanggal_pertandingan': tanggal_pertandingan,
                'waktu_pertandingan': waktu_pertandingan,
                'tim_tuan_rumah': tim_tuan_rumah,
                'tim_tamu': tim_tamu
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
        $('#tanggal_pertandingan').val('')
        $('#waktu_pertandingan').val('')
        $('#tim_tuan_rumah').val('').change()
        $('#tim_tamu').val('').change()
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
        window.location.href = "<?= base_url('schedule') ?>";
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