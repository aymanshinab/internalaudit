<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('الموظفين') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
<div class="flex justify-between"><div>

                </div>
</div>
                    <br>

                    <div class="justify-end flex pr-56">
                        <a href="{{ Route('employee.register') }}">
                            <x-primary-button>{{ __('  موظف جديد') }}</x-primary-button>
                        </a>
                    </div>
                    <br>
                    @if ($employees->count() > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>  الرقم </th>
                                <th>اسم الموظف  </th>
                                <th>  رقم الهاتف</th>
                                <th> البريد الالكتروني  </th>
                                <th> الصلاحيات  </th>

                            </tr>
                        </thead>
                        <tbody>



                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $employee->id }}</td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->phone_number }}               </td>
                                    <td>  {{ $employee->email }}   </td>
                                    <td>  {{ $employee->role }}   </td>
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
                        {{ $employees->links() }}
                    </div>
                    @elseif (($employees->count() == 0))
                    <br>
                     <div> لا يوجد سجلات
                    </div>
                     @endif

</x-app-layout>
