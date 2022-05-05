@extends('layouts.main')
@section('container')
<div class="row justify-content-center ">
    <div class="col-md-7 bg-success px-3 py-3 rounded">
      <h5 class="text-white">Catat Pengeluaran dan Pemasukan keuangan mu setiap hari!</h5>
      <button type="button" class="btn btn-outline-light mb-3 mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Catat Keuangan</button>
          
          <table class="bg-white table table-striped table-hover">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Judul</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Tipe</th>
                <th scope="col">Aksi</th>
                
              </tr>
            </thead>
            <tbody>
              @foreach ($finances as $finance)
              <tr>
                
                <td>{{ $loop->iteration}}</td>
                <td>{{ $finance->title }}</td>
                <td>{{ $finance->amount }}</td>
                <td>{{ $finance->date }}</td>
                <td>{{ $finance->type }}</td>
                <td>
                  <button type="button" class="editbtn" value="{{ $finance->id }}">Edit</button>
                
                  <form action="/home/{{ $finance->id }}" method="POST" class="d-inline">
                    @method('DELETE')
                    @csrf
                  <button class="border-0 badge bg-danger" onclick="return confirm('Are you sure?')"><i class=" bi bi-trash text-white"></i></td></button>
              
                </form>
                </tr>
              @endforeach
            
              
            </tbody>
          </table>
       {{-- Add modal --}}
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Catat Keuangan</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="/home" method="POST" >
                    @csrf
                    <div class="mb-3">
                      <label for="judul" class="col-form-label">Judul:</label>
                      <input type="text" name="title" class="form-control" id="judul">
                    </div>
                    <div class="mb-3">
                      <label for="jumlah" class="col-form-label">Jumlah:</label>
                      <input type="text" name="amount" class="form-control" id="jumlah">
                    </div>
                   
                    <div class="mb-3">
                      <label for="startDate" class="col-form-label">Tanggal dan waktu:</label>
                    <input id="startDate" class="form-control" name="date" value="{{Carbon\Carbon::now()->format('Y-m-d')."T".Carbon\Carbon::now()->locale('id')->format('H:i')}}" type="datetime-local" />
                    </div>

                    <div class="mb-3">
                    <label for="tipe" class="col-form-label">Tipe:</label>
                    <select class="form-select " name="type" aria-label="Default select example">
                      <option selected>-- Pilih Tipe --</option>
                      <option value="pemasukan">Pemasukan</option>
                      <option value="pengeluaran">Pengeluaran</option>
                      
                    </select>
                  </div>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" name="submit" class="btn btn-primary">Catat</button>
                  </form>
                </div>
                <div class="modal-footer">
                </div>
              </div>
            </div>
          </div>
          {{-- END ADD MODAL --}}

          {{-- Edit modal --}}
          <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Pencatatan Keuangan</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="/home/{{ $finance->id }}" method="POST" >
                    @method('put')
                    @csrf
                    <input type="hidden" id="finance_id">
                    <div class="mb-3">
                      <label for="judul" class="col-form-label">Judul:</label>
                      <input type="text" name="title" id="title" class="form-control" id="judul">
                    </div>
                    <div class="mb-3">
                      <label for="jumlah" class="col-form-label">Jumlah:</label>
                      <input type="text" name="amount" id="amount" class="form-control" id="jumlah">
                    </div>
                   
                    <div class="mb-3">
                      <label for="startDate" class="col-form-label">Tanggal dan waktu:</label>
                    <input id="startDate" class="form-control" name="date" id="date" value="{{Carbon\Carbon::now()->format('Y-m-d')."T".Carbon\Carbon::now()->format('H:i')}}" type="datetime-local" />
                    </div>

                    <div class="mb-3">
                    <label for="tipe" class="col-form-label">Tipe:</label>
                    <select class="form-select " name="type" id="type"  aria-label="Default select example">
                      <option selected>-- Pilih Tipe --</option>
                      <option value="pemasukan">Pemasukan</option>
                      <option value="pengeluaran">Pengeluaran</option>
                      
                    </select>
                  </div>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" name="submit" class="btn btn-primary">Update Pencatatan</button>
                  </form>
                </div>
                <div class="modal-footer">
                </div>
              </div>
            </div>
          </div>
          {{-- END EDIT MODAL --}}
    </div>
</div>
@endsection

@section('scripts')
    <script>
      $(document).ready(function() {
        $(document).on('click', '.editbtn',  function(){

          var finance_id = $(this).val();
          // alert(finance_id);
          $('#editModal').modal('show');

          $.ajax({

            type: "GET",
            url: "/home/"+finance_id,
            success: function(response) {
              console.log(response.finance);
              $('#title').val(response.finance.title);
              $('#amount').val(response.finance.amount);
              $('#date').val(response.finance.date);
              $('#type').val(response.finance.type);
             
            }

          });

        });
      });
    </script>
@endsection