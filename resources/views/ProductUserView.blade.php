<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>




    <div class="container mt-5">
    <h2 class="mb-4">جدول سفارشات کاربر</h2>

        @if(! $orders & $orders === [])

            <h2>محصولی یافت نشد</h2>

        @else

               <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>نام محصول</th>
                <th>تعداد</th>
                <th>قیمت کل</th>
                <th> وضعیت سفارش</th>

            </tr>
        </thead>
        <tbody>
    @forelse ($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->product->name }}</td>
            <td>{{ $order->quentity }}</td>
            <td>{{ $order->quentity * $order->product->price }}</td>
            <td>{{ $order->status == "in_proccess" ? "در انتظار تایید سفارش" : "کامل شده" }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center">سفارشی یافت نشد.</td>
        </tr>
    @endforelse
</tbody>

    </table>

        @endif

 
</div>



</x-app-layout>