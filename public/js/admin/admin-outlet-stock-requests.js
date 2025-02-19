(() => {
    $(function () {
        let outlet_stock_requests_table = $("#outlet_stock_requests").DataTable({
            scrollX: true,
            destroy: true,
            processing: true,
            serverSide: true,
            fixedHeader: true,
            responsive: true,
            order: [[0, 'asc']],
            ajax: location.href,
            columns: [
                { data: "id", name: "id", searchable: true },
                { data: "outlet_name", name: "outlet_name", searchable: true },
                { data: "empty_cylinders", name: "empty_cylinders", searchable: false },
                { data: "filled_cylinders", name: "filled_cylinders", searchable: false },
                { data: "requested_cylinders", name: "requested_cylinders", searchable: false },
                { data: "requested_at", name: "requested_at", searchable: false },
                { data: "status", name: "status", searchable: true },
                { data: "action", name: "action", orderable: false, searchable: false },
            ],
            columnDefs: [
                { targets: 7, className: "text-center" },
            ],
        });

        // Handle Approve Button Click
        $(document).on('click', '.approve-request', function () {
            let outletStockRequest = $(this).data('id');
            
            $.ajax({
                url: APP_URL + "/admin/outlet-stock-requests/" + outletStockRequest + "/approve",
                type: "POST",
                data: {
                   outletStockRequest,
                },
                dataType: "JSON",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire("Done!", response.message, "success");
                        outlet_stock_requests_table.draw();
                    } else {
                        Swal.fire("Error!", "Something went wrong!", "error");
                    }
                },
        
                error: function (xhr) {
                    let errorMessage = "An error occurred. Please try again.";
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    Swal.fire("Error!", errorMessage, "error");
                },
            });
        });

        // Handle Reject Button Click
        $(document).on('click', '.reject-request', function () {
            let outletStockRequest = $(this).data('id');
            $.ajax({
                url: APP_URL + "/admin/outlet-stock-requests/" + outletStockRequest + "/reject",
                type: "POST",
                data: {
                     outletStockRequest,
                },
                dataType: "JSON",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire("Done!", response.message, "success");
                        outlet_stock_requests_table.draw();
                    } else {
                        Swal.fire("Error!", "Something went wrong!", "error");
                    }
                },
        
                error: function (xhr) {
                    let errorMessage = "An error occurred. Please try again.";
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    Swal.fire("Error!", errorMessage, "error");
                },
            });
        });
    });
})();
