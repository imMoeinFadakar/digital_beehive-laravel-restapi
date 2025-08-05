<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>درخت ارجاع</title>
</head>
<body>
    <div class="container">
    <h2>درخت ارجاع تا ۴ نسل</h2>

    @if($referrals && count($referrals))
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>نسل</th>
                    <th>نام</th>
                    <th>نام خانوادگی</th>
                    <th>ایمیل</th>
                    <th>کد کاربری</th>
                </tr>
            </thead>
            <tbody>
                @foreach($referrals as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->id }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>هیچ ارجاعی پیدا نشد.</p>
    @endif
</div>

</body>
</html>

