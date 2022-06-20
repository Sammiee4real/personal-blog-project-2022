<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Showing details for  this article:')  }} {{ $article->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Show details of the article: {{ $article->title }}
                </div>
            </div>
 
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mt-10 sm:mt-0">
                    <div class="md:grid md:grid-cols-2 md:gap-6">
                      <div class="mt-5 md:mt-0 md:col-span-2">
                      
                          <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                              <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-6">
                                  <label for="title" class="block text-sm font-medium text-gray-700">Title: {{$article->title}}</label>    
                                </div>
                  
                                <div class="col-span-6 sm:col-span-6">
                                  <label for="full_text" class="block text-sm font-medium text-gray-700">Full Text:</label>
                                  <textarea  name="full_text" disabled  id="full_text" rows="10" cols="40">{{ $article->full_text ?? old('full_text') }}</textarea>
                                 
                                </div>
                  
                                <div class="col-span-6 sm:col-span-6">
                                  <label for="category" class="block text-sm font-medium text-gray-700">Category: {{ $category->name }}</label> 
                                </div>
                  
                                <div class="col-span-6">
                                     <strong>Tags:</strong>
                                      @foreach ($tagss as $tag)
                                          @if ( in_array( $tag->name , $article->tags  ) ) 
                                          <label for="tag" class="block text-sm font-medium text-gray-700">{{ $tag->name }}</label>
                                          @endif      
                                      @endforeach
                                 
                                 
                                </div>
                  
                              </div>
                            </div>
                           
                          </div>
                    
                      </div>
                    </div>
                  </div>
                  
            </div>
        </div>
       
    </div>


</x-app-layout>
