// Usage: This script is for gas request listing page.
(() => {
    $(function () {
        let gasRequest_table = $("#gas-requests").DataTable({

            scrollX: true,
            destroy: true,
            processing: true,
            serverSide: true,
            fixedHeader: true,
            responsive: true,
            order: [[0, "asc"]],
            ajax: location.href,
            columns: [
                { data: "id", name: "id", searchable: true },
                { data: "outlet", name: "outlet", searchable: true },
                { data: "quantity", name: "quantity", searchable: true },
                { data: "status", name: "status", searchable: true },
                { data: "created_at", name: "created_at", searchable: true },
                { data: "actions", searchable: false, orderable: false },
            ],
            columnDefs: [{ targets: 5, className: "text-center" }],
        });

        Livewire.on('gasRequest-created', ({ gasRequest }) => {
            gasRequest_table.clear().rows.add(gasRequest).draw();
            $("html, body").animate({ scrollTop: 0 }, 200);
        });

        $(document).on("click", ".cancel-gas-request", function (e) {
            e.preventDefault();
            let gasRequest_id = $(this).data("gasrequest"); // Ensure data attribute is correctly referenced

            Swal.fire({
                title: "Are You Sure?",
                text: "Are you sure you want to cancel this request?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, Cancel it!",
                cancelButtonText: "No, Keep it",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "/user/gas-request/" + gasRequest_id + "/cancel",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr("content"), // CSRF Token
                        },
                        dataType: "JSON",
                        success: function (response) {
                            if (response.status === "rejected") {
                                Swal.fire("Cancelled!", response.message, "success");
                                gasRequest_table.ajax.reload(null, false); // Reload DataTable
                            } else {
                                Swal.fire("Error!", response.message, "error");
                            }
                        },
                        error: function () {
                            Swal.fire("Error!", "Something went wrong.", "error");
                        },
                    });
                }
            });
        });

        $(document).on('click', '.show-token', function() {
            let requestId = $(this).data('id');
    
            $.ajax({
                url: "/user/gas-requests/token/" + requestId,
                type: "GET",
                success: function(response) {
                    if (response.success) {
                        $("#tokenNumber").text(response.token_number);
                        $("#tokenIssuedAt").text(response.token_issued_at);
                        $("#tokenStatus").html(response.status);
                        $("#tokenModal").modal("show");
                    } else {
                        alert("Token not available.");
                    }
                },
                error: function() {
                    alert("An error occurred while fetching token details.");
                }
            });
        });

    });
})();
