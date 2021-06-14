<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Player</h4>
                <div class="row">
                    <div class="col-md-4">
                        <label for="team_id">Nama Tim</label>
                        <select name="team_id" id="team_id" class="form-control" required>
                            <option value="">Pilih Salah Satu</option>
                            <?php foreach($team as $row){ ?>
                                <option value="<?= $row->id ?>"><?= $row->nama_tim ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="nama_pemain">Nama Pemain</label>
                        <input type="text" class="form-control" id="nama_pemain" name="nama_pemain">
                    </div>
                    <div class="col-md-4">
                        <label for="tinggi_badan">Tinggi Badan</label>
                        <input type="number" class="form-control" id="tinggi_badan" name="tinggi_badan">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-4">
                        <label for="berat_badan">Berat Badan</label>
                        <input type="number" class="form-control" id="berat_badan" name="berat_badan">
                    </div>
                    <div class="col-md-4">
                        <label for="posisi_pemain">Posisi Pemain</label>
                        <select name="posisi_pemain" id="posisi_pemain" class="form-control" required>
                            <option value="">Pilih Salah Satu</option>
                            <option value="penyerang">Penyerang</option>
                            <option value="gelandang">Gelandang</option>
                            <option value="bertahan">Bertahan</option>
                            <option value="penjaga_gawang">Penjaga Gawang</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="nomor_punggung">Nomor Punggung</label>
                        <input type="text" class="form-control" id="nomor_punggung" name="nomor_punggung">
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
        var team_id = $('#team_id').val()
        var nama_pemain = $('#nama_pemain').val()
        var tinggi_badan = $('#tinggi_badan').val()
        var berat_badan = $('#berat_badan').val()
        var posisi_pemain = $('#posisi_pemain').val()
        var nomor_punggung = $('#nomor_punggung').val()
   
        if (team_id != '' && nama_pemain != '' && tinggi_badan != '' && berat_badan != '' && posisi_pemain != '' && nomor_punggung != '') {
            submitData()
        } else {
            if (team_id == '') {
                getWarning("Silahkan pilih tim terlebih dahulu")
            } else if (nama_pemain == '') {
                getWarning("Nama pemain tidak boleh kosong")
            } else if (tinggi_badan == '') {
                getWarning("Tinggi badan tidak boleh kosong")
            } else if (berat_badan == '') {
                getWarning("Berat badan tim tidak boleh kosong")
            } else if (posisi_pemain == '') {
                getWarning("Silahkan pilih posisi pemain terlebih dahulu")
            } else if (nomor_punggung == '') {
                getWarning("Nomor punggung tidak boleh kosong")
            }
        }
    }

    function submitData() {
        var team_id = $('#team_id').val()
        var nama_pemain = $('#nama_pemain').val()
        var tinggi_badan = $('#tinggi_badan').val()
        var berat_badan = $('#berat_badan').val()
        var posisi_pemain = $('#posisi_pemain').val()
        var nomor_punggung = $('#nomor_punggung').val()

        $.ajax({
            url: "<?= base_url('player/submit') ?>",
            type: "POST",
            dataType: "json",
            data: {
                'team_id': team_id,
                'nama_pemain': nama_pemain,
                'tinggi_badan': tinggi_badan,
                'berat_badan': berat_badan,
                'posisi_pemain': posisi_pemain,
                'nomor_punggung': nomor_punggung
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
        $('#team_id').val('').change()
        $('#nama_pemain').val('')
        $('#tinggi_badan').val('')
        $('#berat_badan').val('')
        $('#posisi_pemain').val('').change()
        $('#nomor_punggung').val('')
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
        window.location.href = "<?= base_url('player') ?>";
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