<x-app-layout>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4 text-sm">
            {{ session('error') }}
        </div>
    @endif

    <!-- جدول گزارش‌ها -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-6">
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-4 overflow-x-auto">
            <table class="min-w-full text-sm text-left border-collapse">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">وضعیت گزارش</th>
                        <th class="px-4 py-2">عنوان</th>
                        <th class="px-4 py-2">توضیحات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($perviousReports as $index => $order)
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">
                                {{ $order->status == "rejected" ? "ناموفق" : "موفق" }}
                            </td>
                            <td class="px-4 py-2">{{ $order->title }}</td>
                            <td class="px-4 py-2 break-words max-w-xs">{{ $order->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $perviousReports->links() }}
            </div>
        </div>
    </div>

    <!-- فرم ثبت گزارش -->
    <div class="min-h-screen py-10 bg-gray-100">
        <div class="mx-auto max-w-xl px-4">
            <div class="bg-white rounded-2xl shadow-md p-6 sm:p-8">
                <h1 class="text-xl font-semibold mb-6">فرم ثبت گزارش</h1>

                <form method="POST" action="{{ route('new.report.store') }}" class="space-y-5">
                    @csrf

                    <input type="hidden" id="user_id" name="user_id" value="{{ $userId }}">

                    <div>
                        <label for="status" class="block text-sm font-medium mb-2">دسته‌بندی</label>
                        <select id="status" name="status"
                                class="w-full rounded-xl border border-gray-200 bg-gray-100 focus:bg-white focus:border-gray-400 focus:outline-none px-4 py-2.5">
                            <option value="rejected">ناموفق</option>
                            <option value="called">موفق</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-medium mb-2">عنوان</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                               class="w-full rounded-xl border border-gray-200 bg-gray-100 focus:bg-white focus:border-gray-400 focus:outline-none px-4 py-2.5"
                               placeholder="مثلاً: موضوع گزارش">
                        @error('title')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium mb-2">توضیحات</label>
                        <textarea id="description" name="description" rows="5"
                                  class="w-full rounded-xl border border-gray-200 bg-gray-100 focus:bg-white focus:border-gray-400 focus:outline-none px-4 py-2.5"
                                  placeholder="توضیحات خود را وارد کنید…">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col sm:flex-row items-center gap-3 pt-2">
                        <button type="submit"
                                class="rounded-xl bg-black text-white px-5 py-2.5 hover:opacity-90 transition w-full sm:w-auto">
                            ارسال
                        </button>
                        <a href="{{ url()->previous() }}"
                           class="rounded-xl bg-gray-100 text-gray-800 px-5 py-2.5 border border-gray-200 hover:border-gray-300 transition w-full sm:w-auto text-center">
                            انصراف
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
