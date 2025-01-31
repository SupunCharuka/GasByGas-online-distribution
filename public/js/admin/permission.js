(() => {
    $(function () {
        let permission_table = $("#permissions").DataTable();

        Livewire.on('permission-created', ({ permission }) => {
            let action_edit = `<a class="btn btn-sm btn-primary"
                        href="${APP_URL}/admin/permission/${permission.id}/edit">
                        <i class="fa fa-pencil"></i>
                    </a>`;
            let action_delete = `<a class="btn btn-sm delete-permission btn-danger"
                            data-permission="${permission.id}"
                            id="permission-${permission.id}" href="javascript:void(0)">
                            <i class="fa fa-trash"></i>
                        </a>`;
            let added_row = permission_table.row
                .add([
                    permission.id,
                    permission.name,
                    action_edit + " " + action_delete,
                ])
                .node();

            added_row.id = "permission-record-" + permission.id;
            added_row.cells[2].classList.add("text-center");
            permission_table.draw();
            $("html, body").animate({ scrollTop: 0 }, 200);
        });

        $(document).on("click", ".delete-permission", function (e) {
            e.preventDefault();
            __this = $(this);
            let permission_id = $(this).data("permission");
            Swal.fire({
                title: "Are You Sure?",
                text: "Are you want to delete this permission?",
                icon: "warning",
                showCancelButton: true,
            }).then((willDelete) => {
                if (willDelete.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: APP_URL + "/admin/permission/" + permission_id,
                        data: {
                            permission_id,
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
                                    permission_table
                                        .rows(
                                            "#permission-record-" +
                                                permission_id
                                        )
                                        .remove()
                                        .draw();
                            else console.error(response.message);
                        },
                        error: function(response) {
                            Swal.fire("Error!", 'Something went wrong.', "error");
                        }
                    });
                }
            });
        });
    });
})();
