@extends('partials.admin-nav')
@section('content')
    <section class="eats-wrapper relative w-11/12 lg:justify-center mx-auto">
        @if (session()->has('message'))
            <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3 alert" role="alert">
                <p style="color:red">{{ session()->get('message') }}</p>
            </div>
        @endif
        @if ($errors->any())
            <div class="flex items-center bg-red-500 text-white text-sm font-bold px-4 py-3 alert" role="alert">
                <p style="colot:red">{{ implode('', $errors->all(':message')) }}</p>
            </div>
        @endif
        <div class="items-container flex mx-auto mt-8 w-full">
            <div class="ui_single-container relative lg:justify-center flex flex-no-wrap w-1/3 mr-20">

                <form class="w-full max-w-lg" method="post" action="{{ route('saveStudents') }}">
                    @csrf
                    <div class="w-full py-3">
                        <span class="flex items-center tracking-wide text-gray-700 text-base font-bold mb-2">
                            @if ($student)
                                Edit Student
                            @else
                                Add New Student
                            @endif
                        </span>
                    </div>

                    <div class=" -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="flex items-center tracking-wide text-gray-700 text-base font-bold mb-2"
                                for="grid-last-name" required>
                                Name
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="title" name="name" type="text" placeholder="Student Name"
                                @if ($student) value="{{ $student->name }}" @endif>
                            <input type="hidden" name="id"
                                @if ($student) value="{{ $student->id }}" @endif>
                        </div>
                    </div>
                    <div class=" -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="flex items-center tracking-wide text-gray-700 text-base font-bold mb-2"
                                for="grid-last-name" required>
                                Age
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="age" name="age" type="text" placeholder="Student Age"
                                @if ($student) value="{{ $student->age }}" @endif>
                        </div>
                    </div>
                    <div class=" -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="flex items-center tracking-wide text-gray-700 text-base font-bold mb-2"
                                for="grid-gender" required>
                                Gender
                            </label>
                            <select name="gender" id="gender"
                                class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="">Select gender</option>
                                <option @if ($student) @if($student->gender =='Female') selected @endif @endif>Female</option>
                                <option @if ($student) @if($student->gender =='Male') selected @endif @endif >Male</option>
                                <option @if ($student) @if($student->gender =='Other') selected @endif @endif>Other</option>
                            </select>
                        </div>
                    </div>
                    <div class=" -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="flex items-center tracking-wide text-gray-700 text-base font-bold mb-2"
                                for="grid-last-name" required>
                                Reporting Teacher
                            </label>
                            <select name="teacher" id="teacher"
                                class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="">Select Teacher</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}"  @if ($student) @if($student->teacher == $teacher->id) selected @endif @endif>{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <button class="bg-purple-500 hover:bg-purple-700 font-bold text-white py-2 px-4 rounded mr-3">
                        @if ($student)
                            Edit Student
                        @else
                            Create New Student
                        @endif
                    </button>
                </form>

            </div>


            <div class="flex flex-col flex-1">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-6">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            #
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Age
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Gender
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Reporting Teacher
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">

                                    @foreach ($students as $row)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap" data-title="">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $loop->iteration }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap" data-title="">
                                                <div class="text-sm text-gray-900">{{ $row->name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap" data-title="">
                                                <div class="text-sm text-gray-900">{{ $row->age }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap" data-title="">
                                                <div class="text-sm text-gray-900">{{ $row->gender }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap" data-title="">
                                                <div class="text-sm text-gray-900">{{ $row->teachers->name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <a href="{{ route('showStudents', ['id' => $row->id]) }}"
                                                    class="text-indigo-600 hover:text-indigo-900 mrg delete-button mr-3"
                                                    data-placement="top" data-toggle="tooltip"
                                                    data-original-title="Edit">Edit
                                                    <a href="{{ route('deleteStudents', ['id' => $row->id]) }}"
                                                        class="text-indigo-600 hover:text-indigo-900 mrg delete-button"
                                                        data-id="{{ $row->id }}" data-placement="top"
                                                        data-toggle="tooltip" data-original-title="Delete">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (!count($students))
                                        <tr>
                                            <td colspan="5">No records found!</td>
                                        </tr>
                                    @endif

                                    <!-- More people... -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
@section('scripts')
@endsection
