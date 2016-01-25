
			<!-- Older code  -->
			<div class="row">
				<div class="medium-2 columns">
					<label for="quantity" class="right inline">Quantity</label>
				</div>
				<div class="medium-5 end columns">
					<input type="text" name="quantity" id="quantity" value="{{ $product->quantity }}">
				</div>
			</div>				
			<div class="row">
				<div class="medium-2 columns">
					<label for="unit_id" class="right inline">Unit</label>
				</div>
				<div class="medium-5 end columns">
					<select name="unit_id" id="unit_id">
						@foreach ($units as $unit)
							<option value="{{ $unit->id }}" 
								@if($product['unit_id'] == $unit['id'])
									selected="selected" 
								@endif
							>{{ $unit->unit_name }}</option>
						@endforeach
					</select>
				</div>
			</div>				
			<div class="row">
				<div class="medium-2 columns">
					<label for="price" class="right inline">Trolleyin Price</label>
				</div>
				<div class="medium-5 end columns">
					<input type="text" name="price" id="price" value="{{ $product->price }}"></select>
				</div>
			</div>				
			<div class="row">
				<div class="medium-2 columns">
					<label for="mrp" class="right inline">MRP</label>
				</div>
				<div class="medium-5 end columns">
					<input type="text" name="mrp" id="mrp" value="{{ $product->mrp }}">
				</div>
			</div>
			<div class="row">
				<div class="medium-2 columns">
					<label for="desc" class="right inline">Description</label>
				</div>
				<div class="medium-5 end columns">
					<textarea name="description" id="desc">{{ $product->description->description }}</textarea>
				</div>
			</div>				
			<div class="row">
				<div class="medium-2 columns">
					<label for="image1" class="right inline">Images</label>
				</div>
				<div class="medium-10 columns thumb-inputs-wrapper" id="thumb-inputs-wrapper" >
					<div class="row">
						@foreach ($product->images as $image)
							<div class="medium-2 end columns">
								<div class="file-inp-container">
									<input type="file" name="prod_image[]" class="thumb-input" data-fresh="old" data-prod-id="{{ $product->id }}" data-image-id="{{ $image->id }}">
									<img src="images/products/{{ $image->image_name }}" alt="">
									<button class="button tiny alert remove-thumb-input"><i class="fa fa-close"></i></button>
								</div>
							</div>
						@endforeach
							<div class="medium-2 end columns">
								<div class="file-inp-container">
									<input type="file" name="prod_image[]" class="thumb-input" data-fresh="new">
									<img src="" alt="">
								</div>
							</div>
					</div>
				</div>
			</div>