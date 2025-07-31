<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>مشاهده کاربران</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    
    <table class="table table-bordered table-hover table-striped">
    <thead class="table-dark text-center align-middle">
        <tr>
            <th>#</th>
            <th>نام</th>
            <th>نام خانوادگی</th>
            <th>کد ملی</th>
            <th>محل صدور</th>
            <th>تاریخ تولد</th>
            <th>وضعیت تأهل</th>
            <th>آدرس</th>
            <th>شماره اضطراری</th>
            <th>آشنای هم‌تیمی</th>
            <th>فعالیت‌های جانبی</th>
            <th>وضعیت سلامت</th>
            <th>سابقه محکومیت</th>
            <th>کد پرسنلی</th>
            <th>رمز عبور</th>
            <th>تحصیلات</th>
            <th>رشته تحصیلی</th>
            <th>نام موسسه</th>
            <th>موقعیت شغلی</th>
            <th>زمینه فعالیت</th>
            <th>تصویر</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $index => $user)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->national_code }}</td>
                <td>{{ $user->issue_place }}</td>
                <td>{{ $user->birth_date }}</td>
                <td>{{ $user->married_status == "single" ? 'متأهل' : 'مجرد' }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->emergency_phone }}</td>
                <td>{{ $user->any_teammate_family  }}</td>
                <td>{{ $user->extera_activity }}</td>
                <td>{{ $user->health_status }}</td>
                <td>{{ $user->punishment_history  }}</td>
                <td>{{ $user->personel_code }}</td>
                <td>{{ Str::limit($user->password, 10, '***') }}</td>
                <td>{{ $user->educational_background }}</td>
                <td>{{ $user->field_of_study }}</td>
                <td>{{ $user->institution_name }}</td>
                <td>{{ $user->Position }}</td>
                <td>{{ $user->field_of_activity }}</td>
                <td>
                    @if($user->image)
                        <img width="150" src="{{ $user->image }}" alt="تصویر" width="50">
                    @else
                        <span class="text-muted">ندارد</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
