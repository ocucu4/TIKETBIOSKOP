<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Development Error</title>
    <style>
        body { font-family: Arial; background: #f7f7f7; padding: 20px; }
        pre { background: #fff; padding: 20px; border-radius: 6px; }
    </style>
</head>
<body>

<h2>⚠️ Error: Development Mode</h2>

<p>
    A detailed error occurred. If you see this message, it means CodeIgniter
    is running in <strong>development mode</strong> and can now show full trace.
</p>

<hr>

<?= esc($message) ?>

<pre><?= esc($exception) ?></pre>

</body>
</html>
