@extends('layouts.main')
@section('container')
<div class="row justify-content-center ">
    <div class="col-md-7 bg-success px-3 py-3 rounded">
      <h5 class="text-white">Catat Pengeluaran dan Pemasukan keuangan mu setiap hari!</h5>
      <button type="button" class="btn btn-outline-light mb-3 mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Catat Keuangan</button>
      
    <div class="px-2 py-2  rounded" style="background-color: rgb(252, 250, 250)">

      @if ($finances->count())

      <h5>Sisa Uang : {{ rupiah($revenue - $expense) }}</h5>
      <div class="progress bg-grey mb-3">
        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ persentase($revenue, $expense) }};" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" >{{ persentase($revenue, $expense) }}</div>
      </div>
      <hr class="text-grey">
    

          @foreach ($finances as $finance)

        
          <div class="bg-light  rounded  mb-3 px-3 py-3 shadow border border-2 ">
            <div class="d-flex">
            <h5>{{ $finance->title }}</h5>
            <h5 class="fw-100 ms-auto">{{ rupiah($finance->amount) }}</h5>
          </div>
         

          <div class="d-flex ">
            <div class="d-block">
            <small>{{ $finance->date }}</small>
            <br>
            <small>{{ $finance->type }}</small>
          </div>

            <div class="d-flex ms-auto px-2 py-2">
            <button type="button" class="editbtn border-0 badge bg-success me-1" value="{{ $finance->id }}"><i class=" bi bi-pencil-square text-white"></i></button>
                
            <form action="/home/{{ $finance->id }}" method="POST" class="d-flex">
              @method('DELETE')
              @csrf
            <button class="border-0 badge bg-danger" onclick="return confirm('Are you sure?')"><i class=" bi bi-trash text-white"></i></button>
            </form>
          </div>

          </div>

          </div>
          
       

          @endforeach
          <div class="d-flex justify-content-center">
          {{ $finances->links() }}
        </div>
          

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



          @else
         
          <h5>Sisa Uang : 0</h5>
          <div class="progress bg-grey mb-3">
            <div class="progress-bar bg-warning" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" >0%</div>
          </div>
          <hr class="text-grey">
    
    
              
        
                  
    
             <div class="d-flex justify-content-center">
              <h5>Catatan keuangan tidak ditemukan</h5>
             </div>
          @endif
         

        </div>
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