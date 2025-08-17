<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('لیست سفارشات') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- پیام موفقیت -->
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- پیام خطا -->
            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <!-- جدول دسکتاپ -->
            <div class="hidden md:block overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
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
                            <th class="px-4 py-3">نوع پرداخت</th>
                            <th class="px-4 py-3">شناسه پیگیری</th>
                            <th class="px-4 py-3">وضعیت سفارش</th>
                            <th class="px-4 py-3">تأیید سفارش</th>
                            <th class="px-4 py-3">مشاهده بالاسری‌ها</th>
                            <th class="px-4 py-3">دیدن فروشنده</th>
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
                                    @if ($order->payment_method == "card_to_card")
                                        کارت به کارت
                                    @elseif($order->payment_method == "pay_at_home")
                                        درب منزل
                                    @else
                                        درگاه پرداخت
                                    @endif
                                </td>
                                <td class="px-4 py-2">
                                    @if ($order->transaction_number == "pay_at_home")
                                        درب منزل
                                    @else
                                        {{ $order->transaction_number }}
                                    @endif
                                </td>
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
                                <td class="px-4 py-2">
                                    <a href="{{ route('seller.user', $order->user_id) }}"
                                       class="inline-block bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">
                                        فروشنده
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- کارت موبایل -->
            <div class="md:hidden space-y-4">
                @foreach ($orders as $order)
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 space-y-2">
                        <div class="flex justify-between"><span class="font-semibold">ردیف</span><span>{{ $order->id }}</span></div>
                        <div class="flex justify-between"><span class="font-semibold">نام</span><span>{{ $order->user->first_name }}</span></div>
                        <div class="flex justify-between"><span class="font-semibold">نام خانوادگی</span><span>{{ $order->user->last_name }}</span></div>
                        <div class="flex justify-between"><span class="font-semibold">شماره همراه</span><span>{{ $order->user->phone_number }}</span></div>
                        <div class="flex justify-between"><span class="font-semibold">کد پستی</span><span>{{ $order->user->postal_code }}</span></div>
                        <div class="flex justify-between"><span class="font-semibold">تعداد</span><span>{{ $order->quentity }}</span></div>
                        <div class="flex justify-between"><span class="font-semibold">محصول</span><span>{{ $order->product->name }}</span></div>
                        <div class="flex justify-between"><span class="font-semibold">قیمت تکی</span><span>{{ number_format($order->product->price) }} تومان</span></div>
                        <div class="flex justify-between"><span class="font-semibold">قیمت کل</span><span>{{ number_format($order->product->price * $order->quentity) }} تومان</span></div>
                        <div class="flex justify-between"><span class="font-semibold">نوع پرداخت</span><span>
                            @if ($order->payment_method == "card_to_card")
                                کارت به کارت
                            @elseif($order->payment_method == "pay_at_home")
                                درب منزل
                            @else
                                درگاه پرداخت
                            @endif
                        </span></div>
                        <div class="flex justify-between"><span class="font-semibold">شناسه پیگیری</span><span>
                            @if ($order->transaction_number == "pay_at_home")
                                درب منزل
                            @else
                                {{ $order->transaction_number }}
                            @endif
                        </span></div>
                        <div class="flex justify-between"><span class="font-semibold">وضعیت سفارش</span>
                            <span class="px-3 py-1 rounded {{ $order->status == 'in_proccess' ? 'bg-red-400 text-white' : 'bg-green-400 text-white' }}">
                                {{ $order->status == 'in_proccess' ? 'در انتظار تایید' : 'تایید شده' }}
                            </span>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-2 mt-4">
                            <a href="{{ route('confirm', [$order->user_id, $order->id]) }}"
                               class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 text-center transition">
                                تایید سفارش کاربر
                            </a>
                            <a href="{{ route('parent', $order->user_id) }}"
                               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-center transition">
                                مشاهده بالاسری ها
                            </a>
                            <a href="{{ route('seller.user', $order->user_id) }}"
                               class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 text-center transition">
                                مشاهده اطلاعات فروشنده
                            </a>
                            
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>
