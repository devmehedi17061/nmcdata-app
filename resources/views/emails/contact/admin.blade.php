<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Inquiry</title>
</head>
<body style="font-family: Arial, sans-serif; color: #222; line-height: 1.6;">
    <h2 style="margin-bottom: 16px;">New Contact Form Submission</h2>

    <p>A new inquiry has been received from your website contact form.</p>

    <table cellpadding="8" cellspacing="0" border="1" style="border-collapse: collapse; border-color: #ddd; width: 100%; max-width: 700px;">
        <tr>
            <td style="font-weight: bold; width: 170px;">Name</td>
            <td>{{ $contactData['full_name'] }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Email</td>
            <td>{{ $contactData['email'] }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Subject</td>
            <td>{{ $contactData['subject'] }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Submitted At</td>
            <td>{{ $contactData['submitted_at'] }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold; vertical-align: top;">Message</td>
            <td>{!! nl2br(e($contactData['message'])) !!}</td>
        </tr>
    </table>

    <p style="margin-top: 20px;">Reply directly to this email to contact the user.</p>
</body>
</html>
