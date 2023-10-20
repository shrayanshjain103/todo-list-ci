<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ToDo List - Codeigniter 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.css">

</head>
<style>
    #add_task {
        display: flex;
        justify-content: end;
    }

    #todobar {
        background-color: gray;
        margin: 2px;
        padding: 1px;
        border-radius: 5px;
        text-align: center;
        color: white;
    }
</style>

<body>
    <div class="container mt-5">
        <div id="todobar">
            <h2 class="mb-4">To-Do List</h2>
        </div>
        <br>
        <div class="mb-3" id='add_task'>
            <a href="#" class="btn btn-primary" id="openTaskForm">Add Task</a>
        </div>
        <br>
        <table id="tasksTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>status</th>
                    <th>Edit Information</th>
                    <!-- <th>Delete Information</th> -->
                </tr>
            </thead>
            <tbody>
                <!-- Data rows will be populated via DataTables AJAX -->
            </tbody>
        </table>
    </div>
    <div class="modal " id="newModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form id="save" action="" method="post">
                        <div class="container">
                            <label for="task" style="font-weight: bold;">Task:</label>
                            <input type="text" id="task" name="task" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 10px;">
                            <span id="task-error" style="color: red;"></span>
                        </div>
                        <br>
                        <div class="container">
                            <label for="discription" style="font-weight: bold;">Description:</label>
                            <input type="text" id="Discription" name="discription" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 10px;">
                            <span id="discription-error" style="color: red;"></span>
                        </div>
                        <br>
                        <div>
                            <select id="status" name="status" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 10px;">
                                <option style="font-weight: bold;">Select Status</option>
                                <option value="1" style="font-weight: bold; color: green;">Completed</option>
                                <option value="0" style="font-weight: bold; color: red;">Incomplete</option>
                            </select>
                            <span id="status-error" style="color: red;"></span>
                        </div>

                </div>
                <div class="modal-footer pop">
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                    <button type="submit" class="btn btn-primary " style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 10px;">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="editModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="editModalLabel">Edit Question</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add your form elements for editing here -->
                    <form id="editForm" action="" method="post">
                        <br>
                        <div>
                            <label for="editTask" style="font-weight: bold;">Edit the Task:</label>
                            <input type="text" id="editTask" name="title" val="" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 10px;" />
                            <input type="text" id="taskid" name="id" val="" hidden />
                            <span id="editTask-error" style="color:red"></span>
                        </div>
                        <br>
                        <div>
                            <label for="Discription" style="font-weight: bold;">Edit the Discription:</label>
                            <input type="text" id="editDiscription" name="discription" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 10px;" />
                            <span id="editDiscription-error" style="color:red"></span>
                        </div>
                        <br>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="saveEdit">Save Changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        //Ajax used to show table data in datatable
        $(document).ready(function() {
            var dataTable = $('#tasksTable').DataTable({
                "paging": true,
                "lengthMenu": [
                    [1, 2, 3, 4, 25, 50, 75, 100, -1],
                    [1, 2, 3, 4, 25, 50, 75, 100, 'All']
                ],
                columnDefs: [{
                    orderable: false,
                    targets: [-1, -2, -3]
                }],

                "ajax": {
                    "url": "<?= base_url('Todo_controller/showData') ?>",
                    "type": "POST",
                    "dataType": "json",
                    // dataSrc: ""
                },
                "columns": [{
                        data: "title"
                    },
                    {
                        data: "discription"
                    },
                    {
                        data: "status",
                        "render": function(data, type, row) {
                            if (data == 0) {
                                return '<button class="btn btn-warning" onclick="changestat(' + row.id + ',0)">Incomplete</button>';
                            } else {
                                return '<button class="btn btn-success"  onclick="changestat(' + row.id + ',1)">Completed</button>';
                            }
                        }
                    },
                    {
                        data: null,
                        "render": function(data, type, row) {
                            return '<button class="btn btn-info edit-btn shrayansh" data-id="' + data.id + '">Edit</button>&nbsp; <button class="btn btn-danger btn-delete" data-id="' + data.id + '">Delete</button>';
                        }
                    },
                    // {
                    //     "data": null,
                    //     "render": function(data, type, row) {
                    //         return '<button class="btn btn-danger btn-delete" data-id="' + data.id + '">Delete</button>';
                    //     }
                    // }
                ]
            });

            //Ajax used to Add the task
            $("#openTaskForm").click(function() {
                $("#newModal").modal('show');
            });
            // $("#save").submit(function(event) {
            //     event.preventDefault();
            //     var formData = $(this).serialize();
            //     $.ajax({
            //         type: "POST",
            //         url: "<?php echo base_url(); ?>Todo_Controller/addnewTask",
            //         dataType: "json",
            //         data: formData,
            //         success: function(res) {
            //             console.log(res);
            //             if (res == 1) {
            //                 $('#newModal').hide();
            //                 setTimeout(function() {
            //                     window.location.reload(); // Reload the DataTable after successful deletion
            //                 }, 1000);
            //                 toastr.info('Info: Task Insertion Successful', 'Task Added');
            //                 // alert("Task inserted Successfully");
            //                 // Swal.fire('Success', 'Task inserted Successfully', 'success');
            //                 // window.location.reload();
            //             } else {
            //                 $('#newModal').hide();
            //                 // alert("Task inserted Unsuccessful");
            //                 // Swal.fire('Success', 'Task inserted Successfully', 'success');
            //                 setTimeout(function() {
            //                     window.location.reload(); // Reload the DataTable after successful deletion
            //                 }, 1000);
            //                 toastr.warning('Deleted: Task Insertion Unsuccessful', 'Task Not added');
            //                 // window.location.reload();

            //             }
            //         }

            //     });

            // });
            // Ajax used to Add the task
            $("#save").submit(function(event) {
                event.preventDefault();
                if (!validateAddTaskForm()) {
                    return;
                }
                var formData = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>Todo_Controller/addnewTask",
                    dataType: "json",
                    data: formData,
                    success: function(res) {
                        console.log(res);
                        if (res == 1) {
                            $('#newModal').modal('hide'); // Close the modal on successful submission
                            setTimeout(function() {
                                window.location.reload(); // Reload the DataTable after successful submission
                            }, 1000);
                            toastr.info('Info: Task Insertion Successful', 'Task Added');
                        } else {
                            toastr.warning('Info: Task Insertion Unsuccessful', 'Task Not Added');
                        }
                    }
                });
            });



            //Ajax used to delete the task
            // $('#tasksTable').on('click', '.btn-delete', function() {
            //     var taskId = $(this).data('id');
            //     $.ajax({
            //         url: '<?php echo base_url('Todo_controller/deleteTask'); ?>',
            //         method: 'POST',
            //         data: {
            //             id: taskId
            //         },
            //         dataType: 'json',
            //         success: function(data) {
            //             if (data == 1) {
            //                 // alert('Task deletion succesfully');
            //                 // window.location.reload();
            //                 setTimeout(function () {
            //                     window.location.reload(); // Reload the DataTable after successful deletion
            //                 }, 1000);
            //                 toastr.info('Info: Task Deletion Successful', 'Task Deleted');
            //             } else {
            //                 // alert('Task deletion succesfully');
            //                 // window.location.reload();
            //                 setTimeout(function () {
            //                     window.location.reload(); // Reload the DataTable after successful deletion
            //                 }, 1000);
            //                 toastr.warning('Info: Task Deletion Unsuccessful', 'Task Not Deleted');
            //             }
            //         },
            //         error: function() {
            //             // Handle AJAX error here
            //             alert("An error occurred while fetching topics.");
            //         }
            //     });
            // });


            //Ajax used to delete the task
            $('#tasksTable').on('click', '.btn-delete', function() {
                var taskId = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this task!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '<?php echo base_url('Todo_controller/deleteTask'); ?>',
                            method: 'POST',
                            data: {
                                id: taskId
                            },
                            dataType: 'json',
                            success: function(data) {
                                if (data) {
                                    // Reload the DataTable after successful deletion
                                    toastr.warning('Deleted: successful', 'Delete');
                                    dataTable.ajax.reload();
                                } else {
                                    toastr.error('Failed to delete task', 'Failed');
                                    dataTable.ajax.reload();
                                }
                            },
                            error: function() {
                                toastr.error('An error occurred while deleting the task', 'Failed');
                            }
                        });
                    }
                });
            });

            //Ajax used to append the task data in edit modal
            $('.close').click(function() {
                $('#editModal').modal('hide');
            });
            $(document).on('click', '.edit-btn', function() {
                var id = $(this).attr('data-id');
                $('#taskid').val(id);
                $("#editModal").modal('show');
                $.ajax({
                    url: "<?php echo base_url() ?>Todo_controller/showInfo",
                    data: {
                        id: id
                    },
                    method: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        $('#editTask').val(data.title);
                        $('#editDiscription').val(data.discription);
                    }
                });
            });
            //Ajax used to Edit the task
            // $("#editForm").submit(function(event) {
            //     event.preventDefault();
            //     var formData = $(this).serialize();
            //     var id = $('#taskid').val();
            //     $.ajax({
            //         url: "<?php echo base_url(); ?>Todo_controller/editTask",
            //         data: formData,
            //         //    dataType:"json",
            //         method: 'POST',
            //         success: function(data) {
            //             if (data == 1) {
            //                 // alert('Task Updation succesfully');
            //                 // window.location.reload();
            //                 setTimeout(function() {
            //                     window.location.reload(); // Reload the DataTable after successful deletion
            //                 }, 1000);
            //                 toastr.info('Info: Task Updation Successful', 'Task Updated');
            //             } else {
            //                 // alert('Task Updation succesfully');
            //                 // window.location.reload();
            //                 setTimeout(function() {
            //                     window.location.reload(); // Reload the DataTable after successful deletion
            //                 }, 1000);
            //                 toastr.warning('Info:Task Updation Unsuccessful', 'Task Not Updated');
            //             }
            //         },
            //         error: function() {
            //             // Handle AJAX error here
            //             alert("An error occurred while fetching topics.");
            //         }
            //     });
            // });

            //Ajax used to Edit the task
            $("#editForm").submit(function(event) {
                event.preventDefault();
                if (!validateEditTaskForm()) {
                    return;
                }
                var formData = $(this).serialize();
                $.ajax({
                    url: "<?php echo base_url(); ?>Todo_controller/editTask",
                    data: formData,
                    method: 'POST',
                    success: function(data) {
                        if (data == 1) {
                            $('#editModal').modal('hide'); // Close the modal on successful submission
                            setTimeout(function() {
                                window.location.reload(); // Reload the DataTable after successful submission
                            }, 1000);
                            toastr.info('Info: Task Updation Successful', 'Task Updated');
                        } else {
                            toastr.warning('Info: New and Previous value can not be same', 'Task Not Updated');
                        }
                    },
                    error: function() {
                        toastr.error('An error occurred while updating the task', 'Failed');
                    }
                });
            });

        });
        //USED TO UPDATE THE STATUS 
        function changestat(id, status) {
            $.ajax({
                url: "<?php echo base_url() ?>Todo_Controller/editStatus/" + id + "/" + status,
                method: "GET",
                success: function(data) {
                    if (data == 1) {
                        // alert('Status has been changed');
                        // window.location.reload();
                        setTimeout(function() {
                            window.location.reload(); // Reload the DataTable after successful deletion
                        }, 1000);
                        toastr.info('Info: Task Status Changed Successful', 'Task Status Changed');
                    } else {
                        // alert('Status has not been Changed');
                        // window.location.reload();
                        setTimeout(function() {
                            window.location.reload(); // Reload the DataTable after successful deletion
                        }, 1000);
                        toastr.warning('Info:Task Status changed Unsuccessful', 'Task Status Not Changed');
                    }
                },
                error: function() {
                    alert("An error occured while performing this task");
                }
            });
        }


        // Function to validate the "Edit Task" form
        function validateEditTaskForm() {
            $('#editTask-error').text('');
            $('#editDiscription-error').text('');
            var editTask = document.getElementById("editTask").value;
            var editDiscription = document.getElementById("editDiscription").value;

            var isValid = true;

            if (editTask.trim() === "") {
                document.getElementById("editTask-error").textContent = "Task is required.";
                isValid = false;
            }

            if (editDiscription.trim() === "") {
                document.getElementById("editDiscription-error").textContent = "Discription is required.";
                isValid = false;
            }

            return isValid;
        }
        // Event listener to validate the "Edit Task" form on submission
        document.getElementById("editForm").addEventListener("submit", function(event) {
            if (!validateEditTaskForm()) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });

        // Function to validate the "Add Task" form
        function validateAddTaskForm() {
            $('#task-error').text('');
            $('#discription-error').text('');
            $('#status-error').text('');
            var task = document.getElementById("task").value;
            var discription = document.getElementById("Discription").value;
            var status = document.getElementById("status").value;

            var isValid = true;

            // Reset error messages
            if (task.trim() === "") {
                document.getElementById("task-error").textContent = "Task is required.";
                isValid = false;
            }

            if (discription.trim() === "") {
                document.getElementById("discription-error").textContent = "Discription is required.";
                isValid = false;
            }

            if (status === "Select Status") {
                document.getElementById("status-error").textContent = "Status is required.";
                isValid = false;
            }

            return isValid;
        }

        // Event listener to validate the "Add Task" form on submission
        document.getElementById("save").addEventListener("submit", function(event) {
            if (!validateAddTaskForm()) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });
    </script>
</body>

</html>