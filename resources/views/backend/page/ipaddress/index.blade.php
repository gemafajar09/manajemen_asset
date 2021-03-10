@extends('backend.template')

@section('content')
<div class="row py-2">
    <div class="col-md-12">
        @if(session('pesan'))
        <div style="display:none" id="pesan" class="alert alert-success">
            {{session('pesan')}}
        </div>
        @endif
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="float-left">
                    <h3>IP Address Management</h3>
                </div>
                <div class="float-right">
                    <button type="button" onclick="add()" class="btn btn-success btn-sm"> <i class="fa fa-plus"> </i>
                        Add </button>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-response">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Data Pegawai</th>
                            <th>Unit Kerja</th>
                            <!-- <th>IP Address</th>
                            <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                  	@foreach($data as $no => $getUser)
                    <tr>
                      <td>{{$no+1}}</td>
                      <td>{{ $getUser->nama }}</td>
                      <td>{{ $getUser->unit_kerja }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- fungsi untuk show dan hide status pesan -->
@if(session('pesan'))
<script>
    $('#pesan').show()
    setInterval(function () {
        $('#pesan').hide()
    }, 2000);

</script>
@endif

<!-- Fungsi Untuk Menambah data Pegawai menggunakan jquery -->
<script>
    function add() {
        $('#pegawaiAdd').modal()
    }

    function edit(id, nama, email, level, username) {
        $('#id').val(id)
        $('#nama').val(nama)
        $('#email').val(email)
        $('#level').val(level)
        $('#username').val(username)
        $('#pegawaiAdd').modal()
    }
</script>

<!-- Fungsi untuk notifikasi menggunakan sweet alert menggunakan jquery -->
<!-- <script>
    $('.delete').click(function() {      
        var pegawai_id = $(this).attr('pegawai-id')
        // alert(pegawai_id)
        Swal.fire({
            title: 'Anda Yakin?',
            text: 'ingin Menghapus data dengan id '+ pegawai_id + ' ??',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                console.log(result)
            if (result) {
                window.location = ("/delete-pegawai/'+ id_pegawai + '");
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
            
    })
})
</script> -->

<!-- <script>
   function hapus(id) {      
        Swal.fire({
            title: 'Anda Yakin?',
            text: 'ingin Menghapus data dengan id '+ id,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then(function(result){
                console.log(result)
            if (result) {
                window.location = "/delete-pegawai/"+ id;
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
            
    })
})
</script> -->
@endsection
