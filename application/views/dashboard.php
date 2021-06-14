 <!-- partial -->
 <div class="main-panel">
     <div class="content-wrapper">
         <div class="row">
             <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                 <div class="card card-statistics">
                     <div class="card-body">
                         <div class="clearfix">
                             <div class="float-left">
                                 <i class="mdi mdi-cube text-danger icon-lg"></i>
                             </div>
                             <div class="float-right">
                                 <p class="mb-0 text-right">Total Pertandingan</p>
                                 <div class="fluid-container">
                                     <h3 class="font-weight-medium text-right mb-0"><?= $total_pertandingan ?></h3>
                                 </div>
                             </div>
                         </div>
                         <p class="text-muted mt-3 mb-0">
                             <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Total semua pertandingan
                         </p>
                     </div>
                 </div>
             </div>
             <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                 <div class="card card-statistics">
                     <div class="card-body">
                         <div class="clearfix">
                             <div class="float-left">
                                 <i class="mdi mdi-receipt text-warning icon-lg"></i>
                             </div>
                             <div class="float-right">
                                 <p class="mb-0 text-right">Total Pertandingan</p>
                                 <div class="fluid-container">
                                     <h3 class="font-weight-medium text-right mb-0"><?= $total_pertandingan_bulan_ini ?></h3>
                                 </div>
                             </div>
                         </div>
                         <p class="text-muted mt-3 mb-0">
                             <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Total pertandingan bulan ini
                         </p>
                     </div>
                 </div>
             </div>
             <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                 <div class="card card-statistics">
                     <div class="card-body">
                         <div class="clearfix">
                             <div class="float-left">
                                 <i class="mdi mdi-poll-box text-success icon-lg"></i>
                             </div>
                             <div class="float-right">
                                 <p class="mb-0 text-right">Total Pertandingan</p>
                                 <div class="fluid-container">
                                     <h3 class="font-weight-medium text-right mb-0"><?= $total_pertandingan_hari_ini ?></h3>
                                 </div>
                             </div>
                         </div>
                         <p class="text-muted mt-3 mb-0">
                             <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Total pertandingan hari ini
                         </p>
                     </div>
                 </div>
             </div>
             <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                 <div class="card card-statistics">
                     <div class="card-body">
                         <div class="clearfix">
                             <div class="float-left">
                                 <i class="mdi mdi-account-box-multiple text-info icon-lg"></i>
                             </div>
                             <div class="float-right">
                                 <p class="mb-0 text-right">Jumlah Tim</p>
                                 <div class="fluid-container">
                                     <h3 class="font-weight-medium text-right mb-0"><?= $total_tim ?></h3>
                                 </div>
                             </div>
                         </div>
                         <p class="text-muted mt-3 mb-0">
                             <i class="mdi mdi-reload mr-1" aria-hidden="true"></i> Jumlah semua tim
                         </p>
                     </div>
                 </div>
             </div>
         </div>

         <div class="row">
             <div class="col-lg-12 grid-margin">
                 <div class="card">
                     <div class="card-body">
                         <h4 class="card-title">Orders</h4>
                         <div class="table-responsive">
                             <table class="table table-striped">
                                 <thead>
                                     <tr>
                                         <th>#</th>
                                         <th>Pemain</th>
                                         <th>Posisi</th>
                                         <th>Tim</th>
                                         <th>Total Skor</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php
                                        $no = 1;
                                        foreach ($top_scorer as $row) {  ?>
                                         <tr>
                                             <td class="font-weight-medium"><?= $no++ ?></td>
                                             <td><?= $row->player_name ?></td>
                                             <td><?= ucwords(str_replace('_', ' ', $row->posisi_pemain)) ?></td>
                                             <td><?= ucwords($row->tim_score) ?></td>
                                             <td><?= $row->total_score ?> Gol</td>
                                         </tr>
                                     <?php } ?>
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>