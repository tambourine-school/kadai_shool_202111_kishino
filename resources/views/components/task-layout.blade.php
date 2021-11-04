<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>自己研鑽専用Todoリスト</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 480px;
        }

        .task-list {
            display: flex;
            justify-content: space-between;
        }

        .space-evenly {
            display: flex;
            justify-content: space-evenly;
        }

        .down-arrow {
            display: flex;
            justify-content: center;
        }

        .delete-button {
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
        <div class="container">
            <a class="navbar-brand" href="/tasks">MyTasks</a>
        </div>
    </nav>
    <div class="container">
        {{ $slot }}
    </div>
</body>

</html>