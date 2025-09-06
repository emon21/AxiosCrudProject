@extends('layouts.app', ['title' => 'Blog Page'])
@section('content')
    <div class="col-sm-10 mt-2">
        <div class="card">
            <div class="card-header bg-success d-flex justify-content-start align-items-center text-white">
                <h4>Blog Page</h4>
                <button type="button" class="btn btn-outline-success border border-light text-white ms-auto"
                    data-bs-toggle="modal" data-bs-target="#CreateModal">Create Blog</button>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="BlogList"></tbody>
                </table>
                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    <nav>
                        <ul class="pagination justify-content-start" id="Pagination">
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <!-- CreateModal -->
        <div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="CreateModalLabel">Blog Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h3>Create Blog</h3>
                        <div class="form-group mb-1">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control mt-1" id="title"
                                placeholder="Title...">
                        </div>
                        <div class="form-group mb-1">
                            <label for="description">Description</label>
                            <input type="text" name="description" class="form-control mt-1" id="description"
                                placeholder="Description...">
                        </div>
                        <div class="form-group mb-1">
                            <label for="name">Status</label>
                            <input type="text" class="form-control mt-1" id="status"
                                placeholder="Status">
                        </div>

                        {{-- <div class="form-group mb-1">
                            <label for="image">Picture</label>
                            <input type="file" name="image" class="form-control mt-1" id="image">
                        </div>

                        <div class="my-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate">
                                <label class="form-check-label" for="flexCheckIndeterminate">
                                    Enable
                                </label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox
                                    input</label>
                            </div>
                        </div> --}}

                        <button class="btn btn-success" onclick="CreateBlog()">Create</button>
                        {{-- <button class="btn btn-danger" onclick="closeCreateModal()">Close</button> --}}

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Close Modal -->
    @endsection
    @push('scripts')
        <script>
           

            //  Create Blog

            function CreateBlog() {

                let title = document.getElementById('title').value;
                let description = document.getElementById('description').value;
                let status = document.getElementById('status').value;

               //  let image = document.getElementById('image').value;

                

               //  console.log(data);

                  axios.post(`${BASE_URL}/blog`, {
                    title: title,
                    description: description,
                    status: status
                })
                .then(res => {

                  //   document.getElementById("name").value = "";
                  //   document.getElementById("price").value = "";
                  //   document.getElementById("category_id").value = "Select Category";

                    showLoader();
                    toasterMessage("success", "Product added successfully!", "Success");
                  //   loadProducts();
                  closeCreateModal();
                    hideLoader();

                })
                .catch(err => {
                    toasterMessage("error", "Failed to add product!", "Error");
                });
                        

               //  let formData = new FormData();

               // formData.append('title', title);
               // formData.append('description', description);
               // formData.append('status', status);
               // formData.append('image', image);

               //  console.log(formData);
              

                //  axios.post('/blog', formData).then(res => {
                //      getAllBlogs();
                //      closeCreateModal();
                //  });
            }
        </script>
    @endpush
