@extends('layouts.app', ['title' => 'Category Page'])

@section('content')
    <div class="col-sm-10 mt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header bg-success text-light">
                            <h4>Category List</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="CategoryList"></tbody>
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
                            <h4>Category Create</h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter name">
                            </div>
                            <button class="btn btn-outline-success mt-2" onclick="storeCategory()">Create Category</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const url = window.location.origin; //href -> api full path
        // console.log(url);

        // get all Data

        let CategoryList = document.getElementById('category-list');

        // let currentPage = 1;


        function GetAllCategory(page = 1) {
            axios.get(BASE_URL + '/category?page=' + page)
                .then(function(res) {
                    //  let rows = '';
                    // let categories = res.data.data; // মূল ডাটা
                    let perPage = res.data.per_page; // প্রতি পেজে কত ডাটা
                    let currentPage = res.data.current_page; // কোন পেজে আছি
                    let startSerial = (currentPage - 1) * perPage + 1; // সিরিয়াল শুরু হবে এখান থেকে

                    let TableFetchData = '';
                    res.data.data.forEach(function(cat, index) {
                        TableFetchData += `
                <tr id="row-${cat.id}">
                    <td>${startSerial + index}</td>
                    <td id="name-${cat.id}">${cat.name}</td>
                    <td>
                        <button class="btn btn-primary" onclick="EditCategory(${cat.id}, '${cat.name}')">Edit</button>
                        <button onclick="deleteConfirmation(${cat.id})" class="btn btn-danger">Delete</button>
                        <button onclick="showCategory(${cat.id})" class="btn btn-warning">Show</button>
                      
                        <button onclick="viewCategory(${cat.id})">View</button>
                    </td>
                </tr>`;
                    });

                    document.getElementById("CategoryList").innerHTML = TableFetchData;

                    // Bootstrap Pagination
                    let paginationLinks = '';

                    if (res.data.prev_page_url) {
                        paginationLinks += `
                <li class="page-item">
                    <button class="page-link" onclick="GetAllCategory(${res.data.current_page - 1})">Previous</button>
                </li>`;
                    }

                    for (let i = 1; i <= res.data.last_page; i++) {
                        paginationLinks += `
                <li class="page-item ${i === res.data.current_page ? 'active' : ''}">
                    <button class="page-link" onclick="GetAllCategory(${i})">${i}</button>
                </li>`;
                    }

                    if (res.data.next_page_url) {
                        paginationLinks += `
                <li class="page-item">
                    <button class="page-link" onclick="GetAllCategory(${res.data.current_page + 1})">Next</button>
                </li>`;
                    }

                    document.getElementById("Pagination").innerHTML = paginationLinks;
                })
                .catch(function(error) {
                    console.log(error);
                });
        }

        GetAllCategory();



        // Store

        function storeCategory() {
            let name = document.getElementById('name').value;

            if (!name) {
                alert("Category name is required!");
                return;
            }

            axios.post(url + '/category', {
                    name: name
                })
                .then(res => {
                    document.getElementById('name').value = '';
                    showLoader();
                    // toasterMessage("success", "Category added successfully!","Category Update");
                    toasterMessage("success", "Category added successfully!", "Category");

                    GetAllCategory();
                    // setTimeout(function() {

                    //     // CustomMessage("success", "Category added successfully!");


                    // })
                    hideLoader();
                })
                .catch(err => {
                    alert("Something went wrong!");
                });
        }

        // Edit Category

        function EditCategory(id, oldName) {

            // let oldName = document.getElementById(`name-${id}`).innerHTML;


            // document.getElementById(`name-${id}`).innerHTML = `
        // <input type="text" id="editInput-${id}" class="form-control" value="${oldName}">`;

            // document.querySelector(`#row-${id} td:last-child`).innerHTML = `
        // <button class="btn btn-sm btn-success" onclick="UpdateCategory(${id})">Save</button>
        // <button class="btn btn-sm btn-secondary" onclick="GetAllCategory()">Cancel</button>`;


            // window.location.href = url + '/category/' + id + '/edit';
            // let EditCategory = document.getElementById('EditCategory' + id);

            document.getElementById(`name-${id}`).innerHTML = `
            <input type="text" id="editInput-${id}" class="form-control" value="${oldName}">`;

            document.querySelector(`#row-${id} td:last-child`).innerHTML = `
            <button class="btn btn-sm btn-success" onclick="UpdateCategory(${id})">Save</button>
            <button class="btn btn-sm btn-secondary" onclick="GetAllCategory()">Cancel</button>`;

        }

        // Update Category via Axios
        function UpdateCategory(id) {
            let newName = document.getElementById(`editInput-${id}`).value;
            axios.put(`${url + '/category'}/${id}`, {
                    name: newName
                })
                .then(() => {
                    GetAllCategory();
                    // toastr.success("Category updated successfully!");
                    CustomMessage("success", "Category updated successfully!");

                })
                .catch(() => toastr.error("Update failed!"));

        }

        // delete
        $('body').on('click', '#deleteRow', function() {
            // let id = $(this).data('id');
            // let url = base_url + '/category'+id;
            let id = $(this).attr('data-id');
            let url = base_url + '/category' + id;
            axios.delete(url).then(res => {
                GetAllCategory();
                toastr.error("Category deleted successfully!");
            })

        })


        // Delete Category
        function DeleteCategory(id) {
            axios.delete(`${url + '/category'}/${id}`)
                .then(() => {
                    GetAllCategory();
                    toastr.error("Category deleted successfully!");
                });
        }

        // const baseUrl = "http://127.0.0.1:8000"; // আপনার API base URL

        function deleteCategory(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won’t be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`${url + '/category'}/${id}`)
                        .then(res => {
                            Swal.fire(
                                "Deleted!",
                                "Category has been deleted.",
                                "success"
                            );
                            // Reload / remove row from table
                            document.getElementById("row-" + id).remove();
                            // GetAllCategory();
                        })
                        .catch(err => {
                            Swal.fire(
                                "Error!",
                                "Something went wrong!",
                                "error"
                            );
                            console.error(err);
                        });
                }
            });
        }


        // Redirect to single category page
        function viewCategory(id) {
            // window.location.href = "single-category/"+id; // Laravel route
            // axios.get(`${Baseurl}/category/${id}`)
            //     .then((res) => {
            //         console.log(res.data);
            //         // $("#category_id").val(res.data.id);
            //         // $("#category_name").val(res.data.category_name);
            //         // $("#categoryModal").modal("show");
            //          window.location.href = "single-category/"+id; // Laravel route
            //     })
            //     .catch((err) => {
            //         console.log(err);
            //         // alert("Something went wrong!");
            //         // toastr.error("Something went wrong!");
            //         // toastr.error("Something went wrong!");
            //     })

            window.location.href = "single-category/" + id;

        }
    </script>
@endpush
