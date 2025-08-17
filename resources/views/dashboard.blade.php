<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('پنل فروشندگان') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- کد دعوت -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="flex flex-col sm:flex-row items-start sm:items-center gap-2">
                    <span>کد دعوت شما:</span>
                    <div class="flex items-center gap-2">
                        <button class="bg-gray-800 text-white px-3 py-1 rounded hover:bg-gray-700 text-sm" onclick="copyToClipboard()">کپی</button>
                        <a id="inviteLink" href="{{ $sellerRefferalCode }}" target="_blank" class="text-blue-600 break-all">
                            {{ $sellerRefferalCode }}
                        </a>
                    </div>
                </p>
            </div>

            <!-- جدول دسکتاپ -->
            <div class="hidden md:block bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                <div class="overflow-x-auto">
                    <table class="min-w-max w-full text-sm text-left border-collapse table-auto">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="px-4 py-2 whitespace-nowrap">#</th>
                                <th class="px-4 py-2 whitespace-nowrap">نام</th>
                                <th class="px-4 py-2 whitespace-nowrap">نام خانوادگی</th>
                                <th class="px-4 py-2 whitespace-nowrap">ایمیل</th>
                                <th class="px-4 py-2 whitespace-nowrap">شماره تماس</th>
                                <th class="px-4 py-2 whitespace-nowrap">وضعیت سفارشات</th>
                                <th class="px-4 py-2 whitespace-nowrap">زیرمجموعه‌ها</th>
                                <th class="px-4 py-2 whitespace-nowrap">تعداد رفرال</th>
                                <th class="px-4 py-2 whitespace-nowrap">گزارش</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sellerUser as $index => $user)
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <td class="px-4 py-2 whitespace-nowrap">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap">{{ $user->user->first_name }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap">{{ $user->user->last_name }}</td>
                                    <td class="px-4 py-2 break-all">{{ $user->user->email }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap">{{ $user->user->phone_number }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap">
                                        <a class="bg-green-600 text-white px-2 py-1 rounded hover:bg-green-700 text-xs" href="{{ route('user.product.get', $user->user->id) }}">خریدها</a>
                                    </td>
                                    <td class="px-4 py-2 whitespace-nowrap">
                                        <a class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700 text-xs" href="{{ route('reffrals', [$user->user->refferal_code, $gen + 1]) }}">مشاهده</a>
                                    </td>
                                    <td class="px-4 py-2 whitespace-nowrap">{{ $user->referrals_count }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap">
                                        <a class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 text-xs" href="{{ route('new.report.create', $user->user->refferal_code) }}">ثبت گزارش</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- صفحه‌بندی دسکتاپ -->
                <div class="mt-4">
                    {{ $sellerUser->links() }}
                </div>
            </div>

            <!-- کارت موبایل -->
           <!-- کارت موبایل -->
<div class="md:hidden space-y-4">
    @foreach ($sellerUser as $index => $user)
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-4 space-y-2">
            <div class="flex justify-between">
                <span class="font-semibold">شماره</span>
                <span>{{ $index + 1 }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-semibold">نام</span>
                <span>{{ $user->user->first_name }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-semibold">نام خانوادگی</span>
                <span>{{ $user->user->last_name }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-semibold">ایمیل</span>
                <span class="break-all">{{ $user->user->email }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-semibold">شماره تماس</span>
                <span>{{ $user->user->phone_number }}</span>
            </div>
               <div class="flex justify-between mt-2">
                <span class="font-semibold">تعداد رفرال</span>
                <span>{{ $user->referrals_count }}</span>
            </div>
            <div class="flex flex-col sm:flex-row gap-3 mt-2">
                <a class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm text-center" href="{{ route('user.product.get', $user->user->id) }}">خرید های کاربر</a>
                <a class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 text-sm text-center" href="{{ route('reffrals', [$user->user->refferal_code, $gen + 1]) }}">مشاهده زیر مجموعه ها</a>
                <a class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 text-sm text-center" href="{{ route('new.report.create', $user->user->refferal_code) }}">ثبت گزارش</a>
            </div>
         
        </div>
    @endforeach

    <!-- صفحه‌بندی موبایل -->
    <div class="mt-4">
        {{ $sellerUser->links() }}
    </div>
</div>


        </div>
    </div>

    <script>
        function copyToClipboard() {
            const link = document.getElementById("inviteLink").href;
            navigator.clipboard.writeText(link).then(() => {
                alert("لینک با موفقیت کپی شد!");
            }).catch(err => {
                alert("خطا در کپی کردن لینک: " + err);
            });
        }
    </script>
</x-app-layout>
