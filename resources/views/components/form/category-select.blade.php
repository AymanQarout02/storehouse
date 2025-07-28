<div>
    <label class="block text-gray-300 mb-1 font-medium">Categories</label>
    <select name="categories[]" class="js-data-example-ajax w-full" multiple="multiple"></select>
    @error('categories')
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
