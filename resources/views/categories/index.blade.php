<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        
        <div class="max-w-4xl mx-auto  bg-white overflow-hidden shadow-sm sm:rounded-lg">
               <div class="w-3/4 p-4 mx-auto text-green-600">
                    @if (session('message'))
                    <div class="alert alert-success">
                    {{ session('message') }}
                    </div>
                @endif
               </div>
             
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                
                                
                                <th scope="col" class="px-6 py-3">
                                    Category Title
                                </th>
                              
                                <th scope="col" class="px-6 py-3">
                                    Creation Date
                                </th>

                                <th></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                           @forelse ($categories as $category)
                            <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                           
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                <a href="#">{{ $category->name }}</a>
                            </th>
                            <td class="px-6 py-4">
                                {{ $category->created_at }}
                            </td>
                            <td>
                                @if ( auth()->id() == 1 )
                                  <a href="{{ route('categories.edit',$category->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>                                    
                                @endif
                            </td>
                            
                        </tr>
                        @empty
                            No Categories found
                         @endforelse
                            
                        </tbody>
                    </table>
                   <div class="p-4">
                    {{-- {{ $categories->links() }} --}}
                   </div>
                {{-- </div>   --}}
        </div>

    </div>
</x-app-layout>
