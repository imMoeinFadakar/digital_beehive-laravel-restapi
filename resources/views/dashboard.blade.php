<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
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

            </tr>
        </thead>
        <tbody>
            @foreach ($sellerUser as $index => $user)
                
            @endforeach
            <tr>
                <td>{{ $index +1}}</td>
                <td>{{ $user->user->first_name }}</td>
                <td>{{ $user->user->last_name }}</td>
                <td>{{ $user->user->email }}</td>
                <td>{{ $user->user->phone_number }}</td>
                <td>
                    <a  class="btn btn-success" href="{{ route("user.product.get",$user->user->id) }}">وضعیت خریدها</a>
                </td>
            </tr>
          
            <!-- ردیف‌های بیشتر -->
        </tbody>
    </table>
</div>



</x-app-layout>
