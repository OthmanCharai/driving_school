<!DOCTYPE html>
<html>
<head>
    <title>Contact Us Form Information</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
<div>
    <h2>Contact Us Form Information</h2>
    <p>Hello,</p>
    <p>We have received a new submission from the Contact Us form on our website. The following information was provided:</p>
    <ul>
        <li><strong>Name:</strong> {{$data['name']}}</li>
        <li><strong>Email:</strong> {{$data['email']}}</li>
        <li><strong>Message:</strong> {{$data['message']}}</li>
    </ul>
    <p>Please respond to this inquiry as soon as possible.</p>
    <p>Thank you.</p>
</div>
</body>
</html>
