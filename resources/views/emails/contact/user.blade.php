<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Contacting Us</title>
</head>
<body style="font-family: Arial, sans-serif; color: #222; line-height: 1.6;">
    <h2 style="margin-bottom: 16px;">Thank You, {{ $contactData['full_name'] }}</h2>

    <p>We have received your message and our team will get back to you soon.</p>

    <p><strong>Your submitted details:</strong></p>

    <table cellpadding="8" cellspacing="0" border="1" style="border-collapse: collapse; border-color: #ddd; width: 100%; max-width: 700px;">
        <tr>
            <td style="font-weight: bold; width: 170px;">Subject</td>
            <td>{{ $contactData['subject'] }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold; vertical-align: top;">Message</td>
            <td>{!! nl2br(e($contactData['message'])) !!}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Submitted At</td>
            <td>{{ $contactData['submitted_at'] }}</td>
        </tr>
    </table>

    <p style="margin-top: 20px;">Best regards,<br>NMC HR System Team</p>
</body>
</html>
