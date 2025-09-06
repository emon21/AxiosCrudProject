@extends('layouts.app', ['title' => 'Product Page'])
@section('content')
    <div class="col-sm-10 mt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header bg-success text-light">
                            <h4>Product List</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    </tr>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="ProductList"></tbody>
                            </table>
                            
                            {{-- <div id="Pagination" class="mt-3"></div> --}}
                            <!-- Pagination -->
                            <nav>
                                <ul class="pagination justify-content-start" id="Pagination"></ul>
                            </nav>
                        </div>
                     
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header bg-success text-light">
                            <h4>Product Create</h4>
                        </div>
                        <div class="card-body">

                            {{-- <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter name">
                            </div> --}}

                            <button class="btn btn-outline-success mt-2" onclick="storeCategory()">Create</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
@endsection

@push('scripts')
    <script>
        alert("hello");
    </script>
@endpush
