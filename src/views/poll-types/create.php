<?php
// Check if $errors array is not empty
if (!empty($errors)) {
    //Add the 'is-invalid' class to the form-control class attribute
    $formControlClass = 'form-control is-invalid';
} else {
    // Use the default 'form-control' class attribute
    $formControlClass = 'form-control';
}
?>

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
<div class="container">
    <div class="row">
        <div class="col"><h1>Create a poll</h1></div>
    </div>
    <div class="row">
        <div class="col text-end">
            <a class="btn btn-success" href="/poll-types">List</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form class="row g-3 needs-validation" method="post" action="/poll-types/store">
                <div class="col-md-4">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name"
                           class="<?php echo $formControlClass; ?>">
                    <?php foreach ($errors as $error): ?>
                    <?php if (strstr($error, 'name')): ?>
                        <div class="invalid-feedback"><?php echo ucfirst($error); ?></div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-4">
                    <label for="status" class="form-label">Status(draft or published)</label>
                    <input type="text" id="status" name="status"
                           class="<?php echo $formControlClass; ?>">
                    <?php foreach ($errors as $error): ?>
                    <?php if (strstr($error, 'status')): ?>
                        <div class="invalid-feedback"><?php echo ucfirst($error); ?></div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <button class="btn btn-primary" type="submit">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
</body>
</html>