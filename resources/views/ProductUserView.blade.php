<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('مشاهده لیست خریدهای کاربر') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if($orders->isEmpty())
                <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-lg text-center text-gray-700 dark:text-gray-200">
                    محصولی یافت نشد
                </div>
            @else
                <!-- جدول دسکتاپ -->
                <div class="hidden md:block overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-lg">
                    <table class="min-w-full text-sm text-center divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">نام محصول</th>
                                <th class="px-4 py-3">تعداد</th>
                                <th class="px-4 py-3">قیمت کل</th>
                                <th class="px-4 py-3">وضعیت سفارش</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="px-4 py-2">{{ $order->id }}</td>
                                    <td class="px-4 py-2">{{ $order->product->name }}</td>
                                    <td class="px-4 py-2">{{ $order->quentity }}</td>
                                    <td class="px-4 py-2">
                                        {{ number_format($order->quentity * $order->product->price) }} تومان
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ $order->status === 'in_proccess' ? 'در انتظار تایید سفارش' : 'کامل شده' }}
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
                            <div class="flex justify-between">
                                <span class="font-semibold">#</span>
                                <span>{{ $order->id }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-semibold">نام محصول</span>
                                <span>{{ $order->product->name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-semibold">تعداد</span>
                                <span>{{ $order->quentity }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-semibold">قیمت کل</span>
                                <span>{{ number_format($order->quentity * $order->product->price) }} تومان</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-semibold">وضعیت سفارش</span>
                                <span>{{ $order->status === 'in_proccess' ? 'در انتظار تایید سفارش' : 'کامل شده' }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
