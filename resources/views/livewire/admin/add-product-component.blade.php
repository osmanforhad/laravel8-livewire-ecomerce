<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Add Product Panel
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('admin.products')}}" 
                                class="btn btn-success pull-right">
                                Go to All Product List Panel
                            </a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">
                                {{Session::get('message')}}
                            </div>
                        @endif
                        <form class="form-horizontal" enctype="multipart/form-data" wire:submit.prevent="addProduct">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Product Name</label>
                                <div class="col-md-4">
                                <input type="text" wire:model="name" wire:keyup="generateSlug"
                                 placeholder="Product Name" class="form-control input-md"/>
                                 @error('name')
                                <p class="text-danger">{{$message}}</p>        
                                @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Product Slug</label>
                                <div class="col-md-4">
                                <input type="text" wire:model="slug"
                                 placeholder="Product Slug" class="form-control input-md"/>
                                 @error('slug')
                                <p class="text-danger">{{$message}}</p>        
                                @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Short Description</label>
                                <div class="col-md-4" wire:ignore>
                                <textarea class="form-control" id="short_description" placeholder="Short Description" wire:model="short_description"></textarea>
                                @error('short_description')
                                <p class="text-danger">{{$message}}</p>        
                                @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Details Description</label>
                                <div class="col-md-4" wire:ignore>
                                <textarea class="form-control" id="description" placeholder="Details Description" wire:model="description"></textarea>
                                @error('description')
                                <p class="text-danger">{{$message}}</p>        
                                @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Regular Price</label>
                                <div class="col-md-4">
                                <input type="text" wire:model="regular_price"
                                 placeholder="Regular Price" class="form-control input-md"/>
                                 @error('regular_price')
                                 <p class="text-danger">{{$message}}</p>        
                                 @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Sale Price</label>
                                <div class="col-md-4">
                                <input type="text" wire:model="sale_price"
                                 placeholder="Sale Price" class="form-control input-md"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">SKU</label>
                                <div class="col-md-4">
                                <input type="text" wire:model="SKU" placeholder="SKU" class="form-control input-md"/>
                                @error('SKU')
                                 <p class="text-danger">{{$message}}</p>        
                                 @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Stock Status</label>
                                <div class="col-md-4">
                                <select class="form-control" wire:model="stock_status">
                                    <option value="instock">InStock</option>
                                    <option value="outofstock">Out Of Stock</option>
                                </select>
                                @error('stock_status')
                                <p class="text-danger">{{$message}}</p>        
                                @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Featured</label>
                                <div class="col-md-4">
                                <select class="form-control" wire:model="featured">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Quantity</label>
                                <div class="col-md-4">
                                <input type="text" wire:model="quantity" placeholder="Quantity" 
                                class="form-control input-md"/>
                                @error('quantity')
                                <p class="text-danger">{{$message}}</p>        
                                @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Product Image</label>
                                <div class="col-md-4">
                                <input type="file" wire:model="image" class="input-file"/>
                                @if ($image)
                                    <img src="{{$image->temporaryUrl()}}" width="120"/>
                                @endif
                                @error('image')
                                <p class="text-danger">{{$message}}</p>        
                                @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Product Gallery</label>
                                <div class="col-md-4">
                                <input type="file" wire:model="images" class="input-file" multiple/>
                                @if ($images)
                                    @foreach ($images as $image)
                                     <img src="{{$image->temporaryUrl()}}" width="120"/>
                                    @endforeach
                                @endif
                                @error('images')
                                <p class="text-danger">{{$message}}</p>        
                                @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Product Category</label>
                                <div class="col-md-4">
                                <select class="form-control" wire:model="category_id">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <p class="text-danger">{{$message}}</p>        
                                @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>                                
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function() {
            //visual editor for Short Description Field
            tinymce.init({
                selector:'#short_description',
                setup: function(editor) {
                    editor.on('Change', function(e) {
                        tinyMCE.triggerSave();
                        var short_description_data = $('#short_description').val();
                        @this.set('short_description', short_description_data);
                    });
                }
            });
            //visual editor for Description Field
            tinymce.init({
                selector:'#description',
                setup: function(editor) {
                    editor.on('Change', function(e) {
                        tinyMCE.triggerSave();
                        var description_data = $('#description').val();
                        @this.set('description', description_data);
                    });
                }
            });
        });
    </script>
@endpush