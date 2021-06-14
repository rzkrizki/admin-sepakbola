<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Hasil Pertandingan</h4>
                <div class="row">
                    <div class="col-md-3">
                        <label for="tanggal_pertandingan">Tanggal Pertandingan</label>
                        <input type="date" class="form-control" id="tanggal_pertandingan" name="tanggal_pertandingan" value="<?= $result->tanggal_pertandingan ?>" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="waktu_pertandingan">Waktu Pertandingan</label>
                        <input type="time" class="form-control" id="waktu_pertandingan" name="waktu_pertandingan" value="<?= $result->waktu_pertandingan ?>" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="tim_tuan_rumah">Tim Tuan Rumah</label>
                        <input type="input" class="form-control" id="tim_tuan_rumah" name="tim_tuan_rumah" value="<?= $result->tim_tuan_rumah ?>" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="tim_tamu">Tim Tamu</label>
                        <input type="input" class="form-control" id="tim_tamu" name="tim_tamu" value="<?= $result->tim_tamu ?>" readonly>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-3">
                        <label for="total_score">Total Skor</label>
                        <input type="number" class="form-control" id="total_score" name="total_score" value="<?= $result->total_score ?>" >
                    </div>
                    <div class="col-md-3">
                        <label for="tim">Tim</label>
                        <select name="tim" id="tim" onchange="getPlayer(this.value)" class="form-control" required>
                            <option value="">Pilih Salah Satu</option>
                            <?php foreach($team as $row){ ?>
                                <option value="<?= $row->id ?>" <?php if($result->tim_score == $row->id) { echo "selected" ;} ?>><?= $row->nama_tim ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="player_score">Player Skor</label>
                        <select name="player_score" id="player_score" class="form-control" required>
                            <?php foreach($player as $row){ ?>
                                <option value="<?= $row->id ?>" <?php if($result->player_score == $row->id) { echo "selected" ;} ?>><?= $row->nama_pemain ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="time_score">Waktu Skor</label>
                        <input type="time" step="1" class="form-control" id="time_score" name="time_score" value="<?= $result->time_score ?>">
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

    function getPlayer(value){
        $.ajax({
            url: "<?= base_url('player/get_player_by_team/') ?>" + value,
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.status == 500) {
                    getError(response.message)
                } else {
                    if(response.length == 0){
                        getWarning('Pemain di tim ini masih kosong')
                    }else{
                        fillPlayer(response)
                    }
                }
                
            },
            error: function(e) {
                getError(e)
            }
        })
    }

    function fillPlayer(response){
        $('#player_score').empty();
        $('#player_score').append(`
            <option value="">Pilih salah satu</option>
        `);
        $.each(response, function(index, item) {
            $('#player_score').append(`
                <option value="`+item.id+`">`+item.nama_pemain+`</option>
            `);
        });
    }

    function checkData() {
        var schedule_id = '<?= $result->id ?>'
        var total_score = $('#total_score').val()
        var player_score = $('#player_score').val()
        var time_score = $('#time_score').val()
   
        if (total_score != '' && player_score != '' && time_score != '') {
            submitData()
        } else {
            if (total_score == '') {
                getWarning("Total skor tidak boleh kosong")
            } else if (player_score == '') {
                getWarning("Player skor tidak boleh kosong")
            } else if (time_score == '') {
                getWarning("Waktu skor tidak boleh kosong")
            }
        }
    }

    function submitData() {
        var id = '<?= $result->id ?>'
        var schedule_id = '<?= $result->schedule_id ?>'
        var total_score = $('#total_score').val()
        var player_score = $('#player_score').val()
        var time_score = $('#time_score').val()

        $.ajax({
            url: "<?= base_url('report/update') ?>",
            type: "POST",
            dataType: "json",
            data: {
                'id': id,
                'schedule_id': schedule_id,
                'total_score': total_score,
                'player_score': player_score,
                'time_score': time_score
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
        $('#total_score').val('')
        $('#tim').val('').change()
        $('#player_score').val('')
        $('#time_score').val('')
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
        var schedule_id = '<?= $result->schedule_id ?>'
        window.location.href = "<?= base_url('report?schedule_id=') ?>" + schedule_id;
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