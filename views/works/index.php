<?php require 'views/layouts/main.php' ?>
<header class="mt-4 mb-4">
    <div class="container">
        <h1 class="h1 text-center">To Do List</h1>
        <div class="row mt-4">
            <div class="col-6">
                <a href="/works/calendar" class="btn btn-block btn-warning">Calendar Viewer</a>
            </div>
            <div class="col-6">
                <a class="btn btn-block btn-info" href="/works/create">Create New Work</a>
            </div>
        </div>
    </div>
</header>

<section>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div style="height: 400px;overflow: auto;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Starting Date</th>
                                <th>Ending Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($works as $index => $work) : ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo $work->name; ?></td>
                                    <td><?php echo date('Y-m-d H:i:s', strtotime($work->starting_date)); ?></td>
                                    <td><?php echo date('Y-m-d H:i:s', strtotime($work->ending_date)); ?></td>
                                    <td><?php echo $status[$work->status]; ?></td>
                                    <td>
                                        <a href="/works/edit?id=<?php echo $work->id; ?>" class="btn btn-success">Edit</a>
                                        <a href="/works/delete?id=<?php echo $work->id; ?>" class="btn btn-danger delete-work">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require 'views/layouts/bottom.php' ?>