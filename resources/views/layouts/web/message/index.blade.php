@extends('layouts/web/master_admin')
@section('pageTitle', 'View Messages')
@section('content-subheader', 'List Messages')
@section('main-content')

      <div class="btn-add"><i class="fa fa-plus" aria-hidden="true"></i><a href="{{ route('view-create-inbox') }}"><span>  Add</span></a></div>
      <table id="message" class="table table-bordred table-striped">
          <thead>
                <th>From</th>
                <th>Content</th>
                <th></th>
                <th></th>
          </thead>
          <tbody> 
            @foreach($messages as $message)
              <tr>
                  <td class="{{ $message->read_admin == '0' ? 'primary-font' : '' }}">{{ $message->users->full_name }}</td>
                  <td class="{{ $message->read_admin == '0' ? 'primary-font' : '' }}">{{ $message->title }}</td>
                  <td class="{{ $message->count > 0 ? 'primary-font' : '' }}"><span class="badge label-info">{{ $message->count == 0 ? '' : $message->count }}</span></td>
                  <td>
                      <form action="{{ route('update-inbox', ['id' => $message->id]) }}" id="update{{ $message->id }}" method="post" role="form">
                      {{ csrf_field() }}
                      {{ method_field('PATCH') }}
                        <input type="text" class="hidden" name="read_admin" value="1"/>
                      </form>
                      <button class="btn btn-primary btn-xs" type="submit" form="update{{ $message->id }}"><i class="ionicons ion-chatbubble-working" aria-hidden="true"></i></button>
                      <input type="hidden" name="action" value="update{{ $message->id }}"/>
                  </td>
                  <td>                      
                      <a data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete-{{ $message->id }}" ><span class="glyphicon glyphicon-trash"></span></button></a>
                  </td>
              </tr>

            <!-- Form delete -->
            <div class="modal fade" id="delete-{{ $message->id }}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('delete-inbox', ['id' => $message->id]) }}" id="delete{{ $message->id }}" method="post" role="form">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="text" class="hidden" name="id" value="{{ $message->id }}"/>
                        </form>
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span   class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            <h4 class="modal-title custom_align" id="Heading">Delete this message</h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span>  Are you sure you want to delete this Record?</div>
                        </div>
                        <div class="modal-footer ">

                            <button type="submit" class="btn btn-success" form="delete{{ $message->id }}">
                                <span class="glyphicon glyphicon-ok-sign"></span> Yes
                            </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                <span class="glyphicon glyphicon-remove"></span> No
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
          </tbody>          
      </table>
  <!-- Pagination -->
  {{ $messages->links() }}

	@include('layouts.web.partials.footer')
	
@endsection

@section('script')
<script type="text/javascript">
	
</script>
@endsection