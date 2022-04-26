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
                <td><i class="bi bi-pencil-square text-success"></i><i class=" bi bi-trash text-danger"></i></td>
              </tr>
              @endforeach
            
              
            </tbody>
          </table>
       {{-- modal --}}
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Catat Keuangan</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="/" method="POST" >
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
                    <input id="startDate" class="form-control" value="{{ old('date') }}" name="date" type="datetime-local" />
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
    </div>
</div>
@endsection