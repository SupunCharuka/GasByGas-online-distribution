(() => {
    $(function () {
        let role_table = $("#roles").DataTable();
        Livewire.on('role-created', ({ role }) => {
            let action_edit = `<a class="btn btn-sm btn-primary"
                        href="${APP_URL}/admin/role/${role.id}/edit">
                        <i class="fa fa-pencil"></i>
                    </a>`;
            let action_delete = `<a class="btn btn-sm delete-role btn-danger"
                            data-role="${role.id}"
                            id="role-${role.id}" href="javascript:void(0)">
                            <i class="fa fa-trash"></i>
                        </a>`;
            let added_row = role_table.row
                .add([
                    role.id, 
                    role.name,
                    action_edit + " " + action_delete,
                ])
                .node();

            added_row.id = "role-record-" + role.id;
            added_row.cells[2].classList.add("text-center");
            role_table.draw();
            $("html, body").animate({ scrollTop: 0 }, 200);
        });

        $(document).on("click", ".delete-role", function (e) {
            e.preventDefault();
            __this = $(this);
            let role_id = $(this).data("role");
            Swal.fire({
                title: "Are You Sure?",
                text: "Are you want to delete this role?",
                icon: "warning",
                showCancelButton: true,
            }).then((willDelete) => {
                if (willDelete.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: APP_URL + "/admin/role/" + role_id,
                        data: {
                            role_id,
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
                                role_table
                                    .rows("#role-record-" + role_id)
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
