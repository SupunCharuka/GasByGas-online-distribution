(() => {
    $(function () {
        let gas_requests_table = $("#gas_requests").DataTable({
            scrollX: true,
            destroy: true,
            processing: true,
            serverSide: true,
            fixedHeader: true,
            responsive: true,
            order: [[0, 'asc']],
            ajax: location.href,
            columns: [
                { data: "id", name: 'id', searchable: true },
                { data: "customer", name: 'customer', searchable: true, orderable: false },
                { data: "quantity", name: 'quantity', searchable: true, orderable: false },
                { data: "status", name: 'status', searchable: true, orderable: false },
                { data: "created_at", name: 'created_at', searchable: true, orderable: false },
                { data: "expected_pickup_date", name: 'expected_pickup_date', searchable: false, orderable: false },
                { data: "actions", searchable: false, orderable: false },
            ],
            columnDefs: [
                { targets: 6, className: "text-center" },
            ],
        });

        $(document).ready(function () {
            
            // Approve Button Click Event
            $(document).on("click", ".approve-btn", function () {
                let id = $(this).data("id");
                changeStatus(id, "accepted");
            });

            // Reject Button Click Event
            $(document).on("click", ".reject-btn", function () {
                let id = $(this).data("id");
                changeStatus(id, "rejected");
            });

            function changeStatus(id, status) {
                $.ajax({
                    url: APP_URL + "/admin/gas-requests/update-status/" + id,
                    type: "POST",
                    data: {
                        status: status,
                    },
                    dataType: "JSON",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (response) {
                        Swal.fire("Done!", response.message, "success"),
                            gas_requests_table.ajax.reload();
                    },
                    error: function (xhr) {
                        Swal.fire(
                            "Error!",
                            "Something went wrong.",
                            "error"
                        );
                    },
                });
            }
        });
    });
})();
