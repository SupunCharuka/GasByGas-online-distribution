(() => {
    $(function () {
        let manage_business_table = $("#manage_business").DataTable({
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
                { data: "name", name: 'id', searchable: true },
                { data: "email", name: 'email', searchable: true, orderable: false },
                { data: "nic", name: 'nic', searchable: true, orderable: false },
                { data: "phone", name: 'phone', searchable: true, orderable: false },
                { data: "status", name: 'status', searchable: true, orderable: false },
                { data: "business_details", searchable: false, orderable: false },
                { data: "actions", searchable: false, orderable: false },
            ],
            columnDefs: [
                { targets: 7, className: "text-center" },
            ],
        });

        $(document).on("click", ".view-details", function () {
            let businessId = $(this).data("id");
            $.ajax({
                url: APP_URL + "/admin/manage-business/details/" + businessId,
                type: "GET",
                success: function (response) {
                    $("#business_name").text(response.business_name);
                    $("#business_reg_no").text(response.business_registration_number);
                    $("#business_status").text(response.status);
                    $("#business_owner").text(response.user.name);
                    $("#business_email").text(response.user.email);
                    $("#business_phone").text(response.user.phone);

                    if (response.certificate_file) {
                        $("#view_certificate").attr("href", "/storage/" + response.certificate_file).show();
                    } else {
                        $("#view_certificate").hide();
                    }

                    $("#businessDetailsModal").modal("show");
                }
            });
        });


        $(document).on("click", ".approve-business", function () {
            let businessId = $(this).data("id");

            // Use SweetAlert to confirm the action
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to approve this business?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, approve it!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: APP_URL + "/admin/manage-business/" + businessId + "/approve",
                        type: "POST",
                        data: { _token: $('meta[name="csrf-token"]').attr("content") },
                        success: function (response) {
                            Swal.fire(
                                'Approved!',
                                'The business has been approved.',
                                'success'
                            );
                            manage_business_table.draw();
                        },
                        error: function () {
                            Swal.fire(
                                'Error!',
                                'Something went wrong. Please try again.',
                                'error'
                            );
                        }
                    });
                }
            });
        });

        $(document).on("click", ".reject-business", function () {
            let businessId = $(this).data("id");

            // Use SweetAlert to confirm the action
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to reject this business?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, reject it!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: APP_URL + "/admin/manage-business/" + businessId + "/reject",
                        type: "POST",
                        data: { _token: $('meta[name="csrf-token"]').attr("content") },
                        success: function (response) {
                            Swal.fire(
                                'Rejected!',
                                'The business has been rejected.',
                                'error'
                            );
                            manage_business_table.draw();
                        },
                        error: function () {
                            Swal.fire(
                                'Error!',
                                'Something went wrong. Please try again.',
                                'error'
                            );
                        }
                    });
                }
            });
        });


    });
})();
