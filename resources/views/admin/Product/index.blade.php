@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Product Management</h2>

        <div class="d-flex gap-2">
            <input type="text" id="name" placeholder="Product Name" class="form-control">
            <input type="number" id="price" placeholder="Price" class="form-control">
            <select id="category_id" class="form-control"></select>
        </div>
        <button class="btn btn-success my-2" onclick="createProduct()">Add Product</button>

        <table id="productTable" border="1" cellpadding="10" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <!-- Edit Product Modal -->
    {{-- <div id="editModal"
        style="display:none; position:fixed; top:20%; left:30%; background:#fff; padding:20px; border:1px solid #ddd; z-index:1000;">
        <h3>Edit Product</h3>
        <input type="hidden" id="edit_id">
        <input type="text" id="edit_name" placeholder="Product Name">
        <input type="number" id="edit_price" placeholder="Price">
        <select id="edit_category_id"></select>
        <br><br>
        <button onclick="updateProduct()">Update</button>
        <button onclick="closeEditModal()">Close</button>
    </div> --}}

    <!-- The Modal -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Product Information</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <h3>Edit Product</h3>
                    <div class="d-flex gap-3">
                        <input type="hidden" id="edit_id">
                        <input type="text" id="edit_name" placeholder="Product Name" class="form-control">
                        <input type="number" id="edit_price" placeholder="Price" class="form-control">
                        <select id="edit_category_id" class="form-control"></select>
                    </div>
                    <br><br>
                    <button class="btn btn-success" onclick="updateProduct()">Update</button>
                    <button class="btn btn-danger" onclick="closeEditModal()">Close</button>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        //   const Baseurl = "{{ url('/product') }}";

        // const url = window.location.origin;
        let url = "{{ url('/category') }}";
        console.log(BASE_URL);


        // Load categories in dropdown

        function loadCategories() {
            axios.get(`${BASE_URL}/category`).then(res => {
                // console.log(res.data);

                let options = 'Select Category';
                res.data.forEach(cat => {
                    options += `<option value="${cat.id}">${cat.name}</option>`;
                });
                document.getElementById("category_id").innerHTML = options;
            });
        }

        // Load products

        function loadProducts() {
            axios.get(`${BASE_URL}/product`).then(res => {
                let rows = '';
                res.data.forEach((product, index) => {
                    rows += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${product.name}</td>
                    <td>${product.price}</td>
                    <td>${product.category.name}</td>
                    <td>
                        <button class="btn btn-sm btn-danger" onclick="deleteProduct(${product.id})">Delete</button>

                        <button onclick="openEditModal(${product.id})" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                    </td>
                </tr>
            `;
                });
                document.querySelector("#productTable tbody").innerHTML = rows;
            });
        }


        // Create product
        function createProduct() {
            let name = document.getElementById("name").value;
            let price = document.getElementById("price").value;
            let category_id = document.getElementById("category_id").value;

            axios.post(`${BASE_URL}/product`, {
                    name,
                    price,
                    category_id
                })
                .then(res => {
                    document.getElementById("name").value = "";
                    document.getElementById("price").value = "";
                    document.getElementById("category_id").value = "Select Category";

                    showLoader();
                    toasterMessage("success", "Product added successfully!", "Success");
                    loadProducts();
                    hideLoader();

                })
                .catch(err => {
                    toasterMessage("error", "Failed to add product!", "Error");
                });
        }


        // Edit Product
        function loadCategoriesForEdit(selectedId = null) {
            axios.get(`${Baseurl}/category`).then(res => {
                let options = '';
                res.data.forEach(cat => {
                    let selected = selectedId == cat.id ? "selected" : "";
                    options += `<option value="${cat.id}" ${selected}>${cat.name}</option>`;
                });
                document.getElementById("edit_category_id").innerHTML = options;
            });
        }

        function openEditModal(productId) {
            axios.get(`${Baseurl}/product/${productId}`)
                .then(res => {
                    const product = res.data;
                    document.getElementById("edit_id").value = product.id;
                    document.getElementById("edit_name").value = product.name;
                    document.getElementById("edit_price").value = product.price;
                    loadCategoriesForEdit(product.category_id); // set selected category
                    document.getElementById("editModal").style.display = "block";
                })
                .catch(err => {
                    toasterMessage("error", "Failed to load product!", "Error");
                });
        }

        function closeEditModal() {
            // document.getElementById("editModal").style.display = "none";

            const modalEl = document.getElementById('editModal');
            const modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();

        }


        function updateProduct() {
            let id = document.getElementById("edit_id").value;
            let name = document.getElementById("edit_name").value;
            let price = document.getElementById("edit_price").value;
            let category_id = document.getElementById("edit_category_id").value;
            

            axios.put(`${Baseurl}/product/${id}`, {
                    name,
                    price,
                    category_id
                })
                .then(res => {

                    // data = res.data;

                    name.value = "";
                    price.value = "";
                    category_id.value = "";


                    toasterMessage("success", "Product updated successfully!", "Success");
                    closeEditModal();
                    loadProducts(); // reload table

                })
                .catch(err => {
                    toasterMessage("error", "Failed to update product!", "Sorry");
                });
        }



        // function EditProduct(id) {
        //     axios.get(`${BASE_URL}/product/${id}`).then(res => {
        //         document.getElementById("edit_id").value = res.data.id;
        //         document.getElementById("edit_name").value = res.data.name;
        //         document.getElementById("edit_price").value = res.data.price;
        //         document.getElementById("edit_category_id").value = res.data.category_id;
        //         document.getElementById("editModal").style.display = "block";
        //     });
        // }

        // Delete product
        function deleteProduct(id) {
            axios.delete(`${BASE_URL}/product/${id}`)
                .then(res => {

                    toasterMessage("success", "Product deleted!", "Deleted");
                    loadProducts();


                })
                .catch(err => {
                    toasterMessage("error", "Failed to delete!", "Error");
                });
        }

        // Init
        loadCategories();
        loadProducts();
    </script>
@endpush
