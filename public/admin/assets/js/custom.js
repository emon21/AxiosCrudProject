// const Baseurl = "http://127.0.0.1:8000";
const Baseurl = window.location.origin;

const BASE_URL = window.location.origin;

function showLoader() {
    document.getElementById("loader").style.display = "flex";
    document.getElementById("content").style.display = "none";
}

function hideLoader() {
    document.getElementById("loader").style.display = "none";
    document.getElementById("content").style.display = "block";
}

function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
}

// using html

function customAlert() {
    document.getElementById("customAlert").style.display = "block";
}

function closeCustomAlert() {
    document.getElementById("customAlert").style.display = "none";
}

function CustomMessage(icon, message) {
    //  Swal.fire({
    //      position: "top-end",
    //      icon: icon,
    //      text: message,
    //      showConfirmButton: false,
    //      timer: 1500,
    //  });

    Swal.fire({
        // position: "top-end",
        title: message,
        //  text: "You clicked the button!",
        icon: icon,
        showConfirmButton: false,
        timer: 1000,
    });
}

// delete confirmation in sweetAlert
function deleteConfirmation(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
        // showConfirmButton: false,
        // timer: 1000,
    }).then((result) => {
        if (result.isConfirmed) {
            axios
                .delete(`${Baseurl}/category/${id}`)
                .then((res) => {
                    Swal.fire(
                        "Deleted!",
                        "Category has been deleted successfully.",
                        "success"
                    );

                   // CustomMessage("success", "Category has been deleted successfully.");

                    // টেবিল থেকে row remove করুন
                    document.getElementById("row-" + id).remove();
                   
                })
                .catch((error) => {
                    Swal.fire(
                        "Error!",
                        "Something went wrong while deleting.",
                        "error"
                    );
                    console.error(error);
                });
            // document.getElementById("row-" + id).remove();

            // GetAllCategory();
        }
    });
}

// Show category modal

function showCategory(id) {
    console.log(id);
    axios
        .get(`${Baseurl}/category/${id}`)
        .then((res) => {
            console.log(res.data);
            // $("#category_id").val(res.data.id);
            // $("#category_name").val(res.data.category_name);
            // $("#categoryModal").modal("show");
            //other page redirect
            // window.location.href = "single-category";
        })
        .catch((error) => {
            console.error(error);
        });
}

// Toast message


function toasterMessage(type, message, title = "") {
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: "toast-top-right",
        timeOut: "3000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
    };

    // Type অনুযায়ী toastr call
    switch (type) {
        case "success":
            toastr.success(message, title);
            break;
        case "error":
            toastr.error(message, title);
            break;
        case "info":
            toastr.info(message, title);
            break;
        case "warning":
            toastr.warning(message, title);
            break;
        default:
            toastr.info(message, title);
    }

    // if (type == "success") {
    //     toastr.success(message, title);
    // } else if (type == "error") {
    //     toastr.error(message);
    // } else if (type == "info") {
    //     toastr.info(message);
    // } else if (type == "warning") {
    //     toastr.warning(message);
    // }
}

