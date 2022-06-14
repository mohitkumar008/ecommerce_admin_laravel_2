<div class="form-group">
    <label for="parent_category">Parent Category<span class="text-warning">*</span></label>
    <select class="form-control" id="parent_category" name="parent_category">
        <option value="0" selected>Main Category</option>
        @if (isset($getCategory))
            @foreach ($getCategory as $category)
                <option value="{{ $category['id'] }}" @if (isset($categoryData) && $category['id'] == $categoryData->parent_id) {{ 'selected' }} @endif>
                    {{ $category['category_name'] }}</option>
                @if (!empty($category['subcategories']))
                    @foreach ($category['subcategories'] as $subcategory)
                        <option value="{{ $subcategory['id'] }}"
                            @if (isset($categoryData) && $subcategory['id'] == $categoryData->parent_id) {{ 'selected' }} @endif>&nbsp; -
                            &nbsp;{{ $subcategory['category_name'] }}
                        </option>
                    @endforeach
                @endif
            @endforeach
        @endif
    </select>
</div>
