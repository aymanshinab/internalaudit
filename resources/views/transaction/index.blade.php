<x-employee-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('جميع المعاملات') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
<div class="flex justify-between"><div>

                        <form action="{{ route('transaction.search') }}" method="post">
                            @csrf
                        <label for="id">البحث</label>
                        <x-text-input placeholder="رقم المعاملة" name="id"  id="id"  class="h-10"></x-text-input>
                        <x-primary-button  type="submit" >
                          {{ __('بحث') }}
                       </x-primary-button>


                    </form>
                </div>

                    <div>
                    @if (Auth::guard("employee")->user()->role == 1)
                    <div class="justify-end flex pr-56">
                        <a href="{{ Route('transaction.create') }}">
                            <x-primary-button>{{ __('إنشاء معاملة') }}</x-primary-button>
                        </a>
                    </div>
                    @endif
                </div></div>
                    <br>
               @if ($transactions->count() > 0)
                    @if (Auth::guard("employee")->user()->role ==1  )
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
                                        <a href="{{ route('transaction.show', ['transaction' => $transaction->id]) }}">
                                            <x-primary-button class="bg-[#346885] hover:bg-blue-900">
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

                    @endif

 @if (Auth::guard("employee")->user()->role == 2  )
 <table class="table">
     <thead>
         <tr>
             <th>رقم المعاملة</th>
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



         @foreach ($trans as $tran)
             <tr>
                 <td>{{ $tran->id }}</td>
                 <td>{{ $tran->type }}</td>
                 <td>{{ $tran->year }}               </td>
                 <td>


                         @if ($tran->management_id == 1)
                             مكتب المدير العام
                         @elseif ($tran->management_id == 2)
                             الادارة المالية
                             @elseif ($tran->management_id == 3)
                        ادارة الموارد البشرية
                             @elseif ($tran->management_id == 4)
                            ادارة الخدمات
                         @endif



                 </td>
                 <td>{{ $tran->month }}             </td>
                 <td>{{ $tran->data }}              </td>
                 <td>
                     @if ($tran->transactions_type == 1)
                         إنشاء
                     @elseif ($tran->transactions_type == 2)
                         رفض
                         @elseif ($tran->transactions_type == 3)
                        اعتماد
                     @endif
                 </td>
                 <td>
                     <a href="{{ route('transaction.show', ['transaction' => $tran->id]) }}">
                         <x-primary-button class="bg-[#346885] hover:bg-blue-900">
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
 @endif




                    <br>

                </div>


            </div>
            @elseif (($transactions->count() == 0))
            <br>
             <div> لا يوجد سجلات
            </div>
             @endif
        </div>
    </div>
</x-employee-layout>
