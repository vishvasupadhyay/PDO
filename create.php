<?php
require 'db.php';
$message = '';
if (isset($_POST['name'])  && isset($_POST['email'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sql = 'INSERT INTO people(name, email) VALUES(:name, :email)';
    $statement = $connection->prepare($sql);
    if ($statement->execute([':name' => $name, ':email' => $email])) {
        $message = 'data inserted successfully';
    }
}


?>
<?php require 'header.php'; ?>
<div class="container">
    <div class="card mt-5" style="background-color: cornflowerblue;">
        <div class="card-header">
            <h2>Create a person</h2>
        </div>
        <div class="card-body">
            <?php if (!empty($message)) : ?>
                <div class="alert alert-success">
                    <?= $message; ?>
                </div>
            <?php endif; ?>
            <form method="post">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Create a person</button>
                </div>
            </form>
        </div>
    </div>
    <button type="button" class="btn btn-primary btn-lg btn-block" id="h">View Table</button>
</div>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>All people</h2>
        </div>
        <div class="card-body">
            <table id="table_id" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($people as $person) : ?>
                        <tr>
                            <td><?= $person->id; ?></td>
                            <td><?= $person->name; ?></td>
                            <td><?= $person->email; ?></td>
                            <td>
                                <a href="edit.php?id=<?= $person->id ?>" class="btn btn-info">Edit</a>
                                <a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete.php?id=<?= $person->id ?>" class='btn btn-danger'>Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table_id').DataTable();
    });
    $(document).ready(function() {
        $("#h").click(function() {
            $("#table_id").toggle();
        });
    });
</script>
<?php require 'footer.php'; ?>