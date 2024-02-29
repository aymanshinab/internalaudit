<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('جميع المعاملات ') }}
        </h2>
    </x-slot>
    @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative flex flex-row-reverse justify-between"
        role="alert">
        <div>
            <span class="absolute top-0 bottom-0 left-0 px-4 py-3">
                <svg id="close-icon" class="fill-current h-6 w-6 text-green-500" role="button"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">

                    <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </span>
        </div>
        <div>
            <strong class="block sm:inline">{{ session('success') }}</strong>
        </div>
    </div>
    <script>
        document.getElementById('close-icon').addEventListener('click', function() {
            var alert = document.querySelector('[role="alert"]');
            alert.remove();
        });
        setTimeout(function() {
            var alert = document.querySelector('[role="alert"]');
            alert.remove();
        }, 3000);
    </script>
@endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('transaction.adminsearch') }}" method="post">
                        @csrf
                    <label for="id">البحث</label>
                    <x-text-input placeholder="رقم المعاملة" name="id" id="id"  class="h-10"></x-text-input>
                    <x-primary-button  type="submit" >
                      {{ __('بحث') }}
                   </x-primary-button>


                </form>
                    <div class="justify-end flex pr-56">
                        <a href="{{ Route('transaction.admincreate') }}">
                            <x-primary-button>{{ __('إنشاء معاملة') }}</x-primary-button>
                        </a>
                    </div>
 <br>

                    @if ($transactions->count() > 0)



                    <table class="table">
                        <thead>
                            <tr>
                                <th>رقم المعاملة</th>
                                <th>رقم القيد</th>
                                <th>رقم الملخص</th>
                                <th>نوع المعاملة</th>
                                <th>السنة</th>
                                <th>الشهر</th>
                                <th>الإدارة</th>

                                <th>البيانات</th>
                                <th>حالة المعاملة </th>
                                <th>عرض</th>
                            </tr>
                        </thead>
                        <tbody>



                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->id }}</td>
                                    @if ($transaction->idnum != null)
                                    <td>{{ $transaction->idnum }}</td>
                                @else
                                    <td>- </td>
                                @endif
                                @if ($transaction->summary != null)
                                <td>{{ $transaction->summary }}</td>
                            @else
                                <td>- </td>
                            @endif
                                    <td>{{ $transaction->type }}</td>
                                    <td>{{ $transaction->year }}               </td>
                                    <td>{{ $transaction->month }}             </td>
                                    <td>


                                            @if ($transaction->management_id == 1)
                                                مكتب المدير العام
                                            @elseif ($transaction->management_id == 2)
                                                الادارة المالية
                                                @elseif ($transaction->management_id == 3)
                                           ادارة الموارد البشرية
                                                @elseif ($transaction->management_id == 4)
                                               ادارة الخدمات
                                            @endif



                                    </td>

                                    <td>{{ $transaction->data }}              </td>
                                    <td>
                                        @if ($transaction->transactions_type == 1)
                                            إنشاء
                                        @elseif ($transaction->transactions_type == 2)
                                            رفض
                                            @elseif ($transaction->transactions_type == 3)
                                           اعتماد

                                        @elseif ($transaction->transactions_type == 4)
                                        اعادة توجيه
                                     @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('transaction.adminshow', ['transaction' => $transaction->id]) }}">
                                            <x-primary-button class="bg-blue-600 hover:bg-blue-900">
                                                {{ __('عرض') }}
                                            </x-primary-button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                        <style>
                            table {
                                width: 100%;
                                border-collapse: collapse;
                                font-family: Arial, sans-serif;
                                color: #333;
                            }

                            th, td {
                                border: 1px solid #ddd;
                                padding: 12px;
                                text-align: right;
                            }

                            th {
                                background-color: #f2f2f2;
                                font-weight: bold;
                                text-transform: uppercase;
                            }

                            tbody tr:nth-child(even) {
                                background-color: #f9f9f9;
                            }

                            tbody tr:hover {
                                background-color: #f5f5f5;
                            }

                            th:hover {
                                background-color: #e8e8e8;
                            }

                            @media screen and (max-width: 768px) {
                                table {
                                    width: 100%;
                                }

                                th, td {
                                    padding: 8px;
                                }
                            }
                        </style>
                    </table>
                    <div class="pt-4">
                        {{ $transactions->links() }}
                    </div>
                    @elseif (($transactions->count() == 0))
                 لا يوجد سجلات
                 @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
