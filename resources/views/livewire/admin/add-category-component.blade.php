<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <b>Add New Product Category</b>
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('admin.categories')}}" 
                                class="btn btn-success pull-right">Go to All Category List
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
                        <form class="form-horizontal" wire:submit.prevent="storeCategory">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Category Name</label>
                                <div class="col-md-4">
                                <input type="text" wire:model="name" wire:keyup="generateslug"
                                placeholder="Category Name" class="form-control input-md"/>
                                @error('name')
                                <p class="text-danger">{{$message}}</p>        
                                @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Category Slug</label>
                                <div class="col-md-4">
                                <input type="text" wire:model="slug"
                                placeholder="Category Slug" class="form-control input-md"/>
                                @error('slug')
                                <p class="text-danger">{{$message}}</p>        
                                @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label"> </label>
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
