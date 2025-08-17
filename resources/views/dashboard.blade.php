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
                        <button class="bg-gray-800 text-white px-3 py-1 rounded hover:bg-gray-700 text-sm" onclick="copyToClipboard()"> کپی </button>
                        <a id="inviteLink" href="{{ $sellerRefferalCode }}" target="_blank" class="text-blue-600 break-all">
                            {{ $sellerRefferalCode }}
                        </a>
                    </div>
                </p>
            </div>

            <!-- جدول کاربران -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left border-collapse">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="px-4 py-2">#</th>
                                <th class="px-4 py-2">نام</th>
                                <th class="px-4 py-2">نام خانوادگی</th>
                                <th class="px-4 py-2">ایمیل</th>
                                <th class="px-4 py-2">شماره تماس</th>
                                <th class="px-4 py-2">وضعیت سفارشات</th>
                                <th class="px-4 py-2">زیرمجموعه‌ها</th>
                                <th class="px-4 py-2">تعداد رفرال</th>
                                <th class="px-4 py-2">گزارش</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sellerUser as $index => $user)
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">{{ $user->user->first_name }}</td>
                                    <td class="px-4 py-2">{{ $user->user->last_name }}</td>
                                    <td class="px-4 py-2 break-all">{{ $user->user->email }}</td>
                                    <td class="px-4 py-2">{{ $user->user->phone_number }}</td>
                                    <td class="px-4 py-2">
                                        <a class="bg-green-600 text-white px-2 py-1 rounded hover:bg-green-700 text-xs" href="{{ route('user.product.get', $user->user->id) }}">وضعیت خریدها</a>
                                    </td>
                                    <td class="px-4 py-2">
                                        <a class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700 text-xs" href="{{ route('reffrals', [$user->user->refferal_code, $gen + 1]) }}">مشاهده</a>
                                    </td>
                                    <td class="px-4 py-2">{{ $user->referrals_count }}</td>
                                    <td class="px-4 py-2">
                                        <a class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 text-xs" href="{{ route('new.report.create', $user->user->refferal_code) }}">ثبت گزارش</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- صفحه‌بندی -->
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
