<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('مشخصات فروشنده') }}
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

            <!-- جدول دسکتاپ -->
            <div class="hidden md:block overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
                <table class="min-w-full text-sm text-center divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-4 py-3">ردیف</th>
                            <th class="px-4 py-3">نام</th>
                            <th class="px-4 py-3">نام خانوادگی</th>
                            <th class="px-4 py-3">کد پرسنلی</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($sellerUser as $index => $sellerInfo)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-4 py-2">{{ $index + 1 }}</td>
                                <td class="px-4 py-2">{{ $sellerInfo->seller->first_name }}</td>
                                <td class="px-4 py-2">{{ $sellerInfo->seller->last_name }}</td>
                                <td class="px-4 py-2">{{ $sellerInfo->seller->personel_code }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- کارت موبایل -->
            <div class="md:hidden space-y-4">
                @foreach ($sellerUser as $index => $sellerInfo)
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 space-y-2">
                        <div class="flex justify-between"><span class="font-semibold">ردیف</span><span>{{ $index + 1 }}</span></div>
                        <div class="flex justify-between"><span class="font-semibold">نام</span><span>{{ $sellerInfo->seller->first_name }}</span></div>
                        <div class="flex justify-between"><span class="font-semibold">نام خانوادگی</span><span>{{ $sellerInfo->seller->last_name }}</span></div>
                        <div class="flex justify-between"><span class="font-semibold">کد پرسنلی</span><span>{{ $sellerInfo->seller->personel_code }}</span></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

