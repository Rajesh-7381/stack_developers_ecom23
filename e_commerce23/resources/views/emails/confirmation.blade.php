<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-collapse: collapse;
            border: 1px solid #dddddd;
        }

        td {
            padding: 20px;
            text-align: left;
            border: 1px solid #dddddd;
        }

        h1 {
            color: #333333;
        }

        p {
            color: #666666;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td>
                <h1>Dear {{$name}},</h1>
                <p>Thank you choosen our web.....</p>
               <h1>**** click on  below link to activate your Account?****</h1>
               <p><a href="{{url('user/confirm/'.$code)}}">Confirm Account</a></p>
                
                <p>Thank you!</p>
            </td>
        </tr>
    </table>
</body>
</html>
