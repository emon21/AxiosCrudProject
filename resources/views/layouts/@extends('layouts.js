@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Product Management</h2>

    <input type="text" id="name" placeholder="Product Name">
    <input type="number" id="price" placeholder="Price">
    <select id="category_id"></select>
    <button onclick="createProduct()">Add Product</button>

    <table id="productTable" border="1" cellpadding="10">
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

<script>
const Baseurl = "{{ url('/api') }}";

// Load categories in dropdown
function loadCategories() {
    axios.get(`${Baseurl}/categories`).then(res => {
        let options = '';
        res.data.forEach(cat => {
            options += `<option value="${cat.id}">${cat.name}</option>`;
        });
        document.getElementById("category_id").innerHTML = options;
    });
}

// Load products
function loadProducts() {
    axios.get(`${Baseurl}/products`).then(res => {
        let rows = '';
        res.data.forEach((product, index) => {
            rows += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${product.name}</td>
                    <td>${product.price}</td>
                    <td>${product.category.name}</td>
                    <td>
                        <button onclick="deleteProduct(${product.id})">Delete</button>
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

    axios.post(`${Baseurl}/products`, { name, price, category_id })
        .then(res => {
            toasterMessage("success", "Product added successfully!", "Success");
            loadProducts();
        })
        .catch(err => {
            toasterMessage("error", "Failed to add product!", "Error");
        });
}

// Delete product
function deleteProduct(id) {
    axios.delete(`${Baseurl}/products/${id}`)
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
@endsection
