(() => {
    $(function () {
        let user_table = $("#user").DataTable({
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
                { data: "roles", searchable: false, orderable: false },
                { data: "actions", searchable: false, orderable: false },
            ],
            columnDefs: [
                { targets: 4, className: "text-center" },
            ],
        });



        $(document).on("click", ".delete-user", function (e) {
            e.preventDefault();
            __this = $(this);
            let user_id = $(this).data("user");
            Swal.fire({
                title: "Are You Sure?",
                text: "Are you want to delete this user?",
                icon: "warning",
                showCancelButton: true,
            }).then((willDelete) => {
                if (willDelete.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: APP_URL + "/admin/manage-user/" + user_id,
                        data: {
                            user_id,
                        },
                        dataType: "JSON",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        success: function (response) {
                            console.log(response);
                            if (response.status == "deleted")
                                Swal.fire("Done!", response.message, "success"),
                                    user_table
                                        .rows("#user-record-" + user_id)
                                        .remove()
                                        .draw();
                            else console.error(response.message);
                        },
                        error: function (response) {
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

        $(document).on("click", ".suspend-user", function (e) {
            e.preventDefault();

            const user_id = $(this).data("user");
            const is_suspended = $(this).data("suspended");

            Swal.fire({
                title: `Are you sure you want to ${is_suspended ? 'unsuspend' : 'suspend'} this user?`,
                text: is_suspended ? "The user will be able to access the system again." : "The user will be suspended from accessing the system.",
                icon: is_suspended ? "info" : "warning",
                showCancelButton: true,
                confirmButtonText: is_suspended ? "Yes, unsuspend!" : "Yes, suspend!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: APP_URL + `/admin/manage-user/${user_id}/suspend`,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                        success: function (response) {
                            Swal.fire("Done!", response.message, "success");
                            user_table.draw();
                        },
                        error: function () {
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

    });
})();
