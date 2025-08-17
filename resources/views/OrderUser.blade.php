<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('لیست سفارشات') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
                <table class="min-w-full text-sm text-center divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-4 py-3">ردیف</th>
                            <th class="px-4 py-3">نام</th>
                            <th class="px-4 py-3">نام خانوادگی</th>
                            <th class="px-4 py-3">شماره همراه</th>
                            <th class="px-4 py-3">کد پستی</th>
                            <th class="px-4 py-3">تعداد</th>
                            <th class="px-4 py-3">نام محصول</th>
                            <th class="px-4 py-3">قیمت تکی</th>
                            <th class="px-4 py-3">قیمت کل</th>
                            <th class="px-4 py-3">وضعیت سفارش</th>
                            <th class="px-4 py-3">تأیید سفارش</th>
                            <th class="px-4 py-3">مشاهده بالاسری‌ها</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($orders as $order)
                            <tr>
                                <td class="px-4 py-2">{{ $order->id }}</td>
                                <td class="px-4 py-2">{{ $order->user->first_name }}</td>
                                <td class="px-4 py-2">{{ $order->user->last_name }}</td>
                                <td class="px-4 py-2">{{ $order->user->phone_number }}</td>
                                <td class="px-4 py-2">{{ $order->user->postal_code }}</td>
                                <td class="px-4 py-2">{{ $order->quentity }}</td>
                                <td class="px-4 py-2">{{ $order->product->name }}</td>
                                <td class="px-4 py-2">{{ number_format($order->product->price) }} تومان</td>
                                <td class="px-4 py-2">{{ number_format($order->product->price * $order->quentity) }} تومان</td>
                                <td class="px-4 py-2">
                                    {{ $order->status == 'in_proccess' ? 'در انتظار تایید' : 'تایید شده' }}
                                </td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('confirm', [$order->user_id, $order->id]) }}"
                                       class="inline-block bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition">
                                        تأیید
                                    </a>
                                </td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('parent', $order->user_id) }}"
                                       class="inline-block bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">
                                        مشاهده
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

