<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold mb-6 text-center">درخت ارجاع تا ۴ نسل</h2>

    @if($referrals && count($referrals) > 0)
        <!-- نسخه دسکتاپ -->
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full text-center divide-y divide-gray-200 dark:divide-gray-700 border rounded-lg shadow-md">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-3">نسل</th>
                        <th class="px-4 py-3">نام</th>
                        <th class="px-4 py-3">نام خانوادگی</th>
                        <th class="px-4 py-3">ایمیل</th>
                        <th class="px-4 py-3">کد کاربری</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($referrals as $index => $user)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $user->first_name }}</td>
                            <td class="px-4 py-2">{{ $user->last_name }}</td>
                            <td class="px-4 py-2 break-words">{{ $user->email }}</td>
                            <td class="px-4 py-2">{{ $user->id }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- نسخه موبایل (کارت) -->
        <div class="md:hidden space-y-4">
            @foreach($referrals as $index => $user)
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 space-y-2">
                    <div class="flex justify-between"><span class="font-semibold">نسل</span><span>{{ $index + 1 }}</span></div>
                    <div class="flex justify-between"><span class="font-semibold">نام</span><span>{{ $user->first_name }}</span></div>
                    <div class="flex justify-between"><span class="font-semibold">نام خانوادگی</span><span>{{ $user->last_name }}</span></div>
                    <div class="flex justify-between"><span class="font-semibold">ایمیل</span><span class="break-words">{{ $user->email }}</span></div>
                    <div class="flex justify-between"><span class="font-semibold">کد کاربری</span><span>{{ $user->id }}</span></div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg text-center mt-4">
            هیچ ارجاعی پیدا نشد.
        </div>
    @endif
</div>

