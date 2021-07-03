<div>
    <div class="container" style="padding:30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Add New Slider Panel
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('admin.homeslider')}}" 
                                class="btn btn-success pull-right">
                            Go to All Slider List Panel
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
                        <form class="form-horizontal" wire:submit.prevent="addSlider">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Title</label>
                                <div class="col-md-4">
                                    <input type="text" wire:model="title" placeholder="Slider Title" 
                                    class="form-control input-md"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Sub Title</label>
                                <div class="col-md-4">
                                    <input type="text" wire:model="subtitle" placeholder="Slider Sub Title" 
                                    class="form-control input-md"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Price</label>
                                <div class="col-md-4">
                                    <input type="text" wire:model="price" placeholder="Price" 
                                    class="form-control input-md"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Link</label>
                                <div class="col-md-4">
                                    <input type="text" wire:model="link" placeholder="Link" 
                                    class="form-control input-md"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Image</label>
                                <div class="col-md-4">
                                    <input type="file" wire:model="image" class="form-control input-file"/>
                                    @if ($image)
                                    <img src="{{$image->temporaryUrl()}}" width="120"/>
                                @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Status</label>
                                <div class="col-md-4">
                                    <select class="form-control" wire:model="status">
                                        <option value="0">Inactive</option>
                                        <option value="1">Active</option>
                                    </select>
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
