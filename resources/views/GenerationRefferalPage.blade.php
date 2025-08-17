<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('پنل فروشندگان') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-5">

        <!-- جدول دسکتاپ -->
        <div class="hidden md:block overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold">#</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">نام</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">نام خانوادگی</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">شماره تماس</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">وضعیت سفارشات کاربر</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">دیدن زیرمجموعه کاربر</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($userRefferals as $index => $user)
                        <tr>
                            <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 text-sm">{{ $user->reffered->first_name }}</td>
                            <td class="px-4 py-3 text-sm">{{ $user->reffered->last_name }}</td>
                            <td class="px-4 py-3 text-sm">{{ $user->reffered->phone_number }}</td>
                            <td class="px-4 py-3">
                                <a href="{{ route('user.product.get', $user->reffered->id) }}"
                                   class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition mr-2">
                                    وضعیت خریدها
                                </a>
                            </td>
                            <td class="px-4 py-3">
                                <a href="{{ route('reffrals', [$user->reffered->refferal_code, $gen + 1]) }}"
                                   class="inline-block bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                                    مشاهده
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- کارت موبایل -->
        <div class="md:hidden space-y-4">
            @foreach ($userRefferals as $index => $user)
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 space-y-2">
                    <div class="flex justify-between"><span class="font-semibold">#</span><span>{{ $index + 1 }}</span></div>
                    <div class="flex justify-between"><span class="font-semibold">نام</span><span>{{ $user->reffered->first_name }}</span></div>
                    <div class="flex justify-between"><span class="font-semibold">نام خانوادگی</span><span>{{ $user->reffered->last_name }}</span></div>
                    <div class="flex justify-between"><span class="font-semibold">شماره تماس</span><span>{{ $user->reffered->phone_number }}</span></div>
                    <div class="flex flex-col sm:flex-row gap-2 mt-2">
                        <a href="{{ route('user.product.get', $user->reffered->id) }}"
                           class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 text-center transition">
                            وضعیت خریدها
                        </a>
                        <a href="{{ route('reffrals', [$user->reffered->refferal_code, $gen + 1]) }}"
                           class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 text-center transition">
                            مشاهده
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    <script>
        function copyToClipboard() {
            const link = document.getElementById("inviteLink").href;
            navigator.clipboard.writeText(link)
                .then(() => alert("لینک با موفقیت کپی شد!"))
                .catch(err => alert("خطا در کپی کردن لینک: " + err));
        }
    </script>
</x-app-layout>


