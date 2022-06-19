<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create an article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Create an article
                </div>
            </div>
 
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mt-10 sm:mt-0">
                    <div class="md:grid md:grid-cols-2 md:gap-6">
                      <div class="mt-5 md:mt-0 md:col-span-2">
                        <form action=" {{ route('articles.store') }} " method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                              <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-6">
                                  <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                                  <input type="text" value="{{ old('title') }}" name="title" id="title" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                   <span class="text-red-400">
                                    {{ $errors->first('title') }}
                                   </span>
                                </div>
                  
                                <div class="col-span-6 sm:col-span-6">
                                  <label for="full_text" class="block text-sm font-medium text-gray-700">Full Text</label>
                                  <textarea  name="full_text"  id="full_text" rows="10" cols="40">value="{{ old('full_text') }}"</textarea>
                                  <span class="text-red-400">
                                    {{ $errors->first('full_text') }}
                                   </span>
                                </div>
                  
                                <div class="col-span-6 sm:col-span-6">
                                  <label for="image" class="block text-sm font-medium text-gray-700">Image Upload</label>
                                  <input type="file" value="{{ old('image') }}"  name="image" id="image" autocomplete="image" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                  <span class="text-red-400">
                                    {{ $errors->first('image') }}
                                   </span>
                                </div>
                  
                                <div class="col-span-6 sm:col-span-6">
                                  <label for="category" class="block text-sm font-medium text-gray-700">Select Category</label>
                                  <select  id="category" name="category" autocomplete="category" class="select-single mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                     <option value="{{ $category->id }}">{{ $category->name }}</option>   
                                    @endforeach
                                   
                                  </select>
                                  <span class="text-red-400">
                                    {{ $errors->first('category') }}
                                   </span>
                                </div>
                  
                                <div class="col-span-6">
                                  <label for="tag" class="block text-sm font-medium text-gray-700">Add Tags</label>
                                    <select  name="tag[]" multiple="multiple" class="select-multiple mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                      <option value="">Select Tag(s)</option>
                                      @foreach ($tags as $tag)
                                      <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                      @endforeach
                                    </select> 
                                    <span class="text-red-400">
                                      {{ $errors->first('tag') }}
                                     </span>
                                </div>
                  
                              </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                              <input value='Create Article' type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  
            </div>
        </div>
       
    </div>


</x-app-layout>
