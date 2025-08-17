<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>درخت ارجاع</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">

<div class="container">
    <h2 class="mb-4">درخت ارجاع تا ۴ نسل</h2>

    @if($referrals->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover text-center align-middle">
                <thead class="table-dark">
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
        </div>
    @else
        <div class="alert alert-warning text-center">
            هیچ ارجاعی پیدا نشد.
        </div>
    @endif
</div>

</body>
</html>
