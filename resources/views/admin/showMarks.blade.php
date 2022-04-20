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

                <form class="w-full max-w-lg" method="post" action="{{ route('saveMarks') }}">
                    @csrf
                    <div class="w-full py-3">
                        <span class="flex items-center tracking-wide text-gray-700 text-base font-bold mb-2">
                            @if ($mark)
                                Edit Mark
                            @else
                                Add Mark
                            @endif
                        </span>
                    </div>

                    <div class=" -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="flex items-center tracking-wide text-gray-700 text-base font-bold mb-2"
                                for="grid-last-name" required>
                                Name
                            </label>
                            <select name="student" id="student"
                                class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="">Select Student</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}"  @if ($mark) @if($mark->student == $student->id) selected @endif @endif>{{ $student->name }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="id"
                                @if ($mark) value="{{ $mark->id }}" @endif>
                        </div>
                    </div>
                    <div class=" -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="flex items-center tracking-wide text-gray-700 text-base font-bold mb-2"
                                for="grid-term" required>
                                Term
                            </label>
                            <select name="term" id="term"
                                class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="">Select Term</option>
                                @foreach ($terms as $term)
                                    <option value="{{ $term->id }}"  @if ($mark) @if($mark->term == $term->id) selected @endif @endif>{{ $term->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if($subjects)
                    @php $k=0; @endphp
                        @foreach ($subjects as $subject)
                            <div class=" -mx-3 mb-6">
                                <div class="w-full px-3">
                                    <label class="flex items-center tracking-wide text-gray-700 text-base font-bold mb-2"
                                        for="grid-last-name" required>
                                        {{ $subject->name }}
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        id="mark" name="mark[]" type="text" placeholder="Enter  {{ $subject->name }} Mark" @if($mark) value=" {{ json_decode($mark->mark)[$k] }}" @endif>
                                    <input id="subject" name="subject[]" type="hidden" value="{{ $subject->id }}">
                                </div>
                            </div>
                            @php $k++; @endphp
                        @endforeach
                    @endif


                    <button class="bg-purple-500 hover:bg-purple-700 font-bold text-white py-2 px-4 rounded mr-3">
                        @if ($mark)
                            Edit Mark
                        @else
                            Add Mark
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
                                        @foreach ($subjects as $subject )
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ $subject->name }}
                                        </th>

                                        @endforeach
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Term
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Total Marks
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Created On
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">

                                    @foreach ($marks as $row)
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
                                                    <div class="text-sm text-gray-900">{{ $row->students->name }}</div>
                                                </td>
                                                @php $total = 0; @endphp
                                                @foreach(json_decode($row->mark) as $mark)
                                                <td class="px-6 py-4 whitespace-nowrap" data-title="">
                                                    <div class="text-sm text-gray-900">{{ $mark }}</div>
                                                    @php $total += $mark;
                                                    @endphp
                                                </td>
                                                @endforeach
                                                <td class="px-6 py-4 whitespace-nowrap" data-title="">
                                                    <div class="text-sm text-gray-900">{{ $row->terms->name }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap" data-title="">
                                                    <div class="text-sm text-gray-900">{{ $total }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap" data-title="">
                                                    <div class="text-sm text-gray-900">{{ date('M d, Y H:i a',strtotime($row->created_at)) }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <a href="{{ route('showMarks', ['id' => $row->id]) }}"
                                                        class="text-indigo-600 hover:text-indigo-900 mrg delete-button mr-3"
                                                        data-placement="top" data-toggle="tooltip"
                                                        data-original-title="Edit">Edit
                                                        <a href="{{ route('deleteMarks', ['id' => $row->id]) }}"
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

