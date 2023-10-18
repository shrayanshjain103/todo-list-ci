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
                    <th>Delete Information</th>
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
                        </div>
                        <br>
                        <div class="container">
                            <label for="discription" style="font-weight: bold;">Description:</label>
                            <input type="text" id="Discription" name="discription" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 10px;">
                        </div>
                        <br>
                        <select id="status" name="status" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 10px;">
                            <option style="font-weight: bold;">Select Status</option>
                            <option value="1" style="font-weight: bold; color: green;">Completed</option>
                            <option value="0" style="font-weight: bold; color: red;">Incomplete</option>
                        </select>
                </div>
                <div class="modal-footer pop">
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                    <button type="submit" class="btn btn-primary " style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 10px;">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var dataTable = $('#tasksTable').DataTable({
                "paging": true,
                "lengthMenu": [
                    [5, 1, 2, 3, 4, 25, 50, 75, 100, -1],
                    [5, 1, 2, 3, 4, 25, 50, 75, 100, 'All']
                ],
                "ajax": {
                    "url": "<?= base_url('Todo_controller/showData') ?>",
                    "type": "POST",
                    "dataType": "json",
                    dataSrc: ""
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
                                return '<button class="btn btn-warning">Incomplete</button>';
                            } else {
                                return '<button class="btn btn-success">Completed</button>';
                            }
                        }
                    },
                    {
                        data: null,
                        "render": function(data, type, row) {
                            return '<button class="btn btn-info edit-btn" onclick="modalopen(' + data.id + ')" data-id="' + data.id + '">Edit</button>';
                        }
                    },
                    {
                        "data": null,
                        "render": function(data, type, row) {
                            return '<button class="btn btn-danger btn-delete" data-id="' + data.id + '">Delete</button>';
                        }
                    }
                ]
            });
            $("#openTaskForm").click(function() {
                $("#newModal").modal('show');
            });
            $("#save").submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>Todo_Controller/addnewTask",
                    dataType: "json",
                    data: formData,
                    success: function(res) {
                        console.log(res);
                        if (res == 1) {
                            $('#newModal').hide();
                            alert("Task inserted Successfully");
                            window.location.reload();
                        } else {
                            $('#newModal').hide();
                            alert("Task inserted Unsuccessful");
                            window.location.reload();

                        }
                    }

                });

            });

            $('#tasksTable').on('click', '.btn-delete', function() {
                var taskId = $(this).data('id');
                $.ajax({
                    url: '<?php echo base_url('Todo_controller/deleteTask'); ?>',
                    method: 'POST',
                    data: {
                        id: taskId
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data == 1) {
                            alert('Task deletion succesfully');
                            window.location.reload();
                        } else {
                            alert('Task deletion succesfully');
                            window.location.reload();
                        }
                    },
                    error: function() {
                        // Handle AJAX error here
                        alert("An error occurred while fetching topics.");
                    }
                });
            });
        });
    </script>
</body>

</html>