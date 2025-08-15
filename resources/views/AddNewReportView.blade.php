<x-app-layout>


    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif



    <div class="container mt-5">

    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>وضعیت گزارش</th>
                <th> عنوان</th>
                <th>توضیحات</th>
     



            </tr>
        </thead>
        <tbody>
            @foreach ($perviousReports as $index => $order)
                
            <tr>
                <td>{{ $index +1}}</td>
                <td>{{ $order->status == "rejected" ? "ناموفق" : "موفق"}}</td>
                <td>{{ $order->title }}</td>
                <td>{{ $order->description }}</td>
           

            </tr>
            
            @endforeach
            <!-- ردیف‌های بیشتر -->
        </tbody>
    </table>
</div>


<div class="d-flex justify-content-center">
    {{ $perviousReports->links() }}
</div>






<br>
<div class="min-h-screen py-10" style="background-color:#f8f8f8;">
    <div class="mx-auto max-w-xl">
        <div class="bg-white rounded-2xl shadow-md p-6 sm:p-8">
            <h1 class="text-xl font-semibold mb-6">فرم نمونه</h1>

            <form method="POST" action="{{ route('new.report.store') }}" class="space-y-5">
                @csrf

                {{-- Select با 3 گزینه --}}
                <div>

                    
                     <input type="hidden" id="user_id" name="user_id" value="{{  $userId }}"
             
                           class="w-full rounded-xl border border-gray-200 bg-[#f8f8f8] focus:bg-white focus:border-gray-400 focus:outline-none px-4 py-2.5"
                           placeholder="مثلاً: موضوع گزارش">

                    @error("user_id")
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                     @enderror

                    <label for="status" class="block text-sm font-medium mb-2">دسته‌بندی</label>
                    <select id="status" name="status"
                            class="w-full rounded-xl border border-gray-200 bg-[#f8f8f8] focus:bg-white focus:border-gray-400 focus:outline-none px-4 py-2.5">
                        <option value="rejected">ناموفق </option>
                        <option value="called">موفق</option>
       
                    </select>
                    @error('status')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Input Text --}}
                <div>
                    <label for="title" class="block text-sm font-medium mb-2">عنوان</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}"
                           class="w-full rounded-xl border border-gray-200 bg-[#f8f8f8] focus:bg-white focus:border-gray-400 focus:outline-none px-4 py-2.5"
                           placeholder="مثلاً: موضوع گزارش">
                    @error('title')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Textarea --}}
                <div>
                    <label for="description" class="block text-sm font-medium mb-2">توضیحات</label>
                    <textarea id="description" name="description" rows="5"
                              class="w-full rounded-xl border border-gray-200 bg-[#f8f8f8] focus:bg-white focus:border-gray-400 focus:outline-none px-4 py-2.5"
                              placeholder="توضیحات خود را وارد کنید…">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- دکمه‌ها --}}
                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                            class="rounded-xl bg-black text-white px-5 py-2.5 hover:opacity-90 transition">
                        ارسال
                    </button>
                    <a href="{{ url()->previous() }}"
                       class="rounded-xl bg-[#f8f8f8] text-gray-800 px-5 py-2.5 border border-gray-200 hover:border-gray-300 transition">
                        انصراف
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
</x-app-layout>
