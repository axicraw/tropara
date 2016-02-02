@extends ('admin/master')
@section ('content')
	<div class="row page-title">
		<div class="medium-6 columns">
			<h3 class="title">Global Settings</h3>
		</div>
	</div>
	<div class="row page-body">
		{!! Form::open(array('route'=>'admin.settings.store')) !!}
		<div class="medium-12 columns">
			<div class="row">
				<div class="medium-2 columns end">
					<label for="appname">App Name</label>
				</div>
				<div class="medium-6 columns end">
					<input id="appname" type="text" name="appname" value="{{$settings['appname']}}">
				</div>
			</div>
			<div class="row">
				<div class="medium-2 columns end">
					<label for="tagline">Tagline</label>
				</div>
				<div class="medium-6 columns end">
					<input id="tagline" type="text" name="tagline" value="{{$settings['tagline']}}">
				</div>
			</div>
			<div class="row">
				<div class="medium-2 columns end">
					<label for="helpline">Helpline</label>
				</div>
				<div class="medium-6 columns end">
					<input id="helpline" type="text" name="helpline" value="{{$settings['helpline']}}">
				</div>
			</div>
			<div class="row">
				<div class="medium-2 columns end">
					<label for="sales">Sales Enquiry</label>
				</div>
				<div class="medium-6 columns end">
					<input id="sales" type="text" name="sales" value="{{$settings['sales']}}">
				</div>
			</div>
			<div class="row">
				<div class="medium-2 columns end">
					<label for="delivery">Delivery Enquiry</label>
				</div>
				<div class="medium-6 columns end">
					<input id="delivery" type="text" name="delivery" value="{{$settings['delivery']}}">
				</div>
			</div>
			<div class="row">
				<div class="medium-2 columns end">
					<label for="fblink">Facebook link</label>
				</div>
				<div class="medium-6 columns end">
					<input id="fblink" type="text" name="fblink" value="{{$settings['fblink']}}">
				</div>
			</div>
			<div class="row">
				<div class="medium-2 columns end">
					<label for="gplink">Google+ link</label>
				</div>
				<div class="medium-6 columns end">
					<input id="gplink" type="text" name="gplink" value="{{$settings['gplink']}}">
				</div>
			</div>
			<div class="row">
				<div class="medium-2 columns end">
					<label for="twitlink">Twitter link</label>
				</div>
				<div class="medium-6 columns end">
					<input id="twitlink" type="text" name="twitlink" value="{{$settings['twitlink']}}">
				</div>
			</div>
			<div class="row">
				<div class="medium-2 columns end">
					<label for="salesemail">Sales email</label>
				</div>
				<div class="medium-6 columns end">
					<input id="salesemail" type="text" name="salesemail" value="{{$settings['salesemail']}}">
				</div>
			</div>
			<div class="row">
			
				<div class="medium-8 columns end">
					<p class="text-right">
						<button type="submit" class="button tiny">Save Settings</button>
					</p>
				</div>
			</div>
		</div>
		{!! Form::close() !!}
	</div>
@stop
@section ('scriptsContent')
<script type="text/javascript" src="js/modals.js"></script>
<script>
		$('a.cate').on('click', function(e){
		e.preventDefault();
	});
</script>

@stop