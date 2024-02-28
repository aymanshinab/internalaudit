<script>
    function closeModal() {
        event.preventDefault();
        location.reload();
    }
</script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://kit.fontawesome.com/c100dce926.js" crossorigin="anonymous"></script>

<x-employee-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('تفاصيل المعاملة ') }}
        </h2>
    </x-slot>
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative flex flex-row-reverse justify-between"
            role="alert">
            <div>
                <span class="absolute top-0 bottom-0 left-0 px-4 py-3">
                    <svg id="close-icon" class="fill-current h-6 w-6 text-green-500" role="button"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Close</title>
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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <script src="https://code.jquery.com/jquery-3.7.0.min.js"
                    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
                <script src="//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>



                <div>
                    <div class= " pb-10 p-4 text-xl font-normal flex justify-between  ">
                        <div>


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
                        <form action="{{ route('transaction.update', $transaction->id) }}" method="POST">
                            @method('PATCH')
                            @csrf

                            <x-input-label class="pb-2" name="transactions_type">نوع الاجراء</x-input-label>




                            <div x-data="{ selectedOption: '3', note: '', modelOpen: true }">
                                <select
                                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    name="transactions_type" x-model="selectedOption">
                                    <option value="3">اعتماد</option>
                                    <option value="2">رفض</option>
                                    <option value="4">اعادة توجيه</option>
                                </select>



                                <div x-show="selectedOption === '4' && modelOpen"
                                    class="fixed inset-0 flex items-center justify-center z-50">
                                    <div class="modal-overlay absolute inset-0 bg-gray-900 opacity-50"></div>
                                    <div class="modal-container bg-white w-1/2 mx-auto rounded-lg shadow-lg z-50">
                                        <div class="modal-content p-4">
                                            <div class="text-xl font-bold mb-4 justify-between flex">
                                                <h2>الرجاء اختيار الموظف الذي سيتم توجيه المعاملة اليه</h2>
                                                <button onclick="closeModal();"
                                                    class="text-gray-600 focus:outline-none hover:text-gray-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="overflow-y-auto" style="max-height: 400px;">

                                                <div id="fields-container" class="flex flex-row gap-3">

                                                    <x-input-label class="pt-3 pb-2" name="name"> اسم الموظف
                                                    </x-input-label>


                                                    <div>
                                                        <select
                                                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                                            name="to_employee" x-model="selectedOption2">
                                                            @foreach ($employees as $employee)
                                                          <option value="{{ $employee->id }}" >  {{ $employee->name }}
</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex justify-end mt-4">
                                                <x-primary-button type="submit"
                                                    class="text-white bg-green-600 hover:bg-green-800 font-bold rounded"
                                                    @click="sendForm">موافق</x-primary-button>
                                            </div>
                                        </div>
                                    </div>
                                </div>





                                <div x-show="selectedOption === '2' && modelOpen"
                                    class="fixed inset-0 flex items-center justify-center z-50">
                                    <div class="modal-overlay absolute inset-0 bg-gray-900 opacity-50"></div>
                                    <div class="modal-container bg-white w-1/2 mx-auto rounded-lg shadow-lg z-50">
                                        <div class="modal-content p-4">
                                            <div class="text-xl font-bold mb-4 justify-between flex">
                                                <h2>الرجاء ادخال الملاحظات</h2>
                                                <button onclick="closeModal();"
                                                    class="text-gray-600 focus:outline-none hover:text-gray-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </button>

                                            </div>
                                            <div id="grid-view" class="overflow-y-auto" style="max-height: 400px; ">
                                                <div id="fields-container" class="flex flex-row gap-3  ">
                                                    <div>
                                                        <x-input-label class="pt-3 pb-2"
                                                            name="content">الملاحظة</x-input-label>
                                                        <x-text-input name="content[]" id="content"
                                                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                                            x-model="note"></x-text-input>
                                                    </div>

                                                    <div>
                                                        <x-input-label class="pt-3 pb-2"
                                                            name="management">الإدارة</x-input-label>
                                                        <select
                                                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                                            name="management_id[]" onchange="showFields(this.value)">

                                                            <option value="1">مكتب المدير العام</option>
                                                            <option value="2">الإدارة المالية</option>
                                                            <option value="3">إدارة الموارد البشرية
                                                            </option>
                                                            <option value="4">إدارة الخدمات</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <script>
                                                function createNewFields(event) {
                                                    event.preventDefault();
                                                    // إنشاء العناصر الجديدة
                                                    var newRow = document.createElement("div");
                                                    var col1 = document.createElement("div");
                                                    var col2 = document.createElement("div");
                                                    var newLabel = document.createElement("label");
                                                    var newTextInput = document.createElement("input");
                                                    var newInputLabel = document.createElement("label");
                                                    var newSelect = document.createElement("select");

                                                    newRow.setAttribute("class", "flex flex-row gap-3");
                                                    // var rowId = Math.random().toString(16);
                                                    // newRow.setAttribute("id", rowId )
                                                    // تعيين الصفات للعناصر الجديدة
                                                    newLabel.setAttribute("class", "pt-3 pb-2 block font-medium text-sm text-gray-700 dark:text-gray-300");
                                                    newLabel.setAttribute("for", "content");
                                                    newLabel.textContent = "الملاحظة";

                                                    newTextInput.setAttribute("name", "content[]");
                                                    //newTextInput.setAttribute("id", "content");
                                                    newTextInput.setAttribute("class",
                                                        "border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                                    );

                                                    newInputLabel.setAttribute("class", "pt-3 pb-2 block font-medium text-sm text-gray-700 dark:text-gray-300");
                                                    newInputLabel.setAttribute("for", "management");
                                                    newInputLabel.innerText = "الإدارة";

                                                    newSelect.setAttribute("class",
                                                        "border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                                    );
                                                    //newSelect.setAttribute("id", "management");
                                                    newSelect.setAttribute("name", "management_id[]");
                                                    newSelect.onchange = function() {
                                                        showFields(this.value);
                                                    };

                                                    var option1 = document.createElement('option');
                                                    option1.value = '1';
                                                    option1.textContent = 'مكتب المدير العام';
                                                    var option2 = document.createElement('option');
                                                    option2.value = '2';
                                                    option2.textContent = 'الإدارة المالية';
                                                    var option3 = document.createElement('option');
                                                    option3.value = '3';
                                                    option3.textContent = 'إدارة الموارد البشرية';
                                                    var option4 = document.createElement('option');
                                                    option4.value = '4';
                                                    option4.textContent = 'إدارة الخدمات';

                                                    // إضافة الخيارات إلى عنصر الاختيار الجديد:
                                                    newSelect.appendChild(option1);
                                                    newSelect.appendChild(option2);
                                                    newSelect.appendChild(option3);
                                                    newSelect.appendChild(option4);

                                                    // إضافة العناصر الجديدة إلى العنصر الأب
                                                    col1.appendChild(newLabel);
                                                    col1.appendChild(newTextInput);
                                                    col2.appendChild(newInputLabel);
                                                    col2.appendChild(newSelect);

                                                    newRow.appendChild(col1);
                                                    newRow.appendChild(col2);


                                                    // إضافة العنصر الجديد إلى عنصر الحاوية
                                                    var gridView = document.getElementById("grid-view");
                                                    gridView.appendChild(newRow);
                                                }

                                                function showFields(value) {
                                                    // تحديد العنصر الذي سيتم عرضه بناءً على القيمة المحددة
                                                    // var contentInput = document.getElementById("content");
                                                    // var managementSelect = document.getElementById("management");


                                                    // contentInput.style.display = "block";
                                                    // managementSelect.style.display = "none";

                                                }
                                            </script>



                                            <script>
                                                function deleteRow(event) {
                                                    event.preventDefault();
                                                    var gridView = document.getElementById("grid-view");

                                                    if (gridView.children.length > 1) {
                                                        gridView.removeChild(gridView.lastChild);
                                                    }
                                                }
                                            </script>
                                            <div class="flex justify-between mt-6">
                                                <div> <x-primary-button onclick="createNewFields(event)">إنشاء ملاحظة
                                                        جديدة</x-primary-button>

                                                    <x-primary-button class="bg-red-500 hover:bg-red-800"
                                                        onclick="deleteRow(event)">حذف ملاحظة </x-primary-button>


                                                </div>

                                                <div>
                                                    <x-primary-button type="submit"
                                                        class="text-white  bg-green-600 hover:bg-green-800 font-bold rounded"
                                                        @click="sendForm">موافق</x-primary-button>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                                <x-primary-button type="submit">موافق</x-primary-button>
                            </div>

                            <script src="https://cdn.jsdelivr.net/npm/alpinejs" defer></script>


                        </form>

                    </div>

                    <div>

                        <div class="pr-3">
                            <x-primary-button> <a href="{{ route('transaction.index', $transaction->id) }}">رجوع</a>
                            </x-primary-button>
                        </div>

                    </div>


                </div>

                <br>
                <div class=" justify-center flex pb-10">


                    <table class="table">
                        <thead>
                            <tr>
                                <th>اسم الموظف</th>
                                <th>نوع الاجراء </th>
                                <th>تاريخ الانشاء</th>
                                <th>اعادة التوجيه الي </th>
                                <th>الملاحظات</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($procedures as $procedure)
                                <tr>
                                    <td>{{ $procedure->name }}</td>
                                    <td>{{ $procedure->procedure_name }} </td>
                                    <td>{{ $procedure->procedure_time }} </td>
                                <td> {{ $procedure->to_name }}</td>
                                    <td>
                                        @if ($procedure->procedure_name == 'رفض')
                                            <a href="{{ Route('notice.show', $transaction->id) }}">


                                                <x-primary-button> عرض
                                                </x-primary-button>
                                            </a>
                                        @endif

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

                </div>

            </div>
        </div>
    </div>
    </div>
</x-employee-layout>
