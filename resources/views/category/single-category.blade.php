{{-- <h2>Single Category Page</h2>

<h2>Category Details</h2>
<p>ID: {{ $cat->id }}</p>
<p>Name: {{ $cat->name }}</p> --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Category Details</h2>
    {{-- <p><b>ID:</b> {{ $cat->id }}</p> --}}
    <p><b>Name:</b> {{ $category->name }}</p>
    <h4 id="category_name"></h4>
   <a href="{{ route('get-all-category') }}">Back to List</a>

</div>
@endsection

@push('scripts')

{{-- // single data show --}}
<script>

   let pageUrl = window.location.href;
   // console.log(pageUrl);

   // axios.get(pageUrl)
   //          .then((res) => {
   //              console.log(res.data);
   //              // $("#category_id").val(res.data.id);
   //              // $("#category_name").val(res.data.category_name);
   //              // $("#categoryModal").modal("show");
                 
   //          })
   //          .catch((err) => {
   //              console.log(err);
                
   //              // toastr.error("Something went wrong!");
   //          })

   // console.log("Demo");
   
  
   axios.get(`${pageUrl}`)
    .then((res) => {
      //   console.log(res.data);
      //   $("#category_id").val(res.data.id);
      //   document.getElementById("category_name").value(res.data.name);
            let newName = document.getElementById(`category_name-${id}`).value;
            console.log(newName);
            

        // $("#categoryModal").modal("show"); --}}
        //other page redirect
        
    })
    .catch((error) => {
        console.error(error);
    })
</script>

@endpush