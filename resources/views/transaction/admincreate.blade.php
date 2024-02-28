<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('انشاء معاملة جديدة') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <script src="https://code.jquery.com/jquery-3.7.0.min.js"
                integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
            <script src="//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>





            <script>
                @if (Session::has('success'))
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.success("{{ session('success') }}");
                @endif
            </script>
                <div class="p-6 text-gray-900">
                    @if (session()->has('success'))
                    <div>
                        <p class="bg-green-500">{{ session()->get('message') }}</p>
                    </div>
                @endif

                <form action="{{ route('transaction.adminstore') }}" method="post">
@csrf

<div class="pb-2">
    <x-input-label class="pb-2" name="data">البيانات</x-input-label>
    <x-text-input name="data"></x-text-input>
  </div>

<div class="pb-2"><x-input-label class="pb-2" name="type">نوع المعاملة</x-input-label>
      <select  class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="type">
        <option value="  رعاية صحية ">   رعاية صحية </option>
        <option value="اثبات">   اثبات </option>
        <option value="  اقفال ">   اقفال </option>
        <option value="إجراء   "> إجراء   </option>
        <option value="سداد   ">  سداد  </option>
        <option value="  مرتبات ">   مرتبات </option>
      </select>
</div>



<div class="pb-2">
    <x-input-label class="pb-2" name="year">السنة</x-input-label>
    <select name="year" class="form-control border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
        @for ($i = date('Y'); $i >= 2012; $i--)
            <option value="{{ $i }}">{{ $i }}</option>
        @endfor
    </select>
</div>
<div class="pb-2"> <x-input-label class="pb-2" name="month">الشهر</x-input-label> <select class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="month"> <option value="يناير">يناير</option> <option value="فبراير">فبراير</option> <option value="مارس">مارس</option> <option value="أبريل">أبريل</option> <option value="مايو">مايو</option> <option value="يونيو">يونيو</option> <option value="يوليو">يوليو</option> <option value="أغسطس">أغسطس</option> <option value="سبتمبر">سبتمبر</option> <option value="أكتوبر">أكتوبر</option> <option value="نوفمبر">نوفمبر</option> <option value="ديسمبر">ديسمبر</option> </select> </div>

<div class="pb-2"><x-input-label  class="pb-2" name="management_id">الادارة</x-input-label>
    <select class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="management_id" onchange="showFields(this.value)">
        <option value="1">مكتب المدير العام</option>
        <option value="2">الإدارة المالية</option>
        <option value="3">إدارة الموارد البشرية</option>
        <option value="4">إدارة الخدمات</option>
      </select>

      <div id="idnumField" style="display: none;">
        <x-input-label class="pt-3 pb-2" name="idnum">رقم القيد</x-input-label>
        <x-text-input id="idnum" type="number" name="idnum" class="mb-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></x-text-input>
      </div>

      <div id="summaryField" style="display: none;">
        <x-input-label class="pt-3 pb-2" name="summary">رقم الملخص</x-input-label>
        <x-text-input id="summary" type="number" name="summary" class="mb-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></x-text-input>
      </div>

      <div class="pb-2">

      </div>

      <br>

      <x-primary-button type="submit">انشاء</x-primary-button>

      <script>
        function showFields(value) {
          const idnumField = document.getElementById('idnumField');
          const summaryField = document.getElementById('summaryField');

          if (value == 2) {
            idnumField.style.display = 'block';
            summaryField.style.display = 'none';
          } else if (value == 3) {
            idnumField.style.display = 'none';
            summaryField.style.display = 'block';
          } else {
            idnumField.style.display = 'none';
            summaryField.style.display = 'none';
          }
        }
      </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
