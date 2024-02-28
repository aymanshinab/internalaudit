
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(' الملاحظات ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
<div>

    <div class=" pb-6 p-4 text-xl font-normal">


        <div> نوع المعاملة : {{ $transaction->type }}
        </div>
        <div> السنة : {{ $transaction->year }}
        </div>
        <div> الادارة :

            @if ($transaction->management_id == 1)
                مكتب المدير العام
            @elseif ($transaction->management_id == 2)
                الادارة المالية
            @elseif ($transaction->management_id == 3)
                ادارة الموارد البشرية
            @elseif ($transaction->management_id == 4)
                ادارة الخدمات
            @endif




        </div>
        <div> الشهر : {{ $transaction->month }}
        </div>
        <div> البيانات : {{ $transaction->data }}
        </div>
    </div>


    <div class="p-3">
        <x-primary-button> <a href="{{ route('transaction.adminshow',  $transaction->id) }}">رجوع</a>
        </x-primary-button>
    </div>



<div class="flex justify-center">
    <table class="table  justify-center">
        <thead>
            <tr>
                <th>الملاحظة</th>
                <th>الإدارة</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notices as $notice)
            <tr>
                <td>{{ $notice->content }}</td>
                <td>
                    @php
                        $management = '';
                        switch ($notice->management_id) {
                            case 1:
                                $management = 'مكتب المدير العام';
                                break;
                            case 2:
                                $management = 'الإدارة المالية';
                                break;
                            case 3:
                                $management = 'إدارة الموارد البشرية';
                                break;
                            case 4:
                                $management = 'إدارة الخدمات';
                                break;
                        }
                    @endphp
                    {{ $management }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

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





















</div>

</div>
</div>
</div>


</x-app-layout>




