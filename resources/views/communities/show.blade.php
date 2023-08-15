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
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    @forelse($posts as $post)
                        <a
                            href="{{ route('communities.posts.show',[$community,$post]) }}"
                            class="block max-w-lg mx-auto p-6 mb-2 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $post->title }}
                            </h5>
                            <p class="font-normal text-gray-700 dark:text-gray-400">
                                {{ $post->body }}
                            </p>
                        </a>
                    @empty
                        <div
                            class="p-4 mb-4 text-sm text-gray-800 rounded-lg text-center dark:bg-gray-800 dark:text-gray-400"
                            role="alert">
                            No posts yet.
                        </div>
                    @endforelse
                    <div class="px-8 py-4">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
