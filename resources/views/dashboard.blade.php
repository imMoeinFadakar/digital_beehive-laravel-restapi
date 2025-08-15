<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('پنل فروشندگان') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <p  clas >کد دعوت شما:
                        <button class="btn btn-dark" onclick="copyToClipboard()">📋 کپی کن</button>
                        <a id="inviteLink" href="{{ $sellerRefferalCode }}" target="_blank">
                           {{ $sellerRefferalCode }}
                        </a>
                    </p>
              
                </div>
            </div>
        </div>
    </div>





    <div class="container mt-5">

    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>نام</th>
                <th>نام خانوادگی</th>
                <th>ایمیل</th>
                <th>شماره تماس</th>
                <th> وضعیت سفارشات کاربر</th>
                <th>دیدن زیرمجموعه کاربر</th>
                <th>رفرال های کاربر</th>
                <th> ثبت گزارش </th>



            </tr>
        </thead>
        <tbody>
            @foreach ($sellerUser as $index => $user)
                
            <tr>
                <td>{{ $index +1}}</td>
                <td>{{ $user->user->first_name }}</td>
                <td>{{ $user->user->last_name }}</td>
                <td>{{ $user->user->email }}</td>
                <td>{{ $user->user->phone_number }}</td>
                <td>
                    <a  class="btn btn-success" href="{{ route("user.product.get",$user->user->id) }}">وضعیت خریدها</a>
                </td>
                 <td>
                    <a  class="btn btn-danger" href="{{ route("reffrals",[$user->user->refferal_code, $gen + 1 ]) }}">مشاهده</a>
                </td>
                <td>{{ $user->referrals_count  }}</td>
                <td>
                    <a  class="btn btn-warning" href="{{ route("new.report.create",$user->user->refferal_code) }}">ثبت گزارش</a>
                </td>

            </tr>
            
            @endforeach
            <!-- ردیف‌های بیشتر -->
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    {{ $sellerUser->links() }}
</div>
<script>
    function copyToClipboard() {
        const link = document.getElementById("inviteLink").href;

        // کپی کردن به کلیپ‌بورد
        navigator.clipboard.writeText(link).then(function() {
            alert("لینک با موفقیت کپی شد!");
        }, function(err) {
            alert("خطا در کپی کردن لینک: " + err);
        });
    }
</script>

</x-app-layout>
