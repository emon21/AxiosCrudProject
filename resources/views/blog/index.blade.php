@extends('layouts.app', ['title' => 'Blog Page'])
@section('content')
    <div class="col-sm-10 mt-2">
        <div class="card">
            <div class="card-header bg-success d-flex justify-content-start align-items-center text-white">
                <h4>Blog Page</h4>
                <button type="button" class="btn btn-outline-success border border-light text-white ms-auto"
                    data-bs-toggle="modal" data-bs-target="#createBlogModal">Create Blog</button>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
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
    </div>
    <!-- Create Modal -->
    <div class="modal fade modal-lg" id="createBlogModal" tabindex="-1" aria-labelledby="CreateModalLabel"
        aria-hidden="true">
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
                        <textarea class="form-control mt-1" name="description" id="description" cols="10" rows="7"
                            placeholder="Description"></textarea>
                    </div>
                    <div class="form-group mb-1">
                        <label for="name">Status</label>
                        <input type="text" class="form-control mt-1" id="status" placeholder="Status">
                    </div>
                    <button class="btn btn-success my-2" onclick="CreateBlog()">Create</button>
                </div>

            </div>
        </div>
    </div>
    <!-- Close Modal -->

    <!-- show modal -->

    <div class="modal fade modal-lg" id="showModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">Blog Details :</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-striped">
                        <tbody id="showModalBody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- show modal End -->


    <!-- Edit modal -->

    <!-- Edit modal End -->
@endsection
@push('scripts')
    <script>
        let Path_URL = window.location.origin;
        // All Blog List

        async function AllBlogList() {
            const BlogData = await axios.get(Path_URL + "/blog");
            table_data_row(BlogData.data);

        }
        AllBlogList();

        const table_data_row = (items) => {

            let loop = items.map((item, index) => {
                return `<tr>
                <td>${index + 1}</td>
                <td>${item.title}</td>
                <td>${item.description}</td>
                <td>${item.status}</td>
                <td>
                    <button class="btn btn-primary" onclick="EditCategory(${item.id}, '${item.title}')">Edit</button>
                    <button onclick="DeleteBlog(${item.id})" class="btn btn-danger">Delete</button>
                    <button class="btn btn-warning" data-id="${item.id}" data-bs-toggle="modal" data-bs-target="#showModal" id="viewRow">Show</button>
                </td>
            </tr>`

            });

            loop = loop.join("");
            const tbody = document.querySelector('#BlogList');
            tbody.innerHTML = loop;

            // document.getElementById("BlogList").innerHTML = loop;
        }

        //  Create Blog


        function CreateBlog() {

            let title = document.getElementById('title').value;
            let description = document.getElementById('description').value;
            let status = document.getElementById('status').value;

            axios.post(`${BASE_URL}/blog`, {
                    title: title,
                    description: description,
                    status: status
                })
                .then(res => {

                    document.getElementById('title').value = '';
                    document.getElementById('description').value = '';
                    document.getElementById('status').value = '';

                    showLoader();
                    toasterMessage("success", "Blog Created successfully!!", "Success");
                    // closeCreateModal();

                    // ✅ Modal Auto Close
                    const modal = document.getElementById("createBlogModal");
                    const modalInstance = bootstrap.Modal.getInstance(modal);
                    modalInstance.hide();

                    hideLoader();

                    // ✅ টেবিল আবার লোড
                    AllBlogList();



                })
                .catch(err => {
                    toasterMessage("error", "Failed to add blog!", "Error");
                });
            // .finally(() => {
            //     hideLoader();
            // });
        }

        //  Show data
        $('body').on('click', '#viewRow', function() {

            // let slug = document.getElementById('data-id')

            // let slug = $(this).attr('data-id')
            let id = $(this).data('id')
            console.log(id);

            let url = BASE_URL + '/blog/' + id;

            axios.get(url).then(res => {

                // console.log(res.data);
                let response = `
                            <tr>
                            <th class="w-25">Name : </th>
                            <td class="w-75">${res.data.title}</td>
                             </tr>
                             <tr>
                            <th>Description : </th>
                            <td>${res.data.description}</td>
                             </tr>
                             <tr>
                            <th>Status : </th>
                            <td>${res.data.status}</th>
                            </tr>
                            `
                let tbdy = document.querySelector('#showModalBody');
                tbdy.innerHTML = response;

            });

            // let id = $(this).attr('data-id');
            // axios.get(`${BASE_URL}/blog/${id}`).then(res => {

            // })
        });


        // Delete Blog

        function DeleteBlog(id) {
            axios.delete(`${BASE_URL}/blog/${id}`)
                .then(() => {
                    toasterMessage("success", "Blog deleted successfully!", "Delete");
                    AllBlogList();
                })
                .catch(() => {
                    toasterMessage("error", "Delete failed!", "Sorry");
                })

        }
    </script>
@endpush
