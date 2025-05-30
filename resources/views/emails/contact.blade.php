<!doctype html>
<html lang="en">
<head>
    <title>{{ $title }}</title>
</head>
<body>
    <p>
        There is new contact mail from your website.
    </p>
    <table>
        <tr>
            <td>Name</td>
            <td>:</td>
            <td>{{ $name }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>:</td>
            <td>{{ $email }}</td>
        </tr>
        <tr>
            <td>Subject</td>
            <td>:</td>
            <td>{{ $subject }}</td>
        </tr>
        <tr>
            <td>Message</td>
            <td>:</td>
            <td>{{ $content }}</td>
        </tr>
        <tr>
            <td>Time</td>
            <td>:</td>
            <td>{{ $created_at }}</td>
        </tr>
    </table>
</body>
</html>