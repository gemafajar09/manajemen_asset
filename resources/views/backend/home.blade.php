    <!-- extends dibawah berfungsi sebagai template default/turunan untuk semua file yg di panggil -->
    @extends('backend.template')

    @section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="login">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    @endsection

    @section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$aset}}</h3>

                    <p>Jumlah Total Aset</p>
                </div>
                <div class="icon">
                    <i class="ion ion-laptop"></i>
                </div>
                <a href="{{ route('data-aset') }}" class="small-box-footer">Create Aset <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$pegawai}}</h3>

                    <p>Total Pegawai</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{route('pegawai')}}" class="small-box-footer">Create Pegawai <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$kategori}}</h3>

                    <p>Total Kategori</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{route('kategori')}}" class="small-box-footer">Create Kategori <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$departement}}</h3>

                    <p>Total Department</p>
                </div>
                <div class="icon">
                    <i class="ion ion-home"></i>
                </div>
                <a href="{{route('departement')}}" class="small-box-footer">Create Department <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <!-- donut chart -->
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Chart Total Aset Berdasarkan Nama Aset/Perangkat</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="grafikbar"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- end donut chart -->

                <!-- bar chart -->
                <div class="col-md-6">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Grafik Chart Total Aset Berdasarkan Tahun Pengadaan</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="grafikbar1"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- end bar chart -->

        <!-- activity -->
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3>Last Activity User</h3>
            </div>
            <div class="card-body">
              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th>Nama User</th>
                    <th>Tanggal</th>
                    <th>Aktifitas</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($activity as $activity1)
                  <tr>
                    <td>{{$activity1->nama}}</td>
                    <td>{{$activity1->tanggal}}</td>
                    <td>{{$activity1->activity}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{ $activity->links() }}
            </div>
          </div>
        </div>
    </div>
    <!-- end activity -->
    <script>
        var areaChartData = {
            labels: <?= json_encode($hasil_nama_aset) ?>,
            datasets: [{
                    label: 'Asset',
                    backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                    data: <?= json_encode($hasil_grafik1) ?>
                }
            ]
        }

        var barChartCanvas = $('#grafikbar').get(0).getContext('2d')
        var barChartData = $.extend(true, {}, areaChartData)

        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
            
        }

        var barChart = new Chart(barChartCanvas, {
            type: 'doughnut',
            data: barChartData,
            options: barChartOptions
        })

        var areaChartData = {
            labels: <?= json_encode($hasil_tahun) ?>,
            datasets: [{
                    label: 'Jumlah Total Aset Berdasarkan Tahun Pengadaan',
                    backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                    data: <?= json_encode($hasil_grafik) ?>
                }
            ]
        }

        var barChartCanvas = $('#grafikbar1').get(0).getContext('2d')
        var barChartData = $.extend(true, {}, areaChartData)

        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
            
        }

        var barChart = new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
        })

    </script>
    @endsection
