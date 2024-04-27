<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<h1>Review types</h1>

<div class="container m-3">
    <div class="row">
        <div class="col text-end">
            <a class="btn btn-primary" href="/poll-types/create">Create</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($polltypes as $polltype): ?>
                <tr>
                    <td><?php echo $polltype->attributes['id'] ?></td>
                    <td><?php echo $polltype->attributes['name'] ?></td>
                    <td>
                        <?php if($polltype->isDraft()): ?>
                        <span class="badge text-bg-secondary"><?php echo $polltype->attributes['status'] ?></span>
                        <?php elseif($polltype->isPublished()): ?>
                        <span class="badge text-bg-success"><?php echo $polltype->attributes['status'] ?></span>
                        <?php endif; ?>
                    </td>

                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
