<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <b>Create New Coupon</b>
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('admin.coupons')}}" 
                                class="btn btn-success pull-right">Go to All Coupon List
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
                        <form class="form-horizontal" wire:submit.prevent="createCoupon">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Coupon Code</label>
                                <div class="col-md-4">
                                <input type="text" wire:model="code"
                                placeholder="Coupon Code" class="form-control input-md"/>
                                @error('code')
                                <p class="text-danger">{{$message}}</p>        
                                @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Coupon Type</label>
                                <div class="col-md-4">
                                <select class="form-control" wire:model="type">
                                    <option value="">Select</option>
                                    <option value="fixed">Fixed</option>
                                    <option value="percent">Percent</option>
                                </select>
                                @error('type')
                                <p class="text-danger">{{$message}}</p>        
                                @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Coupon Value</label>
                                <div class="col-md-4">
                                <input type="text" wire:model="value"
                                placeholder="Coupon Value" class="form-control input-md"/>
                                @error('value')
                                <p class="text-danger">{{$message}}</p>        
                                @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Cart Value</label>
                                <div class="col-md-4">
                                <input type="text" wire:model="cart_value"
                                placeholder="Cart Value" class="form-control input-md"/>
                                @error('cart_value')
                                <p class="text-danger">{{$message}}</p>        
                                @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Expiry Date</label>
                                <div class="col-md-4">
                                <input type="text" id="expiry-date" wire:model="expiry_date"
                                placeholder="Expiry Date" class="form-control input-md"/>
                                @error('expiry_date')
                                <p class="text-danger">{{$message}}</p>        
                                @enderror
                                </div>
                            </div>
    
                            <div class="form-group">
                                <label class="col-md-4 control-label"> </label>
                                <div class="col-md-4" wire:ignore>
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
    //function for js date sclection
    $(function() {
        $('#expiry-date').datetimepicker({
            format: 'Y-MM-DD'
        })
        .on('dp.change', function(ev) {
            var data = $('#expiry-date').val();
            @this.set('expiry_date', data);
        });
    });
</script>
@endpush
