<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <title>جدول 10 ستونه</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif




  <div class="container">
    <h4 class="mb-4">لیست سفارشات</h4>

    <table class="table table-bordered text-center">
      <thead class="table-primary">
        <tr>
          <th>ردیف</th>
          <th>نام </th>
          <th> نام خانوادگی</th>
          <th> شماره همراه</th>
          <th>کد پستی</th>
          <th> تعداد</th>
          <th>نام محصول</th>
          <th>قیمت تکی محصول</th>
          <th> قیمت کل فاکتور</th>
          <th>وضعیت سفارش</th>
          <th>تأیید سفارش</th>
          <th> مشاهده بالاسری ها</th>

        </tr>
      </thead>
      <tbody>
        @foreach ($orders as $order)
              <tr>
          <td>{{ $order->id }}</td>
          <td>{{ $order->user->first_name }}</td>
          <td>{{ $order->user->last_name }}</td>
          <td>{{ $order->user->phone_number }}</td>
          <td>{{ $order->user->postal_code }}</td>
          <td>{{ $order->quentity }}</td>
          <td>{{ $order->product->name  }}</td>
          <td>{{ $order->product->price }}</td>
          <td>{{ $order->product->price * $order->quentity  }}</td>
          <td>{{ $order->status == "in_proccess" ? "در انتظار تایید" : "تایید" }} </td>
          <td>
            <a href="{{ route("confirm",[$order->user_id,$order->id]) }}" class="btn btn-success btn-sm">تأیید سفارش</a>
          </td>
            <td>
            <a href="{{ route("parent",$order->user_id) }}" class="btn btn-success btn-sm"> مشاهده بالاسری ها</a>
          </td>
        </tr>
        @endforeach
      
        <!-- ردیف‌های بیشتر را می‌توان داینامیک اضافه کرد -->
      </tbody>
    </table>
  </div>

</body>
</html>
