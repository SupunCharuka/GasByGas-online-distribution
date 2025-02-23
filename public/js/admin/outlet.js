(() => {
    $(function () {
        let outlet_table = $("#outlets").DataTable();

        Livewire.on('outlet-created', ({ outlet }) => {
           
            
            let action_edit = `<a class="btn btn-sm btn-primary"
                        href="${APP_URL}/admin/outlet/${outlet.id}/edit">
                        <i class="fa fa-pencil"></i>
                    </a>`;
            let action_delete = `<a class="btn btn-sm delete-outlet btn-danger"
                            data-outlet="${outlet.id}"
                            id="outlet-${outlet.id}" href="javascript:void(0)">
                            <i class="fa fa-trash"></i>
                        </a>`;
            let added_row = outlet_table.row
                .add([
                    outlet.id,
                    outlet.name,
                    outlet.district,
                    outlet.address,
                    outlet.contact_number,
                    outlet.total_empty_cylinders,
                    outlet.stock,
                    action_edit + " " + action_delete,
                ])
                .node();

            added_row.id = "outlet-record-" + outlet.id;
            added_row.cells[7].classList.add("text-center");
            outlet_table.draw();
            $("html, body").animate({ scrollTop: 0 }, 200);
        });

        $(document).on("click", ".delete-outlet", function (e) {
            e.preventDefault();
            __this = $(this);
            let outlet_id = $(this).data("outlet");
            Swal.fire({
                title: "Are You Sure?",
                text: "Are you want to delete this outlet?",
                icon: "warning",
                showCancelButton: true,
            }).then((willDelete) => {
                if (willDelete.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: APP_URL + "/admin/outlet/" + outlet_id,
                        data: {
                            outlet_id,
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
                                    outlet_table
                                        .rows(
                                            "#outlet-record-" +
                                                outlet_id
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
