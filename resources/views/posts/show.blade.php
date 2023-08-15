<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('communities.show',$community) }}" class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $community->name }}
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                @if(session('message'))
                    <div
                        class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                        role="alert">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="py-8 px-4 flex justify-end px-4">
                    <a href="{{ route('communities.posts.create',$community) }}" type="button"
                       class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Add New Post
                    </a>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-8">
                    @if($post->image !== "")
                        <img src="{{ asset($post->image)  }}" alt="{{ $post->title }}" class="w-48 h-48"
                    @endif

                    <div
                        href="{{ route('communities.posts.show',[$community,$post]) }}"
                        class="block max-w-2xl mx-auto p-6 mb-2 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $post->title }}
                        </h5>
                        @if($post->url != "")
                            <a href="{{ $post->url }}"
                               target="_blank"
                               class="font-normal text-gray-700 dark:text-gray-400 underline">
                                {{ $post->url }}
                            </a>
                        @endif
                        <p class="font-normal text-gray-700 dark:text-gray-400">
                            {{ $post->body }}
                        </p>

                        <div class="mt-8">
                            <a href="{{ route('communities.posts.edit',[$community,$post]) }}" type="button"
                               class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Edit
                            </a>

                            <form action="{{ route('communities.posts.destroy',[$community,$post]) }}" method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        onclick="return confirm('Are you sure?')"
                                        class=" text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300
                                    font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600
                                    dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800
                            ">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
