@extends ('site/master')

@section ('content')
@include('site.partials.header_middle')
<div class="full-width account-view">
  <div class="row page-content">
    <div class="small-12 large-10 columns large-centered account-wrapper">
      <div class="row collapse">
        <div class="small-3 columns">
          <div class="side-menu">
            
            <div class="row">
              <ul>
                <li><a href="/account">Profile</a></li>
                <li><a href="/account/myorders">Orders</a></li>
                <li class="active"><a href="/account/myreturns">Returns</a></li>
              </ul>
            </div>  
          </div>
        </div>
        <div class="small-9 columns">
          <div class="tab-content-wrapper">
            

            <div class="row">
              <div class="medium-12 columns">
                <h4>My Returns</h4>
                <table width="100%">
                  <tr>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Reason</th>
                  </tr>
                  @foreach($returns as $return)
                    <tr>
                      <td>{{$return->order_return[0]->orders->product->product_name}}</td>
                      <td>{{$return->order_return[0]->orders->pqty}}</td>
                      
                      <td>{{ Carbon\Carbon::parse($return->created_at)->format('d/m/Y')}}</td>
                      <td>{{$return->reason}}</td>
                    </tr>
                  @endforeach
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<div id="passwordModal" class="reveal-modal small" data-reveal aria-hidden="false" role="dialog">
  <div class="row collapse">
    <div class="medium-6 columns">
      <h4>Change Password</h4>
    </div>
  </div>
  <div class="row reg-wrapper">
    <div class="medium-12 columns">
      {!! Form::open(array('route'=>'account.changepassword')) !!}
        <div class="row">
          <div class="medium-12 columns">
            <label for="password">
              New Password
              <input type="password" name="password" id="password" >
            </label>
          </div>
        </div>
        <div class="row">
          <div class="medium-12 columns">
            <label for="cpassword">
              Confirm Password
              <input type="password" name="cpassword" id="cpassword" >
            </label>
          </div>
        </div>
        <div class="row">
          <div class="medium-6 columns">
            <button class="submit button tiny">Change Password</button>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>
@include('site.partials.footer_middle')
@stop

@section('page-modal')

@stop

@section('scriptsContent')
  
@stop