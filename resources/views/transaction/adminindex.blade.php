<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('جميع المعاملات ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

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
                                <th>الإدارة</th>
                                <th>الشهر</th>
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
                                    <td>لا يوجد</td>
                                @endif
                                @if ($transaction->summary != null)
                                <td>{{ $transaction->summary }}</td>
                            @else
                                <td>لا يوجد</td>
                            @endif
                                    <td>{{ $transaction->type }}</td>
                                    <td>{{ $transaction->year }}               </td>
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
                                    <td>{{ $transaction->month }}             </td>
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
